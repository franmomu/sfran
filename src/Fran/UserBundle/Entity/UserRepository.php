<?php

namespace Fran\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository implements UserProviderInterface 
{
	function loadUserByUsername($username)
    {
        $qb = $this->createQueryBuilder('u');
        $qb->where(
	            $qb->expr()->orx(
	                $qb->expr()->like('u.username' ,':username') ,
	                $qb->expr()->like('u.email' ,':username')
	            )
        	)
        	->setParameter('username', $username)
        ;
        return $qb->getQuery()->getSingleResult();                  
    }

    function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername() );
    }

    function supportsClass($class)
    {
        return $class === 'Fran\UserBundle\Entity\User';
    }

}