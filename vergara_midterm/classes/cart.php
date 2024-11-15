<?php
require_once('connection.php');
$GLOBALS['konek'] = $connection;


class Cart {
    private $db;


    function __construct(){
        $this->db = $GLOBALS['konek'];
    }


    function viewCart($orderid){
        $cart = $this->db->query("SELECT * FROM `cart` WHERE order_id = $orderid")->fetch_all(MYSQLI_ASSOC);
        return $cart;
    }

    function totalAmount($orderid){
        $totalamount = 0;
        $query = "SELECT * FROM `cart` WHERE order_id = '$orderid'";
        $res = mysqli_query($this->db, $query);

        while ($item = mysqli_fetch_assoc($res)){
            $totalamount += $item['quantity'] * $item['price'];
        }
        return $totalamount;
    }

    function removeItem($cartid){
        $cart2 = $this->db->query("DELETE FROM `cart` where cart_id = $cartid");
        return $cart2;
    }

    function orderTotal($orderid){
        $cart3 = $this->db->query("SELECT totalamount from `orders` where order_id = $orderid");
        return $cart3;
    }


    function addToDb($order_id, $item_name,$quantity,$item_price){
        $addquery = $this->db->query("INSERT INTO `cart`(`order_id`,`name`, `quantity`, `price`) VALUES ('$order_id','$item_name','$quantity','$item_price')");
        return $addquery;
    }
}
?>