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
     * @param int $id
     *
     * @return array|null
     */
    public function find($id)
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        return null;
    }
}