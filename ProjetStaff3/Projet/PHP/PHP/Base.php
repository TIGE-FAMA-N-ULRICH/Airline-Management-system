<?php

  try{
    $base = new PDO("mysql:host=localhost;dbname=Staff_Airline","root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOExection $a){
    echo $a;
  }
?>
