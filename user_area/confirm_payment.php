<?php
session_start();
include('../includes/connect.php');
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    //echo $order_id;

    $select_data="Select * from `user_orders` where order_id=$order_id";
    $result=mysqli_query($con, $select_data);
    $row_fetch=mysqli_fetch_assoc($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];

}


if(isset($_POST['confirm_payment'])){
    
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];

    $insert_query="insert into `user_payments` (order_id, invoice_number, amount, payment_mode) values
    ($order_id, $invoice_number, $amount, '$payment_mode')";
    $result=mysqli_query($con, $insert_query);

    if($result){
        echo "<h3>Successfully completed the payment</h3>";
        echo "<script>window.open('profile.php?user_orders','_self')</script>";
    }
    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders=mysqli_query($con, $update_orders);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website using PHP and MySQL.</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- fontawesomelink link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center">
                <input type="text" class="form-control" name="invoice_number" value="<?php echo $invoice_number?>">
            </div>
            <div class="form-outline my-4 text-center">
                <input type="text" class="form-control" name="amount" value="<?php echo $amount_due?>">
            </div>
            <div class="form-outline my-4 text-center">
                <select name="payment_mode" id="">
                    <option>COD</option>
                    <option>GCASH</option>
                    <option>BANK</option>  
                </select>
            </div>
            <div>
                <input type="submit" value="Confirm" name="confirm_payment">
            </div>
        </form>

    </div>

</body>

</html>