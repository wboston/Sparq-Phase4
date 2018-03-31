<?php

/**
 * Service User.
 *
 * @category   Anahita
 *
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComConnectOauthUser
{
    /**
     * Instantiate an oauth user using the its attributes.
     *
     * @param array $attributes
     */
    public function __construct($attributes = array())
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Profile URL.
     *
     * @var string
     */
    public $profile_url;

    /**
     * Id.
     *
     * @var string
     */
    public $id;

    /**
     * Username.
     *
     * @var string
     */
    public $username;

    /**
     * Email.
     *
     * @var string
     */
    public $email;

    /**
     * Description.
     *
     * @var string
     */
    public $description;

    /**
     * Name.
     *
     * @var string
     */
    public $name;

    /**
     * Large Avatar.
     *
     * @var string
     */
    public $large_avatar;

    /**
     * Thumb Avatar.
     *
     * @var string
     */
    public $thumb_avatar;
}
