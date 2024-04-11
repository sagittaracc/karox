<?php

namespace Arutyunyan\Karox;

abstract class Component
{
    protected $key = 0;

    protected $links = [];

    protected $vars = [];

    abstract public function template();

    abstract public function js();

    abstract public function css();

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function render($wrapper = null)
    {
        if ($wrapper) echo "<$wrapper>";

        require 'Css.php';
        require $this->template();
        require 'Js.php';

        if ($wrapper) echo "</$wrapper>";
    }

    use Directive;
    use JsScope;
}