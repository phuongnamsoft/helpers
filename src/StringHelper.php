<?php

namespace PNS\Core\Helpers;

class StringHelper {

    static function stringRemoveUtf8($value) {
        $chars = array(
            'a' => array('ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'á', 'à', 'ả', 'ã', 'ạ', 'â', 'ă', 'Á', 'À', 'Ả', 'Ã', 'Ạ', 'Â', 'Ă'),
            'e' => array('ế', 'ề', 'ể', 'ễ', 'ệ', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê'),
            'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị', 'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'),
            'o' => array('ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'Ố', 'Ồ', 'Ổ', 'Ô', 'Ộ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ơ', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ơ'),
            'u' => array('ứ', 'ừ', 'ử', 'ữ', 'ự', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư'),
            'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
            'd' => array('đ', 'Đ'),
            '-' => array(' '),
        );
        foreach ($chars as $key => $arr)
            foreach ($arr as $val)
                $value = str_replace($val, $key, $value);
        return $value;
    }

    static function createRandomString($num) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $num; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }

    static function createKeygen($num) {
        $result = array();
        for ($i = 1; $i <= $num; $i++) {
            $result[] = self::createRandomString(4);
        }
        return strtoupper(implode('-', $result));
    }

    static function createAlias($value) {
        $value = self::stringRemoveUtf8($value);
        $value = preg_replace('/[^a-zA-Z0-9-]/i', '', $value);
        $value = str_replace(array(
            '------------------',
            '-----------------',
            '----------------',
            '---------------',
            '--------------',
            '-------------',
            '------------',
            '-----------',
            '----------',
            '---------',
            '--------',
            '-------',
            '------',
            '-----',
            '----',
            '---',
            '--',
                ), '-', $value
        );
        $value = str_replace(array(
            '------------------',
            '-----------------',
            '----------------',
            '---------------',
            '--------------',
            '-------------',
            '------------',
            '-----------',
            '----------',
            '---------',
            '--------',
            '-------',
            '------',
            '-----',
            '----',
            '---',
            '--',
                ), '-', $value
        );
        if (!empty($value)) {
            if ($value[strlen($value) - 1] == '-') {
                $value = substr($value, 0, -1);
            }
            if ($value[0] == '-') {
                $value = substr($value, 1);
            }
        }
        return strtolower($value);
    }

    static function stringStripWhitespace($param) {
        return str_replace(array(
            '                  ',
            '                 ',
            '                ',
            '               ',
            '              ',
            '             ',
            '            ',
            '           ',
            '          ',
            '         ',
            '        ',
            '       ',
            '      ',
            '     ',
            '    ',
            '   ',
            '  ',
                ), ' ', $param
        );
    }

    static function stringCutchar($str, $n = 0) {
        if (strlen($str) < $n)
            return $str;
        $html = substr($str, 0, $n);
        $html = substr($html, 0, strrpos($html, ' '));
        return $html;
    }

}
