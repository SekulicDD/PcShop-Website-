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

    if(isset($_POST["insertSubmit"])){

        $name = $_POST['productName'];
        $text = $_POST['productText'];
        $price = $_POST['productPrice'];
        $inStock = $_POST['productStock'];
        $brand = $_POST['productBrand'];
        $model = $_POST['productModel'];
        $features=$_POST['productFeatures'];
        $released=$_POST['productDate'];

        $catId=$_POST['category'];
        list($catId, $subId) = explode(',', $catId);
    
        $reString="/^.{1,30}$/";
        $errors = [];
    
        if(!preg_match($reString, $name))
            array_push($errors,"Name is inncorect (max 30 chars)");
        
        if(!preg_match($reString, $text))
            array_push($errors,"Text is inncorect (max 30 chars)");
        
        if(!preg_match($reString, $brand))
            array_push($errors,"Brand is inncorect (max 30 chars)");
        
        if(!preg_match($reString, $model))
            array_push($errors,"Model is inncorect (max 30 chars)");

        if(!preg_match($reString, $features))
            array_push($errors,"Features is inncorect (max 30 chars)");
    
       
        if(count($errors) == 0) {
            require_once "../konekcija.php";

            $query = "INSERT INTO products VALUES (null,:name,:text,:catID,:subCatId,:price,:inStock,:brand,:model,:released,:features,:isFeatured,:img)";
            
            $img="t1";
            $isFeatured=0;

            $prepare=$konekcija->prepare($query);
            $prepare->bindParam(":name", $name);
            $prepare->bindParam(":text", $text);
            $prepare->bindParam(":catID",$catId);
            $prepare->bindParam(":subCatId",$subId);
            $prepare->bindParam(":price",$price);
            $prepare->bindParam(":inStock", $inStock);
            $prepare->bindParam(":brand",$brand);
            $prepare->bindParam(":model", $model);
            $prepare->bindParam(":released",$released);
            $prepare->bindParam(":features",$features);
            $prepare->bindParam(":isFeatured",$isFeatured);
            $prepare->bindParam(":img",$img);

    
            try {
                $prepare->execute();                             
                echo "Product was successfuly inserted"; 
                echo "<h3>You will be redirected back!</h3>";
                header("refresh:2;url=../admin.php" ); 
            } 
            catch(PDOException $ex){           
                echo "Operation error"+$ex;   
                echo "<h3>You will be redirected back!</h3>";
                header("refresh:2;url=../admin.php" );   
            }
            
        } 
        else {  
            for ($i=0; $i <count($errors); $i++) { 
                echo "<p>".$errors[$i]."</p>";
            }

            echo "<h3>You will be redirected back!</h3>";
            header("refresh:2;url=../admin.php" ); 
        }
        
    }
    
?>