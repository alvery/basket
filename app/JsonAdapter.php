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
        $data = json_decode(file_get_contents($path), true);

        foreach($data['items'] as $item){
            $this->data[$item['id']] = $item;
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