<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST["registerBtn"])){

    $name = $_POST['inputFname1'];
    $lName = $_POST['inputLnam'];
    $email = $_POST['input_email'];
    $pass = $_POST['inputPassword1'];
    $cPass = $_POST['inputPassword2'];

    $reFname="/^[A-Z][a-z]{2,25}$/";
    $reLname="/^[A-Z][a-z]{2,35}$/";
    $rePass="/^.{5,30}$/";

    $errors = [];

    if(!preg_match($reFname, $name))
        array_push($errors,"First name is in wrong format - Example: John");
    
    if(!preg_match($reLname, $lName))
        array_push($errors,"Last name is in wrong format - Example: Smith");
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($errors,"Email is in wrong format - Example: john12@gmail.com");
    
    if(!preg_match($rePass, $pass))
        array_push($errors,"Password is in wrong format - Example: m0nk3y (minimum 5 characters)");
    
    if($cPass != $pass)
        array_push($errors,"Password and confrim password do not match");
    

    if(count($errors) == 0) {

        require_once "registerKonekcija.php";

        $activation=sha1(mt_rand(10000,99999).time().$email);
        $timestamp=date("Y-m-d H:i:s");
        $pass=md5($pass);
        $active=0;
        $uloga=2;

        $query = "INSERT INTO users VALUES (null,:name,:lastName,:password,:email,null,:isActive,:code,:idUloga)";
        
        $prepare=$konekcija2->prepare($query);
        $prepare->bindParam(":name", $name);
        $prepare->bindParam(":lastName", $lName);
        $prepare->bindParam(":password",$pass);
        $prepare->bindParam(":email", $email);
        $prepare->bindParam(":isActive",$active);
        $prepare->bindParam(":code", $activation);
        $prepare->bindParam(":idUloga",$uloga);

        try {
            $prepare->execute();                             
            mail($email, "Confrim link", "Please confrim your registration:https://phpdavid1.000webhostapp.com/manage/activation.php?code=".$activation,"From:pcshop@company.com");
            $_SESSION["success"] = "<p>Aktivacioni link je uspesno poslat na vas mail</p>";
            header("Location: ../loginRegister.php#msg");
        } 
        catch(PDOException $ex){           
            $_SESSION["errors"] = ["User with same email already exists!"];
            header("Location: ../loginRegister.php#msg");
        }
        
    } 
    else {  
        $_SESSION['errors'] = $errors;
        header("Location: ../loginRegister.php#msg");
    }
}

?>