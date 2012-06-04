<?php

namespace Fran\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Marcadotecnia\ArticulosBundle\Entity\Autor
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Fran\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
	/**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** 
     * @ORM\Column(name="twitter_id", type="string", length=255)
     * @var string
     */
    protected $twitterID;

    /** 
     * @ORM\Column(name="twitter_username", type="string", length=255)
     * @var string
     */
    protected $twitter_username;

    public function __construct()
    {
        parent::__construct();
    }

    public function getRoles()
    {
        return array(
            "ROLE_USER"
        );
    }

    /**
     * Set twitterID
     *
     * @param string $twitterID
     */
    public function setTwitterID($twitterID)
    {
        $this->twitterID = $twitterID;
        $this->setUsername($twitterID);
        $this->salt = '';
    }

    /**
     * Get twitterID
     *
     * @return string 
     */
    public function getTwitterID()
    {
        return $this->twitterID;
    }

    /**
     * Set twitter_username
     *
     * @param string $twitterUsername
     */
    public function setTwitterUsername($twitterUsername)
    {
        $this->twitter_username = $twitterUsername;
    }

    /**
     * Get twitter_username
     *
     * @return string 
     */
    public function getTwitterUsername()
    {
        return $this->twitter_username;
    }

    public function equals(UserInterface $user)
    {
        return $this->getEmail() == $user->getEmail() || $this->username == $user->getUsername();
    }
}