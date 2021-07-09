<?php

function formatDate($value, $maskInput= 'd/m/Y', $maskOutput= 'Y-m-d') {
    if ($value == null) {
        return "";
    } else {
        //return date_format(new \DateTime($value), $mask);
        return Carbon\Carbon::createFromFormat($maskInput, $value)->format($maskOutput);
    }
}

function formatCellular($value)
{
    return '('.substr($value,0,2).')'.( strlen($value) == 10 ? substr($value,2,4) : substr($value,2,5) )."-".substr($value,-4);
}

function formatCpf($value)
{
    return substr($value,0,3).".".substr($value,3,3).".".substr($value,6,3)."-".substr($value,-2);
}

function formatCep($value)
{
    return substr($value,0,5)."-".substr($value,-3);
}

function hoursToSeconds($value)
{
    $sec = 0;
    foreach (array_reverse(explode(':', $value)) as $k => $v) $sec += pow(60, $k) * $v;
    return $sec;
}

function secondsToHours($value)
{
    $h = floor($value / 3600);
    $m = floor(($value - ($h * 3600)) / 60);
    $s = floor($value % 60);
    return str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($m, 2, "0", STR_PAD_LEFT) . ":" . str_pad($s, 2, "0", STR_PAD_LEFT);
}
