<?php

namespace App;

class CookieAdapter implements StorageAdapterInterface
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(string $cookieName)
    {
        if (isset($_COOKIE[$cookieName]))
        {
            $this->data = json_decode($_COOKIE[$cookieName]);
        }
        else
        {
            $this->data = [];
        }

    }

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
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