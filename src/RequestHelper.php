<?php

namespace PNS\Core\Helpers;

class RequestHelper {

    const REQUEST_TIMEOUT = 300;
    const CONNECT_TIMEOUT = 300;

    static function checkCurl() {
        return function_exists('curl_init');
    }

    static function downloadFile($url, $savePath = NULL, $createPath = TRUE) {
        
    }

    static function createDownloadRequest($url, $headers = array(), $https = TRUE) {
        if (self::checkCurl()) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $https ? curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE) : NULL;
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIMEOUT);
            curl_setopt($ch, CURLOPT_TIMEOUT, self::REQUEST_TIMEOUT);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $serverOutput = curl_exec($ch);
            curl_close($ch);
            return $serverOutput;
        }
        return FALSE;
    }

    static function createRequest($url, $headers = array(), $postData = array(), $https = TRUE) {
        if (self::checkCurl()) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            if (!empty($postData)) {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            } else {
                curl_setopt($ch, CURLOPT_POST, 0);
            }

            $https ? curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE) : NULL;
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIMEOUT);
            curl_setopt($ch, CURLOPT_TIMEOUT, self::REQUEST_TIMEOUT);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $serverOutput = curl_exec($ch);
            curl_close($ch);
            return $serverOutput;
        }
        return FALSE;
    }

}
