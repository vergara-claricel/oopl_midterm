<?php
    include('../classes/paymentmethod.php');
    include('../classes/order.php');

    session_start();

    $user = $_GET['user'];
    $userId = $_GET['id'];
    $orderId = $_GET['orderid'];

    if(isset($_POST['todelivery'])){
        $o = new Order();
        $amount = $o->getTotalAmount($orderId);
        $first_name = $_POST['customer_fn'];
        $last_name = $_POST['customer_ln'];
        $contactnum = $_POST['contactnum'];
        $address= $_POST['address'];


        $paymentMethod = $_POST['payment_method'];

        if ($paymentMethod == 'gcash' && !empty($_POST['gcash_number'])) {
            $gcashNumber = $_POST['gcash_number'];
            $_SESSION['paydetails'] = $gcashNumber;
           $_SESSION['paymethod'] = 'gcash';
        } elseif ($paymentMethod == 'credit' && !empty($_POST['credit_number'])) {
            $creditNumber = $_POST['credit_number'];
            $_SESSION['paydetails'] = $creditNumber;
            $_SESSION['paymethod'] = 'credit';            $_SESSION['ccnumber'] = $creditNumber;
        } elseif ($paymentMethod == 'cod') {
            $_SESSION['paydetails'] = '';
            $_SESSION['paymethod'] = 'cod'; 
        } else {
            echo "Please provide all required payment details.";
            exit;
        }

        $order = new Order();
        $orderdeets = $order->setOrderDetails($orderId, $first_name, $last_name, $contactnum, $address, $paymentMethod);
        header("Location: /vergara_midterm/view/delivery.php?user=$user&id=$userId&orderid=$orderId");
    }

    if(isset($_POST['backToCart'])){
        header("Location: /vergara_midterm/view/view_cart.php?user=$user&id=$userId&orderid=$orderId");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Transaction</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>

        body{
            background-color: #f9f9f9;
        }
        .header{
            display:flex;
            gap:350px;
            background-color: #2f4f4f;
            padding-top: 1rem;
           padding-bottom: 1rem;
           padding-left: 4rem;
           padding-right: 4rem;
        }
        #icon{
            height:70px;
            width:130px;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }
        .payform {
            background-color: white;
            color: black;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            justify-self: center;
            margin-bottom: 3rem;
        }
        h3 {

            text-align: center;
            color: black;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        label {
            font-weight: bold;

        }
        input[type="text"], input[type="number"], input[type="radio"] {
            width: 100%;
            padding: .3rem;
            margin-top: 0.3rem;
            margin-bottom: .7rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        input[type="radio"] {
            width: auto;
            margin-top:10px;
            margin-right: 5px;
            margin-left: 15px;
        }


        .btn.btn-warning {
            background-color: orangered;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            font-size: 1rem;
            width: 150px;
            cursor: pointer;
        }

        .btn.btn-warning:hover{
            color: yellow;
            font-size:13pt;
        }

        .backtocart {
            background-color:white;
            border: none;
            color: darkgrey;
            font-size: 1rem;
            padding: 0.6rem 1rem;
            border-radius: 30px;
            font-size: 1rem;
            width: 150px;
            cursor: pointer;
            margin-top: 10px;
        }
        .backtocart:hover {
            color: black;
        }
        .confirm{
            display: flex;
            justify-content: center;
            margin-top:1rem;
        }
        h4{
            color: orangered;
            font-size: 16pt;
        }

    </style>
</head>
<body>
<div class="parent">
    <div class="header">
    <form method="POST">
    <button type="submit" name="backToCart" class="backtocart">Back to Cart</button>
</form>
        <img src="../img/icon-removebg-preview.png" id="icon" alt="Icon">
    </div>
</div>

<h3>Payment Transaction</h3>


<div class="payform">
    <h4>Customer Details</h4>
    <form method="POST">
        <label for="customer_fn">First Name</label>
        <input type="text" name="customer_fn" required>
        <label for="customer_ln">Last Name</label>
        <input type="text" name="customer_ln" required>
        <label for="contactnum" required>Contact Number</label>
        <input type="number" name="contactnum">
        <label for="customer_name" required>Full Address</label>
        <input type="text" name="address">

    <h4>Choose payment method: </h4>
    <input type="radio" name="payment_method" value="gcash" id="gcash" onclick="togglePaymentFields('gcash')" required>
    <label for="gcash">GCash</label>
    <input type="text" id="gcash_number" name="gcash_number" placeholder="GCash Number" style="display:none;">

    <input type="radio" name="payment_method" value="cod" id="cod" onclick="togglePaymentFields('cod')">
    <label for="cod">Cash on Delivery</label>

    <input type="radio" name="payment_method" value="credit" id="credit" onclick="togglePaymentFields('credit')">
    <label for="credit">Credit Card</label>
    <input type="text" id="credit_number" name="credit_number" placeholder="Credit Card Number" style="display:none;">
        <div class="confirm">
        <button class="btn btn-warning" name="todelivery" type="submit">Confirm</button>
        </div>
</form>
</div>

<?php
    
?>

</body>
<script>
function togglePaymentFields(paymentMethod) {
    document.getElementById('gcash_number').style.display = (paymentMethod === 'gcash') ? 'block' : 'none';
    document.getElementById('credit_number').style.display = (paymentMethod === 'credit') ? 'block' : 'none';
}
</script>
</html>
