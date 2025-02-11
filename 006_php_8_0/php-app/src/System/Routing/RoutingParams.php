<?php

namespace App\System\Routing;

class RoutingParams implements RoutingParamsInterface
{
    public function __construct(
        private mixed $callback,
        private mixed $arguments,
    )
    {}
    
    public function getCallback(): mixed
    {
        return $this->callback;
    }
    
    public function getArguments(): mixed
    {
        return $this->arguments;
    }
}