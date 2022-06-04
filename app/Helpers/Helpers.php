<?php

use Carbon\Carbon;

function getAge($date)
{
    $birth_date = Carbon::parse($date);
    $now = Carbon::now();

    return $birth_date->diffInYears($now);
}

function getRangeValue($value)
{
    switch($value){
        case 1 :
            return 'Menurun';
        break;
        case 2 :
            return 'Cukup Menurun';
        break;
        case 3 :
            return 'Sedang';
        break;
        case 4 :
            return 'Cukup Meningkat';
        break;
        case 5 :
            return 'Meningkat';
        break;
        default :
            return '-';
        break;
    }
}

function getRasaNyeri($value)
{
    switch($value){
        case 'mengekuh_nyeri':
            return 'Pasien mengekuh nyeri';
        break;
        case 'nyeri_berkurang':
            return 'Pasien nyeri berkurang';
        break;
        case 'tidak_nyeri':
            return 'Pasien tidak merasakan nyeri';
        break;
        default :
            return '-';
        break;
    }
}

function getAnalisa($value)
{
    switch($value){
        case 'teratasi':
            return 'Masalah Teratasi';
        break;
        case 'teratasi_sebagian':
            return 'Masalah Teratasi Sebagian';
        break;
        case 'belum_teratasi':
            return 'Masalah Belum Teratasi';
        break;
        default :
            return '-';
        break;
    }
}