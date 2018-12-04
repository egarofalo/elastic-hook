<?php

namespace CoDevelopers\Elastic\Component;

class Action extends Hook
{
    public function addHook(string $tag, callable $functionToAdd, int $priority, int $acceptedArgs)
    {
        \add_action($tag, $functionToAdd, $priority, $acceptedArgs);
    }
}
