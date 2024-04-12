<?php

namespace Arutyunyan\Karox;

abstract class RootComponent extends Component
{
    protected function terminate()
    {
        echo '<script type="text/javascript">';
        $this->requireJs();
        echo '</script>';

        // TODO: build css
    }
}