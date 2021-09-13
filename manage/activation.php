<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_GET["code"])){

    $code=$_GET["code"];
    require_once "registerKonekcija.php";
    $prep=$konekcija2->prepare("select * from users where code=:code");
    $prep->execute(['code' => $code]); 
    $data=$prep->fetchAll();

    if(count($data)==1){
        $prep=$konekcija2->prepare("update users set isActive=1 where code=:code");
        $prep->execute(['code' => $code]); 
        $_SESSION["success"]="<p>You have activated your account successfuly, you can login now!</p>";
        header("Location: ../loginRegister.php#msg");     
    }

    else{
        echo "Your confrimation code is wrong!";
        echo "Please check again if you got the correct link.";
    }
}

else{
    echo "Your confrimation code is wrong!";
    echo "Please check again if you got the correct link.";
}


?>