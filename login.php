<?php

include 'config.php';
session_start();


if(isset($_POST['masuk'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($dbconnect, "SELECT * FROM user WHERE username='$username' and password='$password'");

    $data = mysqli_fetch_assoc($query);

    $check =mysqli_num_rows($query);

    if(!$check) {
        $_SESSION['error'] = 'username atau password salah';
    }
    else{
        $_SESSION['userid'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role_id'] = $data['role_id'];

        header("location:index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
   integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <?php if(isset($_SESSION['error']) && $_SESSION['error'] != '') {?>
            <div class="alert alert-danger" role="alert">
                <?=$_SESSION['error']?>
            </div>
        <?php }
            $_SESSION['error'] = '';
        ?>
    <div class="container">
        <form method="post">
            <div class="login wrap">
                <div class="h1">Login</div>
                <input type="text" class=""name="username" placeholder="Username">
                <input type="password" class=""name="password" placeholder="Password">
                <input type="submit" name="masuk" value="Masuk" class="btn">
            </div>
        </form>
    </div>
</body>
</html>