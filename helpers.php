<?php 

use PNS\Core\Helpers\StringHelper;

if (!function_exists('stringCreateAlias')) {

    /**
     * Create url slug (alias) from string.
     *
     * @param string $value
     * @return string
     */
    function stringCreateAlias($value) {
        return StringHelper::createAlias($value);
    }
}
