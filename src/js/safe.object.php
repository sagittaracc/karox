<?php

return 'const safeObject => (object, keys, value) {
    keys.reduce((nestedObj, key, index) => {
        if (index === keys.length - 1) {
            nestedObj[key] = value;
            return nestedObj[key];
        } else {
            if (!nestedObj[key]) {
                nestedObj[key] = {};
            }
            return nestedObj[key];
        }
    }, object);
};';
