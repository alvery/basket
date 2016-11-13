<?php


namespace App;

use App\Entity\Product;

class ProductMapper
{
    /**
     * @var StorageAdapterInterface
     */
    private $adapter;

    /**
     * ProductMapper constructor.
     * @param StorageAdapterInterface $storage
     */
    public function __construct(StorageAdapterInterface $storage)
    {
        $this->adapter = $storage;
    }


    /**
     * Finds product with id
     * @param int $id
     * @return Product
     */
    public function findById(int $id)
    {
        $result = $this->adapter->find($id);

        if ($result === null) {
            throw new \InvalidArgumentException("Product #$id not found");
        }

        return $this->mapToEntity($result);
    }


    /**
     * Get all products
     * @return mixed
     */
    public function getAll(){

        $items = [];
        foreach($this->adapter->all() as $item){
            $items[] = $this->mapToEntity($item);
        }

        return $items;
    }


    public function getAllJSON(){

        $items = [];
        foreach($this->getAll() as $item){
            $items[] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'description' => $item->description
            ];
        }

        return json_encode($items);
    }


    /**
     * Map data to entity
     * @param array $row
     * @return Product
     */
    private function mapToEntity(array $row)
    {
        return Product::fromState($row);
    }
}