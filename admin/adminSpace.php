    <?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: ../index.php");
    }
    $inp = file_get_contents('../db/users.json');
    $tempArray = json_decode($inp,true);
    session_destroy();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div>
    <table class="table table-dark table-sm">
      <thead>
        <tr>
          <th scope="col"> # </th>
          <th scope="col"> First Name </th>
          <th scope="col"> Last Name </th>
          <th scope="col"> Email </th>
          <th scope="col"> Birthday </th>
          <th scope="col"> Username </th>
                <th scope="col"> Password </th>
                <th scope="col"> Date Inscription </th>
                <th scope="col"> Last login </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tempArray["users"] as $user) : ?>
                <tr>
                  <td><?= $user['id'] ?></td>
                  <td><?= $user['name'] ?></td>
                  <td><?= $user['lastName'] ?></td>
                  <td><?= $user['email'] ?></td>
                  <td><?= $user['birthday'] ?></td>
                  <td><?= $user['userName'] ?></td>
                  <td><?= $user['password'] ?></td>
                  <td><?= $user['signUpDate'] ?></td>
                  <td><?= $user['logInDate'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
      </div>
</body>
</html>