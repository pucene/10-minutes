<?php

namespace Pucene;

class Analyzer
{
    public function analyze($text)
    {
        return explode(' ', $text);
    }
}
