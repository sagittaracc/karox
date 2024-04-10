<?php

namespace Arutyunyan\Karox;

abstract class Component
{
    protected $key = 0;

    protected $links = [];

    protected $vars = [];

    public function setKey($key)
    {
        $this->key = $key;
    }

    abstract public function template();

    abstract public function js();

    abstract public function css();

    public function render($wrapper = null)
    {
        if ($wrapper) echo "<$wrapper>";

        require 'Css.php';
        require $this->template();
        require 'Js.php';

        if ($wrapper) echo "</$wrapper>";
    }

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