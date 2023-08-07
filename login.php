<?php 

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $userpassword = $_POST['password'];
  
  include "conn.php";

  $credentials = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($connection,$credentials);
  $userinfo = mysqli_fetch_assoc($result);

  if(  $userpassword == $userinfo['password'] &&  $email == $userinfo['email']){
    session_start();
    $_SESSION['email'] = $email;
    header("location: dashboard.php");
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>LOG IN</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: grey;
            width: 100%;
            color: #333333;
        }
    </style>
   </head>
  <body>
  <div class="container d-flex justify-content-center p-5" style="margin-top: 10%;">
        <form action="login.php" method="POST" class="col-4 shadow p-5 " style="background-color: white;">
        <h3>Log In</h3>
            <div class="form-group">
                <label for="mail">Email</label>
                <span style="color: red;" ><?php if( isset($_POST['login']) && $email != $userinfo['email'] ) { echo "enter correct email"; } ?></span>
                <input type="email" name="email" class="form-control" id="email" placeholder="" required>
            </div>
            <div class="form-group">
                <label for="city">Password</label>
                <span style="color: red;" ><?php if( isset($_POST['login']) && $userpassword != $userinfo['password'] ) { echo "enter correct password"; } ?></span>
                <input type="password" name="password" class="form-control" id="password" placeholder="" required>
            </div>
            <input type="submit" name="login" class="btn btn-success" value="login">
        </form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

