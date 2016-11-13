<?php

namespace App\Entity;

use App\ProductMapper;
use app\StorageAdapterInterface;

class Basket
{
    protected $productMapper;
    protected $cookieAdapter;
    protected $items;


    public function __construct(StorageAdapterInterface $cookieAdapter, ProductMapper $product)
    {
        $this->productMapper = $product;
        $this->cookieAdapter = $cookieAdapter;

        foreach($this->cookieAdapter->all() as $itemId){
            $this->items[] = $this->productMapper->findById($itemId);
        }

        //var_dump($this->items);
    }

    /**
     * Return product items
     * @return mixed
     */
    public function getItems(){
        return $this->items;
    }


    /**
     * Get items for output
     */
    public function getItemsArray(){

        $response = [];
        foreach($this->items as $item){
            $response[$item->id] = [
                'id' => $item->id,
                'quantity' => $this->getItemCount($item->id),
                'sum' => $this->getItemSum($item->id),
            ];
        }

        return $response;
    }

    public function add(Product $item)
    {
        $this->cookieAdapter->add($item->id);
    }

    public function remove($product_id)
    {
        $this->cookieAdapter->remove($product_id);
    }

    public function getTotalSum() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->price;
        }
        return $total;
    }

    public function getItemCount($id){
        $cnt = 0;
        foreach ($this->items as $item) {
            if($id == $item->id){
                $cnt++;
            }
        }
        return $cnt;
    }

    public function getItemSum($id){
        $sum = 0;
        foreach ($this->items as $item) {
            if($id == $item->id){
                $sum+= $item->price;
            }
        }
        return $sum;
    }



}