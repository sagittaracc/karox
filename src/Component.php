<?php

namespace Arutyunyan\Karox;

abstract class Component
{
    protected $links = [];

    protected $vars = [];

    protected $nestedComponents = [];

    abstract public function template();

    abstract public function js();

    abstract public function css();

    protected function initialize()
    {}

    protected function terminate()
    {}

    public function render(Component $component = null)
    {
        if ($component) {
            $component->render();
            $this->nestedComponents[] = $component;
        }
        else {
            $this->initialize();
            require $this->template();
            $this->terminate();
        }
    }

    public function requireJs()
    {
        require 'Js.php';
    }

    use Directive;
    use JsScope;
}