<?php

use Carbon\Carbon;

function getAge($date)
{
    $birth_date = Carbon::parse($date);
    $now = Carbon::now();

    return $birth_date->diffInYears($now);
}