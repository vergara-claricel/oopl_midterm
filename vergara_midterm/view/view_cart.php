<?php
include('../classes/order.php'); 
include('../classes/cart.php');


$orderId = $_GET['orderid'];
$user = $_GET['user'];
$userId = $_GET['id'];

ob_start();

if(isset($_POST['backToMenu'])){
    header("Location: /vergara_midterm/view/view_menu_items.php?user=$user&id=$userId&orderid=$orderId");
    ob_end_flush();
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        .header{
            color:white;
            display:flex;
            justify-content: center;
            background-color: #2f4f4f;
            padding-top: 1rem;
           padding-bottom: 1rem;
           padding-left: 4rem;
           padding-right: 4rem;
        }
        h4{
    font-size: 24pt;
    font-weight: 500;
}

#icon{
    height:70px;
    width:130px;
        }
#cart{
    height: 40px;
    width:40px;
}
.cart_title{
    padding-top: 2rem;
    padding-bottom: 2rem;
    display: flex;
    gap:1rem;
    margin-left: 200px;
    color: orangered;
}
.tablez{
    border: 2px solid orangered;
    border-radius: 20px;
    margin-left: 200px;
    margin-right: 200px;
    box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.2), -3px -3px 6px rgba(0, 0, 0, 0.1);
    background-color: white;
    margin-bottom: 3rem;
}
.table{
    margin-top: 1rem;
    /* border: 1px solid burlywood; */
    /* padding-left:3rem;
    padding-right:3rem; */
    max-width: 600px;
    padding-top: 2rem;
    justify-self: center;


}


.button-38 {
  background-color: #FFFFFF;
  border: 0;
  border-radius: .5rem;
  box-sizing: border-box;
  color: #111827;
  font-family: "Inter var",ui-sans-serif,system-ui,-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
  font-size: .875rem;
  font-weight: 600;
  line-height: 1.25rem;
  padding: .75rem 1rem;
  text-align: center;
  text-decoration: none #D1D5DB solid;
  text-decoration-thickness: auto;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-38:hover {
  background-color: lightgray;
}

.button-38:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.button-38:focus-visible {
  box-shadow: none;
}

.btncheckout{
    background-color: orangered;
    font-family: "Inter var",ui-sans-serif,system-ui,-apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    border: 0;
    border-radius: .5rem;
    font-size: .875rem;
  font-weight: 600;
  line-height: 1.25rem;
  padding: .75rem 1rem;
  text-align: center;
  color: white;
}

.btncheckout:hover {
  color: yellow;
  font-size:  1rem;
}

form {
    display: flex;
    justify-content: center;
    gap: 20px;
}


.btn.btn-danger:hover{
    font-size: 12pt;
    background-color: red;
    color:black;
}




    </style>
</head>
<body>
<div class="header">
    <img src="../img/icon-removebg-preview.png" id="icon" alt="Icon">


    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cart">
                    <div class="cart_title">
                        <img src="../img/cart.png" alt="Cart icon" id="cart">
                        <h4>Your Cart</h4>
                    </div>
                    <div class="tablez">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Quantity * Item Price</th>
                                <th scope= "col" >Item Name</th>
                                <th scope= "col" >Item/s Total</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <?php
                        $itemz = new Cart();
                        $ordered_items = $itemz->viewCart($orderId);
                        

                        if (empty($ordered_items)) {
                            echo '<tr><td colspan="3">Your cart is empty.</td></tr>';
                        } else{
                            foreach($ordered_items as $key => $value){
                                
                                $itemTotal = $value['price'] * $value['quantity'];
                                echo '<tr> <td>' . $value['quantity'] . ' x ' . $value['price']. '</td> 
                                <td> ' . $value['name'] . '</td> 
                                <td> ' . $itemTotal  . '</td>
                                 <form method="POST"> 
                                <input type=""hidden style="display:none;" name="cartid" value="'. $value['cart_id'] .'" >
                                
                                <td> <button type="submit" name="remove" class="btn btn-danger"> Remove </button> </td> 
                                </form>
                                
                                </tr>';
                            }
                        }

                        if(isset($_POST['remove'])){
                            $cartid = $_POST['cartid'];

                            $itemz->removeItem($cartid);
                            header("Location: /vergara_midterm/view/view_cart.php?user=$user&id=$userId&orderid=$orderId");
                            exit;
                        }
                        
                        ?>
                        <tr>
                            <th colspan="2"> TOTAL AMOUNT</th>
                            <th>
                                <?php $total=$itemz->totalAmount($orderId);
                                echo $total;
                                ?>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    <form method="POST">
                    <button name="backToMenu" type="submit" class="button-38">Back to Menu </button>
                    <button name="checkout" type="submit" class="btncheckout">Proceed to Checkout</button>
                    </form>
                    <?php
                        if(isset($_POST['checkout'])){
                            if(empty($ordered_items)){
                                echo 'No order made. Checkout not possible.';
                            } else {
                                $connection->query("UPDATE `orders` SET `totalamount` = '$total' WHERE order_id = $orderId");
                                header("Location: /vergara_midterm/view/checkout.php?user=$user&id=$userId&orderid=$orderId");
                                ob_end_flush();
                                exit;
                            }
                        } 
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script>


</script>
</html>