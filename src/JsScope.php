<?php

namespace Arutyunyan\Karox;

trait JsScope
{
    protected $withScope = true;

    public function withoutScope()
    {
        $this->withScope = false;

        return $this;
    }

    public function useScope()
    {
        return $this->withScope === true;
    }
}