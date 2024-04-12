<?php
    $scopeName = $this->getScopeName();
    $links = json_encode($this->links);
    $vars = json_encode($this->vars);

    ob_start();

    echo "
        const scope = {
            links: $links,
            vars: $vars,
            set: function (prop, value) {
                let links = this.links[prop];
                for (const [id, jsUpdateCallback] of Object.entries(links)) {
                    let el = document.getElementById(id);
                    eval(jsUpdateCallback)(el, value);
                }
            }
        };
    ";

    echo file_get_contents($this->js());

    foreach ($this->nestedComponents as $nestedComponent)
    {
        $nestedComponent->requireJs();
    }

    if ($this->isGlobal()) {
        echo 'var global = global || window;';
        echo "global.$scopeName = scope;";
    }

    $jsScript = ob_get_clean();

    echo $this->useScope() ? '(function(global){'.$jsScript.'})(window);' : $jsScript;