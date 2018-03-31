<?php

/**
 * Actorbar.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComPhotosControllerToolbarActorbar extends ComMediumControllerToolbarActorbar
{
    /**
     * Before controller action.
     *
     * @param KEvent $event Event object
     *
     * @return string
     */
    public function onBeforeControllerGet(KEvent $event)
    {
        parent::onBeforeControllerGet($event);

        $viewer = $this->getController()->viewer;
        $actor = pick($this->getController()->actor, $viewer);
        $layout = pick($this->getController()->getRequest()->layout, 'default');
        $name = $this->getController()->getIdentifier()->name;

        //create title
        if ($layout == 'upload') {
            $this->setTitle(AnTranslator::sprintf('COM-PHOTOS-UPLOAD-PHOTOS', $actor->name));
        } elseif ($name == 'set') {
            $this->setTitle(AnTranslator::sprintf('COM-PHOTOS-HEADER-ACTOR-SETS', $actor->name));
        } else {
            $this->setTitle(AnTranslator::sprintf('COM-PHOTOS-HEADER-ACTOR-PHOTOS', $actor->name));
        }

        //create navigations
        $this->addNavigation('photos',
            AnTranslator::_('COM-PHOTOS-LINKS-PHOTOS'),
            array('option' => 'com_photos', 'view' => 'photos', 'oid' => $actor->uniqueAlias),
            $name == 'photo' && (in_array($layout, array('default', 'add', 'masonry'))));

        if ($actor->photos->getTotal() > 0) {
            $this->addNavigation('sets', AnTranslator::_('COM-PHOTOS-LINKS-SETS'),
            array('option' => 'com_photos', 'view' => 'sets', 'oid' => $actor->uniqueAlias),
            $name == 'set' && in_array($layout, array('default', 'add', 'edit')));
        }
    }
}
