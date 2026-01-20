<?php

if (!function_exists('dateAndTimeFormat')) {
    function dateAndTimeFormat($date, $format = 'Y-m-d H:i:s A')
    {
        return $date ? date($format, strtotime($date)) : null;
    }
}

if(!function_exists('dateFormat')) {
    function dateFormat($date, $format = 'Y-m-d')
    {
        return $date ? date($format, strtotime($date)) : null;
    }
}
