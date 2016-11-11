<?php


namespace app;

use App\Entity\Product;

class ProductMapper
{
    /**
     * @var StorageAdapter
     */
    private $adapter;

    /**
     * @param StorageAdapter $storage
     */
    public function __construct(StorageAdapter $storage)
    {
        $this->adapter = $storage;
    }

    /**
     * finds a user from storage based on ID and returns a User object located
     * in memory. Normally this kind of logic will be implemented using the Repository pattern.
     * However the important part is in mapRowToUser() below, that will create a business object from the
     * data fetched from storage
     *
     * @param int $id
     *
     * @return Product
     */
    public function findById(int $id): Product
    {
        $result = $this->adapter->find($id);

        if ($result === null) {
            throw new \InvalidArgumentException("Product #$id not found");
        }

        return $this->mapRowToUser($result);
    }

    private function mapRowToUser(array $row): Product
    {
        return Product::fromState($row);
    }
}