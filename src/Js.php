<script type="text/javascript">
    <?=$this->useScope() ? '(function(global){' : ''?>

        const <?=$this->getScopeName()?> = {
            links: <?=json_encode($this->links)?>,
            vars: <?=json_encode($this->vars)?>,
            set: function (prop, value) {
                let links = this.links[prop]

                for (const [id, jsUpdateCallback] of Object.entries(links)) {
                    let el = document.getElementById(id);
                    eval(jsUpdateCallback)(el, value);
                }
            },
        };

        <?=file_get_contents($this->js())?>;

        <?php
            // TODO: Build scope of the nested components
        ?>

        <?=$this->isGlobal() ? "global = global || window; global.{$this->getScopeName()} = {$this->getScopeName()};" : ''?>

    <?=$this->useScope() ? '})(window);' : ''?>
</script>