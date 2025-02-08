<?php

// ---------------------------------------- the variables we need into all programm

session_start();

if (isset($_SESSION["id"])) {
    header('Location: userSpace.php');
}
$GLOBALS["message"] = "";
global $tempArray;
global $user;
global $existe;
$inp = file_get_contents('users.json');
$tempArray = json_decode($inp,true);
$existe = false;

// --------------------------------------- the user class for user data structure into an object  

class user {
    public $id;
    public $name;
    public $lastName;
    public $email;
    public $birthday;
    public $userName;
    public $password;
    public $signUpDate;
    public $logInDate;
    
    function __construct($id , $name , $lastName , $email , $birthday , $userName , $password , $signUpDate , $logInDate) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->lastName = $lastName;
        $this->birthday = $birthday;
        $this->userName = $userName;
        $this->password = $password;
        $this->signUpDate = $signUpDate;
        $this->logInDate = $$logInDate;
    }
}

// --------------------------------------------------- sign up button

if (isset($_POST['sign_up'])) {

    $user = new user (end( $tempArray["users"])["id"]+1 ,$_POST['name'], $_POST['lastName'], $_POST['email'], $_POST['birthday'], $_POST['userName'], $_POST['password'],date("Y-m-d h:i:sa"),'');

    if($user->password == $_POST['passwordConfirmation']){

        failedSignUp($user, $tempArray, $existe);

        if ($existe == false) {
           pushData($user, $tempArray);
        }
    }

    else {
        $GLOBALS["message"] = "enter the same pasword";
    }
}

// ----------------------------------function to push sign up data inside JSON file

function pushData($user, $tempArray){

    array_push($tempArray["users"], $user);
    $jsonData = json_encode($tempArray, JSON_PRETTY_PRINT);
    file_put_contents('users.json', $jsonData);
    $_SESSION["id"] = $user->id;
    header('Location: userSpace.php');
    exit;
}


function failedSignUp($user, $tempArray, $existe){

    global $existe;
    foreach($tempArray["users"] as $users) { 
        if ($users["userName"] == $user->userName) {
            $GLOBALS["message"] = "existe";
            $existe = true;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Your Space</title>
</head>
<body>
<form method="post" action="">
        <div class="title">
            <h1>Sign Up</h1>
            <h3>Already Have an Account? <a href="login.php"> login</a></h3>
        </div>
        <hr>
        <div class="row">
            <div class="column1 test">
                <label for="">Name</label>
                <input type="text" name="name">
                <label for="">Last Name</label>
                <input type="text" name="lastName">
                <label for="">Email</label>
                <input type="text" name="email">
                <label for="">Birthday</label>
                <input type="date" name="birthday">
            </div>
            <div class="column1">
                <label for="">User Name</label>
                <input type="text" name="userName">
                <label for="">Password</label>
                <input type="text" name="password">
                <label for="">Password Confirmation</label>
                <input type="text" name="passwordConfirmation">
            </div>
        </div>
        <input type="submit" value="sign up" name="sign_up">
        <p class="error">  
        <?php
         echo $GLOBALS["message"]; 
         ?> 
         </p>
    </form>
</html>