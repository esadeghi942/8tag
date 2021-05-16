<?php
function english_digits($str) {
    $newstring = str_replace(array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $str);
    return $newstring;

}