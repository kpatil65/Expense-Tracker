<?php
session_start();
if (isset($_SESSION['email'])) {
  include "conn.php";
  $email = $_SESSION['email'];
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($connection, $query);
  $user1 = mysqli_fetch_assoc($result);
  $userID = $user1['userid'];
  $query2 = "SELECT * FROM wallets WHERE userID='$userID'";
  $result2 = mysqli_query($connection,$query2);
  
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
    <div class="container mt-5">
      <div class="d-flex">
        <h3>MY WALLETS</h3>
        <p class="mt-2 ml-4"><a href="create_wallet.php">Create a wallet!</a></p>
      </div>
    </div>
    <div class="container d-flex mt-5">
      <?php while($wallet = mysqli_fetch_assoc($result2)){ ?>
      <div class="card  bg-white mb-3 ml-3" style="max-width: 18rem;">
        <div class="card-header">Wallet: <?php echo $wallet['walletname']; ?></div>
        <div class="card-body">
          <h5 class="card-title text-white bg-success"><?php echo $wallet['bank']; ?></h5>
          <p class="card-text">Check Your wallet add transactions and your all Transactions of this wallet <a href="transactions.php?walletid=<?php echo $wallet['walletid']; ?>">here</a></p>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="container">
      <a class="btn btn-primary" href="logout.php">Logout</a>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

  </html>

<?php
} else {
  header("location: login.php");
}
?>