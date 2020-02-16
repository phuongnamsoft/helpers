<?php

namespace PNS\Core\Helpers;

class InputHelper {

    static function post($index = NULL) {
        if ($index === NULL) {
            return $_POST;
        } else if (isset($_POST[$index])) {
            return $_POST[$index];
        }
        return FALSE;
    }

    static function get($index = NULL) {
        if ($index === NULL) {
            return $_GET;
        } else if (isset($_GET[$index])) {
            return $_GET[$index];
        }
        return FALSE;
    }

    static function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    static function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    static function isAjax() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }

    static function isCLI() {
        return (php_sapi_name() === 'cli');
    }

    static function isHTTPS() {
        return TRUE;
    }


    static function getRealClientIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    static function getClientIP() {
        return $_SERVER['REMOTE_ADDR'];
    }

    static function getUserAgent() {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            return $_SERVER['HTTP_USER_AGENT'];
        }
        return FALSE;
    }

    static function getClientCountryCode() {
        if (function_exists('geoip_country_code_by_name')) {
            return geoip_country_code_by_name(self::getClientIP());
        }
    }

    static function getClientCountryName() {
        if (function_exists('geoip_country_name_by_name')) {
            return geoip_country_name_by_name(self::getClientIP());
        }
    }

}
