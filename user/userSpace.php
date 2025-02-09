<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: ../index.php");
    }
    $id = $_SESSION["id"] - 1;
    $inp = file_get_contents('../db/users.json');
    $tempArr = json_decode($inp ,true);
    $GLOBALS["name"] = $tempArr['users'][$id]["name"];
    $GLOBALS["lastName"] = $tempArr['users'][$id]["lastName"];
    $GLOBALS["ID"] = $tempArr['users'][$id]["id"];
    $GLOBALS["email"] = $tempArr['users'][$id]["email"];
    $GLOBALS["birthday"] = $tempArr['users'][$id]["birthday"];
    $GLOBALS["userName"] = $tempArr['users'][$id]["userName"];
    $GLOBALS["password"] = $tempArr['users'][$id]["password"];
    $GLOBALS["signup"] = $tempArr['users'][$id]["signUpDate"];
    if (array_key_exists('logOut', $_POST)) {
        session_destroy();
        header('Location: ../index.php');
        exit;
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <nav>
      <h1>your space</h1>
      <ul>
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <form method="post"> 
              <input type="submit" name="logOut" class="button" value="log out"/> 
            </form> 
            
        </ul>
    </nav>
    <h1 id="title">welcome to your space <br><span><?php echo $GLOBALS["name"]." ".$GLOBALS["lastName"]; ?></span></h1>
    <section>
    <div>
            <p><b>your id : </b><?php echo $GLOBALS["ID"]; ?></p>
            <p><b>your email : </b><?php echo $GLOBALS["email"]; ?></p>
            <p><b>your birthday : </b><?php echo $GLOBALS["birthday"]; ?></p>
            <p><b>your user name : </b><?php echo $GLOBALS["userName"]; ?></p>
            <p><b>your password : </b><?php echo $GLOBALS["password"]; ?></p>
            <p><b>your signup date : </b><?php echo $GLOBALS["signup"]; ?></p>
        </div>
        <img src="../images/dessin.png" alt="">
    </section>
    <script src="https://kit.fontawesome.com/6e2f9a7b88.js" crossorigin="anonymous"></script>
</body>
</html>