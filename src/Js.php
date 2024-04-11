<script type="text/javascript">
    (function(global){
        const scope = {
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

        <?=$this->isWithoutScope() ? "global.{$this->getKey()} = scope;" : ''?>
    })(window);
</script>