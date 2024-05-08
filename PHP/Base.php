<?php

  try{
    $base = new PDO("mysql:host=localhost;dbname=staffs_airways","root", "");
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOExection $a){
    echo $a;
  }
?>