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

        return $this;
    }

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

    use Directive;
    use JsScope;
}