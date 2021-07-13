<?php

namespace App\Helpers;

class apiHelper
{

    public $base = 'http://dnd/api/';

    public function createLink($cat, $item)
    {
        return $this->base . "$cat/$item";
    }
}
