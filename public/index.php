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

/**
 * Get all items from JSON file OR CSV
 */
$storage = new JsonAdapter(__DIR__.'/../storage/data.json');

/**
 * Init product mapper
 */
$productMapper = new ProductMapper($storage);

/**
 * Get all items in basket
 */
$basketData = new CookieAdapter('cart');
$basket = new Basket($basketData, $productMapper);

/**
 * Init api controller
 */
$controller = new App\Controllers\ApiController();


/**
 * Register api routes
 */

// GET /api/products
Router::route('/api/products/', function() use($controller, $productMapper){
    $controller->products($productMapper);
});

// POST api/cart
Router::route('/api/cart/add/(\d+)/', function($product_id) use($controller, $basket, $productMapper){
    $controller->addItem($product_id, $basket, $productMapper);
});

// DELETE api/cart
Router::route('/api/cart/delete/(\d+)/', function($product_id) use($controller, $basket){
    $controller->removeItem($product_id, $basket);
});

// GET api/cart
Router::route('/api/cart/', function() use($controller, $basket){
    $controller->cart($basket);
});


Router::execute($_SERVER['REQUEST_URI']);