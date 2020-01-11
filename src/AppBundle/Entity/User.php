<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_USER = 'ROLE_USER';

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

    // Useful with more than 2 roles
    public function getHigherRole()
    {
        $rolesSortedByImportance = [self::ROLE_SUPER_ADMIN, self::ROLE_USER]; /*form roles here */
        foreach ($rolesSortedByImportance as $role) {
            if (in_array($role, $this->roles)) {
                return $role;
            }
        }
    }
    
    public function upRole()
    {
        return $newRole = 'ROLE_SUPER_ADMIN';
    }
    
    public function downRole()
    {
        return $newRole = 'ROLE_USER';
    }
}
