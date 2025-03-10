<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderDetailRepository::class)]
class OrderDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $myOrder = null;

    #[ORM\Column(length: 255)]
    private ?string $productName = null;

    #[ORM\Column(length: 255)]
    private ?string $productIllustration = null;

    #[ORM\Column]
    private ?int $productQuantity = null;

    #[ORM\Column]
    private ?float $productPrice = null;
    
    #[ORM\Column(name: "product_tva", type: "float")]
    private ?float $productTva = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMyOrder(): ?Order
    {
        return $this->myOrder;
    }

    public function setMyOrder(?Order $myOrder): static
    {
        $this->myOrder = $myOrder;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): static
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductIllustration(): ?string
    {
        return $this->productIllustration;
    }

    public function setProductIllustration(string $productIllustration): static
    {
        $this->productIllustration = $productIllustration;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }

    public function setProductQuantity(int $productQuantity): static
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    /**
     * On créé une méthode qui nous permettre de calculer le prix TTC de notre produit qu'on appellera après dans notre 
     * boucle foreach de notre class PayementController avec Stripe 
     */

    public function getProductPriceWt()
    {
        $coeff = 1 + ($this->productTva/100);
        
        return $coeff * $this->productPrice;

    }

    public function getProductPrice(): ?float
    {
        return $this->productPrice;
    }

    public function setProductPrice(float $productPrice): static
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    public function getProductTva(): ?float
    {
        return $this->productTva;
    }

    public function setProductTva(float $prductTva): static
    {
        $this->productTva = $prductTva;

        return $this;
    }
}
