<?php

namespace Fran\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Marcadotecnia\ArticulosBundle\Entity\Autor
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Fran\UserBundle\Entity\UserRepository")
 */
class User implements UserInterface
{
	/**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $username;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", unique="true", type="string", length=255)
     * @Assert\Email()
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\MinLength(6)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $salt;

    public function __construct()
    {
        // Generación aleatoria del salt
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function getRoles()
    {
        return array(
            "ROLE_USER"
        );
    }

    public function eraseCredentials()
    {

    }

    public function equals(UserInterface $user)
    {
        return $this->getEmail() == $user->getEmail() || $this->username == $user->getUsername();
    }
}