<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('app_users')]
class User
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column('full_name')]
    private string $fullName;

    #[Column]
    private string $email;

    #[Column('created_at')]
    private \DateTime $createdAt;

    #[OneToMany(targetEntity: Ticket::class, mappedBy: 'user', cascade: ['persist', 'remove'])]
    private Collection $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return User
     */
    public function setFullName(string $fullName): User
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt(\DateTime $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getTickets(): ArrayCollection|Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket)
    {
        $ticket->setUserId($this);
        $this->tickets->add($ticket);
    }

}