<?php


namespace App\Entity;


class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $description;


    public static function fromState(array $state): Product
    {
        // validate state before accessing keys!

        return new self(
            $state['name'],
            $state['price'],
            $state['description']
        );
    }

    public function __construct($name, $price, $description = '') {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

}