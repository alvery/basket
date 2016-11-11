<?php

/**
 * Подключение psr-4 autoload через composer
 */
require __DIR__.'/../vendor/autoload.php';

use App\Basket;
use App\Product;
use App\ProductMapper;
use App\JsonAdapter;



//$cart = new Basket();
$storage = new JsonAdapter(__DIR__.'/../storage/data.json');
//$mapper = new ProductMapper($storage);