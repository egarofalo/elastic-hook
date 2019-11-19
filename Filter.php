<?php

namespace CoDevelopers\WpHook;

class Filter extends WpHook
{
    public function addHook(string $tag, callable $functionToAdd, int $priority, int $acceptedArgs)
    {
        \add_filter($tag, $functionToAdd, $priority, $acceptedArgs);
    }
}
