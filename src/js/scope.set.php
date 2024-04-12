<?php

return 'function (prop, value) {
    let links = this.links[prop]

    for (const [id, jsUpdateCallback] of Object.entries(links)) {
        let el = document.getElementById(id);
        eval(jsUpdateCallback)(el, value);
    }
}';
