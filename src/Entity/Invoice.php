<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 * @ApiResource(
 * attributes={
 *     "pagination_enabled"=true,
 *     "pagination_items_per_page"=20,
 *     "order": {"sentAt":"desc"}
 *  },
 * subresourceOperations={
 *      "api_customers_invoices_get_subresource"={
 *          "normalization_context"={"groups"={"invoices_subresource"}}
 * }
 * },
 *  itemOperations={"GET", "PUT", "DELETE", "increment"={
 *       "method"="post", 
 *       "path"="/invoices/{id}/increment", 
 *       "controller"="App\Controller\InvoiceIncrementationController", 
 *       "openapi_context"={
 *          "summary"="Incrémente une facture",
 *          "description"="Incrémente le chrono d'une facture donnée"
 *       }
 *     }
 *  },
 * normalizationContext={"groups"={"invoices_read"}},
 * denormalizationContext={"disable_type_enforcement"=true}
 * )
 * @ApiFilter(OrderFilter::class, properties={"amount","sentAt"})
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"invoices_read", "customers_read", "invoices_subresource"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"invoices_read", "customers_read", "invoices_subresource"})
     * @Assert\NotBlank(message="le montant de la facture est obligatoire")
     * @Assert\Type(type="numeric", message="le montant de la facuture doit etre numerique !")
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"invoices_read", "customers_read"})
     * @Assert\Type(type="\DateTimeInterface", message="la date doit etre au format YYYY-MM-DD")
     * @Assert\NotBlank(message="la date doit etre renseigner")
     */
    private $sentAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"invoices_read", "customers_read", "invoices_subresource"})
     * @Assert\NotBlank(message="status obligatoire")
     * @Assert\Choice(choices={"SENT", "PAID", "CANCELLED"}, message="le status doit etre sent, paid ou cancelled")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="invoices")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"invoices_read", "invoices_subresource"})
     * @Assert\NotBlank(message="le client de la facture doit etre renseigner")
     */
    private $customer;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"invoices_read", "customers_read"})
     * @Assert\NotBlank(message="il faut absolument un chrono pour la facture")
     * @Assert\Type(type="integer", message="le chrono doit etre un nombre")
     */
    private $chrono;

    /**
     * @Groups({"invoices_read", "invoices_subresource", "invoices_subresource"})
     */
    public function getUser() : User {
        return $this->customer->getUser(); 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt($sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getChrono(): ?int
    {
        return $this->chrono;
    }

    public function setChrono($chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }
}
