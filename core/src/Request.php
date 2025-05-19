<?php

namespace Src;

use Error;

class Request
{
    protected array $body;
    public string $method;
    public array $headers;

    public function __construct()
    {
        $this->body = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders() ?? [];
    }

    public function all(): array
    {
        return $this->body + $this->files();
    }

    public function set($field, $value):void
    {
        $this->body[$field] = $value;
    }

    public function get(string $key, $default = null)
    {
        // Для GET-параметров
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }

        // Для POST-данных
        if (isset($this->body[$key])) {
            return $this->body[$key];
        }

        return $default;
    }

    public function files(): array
    {
        return $_FILES;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->body)) {
            return $this->body[$key];
        }
        throw new Error('Accessing a non-existent property');
    }
}