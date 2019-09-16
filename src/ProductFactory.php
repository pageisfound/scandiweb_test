<?php

require_once 'AbstractProduct.php';
require_once 'ProductTypes/Disc.php';
require_once 'ProductTypes/Furniture.php';
require_once 'ProductTypes/Plate.php';

class ProductFactory
{
    /**
     * @param array $data
     * @return mixed
     */
    public function build(array $data)
    {
        $type = $data['type'] ?? '';
        if (empty($type) || $type === 'none') {
            throw new RuntimeException('No product type given');
        }

        $className = ucfirst($type);
        if (class_exists($className)) {
            return new $className($data);
        }

        throw new RuntimeException(sprintf('Invalid product type "%s"', $type));
    }
}
