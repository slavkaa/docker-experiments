<?php

namespace App\System\Routing;

interface RoutingParamsInterface
{
    public function getCallback(): mixed;
    
    public function getArguments(): mixed;
}