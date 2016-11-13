<?php

namespace App;

class CookieAdapter implements StorageAdapterInterface
{
    /**
     * Cookie name
     * @var string
     */
    private $cookie;

    /**
     * Cookie items
     * @var array
     */
    private $data = [];

    public function __construct(string $cookieName)
    {
        $this->cookie = $cookieName;

        if (isset($_COOKIE[$this->cookie]))
        {
            $this->data = json_decode($_COOKIE[$this->cookie], true);
        }
        else
        {
            $this->data = [];
        }

    }

    /**
     * Add item with product_id to cookie
     * @param $id
     */
    public function add($id){

        $this->data[] = $id;
        $this->update();

    }

    /**
     * Remove item with product_id from cookie
     * @param $id
     */
    public function remove($id){

        foreach($this->data as $key => $item_id){
            if($id == $item_id){
                unset($this->data[$key]);
                $this->update();
                return;
            }
        }

    }

    public function update(){
        setcookie($this->cookie, json_encode($this->data), time()+3600, '/');
    }

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        foreach($this->data as $key => $item_id){
            if($id == $item_id){
                return $id;
            }
        }
        return null;
    }


    /**
     * @inheritdoc
     */
    public function all(){
        return $this->data;
    }
}