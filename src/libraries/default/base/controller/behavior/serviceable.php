<?php

/**
 * Adds a BREAD action to the controller. It also mixes other behaviors.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class LibBaseControllerBehaviorServiceable extends AnControllerBehaviorAbstract
{
    /**
     * An array of actions to exclude from the
     * default CRUD actions.
     *
     * @var array
     */
    protected $_exclude_actions;

    /**
     * Constructor.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        //inverse of exclude_actions
        if (count($config->only)) {
            $actions = (array) $config['only'];

            $exclude = array();

            foreach ($this->getMethods() as $method) {
                if (strpos($method, '_action') === 0) {
                    $action = strtolower(substr($method, 7));

                    if (!in_array($action, $actions)) {
                        $exclude[] = $action;
                    }
                }
            }

            $config->append(array(
                'except' => $exclude,
            ));
        }

        if ($config->read_only) {
            $config->append(array(
                'except' => array('add', 'edit', 'delete'),
            ));
        }

        $config->append(array(
            'identifiable' => array(),
            'validatable' => array(),
            'committable' => array(),
        ));

        $this->_mixer->addBehavior('identifiable', $config['identifiable']);
        $this->_mixer->addBehavior('validatable', $config['validatable']);
        $this->_mixer->addBehavior('committable', $config['committable']);

        $this->_exclude_actions = (array) $config['except'];

        foreach ($this->_exclude_actions as $i => $action) {
            $this->_exclude_actions[$i] = '_action'.ucfirst($action);
        }
    }

    /**
     * Initializes the default configuration for the object.
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'actions' => array(),
            'read_only' => false,
            'except' => array(),
        ));

        parent::_initialize($config);
    }

    /**
     * Removes the methods that are blacklisted.
     *
     * (non-PHPdoc)
     *
     * @see KMixinAbstract::getMethods()
     */
    public function getMethods()
    {
        $methods = parent::getMethods();
        $methods = array_diff($methods, $this->_exclude_actions);

        return $methods;
    }

    /**
     * Service Browse.
     *
     * @param KCommandContext $context Context parameter
     *
     * @return AnDomainQuery
     */
    protected function _actionBrowse(KCommandContext $context)
    {
        if (!$context->query) {
            $context->query = $this->getRepository()->getQuery();
        }

        $query = $context->query;

        if ($this->q) {
            $query->keyword = $this->getService('anahita:filter.term')->sanitize($this->q);
        }

        if ($this->hasBehavior('parentable') && $this->getParent()) {
            $query->parent($this->getParent());
        }

        if ($this->hasBehavior('ownable') && $this->hasBehavior('pinnable')) {
            $owner = $this->getActor();
            if (isset($owner)) {
                $query->order('pinned', 'DESC');
            }
        }

        switch ($this->sort) {
            case 'top':
                $identifierName = $this->_mixer->getIdentifier()->name;
                $query->order('(COALESCE('.$identifierName.'.comment_count,0) + COALESCE('.$identifierName.'.vote_up_count,0) + COALESCE('.$identifierName.'.subscriber_count,0) + COALESCE('.$identifierName.'.follower_count,0))', 'DESC');
            break;

            case 'updated':
                $query->order('updateTime', 'DESC');
            break;

            case 'oldest':
                $query->order('creationTime', 'ASC');
            break;

            case 'recent':
            case 'newest':
                $query->order('creationTime', 'DESC');
            break;
        }

        $query->limit($this->limit, $this->start);

        return $this->getState()->setList($query->toEntityset())->getList();
    }

    /**
     * Add Action.
     *
     * @param KCommandContext $context Context parameter
     *
     * @return AnDomainEntityAbstract
     */
    protected function _actionAdd(KCommandContext $context)
    {
        $context->response->status = KHttpResponse::CREATED;
        $entity = $this->getRepository()->getEntity()->setData($context['data']);
        $this->setItem($entity);

        return $this->getItem();
    }

    /**
     * Edit Action.
     *
     * @param KCommandContext $context Context parameter
     *
     * @return AnDomainEntityAbstract
     */
    protected function _actionEdit(KCommandContext $context)
    {
        $context->response->status = KHttpResponse::RESET_CONTENT;

        return $this->getItem()->setData($context['data']);
    }

    /**
     * Return the state get item.
     *
     * @return mixed
     */
    protected function _actionRead(KCommandContext $context)
    {
        return $this->getItem();
    }

    /**
     * Delete Action.
     *
     * @param KCommandContext $context Context parameter
     *
     * @return AnDomainEntityAbstract
     */
    protected function _actionDelete(KCommandContext $context)
    {
        $context->response->status = KHttpResponse::NO_CONTENT;
        $entity = $this->getItem()->delete();

        return $entity;
    }
}
