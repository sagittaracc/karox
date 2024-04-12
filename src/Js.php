<?php
    ob_start();

    require 'js/safe.object.php';

    $scope = [
        'links' => $this->links,
        'vars' => $this->vars,
        'set' => require 'js/scope.set.php',
    ];

    echo 'const '.$this->getScopeName().' = '.json_encode($scope);
    echo file_get_contents($this->js());

    foreach ($this->nestedComponents as $nestedComponent)
    {
        $nestedComponent->requireJs();
    }

    if ($this->isGlobal()) {
        echo 'var global = global || window';
        echo 'safeObject(global, ['.explode('\\', static::class)."], '{$this->getScopeName()}');";
    }

    $jsScript = ob_get_clean();

    echo $this->useScope() ? '(function(global){'.$jsScript.'})(window);' : $jsScript;