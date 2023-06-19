<?php

require 'Route.php';

class Kernel
{
    public static function handle($request)
    {
        return (new Route())->dispatch($request);
    }
}