<?php

namespace CoDevelopers\Elastic\Component;

class Filter extends Hook
{
    public function addHook(string $tag, callable $functionToAdd, int $priority, int $acceptedArgs)
    {
        \add_filter($tag, $functionToAdd, $priority, $acceptedArgs);
    }
}
