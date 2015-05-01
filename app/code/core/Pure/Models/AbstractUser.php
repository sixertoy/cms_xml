<?php
namespace Pure\Models;

use Doctrine\ORM\EntityRepository;

class AbstractUser extends EntityRepository
{
    /**
     * Verifie si l'utilisateur est de type 'admin'
     * 
     * @param Doctrine\Models\User $user
     */
    public function isAdmin( $user )
    {
        $criteria = array( "role_friendly_name"=>"admin" );
        $admin_role = $this->getEntityManager()->getRepository( "Doctrine\Models\Role" )->findOneBy( $criteria );
        return ( $user->getRole() == $admin_role );
    }
}