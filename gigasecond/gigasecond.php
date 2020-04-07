<?php

function from(DateTimeImmutable $date)
{
    return $date->add(new DateInterval('PT1000000000S'));
}
