<?php

namespace Arutyunyan\Karox;

abstract class Component
{
    protected $key = 0;

    protected $scopeName = 'scope';

    protected $global = false;

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

    public function getKey()
    {
        return $this->key;
    }

    public function getScopeName()
    {
        return $this->scopeName;
    }

    public function setGlobal($global)
    {
        $this->global = $global;

        return $this;
    }

    public function isGlobal()
    {
        return $this->global;
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