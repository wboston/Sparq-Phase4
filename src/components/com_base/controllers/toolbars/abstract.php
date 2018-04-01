<?php

/**
 * Abstract Toolbar.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
abstract class ComBaseControllerToolbarAbstract extends AnControllerToolbarAbstract
{
    /**
     * Constructor.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        //commands is template objects container
        $this->_commands = new LibBaseTemplateObjectContainer();
    }

    /**
     * The toolbar description.
     *
     * @var string
     */
    protected $_description = '';

    /**
     * Set the toolbar's description.
     *
     * @param string $description
     *
     * @return ComBaseControllerToolbarAbstract
     */
    public function setDescription($description)
    {
        $this->_description = $description;

        return $this;
    }

    /**
     * Get the toolbar's description.
     *
     * @return string Description
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Resets the commands container.
     */
    public function reset()
    {
        $this->_commands->reset();
    }

    /**
     * Add a command.
     *
     * @param string $command Comamd name
     * @param array  $config  Parameters to be passed to the command
     *
     * @return AnControllerToolbarAbstract
     */
    public function addCommand($command, $config = array())
    {
        if (!($command instanceof LibBaseTemplateObjectInterface)) {
            $command = $this->getCommand($command, $config);
        }

        $this->_commands[$command->getName()] = $command;

        return $this;
    }

    /**
     * Get a command by name.
     *
     * @param string The command name
     * @param array  An optional associative array of configuration settings
     *
     * @see LibBaseTemplateObject
     *
     * @return LibBaseTemplateObject Return a template object
     */
    public function getCommand($name, $config = array())
    {
        if (!isset($this->_commands[$name])) {
            if (!is_array($config)) {
                $config = array('label' => $config);
            }

            //Create the config object
            $command = ComBaseControllerToolbarCommand::getInstance($name, $config);

            //Find the command function to call
            if (method_exists($this, '_command'.ucfirst($name))) {
                $function = '_command'.ucfirst($name);
                $this->$function($command);
            } else {
                //Don't set an action for GET commands
                if (!isset($command->attribs->href)) {
                    $command->append(array(
                        'attribs' => array(
                            'data-action' => $command->getName(),
                        ),
                    ));
                }
            }
        } else {
            $command = $this->_commands[$name];
        }

        return $command;
    }

    /**
     * Clones the toolbar.
     */
    public function __clone()
    {
        $this->_commands = clone $this->_commands;
    }
}
