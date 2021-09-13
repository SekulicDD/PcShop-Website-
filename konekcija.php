<?php

  $serverBaze = "localhost";
  $username = "id13115198_web";
  $password = "fAJ]Ynt~ei#9]C2D";
  $bazaPodataka = "id13115198_proizvodi";

  try 
  {
    $konekcija = new PDO("mysql:host=$serverBaze;dbname=$bazaPodataka",$username, $password);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  }
  catch(PDOException $e)
  {
    echo "Greska sa konekcijom: " . $e->getMessage();
  }
  
?>
