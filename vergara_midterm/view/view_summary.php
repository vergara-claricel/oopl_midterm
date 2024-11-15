<?php
include ('../classes/deliveryoption.php');
include ('../classes/cart.php');
include('../classes/order.php');
include('../classes/paymentmethod.php');

session_start();

$user = $_GET['user'];
$userId = $_GET['id'];
$orderId = $_GET['orderid'];
$delifee = $_GET['fee'];


if(isset($_POST['placeorder'])){
    header("Location: /vergara_midterm/view/view_restaurant.php?user=$user&id=$userId");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery method</title>
    <link rel="stylesheet" href="../css/bootstrap.css">


    <style>
        *{
            margin:0;
            padding:0;
        }
        body{
            background-color: #f9f9f9;
            
        }
        .header{
            display:flex;
            justify-content: center;
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
        .parent{
            display: flex;
            justify-content: center;
            align-items: center;
            padding-bottom: 3rem;
        }

        .summary {
            align-self: center;
            width: 500px;
            height:550px;
            margin-top: 1.5rem;
            padding: 2rem;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .title {
            text-align: center;
            color: #2f4f4f;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .details {
            margin-top: 1rem;
            line-height: 1.5;

        }

        .details p {
            color: #555;
            margin-bottom: 0.5rem;
        }

  
        .placeorder {
            display: block;
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            color: white;
            background-color: #2f4f4f;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .placeorder:hover {
            background-color: #3c6e6e;
        }


    </style>
</head>
<body>


    <div class="header">
        <img src="../img/icon-removebg-preview.png" id="icon" alt="Icon">
    </div>

    <div class="parent">
        <div class="summary">
        <h4 class="title">Order Summary</h4>

        <table>
            <tr>
                <th>Quantity</th>
                <th>Name</th>
                <th>Item Total</th>
            </tr>

            <?php
                    $getorder = new Order();
                    $fintotal = $getorder->addfeetototal($orderId, $delifee);
                    $getorders = new Cart();
                    $othersum = $getorders->viewCart($orderId);
                    
                    

                    foreach ($othersum as $key => $value){
                        $itemTotal = $value['price'] * $value['quantity'];
                        echo '<tr> <td>' . $value['quantity'] .'</td> 
                        <td> ' . $value['name'] . '</td> 
                        <td> ' . $itemTotal  . '</td>
                        
                        </tr>';
                    }

            
                ?>
                <tr>
                    <td></td>
                    <td>Delivery Fee </td>
                    <td >
                        <?php
                            echo $delifee;
                        ?>
                    </td>
                </tr>
                <tr>
                <td></td>
                <td id="finaltot" style="font-weight: bold;">FINAL TOTAL: </td>
                    <td>
                        <?php
                            echo $fintotal;
                        ?>
                    </td>
                </tr>
        </table>
        <div class="details">
            <?php
                
                $summary = $getorder->getSummary($orderId);


                foreach($summary as $key => $value){
                    $address = $value['address'];
                    echo '<p> Customer Name: ' . $value['first_name'] . ' ' . $value['last_name'] . '</p> 
                    <p> Delivery Address: ' . $value['address'] . '</p> 
                    <p> Contact Number: ' . $value['contact_num']  . '</p>
                    <p> Delivery Mode: ' . $value['deliverymode']  . '</p>';
                    
                }    

                if (isset($_SESSION['paymethod'])) {
                    $paymentMethod = $_SESSION['paymethod'];
                    $paymentDetails = $_SESSION['paydetails'];
                
                    switch ($paymentMethod) {
                        case 'gcash':
                            $pay = new GCash($fintotal, $paymentDetails);
                            $pay->processTransaction();
                            break;
                
                        case 'credit':
                            $pay = new CreditCard($fintotal, $paymentDetails);
                            $pay->processTransaction();
                            break;
                
                        case 'cod':
                            $pay = new CashOnDelivery($address, $fintotal);
                            $pay->processTransaction();
                            break;
                    }
                        }


            ?>
        </div>
            <form method="post">
            <button class="placeorder" type="submit" name="placeorder">Place Order</button>
            </form>
        </div>
    </div>

</body>
</html>