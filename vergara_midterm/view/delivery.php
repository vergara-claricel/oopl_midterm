<?php
include ('../classes/deliveryoption.php');

$user = $_GET['user'];
$userId = $_GET['id'];
$orderId = $_GET['orderid'];


if(isset($_POST['bike'])){
    $deliver = new BikeDelivery();
    $deliver->selectDeliveryMethod('Bike', $orderId);
    $delifee = $deliver->getFee();
    header("Location: /vergara_midterm/view/view_summary.php?user=$user&id=$userId&orderid=$orderId&fee=$delifee");
} else if(isset($_POST['delivehicle'])){
    $deliver = new DeliveryVehicle();
    $deliver->selectDeliveryMethod('Delivery Vehicle', $orderId);
    $delifee = $deliver->getFee();
    header("Location: /vergara_midterm/view/view_summary.php?user=$user&id=$userId&orderid=$orderId&fee=$delifee");
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
        .title{
            padding-top: 2rem;
            text-align: center;
            /* color:orange; */

        }

        form{
            /* max-width: 600px; */
            display:flex;
            justify-content: center;
            /* gap:10px; */
            margin-top: 10px;
            
        }

        .bike{
            padding: 3rem 4.7rem;
            
        }

        .deli{
            padding: 3rem 3rem;
        }

        .bikebtn, .delibtn{
            border-radius: 15px;
            background-color: orange;
            color:#f9f9f9;
            padding: 2rem 2rem;
            color: white;
            font-size: 15pt;
            border: none;
            
        }

        .bikebtn:hover, .delibtn:hover{
            padding:4rem 4rem;
            font-size: 20pt;
            transition: .5s;
            transition-duration: 1s;
            font-weight: bold;
        }

        #bikepic{
            height:150px;
            width: 200px;
            margin-bottom: 10px;
        }
        #truckpic{
            height:150px;
            width: 200px;
            margin-bottom: 7px;

        }
    </style>
</head>
<body>


<div class="header">
    <img src="../img/icon-removebg-preview.png" id="icon" alt="Icon">
    </div>

<h3 class="title">Choose delivery method: </h3>

    <form method="POST">
    <div class="bike">
    <button type="submit" name="bike" class="bikebtn">
        
    <img src="../img/bike.png" alt="Bike" id="bikepic">
    <p>BIKE</p>
    </button>

    </div>
    
    <div class="bike">
        <button type="submit" name="delivehicle" class="delibtn">
        <img src="../img/truck.png" alt="Truck" id="truckpic">
        <p>DELIVERY VEHICLE</p></button>

    </div>

    </form>
</body>
</html>