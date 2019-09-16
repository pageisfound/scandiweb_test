<?php

class Plate extends AbstractProduct
{
    /** @var float $weight */
    private $weight;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->weight = (float)strip_tags(trim($data['weight'] ?? 0));
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->weight . ' KG';
    }

    /**
     * @return string
     */
    public function getAttributeName(): string
    {
        return 'Weight';
    }

    public function validate(): void
    {
        parent::validate();

        if ($this->weight <= 0) {
            throw new RuntimeException('Weight is invalid');
        }
    }
}
