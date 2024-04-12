<?php
    $scope = [
        'links' => $this->links,
        'vars' => $this->vars,
        'set' => require 'js/scope.set.php',
    ];
?>

<script type="text/javascript">
    <?=$this->useScope() ? '(function(global){' : ''?>

        const <?=$this->getScopeName()?> = <?=json_encode($scope)?>;

        <?=file_get_contents($this->js())?>;

        <?php
            // TODO: Build scope of the nested components
        ?>

        <?=$this->isGlobal() ? "global = global || window; global.{$this->getScopeName()} = {$this->getScopeName()};" : ''?>

    <?=$this->useScope() ? '})(window);' : ''?>
</script>