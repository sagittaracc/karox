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

    protected function initialize()
    {}

    protected function finitialize()
    {}

    public function render(Component $component = null)
    {
        $this->initialize();

        if ($component) {
            $component->render();
            $this->nestedComponents[] = $component;
        }
        else {
            require $this->template();
        }

        $this->finitialize();
    }

    use Directive;
    use JsScope;
}