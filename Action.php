<?php

namespace CoDevelopers\WpHook;

class Action extends WpHook
{
    public function addHook(string $tag, callable $functionToAdd, int $priority, int $acceptedArgs)
    {
        \add_action($tag, $functionToAdd, $priority, $acceptedArgs);
    }
}
