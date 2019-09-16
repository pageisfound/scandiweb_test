<?php

abstract class AbstractProduct
{
    /** @var string $sku */
    private $sku;

    /** @var string $name */
    private $name;

    /** @var float $price */
    private $price;

    /** @var string $type */
    private $type;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        // data sanitization
        $this->sku = htmlspecialchars(strip_tags(trim($data['sku'] ?? '')));
        $this->name = htmlspecialchars(strip_tags(trim($data['name'] ?? '')));
        $this->price = (float)strip_tags(trim($data['price'] ?? 0));
        $this->type = htmlspecialchars(strip_tags(trim($data['type'] ?? '')));
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    abstract public function getAttribute(): string;

    /**
     * @return string
     */
    abstract public function getAttributeName(): string;

    public function validate(): void
    {
        if (strlen($this->sku) < 3) {
            throw new RuntimeException('SKU is too short');
        }
        if (strlen($this->name) < 3) {
            throw new RuntimeException('Name is too short');
        }
        if ($this->price <= 0) {
            throw new RuntimeException('Price is invalid');
        }
    }
}
