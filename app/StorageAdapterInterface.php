<?php
/**
 * Created by PhpStorm.
 * User: alvery
 * Date: 11.11.16
 * Time: 23:47
 */

namespace app;


interface StorageAdapterInterface
{

    /**
     * Find item
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Return all items
     * @return mixed
     */
    public function all();

}