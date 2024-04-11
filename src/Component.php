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

    public function render(Component $component = null)
    {
        if ($component) {
            $component->render();
            $this->nestedComponents[] = $component;
        }
        else {
            $this->template();
        }

        if ($this instanceof RootComponent) {
            $this->buildJs();
        }
    }

    use Directive;
    use JsScope;
}