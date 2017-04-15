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
        $terms = $this->analyzer->analyze($text);

        foreach ($terms as $term) {
            $this->storage->save($term, $text);
        }

        return $text;
    }

    public function search($query)
    {
        $terms = $this->analyzer->analyze($query);

        $hits = [];
        foreach ($terms as $term) {
            $hits = array_merge($hits, $this->storage->load($term));
        }

        return $hits;
    }
}
