<?php

namespace Pucene;

class Index
{
    /**
     * @var Analyzer
     */
    private $analyzer;

    /**
     * @var Storage
     */
    private $storage;

    /**
     * @param Analyzer $analyzer
     * @param Storage $storage
     */
    public function __construct(Analyzer $analyzer, Storage $storage)
    {
        $this->analyzer = $analyzer;
        $this->storage = $storage;
    }

    public function index($text)
    {

    }

    public function search($query)
    {
    }
}
