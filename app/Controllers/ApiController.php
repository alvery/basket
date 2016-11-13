<?php


namespace App\Controllers;

use App\Entity\Basket;
use App\ProductMapper;

class ApiController extends Controller
{
    public function __construct()
    {
        header('Content-Type: application/json');
    }

    // Get all items in store
    public function products(ProductMapper $productMapper){

        echo $productMapper->getAllJSON();
    }

    public function cart(Basket $basket){

        $items = $basket->getItems();

        echo json_encode([
            'data' => [
                'total_sum' => $basket->getTotalSum(),
                'products_count' => count($items),
                'products' => $basket->getItemsArray(),
            ]
        ]);
    }

    public function addItem($product_id, Basket $basket, ProductMapper $productMapper){
        $product = $productMapper->findById($product_id);
        $basket->add($product);
    }

    public function removeItem($product_id, Basket $basket){
        $basket->remove($product_id);
    }




}