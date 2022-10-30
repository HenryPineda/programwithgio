<?php

namespace App\Entities;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('tickets')]
class Ticket
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column]
    private string $title;

    #[Column]
    private string $content;

    #[Column('user_id')]
    private int $userId;

    #[Column('template_id')]
    private int $templateId;

    #[Column]
    private \DateTime $created_at;

    #[ManyToOne(inversedBy: 'tickets')]
    private User $user;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Ticket
     */
    public function setTitle(string $title): Ticket
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Ticket
     */
    public function setContent(string $content): Ticket
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param User $user
     * @return Ticket
     */
    public function setUserId(User $user): Ticket
    {
        $this->userId = $user;
        return $this;
    }

    /**
     * @return int
     */
    public function getTemplateId(): int
    {
        return $this->templateId;
    }

    /**
     * @param int $templateId
     * @return Ticket
     */
    public function setTemplateId(int $templateId): Ticket
    {
        $this->templateId = $templateId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     * @return Ticket
     */
    public function setCreatedAt(\DateTime $created_at): Ticket
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     * @return Ticket
     */
    public function setUpdatedAt(\DateTime $updated_at): Ticket
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    #[Column]
    private \DateTime $updated_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}