<?php
session_start();
if (isset($_SESSION['email'])) {
    include "conn.php";
    $email = $_SESSION['email'];
    $query1 = "SELECT * FROM users WHERE email='$email'";
    $result1 = mysqli_query($connection,$query1);
    $user1 = mysqli_fetch_assoc($result1);
    $userId = $user1['userid'];
    // var_dump($user1);
    if( isset($_POST['submit']) ){
        $walletName = $_POST['walletname'];
        $bankName = $_POST['bank'];
        $initialAmount = $_POST['initial_amount'];
        $query2 = "INSERT INTO wallets (walletname,bank,initial_amount,userID) VALUES ('$walletName','$bankName','$initialAmount','$userId')";
        $result2 = mysqli_query($connection,$query2);
        if($result2){
            header("location: dashboard.php");
        }
        else{
            echo "some error";
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
</head>

<body>
    <div class="container d-flex  justify-content-center p-5">
        <form action="create_wallet.php" method="POST" class="col-4 shadow p-5" style="margin-top: 10%;">
            <h3 class="mb-2">Your Wallet:</h3>
            <div class="form-group">
                <label for="walletname">Wallet Name:</label>
                <input type="text" class="form-control" name="walletname" id="walletname" placeholder="">
            </div>
            <div class="form-group ">
                <label for="bank">Bank Name:</label>
                <input type="text" class="form-control" name="bank" id="bank" placeholder="">
            </div>
            <div class="form-group">
                <label for="initial_amount">Bank Balance:</label>
                <input type="number" class="form-control" name="initial_amount" id="initial_amount" placeholder="Current Amount of Your Account">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="submit">
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>

<?php }
else {
    header("location: login.php");
}
?>