<?php

namespace Pure\Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pure\Models\Role
 *
 * @ORM\Entity()
 * @ORM\Table(name="pr_roles")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $role_id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $label;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="role_id", nullable=false)
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Set the value of role_id.
     *
     * @param integer $role_id
     * @return \Pure\Models\Role
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }

    /**
     * Get the value of role_id.
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Set the value of label.
     *
     * @param string $label
     * @return \Pure\Models\Role
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the value of label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Pure\Models\Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add User entity to collection (one to many).
     *
     * @param \Pure\Models\User $user
     * @return \Pure\Models\Role
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Get User entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function __sleep()
    {
        return array('role_id', 'label', 'name');
    }
}