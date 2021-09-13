<?php

  $serverBaze = "localhost";
  $username = "id13115198_web2";
  $password = "-!*W]n5tTW})@Ibs";
  $bazaPodataka = "id13115198_register";

  try 
  {
    $konekcija2 = new PDO("mysql:host=$serverBaze;dbname=$bazaPodataka",$username, $password);
    $konekcija2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $konekcija2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  }
  catch(PDOException $e)
  {
    echo "Greska sa konekcijom: " . $e->getMessage();
  }
  
?>
