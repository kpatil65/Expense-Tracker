<?php
session_start();
if (isset($_SESSION['email'])) {
  include "conn.php";
  $email = $_SESSION['email'];
  $walletid = $_GET['walletid'];
  $query = "SELECT * FROM wallets WHERE walletid='$walletid'";
  $result = mysqli_query($connection, $query);
  $wallet = mysqli_fetch_assoc($result);
  $userID = $wallet['userID'];
  $initial_amount = $wallet['initial_amount'];
 
  $query3 = "SELECT * FROM transactions WHERE walletid='$walletid'";
  $result3 = mysqli_query($connection,$query3);
  
  
  $query4 = "SELECT amount,type FROM transactions WHERE walletid='$walletid'";
  $result4 = mysqli_query($connection,$query4);
  $sum = 0;

  $query6 = "SELECT type FROM transactions WHERE walletid='$walletid'";
  $query_type = mysqli_query($connection,$query6);
  $type_array = mysqli_fetch_assoc($query_type);

  if( !empty($type_array) ){
  foreach($type_array as $key => $value){
    // echo $key." ".$value."<br>";
  }
  }
  
  $credited = 0;
  $debited = 0;
  while($amounts = mysqli_fetch_assoc($result4)){
    if($amounts['type'] == 'credited'){
      $credited = $credited + $amounts['amount'];
    }
    else{
      $debited = $debited + $amounts['amount'];
    }
  }

  $current_amount = $initial_amount + $credited - $debited;

  $query5 = "UPDATE wallets SET current_amount='$current_amount' WHERE walletid='$walletid'";
  $result5 = mysqli_query($connection,$query5);
  if(!$result5){
    echo mysqli_error($connection);
  }

  if (isset($_POST['submit'])){
    $to_payemnt = $_POST['to_payment'];
    $amount = $_POST['amount'];
    $comment = $_POST['comment'];
    $payment_type = $_POST['payment_type'];
    $date = date("d/m/Y");
    date_default_timezone_set("Asia/kolkata");
    $dateTime =  date("h:i:sa")." ".$date;
    $query2 = "INSERT INTO transactions (userID,walletID,to_payment,type,comment,timestamp,amount) VALUES ('$userID','$walletid','$to_payemnt','$payment_type','$comment','$dateTime','$amount')" ;
    $result2 = mysqli_query($connection,$query2);
    header("location: transactions.php?walletid=$walletid");
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
        overflow-x: hidden;
      }

      .form-modal {
        z-index: 100;
        transform: translate(33%, 5%);
        display: none;
      }

      .transc{
        z-index: -1;
      }
    </style>
  </head>

  <body>
    <div class="container mt-5">
      <div class="">
        <h3>Your Transactions</h3>
        <a class="btn btn-warning" href="dashboard.php">Home</a>
        <button class="btn btn-warning" id="transaction">Add transaction</button>
        <div class="bg-dark text-white mt-1"><h4 >Current Balance: <?php echo $current_amount; ?></h4></div>
      </div>
    </div>
    <div class="form-modal  mt-3 container" id="formModal">
      <span class="btn btn-danger" style="margin-left: 30%; z-index: 999; position: relative;" id="close">&times;</span>
      <form action="transactions.php?walletid=<?php echo $walletid; ?>" method="POST" class="col-4 shadow p-5" style="margin-top: -3%;">
        <span style="font-size: 30px">Form</span>

        <div class="form-group">
          <label for="name">payer/reciever name</label>
          <input type="text" name="to_payment" class="form-control" id="to_payment" placeholder="">
        </div>
        <div class="form-group">
          <label for="amount">Amount</label>
          <input type="number" name="amount" class="form-control" id="amount" placeholder="">
        </div>
        <div class="form-group">
          <label for="comment">Comment</label>
          <textarea type="text" name="comment" class="form-control" id="comment" placeholder=""></textarea>
        </div>
        <div class="form-group">
          <label for="sel1"></label>
          <select class="form-control" name="payment_type">
            <option value="">Payment Type</option>
            <option value="credited">Credited</option>
            <option value="debited">Debited</option>
          </select>
        </div>
        <input type="submit" name="submit" class="btn btn-dark" value="submit">
      </form>
    </div>
    <div class="container mt-3 transc">
        <table class="table mt-5">
            <thead class="thead-inverse">
              <tr>
                <th>Paid to / Recieved from</th>
                <th>Payment Type</th>
                <th>Commented</th>
                <th>Time</th>
                <th>Amount</th>
              </tr>
             </thead>
              <tbody>
                 <?php
                   while ($amounts = mysqli_fetch_assoc($result3)) {
                  ?>
                  <tr>
                    <td><?php echo $amounts['to_payment']; ?></td>
                    <td><?php echo $amounts['type']; ?></td>
                    <td><?php echo $amounts['comment']; ?></td>
                    <td><?php echo $amounts['timestamp']; ?></td>
                    <td><?php echo $amounts['amount']; ?></td>
                 </tr>
                  <?php
                      }
                  ?>        
               </tbody>
               <div>   
            </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
      var transactions = document.getElementById("transaction");
      transactions.addEventListener("click", modal);

      function modal() {
        var formModal = document.getElementById("formModal");
        formModal.style.display = "block";
        // document.body.style.backgroundColor = "black";
      }
      var close = document.getElementById("close");
      close.addEventListener("click", closebutton)

      function closebutton() {
        formModal.style.display = "none";
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>

  </html>

<?php } else {
  header("location: login.php");
}
?>