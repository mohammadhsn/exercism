<?php

function toRna(string $dna)
{
    $out = "";
    $map = [
        'G' => 'C',
        'C' => 'G',
        'T' => 'A',
        'A' => 'U'
    ];
    foreach (str_split($dna) as $letter) {
        $out .= $map[$letter];
    }
    return $out;
}
