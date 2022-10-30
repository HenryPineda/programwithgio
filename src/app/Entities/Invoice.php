<?php

namespace App\Entities;

use App\Enums\InvoiceStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Doctrine\DBAL\Types\Types;

#[Entity]
#[Table('invoices')]
class Invoice
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $amount;

    #[Column('user_id')]
    private int $userId;

    #[Column]
    private InvoiceStatus $status;

    #[Column]
    private \DateTime $created_at;

    #[Column(name: 'due_date')]
    private \DateTime $dueDate;

    /**
     * @return \DateTime
     */
    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     * @return Invoice
     */
    public function setDueDate(\DateTime $dueDate): Invoice
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    #[Column('invoice_number')]
    private string $invoiceNumber;

    #[OneToMany(targetEntity: InvoiceItem::class, mappedBy: 'invoice', cascade: ['persist', 'remove'])]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Invoice
     */
    public function setAmount(float $amount): Invoice
    {
        $this->amount = $amount;
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
     * @param int $userId
     * @return Invoice
     */
    public function setUserId(int $userId): Invoice
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return InvoiceStatus
     */
    public function getStatus(): InvoiceStatus
    {
        return $this->status;
    }

    /**
     * @param InvoiceStatus $status
     * @return Invoice
     */
    public function setStatus(InvoiceStatus $status): Invoice
    {
        $this->status = $status;
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
     * @return Invoice
     */
    public function setCreatedAt(\DateTime $created_at): Invoice
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     * @return Invoice
     */
    public function setInvoiceNumber(string $invoiceNumber): Invoice
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    /**
     * @param InvoiceItem $item
     * @return $this
     */
    public function addItem(InvoiceItem $item): Invoice
    {
        $item->setInvoiceId($this);

        $this->items->add($item);

        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getItems(): ArrayCollection|Collection
    {
        return $this->items;
    }

}