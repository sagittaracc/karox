<?php

namespace Arutyunyan\Karox;

class Tag
{
    private $selfClosingTags = ['input'];

    private $tag;

    private $attributes = [];

    private $content = '';

    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    private function buildAttributes()
    {
        $result = [];

        foreach ($this->attributes as $attribute => $value) {
            $result[] = implode('=', [$attribute, "'$value'"]);
        }

        return implode(' ', $result);
    }

    public function build()
    {
        if (in_array($this->tag, $this->selfClosingTags)) {
            return "<{$this->tag} {$this->buildAttributes()} />";
        }
        else {
            return "<{$this->tag} {$this->buildAttributes()}>{$this->content}</{$this->tag}>";
        }
    }
}