<?php

/**
 * Comment Entity.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComBaseDomainEntityComment extends ComBaseDomainEntityNode
{
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
            'inheritance' => array(
                'abstract' => $this->getIdentifier()->package == 'base', ),
            'attributes' => array(
                'body' => array(
                'required' => AnDomain::VALUE_NOT_EMPTY,
                'format' => 'string' 
                ),
            ),
            'behaviors' => array(
                'parentable' => array(
                    'parent' => 'com:base.domain.entity.node', ),
                    'com:hashtags.domain.behavior.hashtagable',
                    'com:people.domain.behavior.mentionable',
                    'modifiable',
                    'authorizer',
                    'locatable',
                    'votable', ),
        ));

        parent::_initialize($config);
    }

    /**
     * Returns the URL for a comment.
     *
     * @return string
     */
    public function getURL()
    {
        return $this->parent->getURL().'&cid='.$this->id;
    }

    /**
     * Validating Entity.
     *
     * KCommandContext $context Context
     */
    protected function _onEntityValidate(KCommandContext $context)
    {
        $this->parent->getRepository()
                     ->getBehavior('commentable')
                     ->sanitizeComments(array($this));
    }

    /**
     * Resets the comment stats.
     *
     * KCommandContext $context Context
     */
    protected function _afterEntityInsert(KCommandContext $context)
    {
        $this->parent->getRepository()
                     ->getBehavior('commentable')
                     ->resetStats(array($this->parent));
        $this->parent->execute('after.comment', array('comment' => $this));
    }

    /**
     * Resets the comment stats.
     *
     * KCommandContext $context Context
     */
    protected function _afterEntityDelete(KCommandContext $context)
    {
        $this->parent->getRepository()
                     ->getBehavior('commentable')
                     ->resetStats(array($this->parent));
    }
}
