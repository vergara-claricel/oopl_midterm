<?php
 include('../classes/connection.php');
 include('../classes/menu_items.php');
 include('../classes/cart.php');

 $order_id = $_GET['orderid'];
 $user = $_GET['user'];
 $userId = $_GET['id'];
 

 if (isset($_POST['addToCart'])){
    if ($_POST['quantity'] > 0){
        $item_name = $_POST['item_name'];
        $item_price = $_POST['item_price'];
        $quantity = $_POST['quantity'];

        $cart = new Cart();
        $cart->addToDb($order_id, $item_name, $quantity,$item_price);
        // $alertMessage = "Item added to cart!";
        
        header("Location: /vergara_midterm/view/view_menu_items.php?user=$user&id=$userId&orderid=$order_id");
        exit;
    } else {
        echo '<script>alert("Quantity cannot be zero.");</script>';
    }
    
 }
        if (isset($_POST['view_cart'])){
            header("Location: /vergara_midterm/view/view_cart.php?user=$user&id=$userId&orderid=$order_id");
            exit;
        }
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->

    <style>
        *{
            margin: 0;
            padding: 0;
            /* border: 1px solid red; */
        }

        body{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }
        .header{
            color:white;
            display:flex;
            justify-content:space-between;
            background-color: #2f4f4f;
           padding-top: 2rem;
           padding-bottom: 2rem;
           padding-left: 4rem;
           padding-right: 4rem;
        }

        .header2{
            display:flex;
            gap: 20px;
        }

        .container{
            margin-left: 125px;
            padding-bottom: 3rem;
        }

        .col{
            display: flex;
            flex-wrap: wrap;
        }

        .card{
            margin-right: 4rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .card-body{
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }

        .card-img-top{
            width: 100%;               /* Full width of the card */
            height: 200px;             /* Set a fixed height to keep uniformity */
            object-fit: cover;         /* Ensures the image fills the area without distortion */
            display: block;  
        }

        .card-title{
            font-size: 18pt;
            color: orangered;
            text-transform: uppercase;
        }
        .card-text, .card-title{
            margin: 0;
        }

        .card-text{
            font-weight:bold;
            font-size:12pt;
        }

        #quanti{
            text-align: center;
            height:20px;
            width:200px;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            opacity: 1; /* Ensures the arrows are always visible */
            display: inline; /* Forces the arrows to display */
        }

        h2{
            margin-left:100px;
            padding-top: 2rem;
        }

        #addtocart{
            height: 30px;
            width: 200px;
            background-color: white; /* Bootstrap green */
            color: orangered;
            border:1px solid orangered;
        }

        #addtocart:hover{
            background-color: orangered;
            color: white;
            font-weight: bolder;
        }

        #icon{
            height:45px;
            width:105px;
        }
        #menu{
            font-size: 26pt;
        }

        


    </style>
</head>
<body>
<div class="header">
        <img src="../img/icon-removebg-preview.png" id="icon" alt="Icon">


        <form method="POST">
        <!-- <button type="submit" name="view_cart" id="viewcart">CART</button> -->
        <button type="submit" name="view_cart" style="background: none; border: none; cursor: pointer;">
            <i class="fas fa-shopping-cart" style="font-size: 30px; color: red;"></i>
        </button>
    </form>
</div>

    <h2 id="menu">Our Menu</h2>

    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                    $items = new MenuItems();
                    $menu_items = $items->viewMenu();
                    foreach($menu_items as $key => $value){

                    
                    echo '
                    <form method="POST" autocomplete="off">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img class="card-img-top" src="..' . $value['imagelink'] .  '" alt="Card image cap">
                            <p class="card-title">'. $value['name'] . '</p>
                            <p class="card-text"> PHP'. $value['price'] . '</p>
                            <input type="number" name="quantity" value="0"  min="0" id="quanti">
                            <input type="hidden" name="item_name" value="'. $value['name'] . '">
                            <input type="hidden" name="item_price" value="'. $value['price'] . '">
                            <input name="addToCart" class="btn" type="submit" value="ADD TO CART" id="addtocart">
                        </div>
                        </div>

                        </form>';
                    }                
                ?>
            </div>
        </div>


    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeButton = document.querySelector('.alertClose');
        
        closeButton.addEventListener('click', function() {
            const alert = this.closest('.alert');
            alert.style.display = 'none';
        });
    });
</script>
</html>