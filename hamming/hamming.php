<?php

/*
This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
convenience to get you started writing code faster.

Remove this comment before submitting your exercise.
*/

function distance(string $strandA, string $strandB) : int
{
    if (strlen($strandA) !== strlen($strandB)) {
        throw new InvalidArgumentException('DNA strands must be of equal length.');
    }

    $diffs = 0;

    foreach (str_split($strandA) as $index => $char) {
        if ($char !== $strandB[$index]) {
            $diffs += 1;
        }
    }

    return $diffs;
}
