<?php

namespace PNS\Core\Helpers;

class ArrayHelper {

    const MAX_DEPTH_LEVEL = 3;

    static function dropdown($table_array, $key = 'id', $parentid = 'parent_id', $text_field = 'title', $rootparent = 0) {
        $results = array();
        if (!empty($table_array)) {
            foreach ($table_array as $key1 => $level1) {
                if (!isset($level1[$key]) || !isset($level1[$parentid]) || !isset($level1[$text_field])) {
                    return $results;
                }
                if ($level1[$parentid] == $rootparent) {
                    $table_array[$key1][$text_field] = str_repeat('|----- ', 1) . $level1[$text_field];
                    $table_array[$key1]['parent'] = 'root';
                    $results[] = $table_array[$key1];
                    foreach ($table_array as $key2 => $level2) {
                        if ($level2[$parentid] == $level1[$key]) {
                            $table_array[$key2][$text_field] = str_repeat('|----- ', 2) . $level2[$text_field];
                            $table_array[$key2]['parent'] = $level1['title'];
                            $results[] = $table_array[$key2];
                            foreach ($table_array as $key3 => $level3) {
                                if ($level3[$parentid] == $level2[$key]) {
                                    $table_array[$key3][$text_field] = str_repeat('|----- ', 3) . $level2[$text_field];
                                    $table_array[$key3]['parent'] = $level2['title'];
                                    $results[] = $table_array[$key3];
                                }
                            }
                        }
                    }
                }
            }
        }
        return $results;
    }

    static function children($table_array, $key_field = 'id', $parent_field = 'parent_id', $rootparent = 0, $level = 1) {
        $results = array();
        if (!empty($table_array)) {
            foreach ($table_array as $key => $value) {
                if (!isset($value[$key_field]) || !isset($value[$parent_field])) {
                    return array();
                }
                if ($value[$parent_field] == $rootparent) {
                    $level <= self::MAX_DEPTH_LEVEL ? $value['children'] = self::children($table_array, $key_field, $parent_field, $value[$key_field], $level + 1) : NULL;
                    $results[] = $value;
                }
            }
        }
        return $results;
    }

    static function ArraySortingAsc($array, $key) {
        $cmp = function($a, $b) use ($key) {
            if ($a[$key] == $b[$key]) {
                return 0;
            }
            return ($a[$key] < $b[$key]) ? -1 : 1;
        };
        uasort($array, $cmp);
        return $array;
    }

    static function ArraySortingDesc($array, $key) {
        $cmp = function($a, $b) use ($key) {
            if ($a[$key] == $b[$key]) {
                return 0;
            }
            return ($a[$key] > $b[$key]) ? -1 : 1;
        };
        uasort($array, $cmp);
        return $array;
    }

    static function convertKeyValue(array $dataArray, $key, $value) {
        $results = [];
        foreach ($dataArray as $item) {
            $results[$item[$key]] = $item[$value];
        }
        return $results;
    }

    static function convertKeyItem(array $dataArray, $key) {
        $results = [];
        foreach ($dataArray as $item) {
            $results[$item[$key]] = $item;
        }
        return $results;
    }

    static function partition($list, $p) {
        $listlen = count($list);
        $partlen = floor($listlen / $p);
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice($list, $mark, $incr);
            $mark += $incr;
        }
        return $partition;
    }

}
