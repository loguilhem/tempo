<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @UniqueEntity(fields={"email", "username"}, message="There is already an account with this email")
 */
class User implements UserInterface, \Serializable
{
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=180, unique=true, nullable=false)
     */
    protected $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=180, unique=true, nullable=false)
     */
    protected $email;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    /**
     * Encrypted password. Must be persisted.
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     *
     * @var string
     */
    protected $password;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @var string|null
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    protected $confirmationToken;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $passwordRequestedAt;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    protected $roles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="members" ,cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->enabled = false;
        $this->roles = [];
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->enabled,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->enabled,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }
    
    /**
     * getUsername
     *
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }
    
    /**
     * Auto generate Username from email user's 
     *
     * @return self
     */
    public function generateUsername() :self
    {
        $username = $this->getEmail();
        $this->username = $username;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): self 
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setEnabled(bool $isEnabled): self
    {
        $this->enabled = $isEnabled;

        return $this;
    }


    /**
    * @return array
    */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }


    /**
    * @param array $roles
    *
    * @return self
    */
    public function setRoles(array $roles) :self
    {
        foreach($roles AS $role)
            $this->addRole($role);

        return $this;
    }


    /**
    * @param string $role
    *
    * @return self
    */
    public function addRole(string $role): self
    {
        if(!in_array($role, $this->roles))
            $this->roles[] = $role;

        return $this;
    }

    /**
    * @param string $role
    *
    * @return self
    */
    public function removeRole(string $role): self
    {
        foreach($this->roles AS $k => $r)
            if($r === $role)
                unset($this->roles[$k]);

        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmationToken(): string
    {
        return $this->confirmationToken;
    }

    /**
     * @param string $resetToken
     */
    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    public function setlastLogin(\DateTime $dateTime): self
    {
        $this->lastLogin = $dateTime;

        return $this;
    }

    /**
     * @return array
     * Return the current role, the previous role, the next role
     */
    public function getLowerAndHigherRole(): ?array
    {
        $roles = [];
        $rolesSortByImportance = [User::ROLE_USER, User::ROLE_ADMIN, User::ROLE_SUPER_ADMIN];

        foreach ($rolesSortByImportance as $key => $role) {
            if (in_array($role, $this->roles)) {
                $roles['actual'] = $role;
                $roles['previous'] = isset($rolesSortByImportance[$key-1]) ? $rolesSortByImportance[$key-1] : $rolesSortByImportance[$key];
                $roles['next'] = isset($rolesSortByImportance[$key+1]) ? $rolesSortByImportance[$key+1] : $rolesSortByImportance[$key];

                return $roles;
            }
        }
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
