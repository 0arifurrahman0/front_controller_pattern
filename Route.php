<?php

class Route
{
    private $handlers = [
        '/' => 'UserController@home',
        '/contact' => 'UserController@contact'
    ];

    public function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    public function dispatch($request)
    {
        return $this->match($request);
    }

    public function match($request)
    {
        return isset($this->handlers[$request]) ? $this->executeHandler($request) : $this->notFound('Handler');
    }

    private function executeHandler($handler)
    {
        [$controller, $method] = explode('@', $handler);

        if (class_exists($controller) && method_exists($controller, $method)) {
            return (new $controller())->$method();
        }

        return $this->notFound('Method');
    }

    private function autoload($className)
    {
        $classFile = $className . '.php';
        return file_exists($classFile) ?  require_once $classFile : $this->notFound('File');
    }

    private function notFound($message=''): string
    {
        return "404 - {$message} Not Found!";
    }

}
