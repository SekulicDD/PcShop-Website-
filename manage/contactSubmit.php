<?php 
if(isset($_POST["send"])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['text'];
  
    $reName = '/^[A-Z][a-z]{1,14}(\s[A-Z][a-z]{1,19})+$/';

    $errors = [];

    if(!preg_match($reName, $name))
        array_push($errors,"Name is in wrong format - Example: John Smith");
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($errors,"Email is in wrong format - Example: john12@gmail.com");
    
    if (strlen($text) > 160||strlen($text) < 16) {
        array_push($errors,"Message need to between 16 and 160 characters");
    }

    if(count($errors)>0){
        for ($i=0; $i <count($errors); $i++) { 
            echo "<p>".$errors[$i]."</p>";
        }

        echo "<h3>You will be redirected back!</h3>";
        header("refresh:2;url=../contact.php" );
    }

    else {                                 
        mail("sajtphp@gmail.com", "Message",$text,"From:".$email);
        header("refresh:2;url=../contact.php" );
        echo "<p>Message sent to sajtphp@gmail.com</p>";
        echo "<h3>You will be redirected back!</h3>";    
    }
}

?>