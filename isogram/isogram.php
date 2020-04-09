<?php

function isIsogram($world)
{
    $world = strtr(mb_strtolower($world), [' ' => '', '-' => '']);
    $seen = [];
    foreach (str_split($world) as $letter) {
        if (in_array(ord($letter), $seen)) {
            return false;
        }
        $seen []= ord($letter);
    }

    return true;
}
