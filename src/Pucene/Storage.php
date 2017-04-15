<?php

namespace Pucene;

class Storage
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function save($term, $text)
    {
        $storage = $this->loadStorage();
        if (!array_key_exists($term, $storage)) {
            $storage[$term] = [];
        }

        $storage[$term][] = $text;

        $this->saveStorage($storage);
    }

    public function load($term)
    {
        $storage = $this->loadStorage();
        if (!array_key_exists($term, $storage)) {
            return [];
        }

        return $storage[$term];
    }

    private function loadStorage()
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        return unserialize(file_get_contents($this->filePath));
    }

    private function saveStorage($storage)
    {
        file_put_contents($this->filePath, serialize($storage));
    }
}
