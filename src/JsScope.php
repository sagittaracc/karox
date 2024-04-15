<?php

namespace Arutyunyan\Karox;

trait JsScope
{
    protected $scopeName = 'scope';

    protected $withScope = true;

    protected $global = false;

    public function setScopeName($scopeName)
    {
        $this->scopeName = $scopeName;

        return $this;
    }

    public function getScopeName()
    {
        return $this->scopeName;
    }

    public function withoutScope()
    {
        $this->withScope = false;

        return $this;
    }

    public function useScope()
    {
        return $this->withScope === true;
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
}