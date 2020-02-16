<?php

namespace PNS\Core\Helpers;

class UrlHelper {

    static function getCurrentDomain() {
        $domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
        return isset($domain) ? $domain : $_SERVER['SERVER_NAME'];
    }

    static function getBaseUrl($uri = '', $protocol = NULL) {
        if ($protocol === NULL) {
            $ssl = InputHelper::isHTTPS();
            $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
            $protocol = substr($sp, 0, strpos($sp, '/')) . ( ( $ssl ) ? 's' : '' );
        }
        $host = self::getCurrentDomain();
        return $protocol . '://' . $host . '/' . $uri;
    }

    static function getCurrentUrl() {
        $ssl = InputHelper::isHTTPS();
        $sp = strtolower($_SERVER['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . ( ( $ssl ) ? 's' : '' );
        $host = self::getCurrentDomain();
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        return $protocol . '://' . $host . $uri;
    }

    static function redirect($uri = '', $method = 'auto', $code = NULL) {
        if (!preg_match('#^(\w+:)?//#i', $uri)) {
            $uri = self::getBaseUrl($uri);
        }
        if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE) {
            $method = 'refresh';
        } elseif ($method !== 'refresh' && (empty($code) OR ! is_numeric($code))) {
            if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1') {
                $code = ($_SERVER['REQUEST_METHOD'] !== 'GET') ? 303 : 307;
            } else {
                $code = 302;
            }
        }
        switch ($method) {
            case 'refresh':
                header('Refresh:0;url=' . $uri);
                break;
            default:
                header('Location: ' . $uri, TRUE, $code);
                break;
        }
        exit;
    }

}
