<?php

namespace App;

class JsonAdapter implements StorageAdapterInterface
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(string $path)
    {
        $data = file_get_contents($path);
        $this->data = json_decode($data, true);
        var_dump($this->data);
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