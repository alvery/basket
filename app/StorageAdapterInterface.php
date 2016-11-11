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
     * @param $id
     * @return mixed
     */
    public function find($id);

}