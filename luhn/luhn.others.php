<?php

function isValid($digits)
{ 
  
  $onlynumbers = "";
  
   $digits = str_replace(" ","",$digits);

  // Buchstaben entfernen
   $length = strlen($digits);
  //var_dump ($digits);
  for ($i = 0; $i < $length; $i++)
  {
    $garbage = $digits[$i];
    if (is_numeric($garbage)){
      $onlynumbers = $onlynumbers.$garbage;
    }
    else return false;
  }
  /*
  $sum = 0;
  for ($i = 0; $i < $length; $i++){
  $sum + $digits[$i];
  }
  if ($sum == 0){
  return true;
  }  $length = strlen($digits);
  */
  
  //$onlynumbers = str_replace(""," ",$onlynumbers);
  
  // leer ketten abfangen
  $length = strlen($onlynumbers);
  if ($length <= 1) {
    return false;
  }
  //Prüfsumme
  $sum = 0;
  for ($i = 0; $i < $length; $i++)
  {
    $digit = $onlynumbers[$length - $i -1];
    if ($i % 2 == 1)
    {
      $digit = (int)$digit * 2;
      if ($digit > 9)
      {
        $digit-=9;
      }
    }
    $sum = $sum + (int)$digit;
  }
  return ($sum % 10 == 0);
}
