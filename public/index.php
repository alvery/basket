<?php

/**
 * Подключение psr-4 autoload через composer
 */
require __DIR__.'/../vendor/autoload.php';

use App\Entity\Basket;
use App\ProductMapper;
use App\JsonAdapter;
use App\CookieAdapter;
use App\Router;

$controller = new App\Controllers\ApiController();

Router::route('/api/products/', function() use($controller){
    $controller->products();
});

// DELETE api/cart/{product_id}
Router::route('/api/cart/(\d+)', function($product_id){

});


Router::execute($_SERVER['REQUEST_URI']);

// Get all items in store
$storage = new JsonAdapter(__DIR__.'/../storage/data.json');
$productMapper = new ProductMapper($storage);

// Init basket from cookies
$basketData = new CookieAdapter('basket');
$basket = new Basket($basketData, $productMapper);
