<?php
namespace PNS\Core\Helpers;

class DateTimeHelper {

    static function globalShowDatetime($time) {
        return date('d-m-Y h:i:s', $time);
    }

    static function showBirtday($time) {
        return date('d/m/Y', $time);
    }

    static function dayMonthYearToTime($day, $month, $year) {
        return strtotime("$year-$month-$day");
    }

}