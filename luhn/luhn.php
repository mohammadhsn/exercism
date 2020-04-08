<?php

function isValid(string $id)
{
    $id = str_replace(' ', '', trim($id));
    if (strlen($id) < 2 || !is_numeric($id)) {
        return false;
    }

    return array_sum(second_double(str_split($id))) % 10 == 0;
}


function second_double(array $numbers)
{
    $even = count($numbers) % 2 == 0;
    for ($i = count($numbers) - 1;$i >= 0;$i --) {
        if (($even && $i % 2 != 0) || (!$even && $i % 2 == 0)) {
            continue;
        }
    
        $replace = $numbers[$i] * 2;
    
        if ($replace > 9) {
            $replace = array_sum(str_split($replace));
        }

        $numbers[$i] = (string) $replace;
    
    }

    return $numbers;
}
