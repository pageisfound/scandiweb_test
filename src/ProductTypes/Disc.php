<?php

class Disc extends AbstractProduct
{
    /** @var int $size */
    private $size;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->size = (int)strip_tags(trim($data['size'] ?? 0));
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->size . ' MB';
    }

    /**
     * @return string
     */
    public function getAttributeName(): string
    {
        return 'Size';
    }

    public function validate(): void
    {
        parent::validate();

        if ($this->size <= 0) {
            throw new RuntimeException('Size is invalid');
        }
    }
}
