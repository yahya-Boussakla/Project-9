        <?php
        session_start();
        
        if (isset($_SESSION["id"])) {
            header('Location: userSpace.php');
        }
        $GLOBALS["messag"]="";
        global $tempArray;
        global $user;
        $inp = file_get_contents('users.json');
        $tempArray = json_decode($inp,true);
        $existe = false;
        $sucsses = false;
        
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
        
        
        if (isset($_POST['sign_in'])) {
            global $user;
            global $tempArray;
            global $sucsses;
        
            userLogin($user, $tempArray, $sucsses);
        
            adminLogin($user, $tempArray, $sucsses);
        
            if (!$sucsses) {
                $GLOBALS["messag"] = "login failed";
            }
        }
        
        
        function adminLogin($user, $tempArray, $sucsses){
        
            foreach($tempArray["admin"] as $admin){
                if (($admin["admin"] === $_POST['username'] )&& $admin["password"] === $_POST['Password']) {
                 $sucsses = true;
                 $_SESSION["admin"] = true;
                 header('Location: adminSpace.php');
                 exit;
                }
            }
        }
        
        
        function userLogin($user, $tempArray, $sucsses){
        
            foreach($tempArray["users"] as $users) {
                if ($users["userName"] === $_POST['username'] && $users["password"] === $_POST['Password']) {
                 $_SESSION["id"] = $users["id"];
                 $sucsses = true;
                 $tempArray['users'][$users["id"]-1]['logInDate'] = date("Y-m-d h:i:sa");
                 $jsonData = json_encode($tempArray, JSON_PRETTY_PRINT);
                 file_put_contents('users.json', $jsonData);
                 header('Location: userSpace.php');
                 exit;
                }
            }
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Your Space</title>
</head>
<body>
    <form method="post" action="">
        <h1>login</h1>
        <input type="text" name="username" placeholder="user name">
        <input type="text" name="Password" placeholder="password">
        <input type="submit" value="log in" name="sign_in">
    <p class="poooo">
    <?php
    echo $GLOBALS["messag"];
    ?>
    </p>
    </form>
</body>
</html>