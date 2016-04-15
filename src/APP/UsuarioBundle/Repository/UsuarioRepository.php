<?php

namespace APP\UsuarioBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * UsuarioBundle
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsuarioRepository extends EntityRepository implements UserLoaderInterface
{
    
    
    public function buscarporUserorEmail($user){
        return  $this->createQueryBuilder('u')
                ->where('u.email=:email')
                ->setParameter('email', $user)
                ->getQuery()
                ->getOneOrNullResult();
    }

    public function loadUserByUsername($username) {
        $user = $this->buscarporUserorEmail($username);
        if(!$user){
            throw new UsernameNotFoundException("opps nao passo nao em");
        }
        return $user;
    }

    public function refreshUser(UserInterface $user) {
        $class = get_class($user);
        if(!$this->supportsClass($class)){
            
            throw new UnsupportedUserException("ops problemao");
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class) {
        return $this->getEntityName()==$class ||  is_subclass_of($class, $this->getEntityName()) ;
    }

}
