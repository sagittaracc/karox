<?php

namespace Arutyunyan\Karox;

abstract class Component
{
    protected $key = 0;

    protected $links = [];

    protected $vars = [];

    protected $nestedComponents = [];

    abstract public function template();

    abstract public function js();

    abstract public function css();

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function render()
    {
        require $this->template();
        require 'Js.php';
    }

    use Directive;
    use JsScope;
}