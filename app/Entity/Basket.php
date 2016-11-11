<?php

namespace App\Entity;

class Basket
{
    protected $items;


    public function __construct()
    {

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
            $total += $item->getPrice();
        }
        return $total;
    }



}