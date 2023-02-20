<?php

function removeFromString($str, $item) {
    $parts = explode(',', $str);
    while (($i = array_search($item, $parts)) !== false) {
        unset($parts[$i]);
    }
    return implode(',', $parts);
}

function subWord($str, $offset, $limit) {
    $string = implode(' ', array_slice(explode(' ', $str), $offset, $limit)) . "\n";
    return $string;
}

function stripImage($content) {
    $content = preg_replace("/<img[^>]+\>/i", " ", $content);
    return $content;
}
