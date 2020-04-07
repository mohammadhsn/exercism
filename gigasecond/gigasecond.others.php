<?php

function from(DateTime $birthday)
{
    $birthday = clone $birthday;
    $gigaSecond = new DateInterval(sprintf('PT%dS', 1e9));
    $birthday->add($gigaSecond);

    return $birthday;
}