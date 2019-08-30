<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    public function getHigherRole()
    {
        $rolesSortedByImportance = ['ROLE_SUPER_ADMIN', 'ROLE_USER']; /*add roles here */
        foreach ($rolesSortedByImportance as $role)
        {
            if (in_array($role, $this->roles))
            {
                return $role;
            }
        }
    }
    
    public function upRole()
    {
        $currentRole = $this->getHigherRole();
        /*Conditions are here if we like to to add roles */
        if ($currentRole == 'ROLE_SUPER_ADMIN')
        {
            return $currentRole;
        }
        else
        {
            return $newRole = 'ROLE_SUPER_ADMIN';
        }
    }
    
    public function downRole()
    {
        $currentRole = $this->getHigherRole();
        
        if ($currentRole == 'ROLE_SUPER_ADMIN')
        {
            return $newRole = 'ROLE_USER';
        }
        else
        {
            return $newRole = 'ROLE_USER';
        }
    }
}
