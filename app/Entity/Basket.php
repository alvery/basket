<?php

namespace App\Entity;

use App\ProductMapper;
use app\StorageAdapterInterface;

class Basket
{
    protected $productMapper;
    protected $items;


    public function __construct(StorageAdapterInterface $cookieItems, ProductMapper $product)
    {
        $this->productMapper = $product;

        foreach($cookieItems->all() as $itemId){
            $this->items[] = $this->productMapper->findById($itemId);
        }
    }

    public function add(Product $item)
    {
        $this->items[] = $item;
    }

    public function remove(Product $item)
    {
        if(isset($this->items[$item->id])){
            unset($this->items[$item->id]);
        }
    }

    public function getTotalSum() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->price;
        }
        return $total;
    }



}