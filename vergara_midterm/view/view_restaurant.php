<?php

include ('../classes/connection.php');

include('../classes/restaurant.php');

$restau = new Restaurants("Lorena's Canteen");
$restauname = $restau->getRestaurantName();

if (isset($_POST['menu_page'])){
    $username = $_GET['user'];
    $userId = $_GET['id'];

    $result = $connection->query("INSERT INTO `orders` (`user_id`) VALUES ('$userId')");

    if ($result) {
        $orderId = $connection->insert_id;
        header("Location: /vergara_midterm/view/view_menu_items.php?user=$username&id=$userId&orderid=$orderId"); 
        exit;
    } else {
        echo "Error: " . $connection->error;
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* *{
            border: 1px solid black;
        } */
        body{
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url('../img/bg2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container{
            padding: 130px;
            display:flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            padding:40px;
            text-align: center;
            text-align:center;
            font-size:50px;
            text-transform:uppercase;
            color:white;
            letter-spacing:1px;
            font-family:"Playfair Display", serif;
            font-weight:400;
}
        h1 span {
    margin-top: 5px;
    font-size:15px; 
    color:orangered;
    word-spacing:1px;
    font-weight:normal;
    letter-spacing:2px;
    text-transform: uppercase;
    font-family:"Raleway", sans-serif;
    font-weight:500;
    display: grid;
    grid-template-columns: 1fr max-content 1fr;
    grid-template-rows: 27px 0;
    grid-gap: 20px;
    align-items: center;
}

h1 span:after,h1 span:before {
    content: " ";
    display: block;
    border-bottom: 1px solid #ccc;
    border-top: 1px solid #ccc;
    height: 5px;
  background-color:#f8f8f8;
}

        .button-30 {
        align-items: center;
        appearance: none;
        background-color: orangered;
        border-radius: 4px;
        border-width: 0;
        box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
        box-sizing: border-box;
        color: #fdfdfd;
        cursor: pointer;
        display: inline-flex;
        font-family: "JetBrains Mono",monospace;
        height: 48px;
        justify-content: center;
        line-height: 1;
        list-style: none;
        overflow: hidden;
        padding-left: 16px;
        padding-right: 16px;
        position: relative;
        text-align: left;
        text-decoration: none;
        transition: box-shadow .15s,transform .15s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        white-space: nowrap;
        will-change: box-shadow,transform;
        font-size: 18px;
        }

        .button-30:focus {
        box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        }

        .button-30:hover {
        box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        transform: translateY(-2px);
        }

        .button-30:active {
        box-shadow: #D6D6E7 0 3px 7px inset;
        transform: translateY(2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to  <?php echo $restauname ?><span>sabaw lang sapat na</span></h1>
        <form method="POST">
        <button  class="button-30" name="menu_page" type="submit">ORDER HERE</button>
        </form>
        
    </div>


    <script>

    </script>
</body>
</html>