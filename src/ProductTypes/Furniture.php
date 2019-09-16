<?php

class Furniture extends AbstractProduct
{
    /** @var int $height */
    private $height;

    /** @var int $width */
    private $width;

    /** @var int $length */
    private $length;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->height = (int)strip_tags(trim($data['height'] ?? 0));
        $this->width = (int)strip_tags(trim($data['width'] ?? 0));
        $this->length = (int)strip_tags(trim($data['length'] ?? 0));
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->height . 'x' . $this->width . 'x' . $this->length;
    }

    /**
     * @return string
     */
    public function getAttributeName(): string
    {
        return 'Dimensions';
    }

    public function validate(): void
    {
        parent::validate();

        if ($this->height <= 0) {
            throw new RuntimeException('Height is invalid');
        }
        if ($this->width <= 0) {
            throw new RuntimeException('Width is invalid');
        }
        if ($this->length <= 0) {
            throw new RuntimeException('Length is invalid');
        }
    }
}
