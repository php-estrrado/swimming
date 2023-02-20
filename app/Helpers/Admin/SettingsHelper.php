<?php

function getSiteName() {

    $whereData = [
        ['type', '=', 'site_name'],
        ['status', 1]
    ];

    $data = DB::table('settings')->where($whereData)->first();
    if ($data) {
        return $data->value;
    } else {
        return 'Bizz Salon';
    }
}

function getSiteUrl() {

    $whereData = [
        ['type', '=', 'site_url'],
        ['status', 1]
    ];

    $data = DB::table('settings')->where($whereData)->first();
    if ($data) {
        return $data->value;
    } else {
        return 'https://bizzsalon.com/';
    }
}

function getAdminName() {

    $whereData = [
        ['type', '=', 'admin_name'],
        ['status', 1]
    ];

    $data = DB::table('settings')->where($whereData)->first();
    if ($data) {
        return $data->value;
    } else {
        return 'Admin';
    }
}

function getAdminEmail() {

    $whereData = [
        ['type', '=', 'admin_email'],
        ['status', 1]
    ];

    $data = DB::table('settings')->where($whereData)->first();
    if ($data) {
        return $data->value;
    } else {
        return 'admin@bizzsalon.com';
    }
}

function getAdminUrl() {

    $whereData = [
        ['type', '=', 'admin_url'],
        ['status', 1]
    ];

    $data = DB::table('settings')->where($whereData)->first();
    if ($data) {
        return $data->value;
    } else {
        return 'https://bizzsalon.com/admin';
    }
}

function getCurrencyName() {

    $whereData = [
        ['type', '=', 'currency_name'],
        ['status', 1]
    ];

    $data = DB::table('settings')->where($whereData)->first();
    if ($data) {
        return $data->value;
    } else {
        return 'USD';
    }
}

function getCurrencySymbol() {

    $whereData = [
        ['type', '=', 'currency_symbol'],
        ['status', 1]
    ];

    $data = DB::table('settings')->where($whereData)->first();
    if ($data) {
        return $data->value;
    } else {
        return '$';
    }
}
