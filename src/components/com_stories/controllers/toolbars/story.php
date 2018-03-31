<?php

/** 
 * LICENSE: ##LICENSE##.
 * 
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @version    SVN: $Id: resource.php 11985 2012-01-12 10:53:20Z asanieyan $
 *
 * @link       http://www.GetAnahita.com
 */

/**
 * Stories Toolbar.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComStoriesControllerToolbarStory extends ComBaseControllerToolbarDefault
{
    /**
     * Set the list commands.
     */
    public function addListCommands()
    {
        $story = $this->getController()->getItem();

        if ($story->authorize('vote')) {
            $this->getController()->setItem($story->object);
            $this->addCommand('vote');
            $this->getController()->setItem($story);
        }

        if ($story->authorize('add.comment')) {
            $this->getController()->setItem($story->object);

            $this->addCommand('comment')
                 ->getCommand('comment')
                 ->storyid($story->id);

            $this->getController()->setItem($story);
        }

        if ($story->numOfComments > 10) {
            $this->addCommand('view');
        }

        if ($story->authorize('delete')) {
            $this->addCommand('delete');
        }
    }

    /**
     * View Stories.
     *
     * @param LibBaseTemplateObject $command The command object
     */
    protected function _commandView($command)
    {
        $entity = $this->getController()->getItem();
        $label = sprintf(AnTranslator::_('COM-STORIES-VIEW-ALL-COMMENTS'), $entity->getNumOfComments());
        $command->append(array('label' => $label));
        $command->href(route($entity->getURL()));
    }

    /**
     * Comment command.
     *
     * @param LibBaseTemplateObject $command The command object
     */
    protected function _commandComment($command)
    {
        $entity = $this->getController()->getItem();

        $command->append(array('label' => AnTranslator::_('LIB-AN-ACTION-COMMENT')))
            ->href(route($entity->getURL()))
            ->class('comment action-comment')
            ->setAttribute('data-action', 'addcomment');
    }

    /**
     * Delete Command for a story.
     *
     * @param LibBaseTemplateObject $command The command object
     */
    protected function _commandDelete($command)
    {
        $entity = $this->getController()->getItem();
        $link = 'option=com_stories&view=story';

        foreach ($entity->getIds() as $id) {
            $link .= '&id[]='.$id;
        }

        $command->append(array('label' => AnTranslator::_('LIB-AN-ACTION-DELETE')))
        ->href(route($link))
        ->setAttribute('data-action', 'delete')
        ->class('action-delete');
    }
}
