<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST["login"])){
    $email = trim($_POST["input_email0"]);
    $pass = trim($_POST["inputPassword0"]);

    $error = [];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error[] = "Email is not valid!";
    }

    if(count($error) == 0){

        require_once "registerKonekcija.php";

        $prepare = $konekcija2->prepare("SELECT us.id,us.name,ul.name as uloga from users us INNER JOIN uloge ul on us.idUloga=ul.id WHERE isActive=1 AND email = :email AND password= :pass");
    
        $prepare->bindParam(":email", $email);
        $pass = md5($pass);
        $prepare->bindParam(":pass", $pass);
        $prepare->execute();
        $user=$prepare->fetchAll();

        if(count($user) == 1){
            $_SESSION['user'] = $user;

            if($user[0]->uloga== "User"){
                header("Location: ../welcome.php");
            } 
            else if($user[0]->uloga == "Admin"){
                header("Location: ../admin.php");
            }
        }
        else {
            $_SESSION['errorLogin'] = ["User with that password and email is not found"];
            header("Location: ../loginRegister.php");
        }

    }
    else {
        $_SESSION['errorLogin'] = $error;
        header("Location: ../loginRegister.php");
    }
   
}

?>