<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION["user"])){
        header("Location: manage/noAccess.php");
    }
    else if($_SESSION["user"][0]->uloga!="Admin"){
        header("Location: manage/noAccess.php");
    }

    if(isset($_POST["id"])&&$_POST["id"]!=""){
        require_once "../konekcija.php";
        $id=$_POST["id"];
        $query="DELETE FROM products WHERE id=:id";
        $prepare=$konekcija->prepare($query);
        $prepare->bindParam(":id", $id);
        
        try {
            $prepare->execute();                             
            echo "Selected product was successfuly deleted";         
        } 
        catch(PDOException $ex){           
            echo "Product with selected id doesn't exist";     
        }

    }
    else{
        echo "Operation failed, no product selected";       
    }

?>