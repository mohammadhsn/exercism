<?php

/**
 * @param string $sMessage
 * @return bool
 */
function isIsogram(string $sMessage)
{
    $sMessage = utf8_decode($sMessage);
    $sMessage = str_replace(['-', ' '], '', $sMessage);
    $sMessage = strtolower($sMessage);
    $aLetters = str_split($sMessage);
    if ($aLetters === array_unique($aLetters)) {
        return true;
    }
    return false;
}