<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('invoice_items')]
class InvoiceItem
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column('invoice_id')]
    private int $invoiceId;

    #[Column]
    private string $description;

    #[Column]
    private int $quantity;

    #[Column('unit_price', type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $unitPrice;

    #[Column('created_at')]
    private \DateTime $createdAt;

    #[ManyToOne(inversedBy: 'items')]
    private Invoice $invoice;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return InvoiceItem
     */
    public function setCreatedAt(\DateTime $createdAt): InvoiceItem
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Invoice
     */
    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    /**
     * @param Invoice $invoiceId
     * @return InvoiceItem
     */
    public function setInvoiceId(Invoice $invoice): InvoiceItem
    {
        $this->invoice = $invoice;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return InvoiceItem
     */
    public function setDescription(string $description): InvoiceItem
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return InvoiceItem
     */
    public function setQuantity(int $quantity): InvoiceItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     * @return InvoiceItem
     */
    public function setUnitPrice(float $unitPrice): InvoiceItem
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}