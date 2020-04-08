<?php

class Bob
{
    function respondTo($statement)
    {
        if (Statement::isSilence($statement)) {
            return "Fine. Be that way!";
        }
        if (Statement::isShouting($statement)) {
            return "Whoa, chill out!";
        }
        if (Statement::isQuestion($statement)) {
            return "Sure.";
        }

        return "Whatever.";
    }
}

class Statement
{
    static function isSilence($str)
    {
        return trim($str) === '';
    }

    static function isShouting($str)
    {
        return preg_replace('/[^a-zA-Z]/', '', $str) != ''
            && strtoupper($str) === $str;
    }

    static function isQuestion($str)
    {
        return substr(trim($str), -1) === "?";
    }
}