<?php

namespace Arutyunyan\Karox;

abstract class Component
{
    protected $selfClosingTags = ['input'];

    protected $key = 0;

    protected $currentElementId = 0;

    protected $links = [];

    protected $vars = [];

    public function setKey($key)
    {
        $this->key = $key;
    }

    protected function generateId()
    {
        return md5(static::class . '-' . $this->key . '-' . $this->currentElementId++);
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

    public function tag($tag, $var, $jsUpdateCallback = null, $content = '', $attributes = [])
    {
        $id = $this->generateId();
        $this->links[$var][$id] = $jsUpdateCallback;
        $this->vars[$var] = null;

        foreach ($attributes as $attribute => $value) {
            $this->links[$attribute][$id] = "(el, value) => el.setAttribute('$attribute', value)";
            $this->vars[$attribute] = null;
        }
        
        if (in_array($tag, $this->selfClosingTags)) {
            return "<$tag id=\"$id\"/>";
        }
        else {
            return "<$tag id=\"$id\">$content</$tag>";
        }
    }

    public function attribute($attribute, $var)
    {
        $id = $this->generateId();
        $this->links[$var][$id] = "(el, value) => el.setAttribute('$attribute', value)";
        $this->vars[$var] = null;

        return " id=\"$id\" ";
    }

    public function span($var, $attributes = [])
    {
        return $this->tag('span', $var, '(el, value) => el.textContent = value', null, $attributes);
    }

    public function input($var)
    {
        return $this->tag('input', $var, '(el, value) => el.value = value');
    }
}