<?php

require_once 'Database.php';
require_once 'AbstractProduct.php';

class ProductRepository
{
    /** @var Database $database */
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * @return array
     */
    public function readAll(): array
    {
        $query     = 'SELECT * FROM ' . $this->database->getTableName();
        $statement = $this->database->getConnection()->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param AbstractProduct $product
     * @return bool
     */
    public function create(AbstractProduct $product): bool
    {
        $sku = $product->getSku();
        $name = $product->getName();
        $price = $product->getPrice();
        $type = $product->getType();
        $attribute = $product->getAttribute();

        $query = 'INSERT INTO ' . $this->database->getTableName() .
            ' SET sku=:sku, name=:name, price = :price, type = :type, attribute = :attribute';

        $statement = $this->database->getConnection()->prepare($query);
        $statement->bindParam(':sku', $sku);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':attribute', $attribute);

        return $statement->execute();
    }

    /**
     * @param array $idArray
     * @return bool
     */
    public function deleteSelected(array $idArray): bool
    {
        $idList    = implode(',', $idArray);
        $query     = 'DELETE FROM ' . $this->database->getTableName() . ' WHERE id IN (' . $idList . ')';
        $statement = $this->database->getConnection()->prepare($query);

        return $statement->execute();
    }
}
