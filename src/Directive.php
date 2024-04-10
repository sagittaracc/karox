<?php

namespace Arutyunyan\Karox;

trait Directive
{
    public function if($var)
    {
        ob_start(function ($buffer) use ($var) {
            return $this->tag('div', $var, '(el, value) => el.style.display = value ? "block" : "none"', $buffer);
        });
    }

    public function endif()
    {
        ob_end_flush();
    }

    public function tag($name, $var, $jsUpdateCallback = null, $content = '', $attributes = [])
    {
        $id = uniqid();
        $this->links[$var][$id] = $jsUpdateCallback;
        $this->vars[$var] = null;

        foreach ($attributes as $attribute => $value) {
            $this->links[$attribute][$id] = "(el, value) => el.setAttribute('$attribute', value)";
            $this->vars[$attribute] = null;
        }

        $tag = new Tag($name);
        $tag->setAttributes(array_merge($attributes, ['id' => $id]));
        $tag->setContent($content);

        return $tag->build();
    }
}