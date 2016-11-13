<?php


namespace App\Controllers;

use App\Entity\Basket;
use App\ProductMapper;
use App\JsonAdapter;
use app\StorageAdapterInterface;

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

    public function cart(){

        // Init basket from cookies
//        $basketData = new CookieAdapter('basket');
//        $basket = new Basket($basketData, $productMapper);
        
    }

    public function addItem($product_id){
        echo $product_id;
    }

    public function removeItem($product_id){


    }




}