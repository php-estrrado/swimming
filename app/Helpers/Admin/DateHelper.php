<?php

function dateFormat($date, $format) {
    $sttdate = strtotime($date);
    switch ($format) {
        case 1:
            return date("d-m-Y", $sttdate);
            break;
        case 2:
            return date("d/m/Y", $sttdate);
            break;
        case 3:
            return date("m-d-Y", $sttdate);
            break;
        case 4:
            return date("m/d/Y", $sttdate);
            break;
        case 5:
            return date("Y-m-d", $sttdate);
            break;
        case 6:
            return date("Y/m/d", $sttdate);
            break;
        case 7:
            return date("d-m-Y h:i A", $sttdate);
            break;
        case 8:
            return date("d/m/Y h:i A", $sttdate);
            break;
        case 9:
            return date("m-d-Y h:i A", $sttdate);
            break;
        case 10:
            return date("m/d/Y h:i A", $sttdate);
            break;
        case 11:
            return date("Y-m-d h:i A", $sttdate);
            break;
        case 12:
            return date("Y/m/d h:i A", $sttdate);
            break;
        default:
            return date("d-m-Y", $sttdate);
    }
}

function dateConvert($date, $from, $to) {

    $format = [
        0 => "Y-m-d H:i:s",
        1 => "d-m-Y",
        2 => "d/m/Y",
        3 => "m-d-Y",
        4 => "m/d/Y",
        5 => "Y-m-d",
        6 => "Y/m/d",
        7 => "d-m-Y h:i A",
        8 => "d/m/Y h:i A",
        9 => "m-d-Y h:i A",
        10 => "m/d/Y h:i A",
        11 => "Y-m-d h:i A",
        12 => "Y/m/d h:i A",
    ];

    $cdate = date_create_from_format($format[$from], $date);
    $fdate = date_format($cdate, $format[$to]);
    return $fdate;
}

function dateChange($interval, $format) {
    $date = strtotime($interval);
    return date($format, $date);
}

function dateDiffInDays($date1, $date2) {
    $diff = strtotime($date2) - strtotime($date1);
    return abs(round($diff / 86400));
}

function dateAdd($date, $interval) {
    $cdate = date_create($date);
    date_add($cdate, date_interval_create_from_date_string($interval));
    return date_format($cdate, "Y-m-d H:i:s");
}

function dateSub($date, $interval) {
    $cdate = date_create($date);
    date_sub($cdate, date_interval_create_from_date_string($interval));
    return date_format($cdate, "Y-m-d H:i:s");
}

function changeDate($interval) {
    $date = strtotime($interval);
    return date("Y-m-d H:i:s", $date);
}

function checkExpiry($date) {
    $cdate = date("Y-m-d H:i:s");
    $expire = strtotime($date);
    $today = strtotime($cdate);
    if ($today > $expire) {
        return 0; /* expired */
    } else {
        return 1; /* active */
    }
}

function getTimeago($time) {
    $time_difference = time() - strtotime($time);
    if ($time_difference < 1) {
        return "less than 1 second ago";
    }
    $condition = [
        12 * 30 * 24 * 60 * 60 => "year",
        30 * 24 * 60 * 60 => "month",
        24 * 60 * 60 => "day",
        60 * 60 => "hour",
        60 => "minute",
        1 => "second"
    ];
    foreach ($condition as $secs => $str) {
        $dif = $time_difference / $secs;
        if ($dif >= 1) {
            $tim = round($dif);
            return 'posted ' . $tim . ' ' . $str . ( $tim > 1 ? 's' : '' ) . ' ago';
        }
    }
}
