<?php
if(isset($_POST['submit'])){
    include "conn.php";
    $username = $_POST['name'];
    $useremail = $_POST['email'];
    $usercity = $_POST['city'];
    $useraddress = $_POST['address'];
    $userpassword = $_POST['password'];
    echo $userpassword;
    $query = "INSERT INTO users (name,email,city,address,password) VALUES ('$username','$useremail','$usercity','$useraddress','$userpassword')";
    $result = mysqli_query($connection,$query);
    echo $query;
    if($result){
        echo "inserted";
        header("location: login.php");
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: #C5C9B8;
            width: 100%;
            color: #333333;
        }
    </style>
</head>

<body>
    <div class="container d-flex shadow justify-content-center p-5 mt-5" style="background-color: white;">
    <div>
        <img src="" width="50%" height="100%">
    </div>
        <form action="register.php" method="POST" class="col-4">
            <h3 class="mb-3">Registration Info</h3>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" class="form-control" id="city" placeholder="">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="">
            </div>
            <input type="submit" name="submit" class="btn btn-dark" value="submit">
            <p class="mt-2">Already a user? <a href="login.php">Login</a> </p>
        </form>
        
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>