<?php

namespace CoDevelopers\Elastic\Component;

abstract class Hook implements \ArrayAccess
{
    protected $hooks;

    public function __construct()
    {
        $this->hooks = [];
    }

    public function offsetExists($offset): bool
    {
        return isset($this->hooks[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->hooks[$offset]) ? $this->hooks[$offset] : null;
    }

    public function offsetSet($offset, $value): void
    {
        // if the offset is not a string, do nothing
        if (!is_string($offset)) {
            return;
        }

        // check if the value is a callable or an array with a callable
        if (!(is_callable($value) || (is_array($value) && is_callable($value['function_to_add'])))) {
            return;
        }

        // create the hook array (action or filter)
        $hook = [
            'function_to_add' => is_callable($value) ? $value : $value['function_to_add'],
            'priority' => is_array($value) && isset($value['priority']) ? $value['priority'] : 10,
            'accepted_args' => is_array($value) && isset($value['accepted_args']) ? $value['accepted_args'] : 1,
        ];

        // set a single hook
        $this->hooks[$offset][] = $hook;
    }

    public function offsetUnset($offset): void
    {
        unset($this->hooks[$offset]);
    }

    abstract public function addHook(string $tag, callable $functionToAdd, int $priority, int $acceptedArgs);

    public function __invoke()
    {
        foreach ($this->hooks as $tag => $hooks) {
            $this->addHooks($tag, $hooks);
        }
        $this->hooks = [];
    }

    private function addHooks(string $tag, array $hooks)
    {
        foreach ($hooks as $hook) {
            $this->addHook($tag, $hook['function_to_add'], $hook['priority'], $hook['accepted_args']);
        }
    }
}
