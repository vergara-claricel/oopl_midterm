<?php 

include('connection.php');
$GLOBALS['connection'] = $connection;



class Order{
    private $konek;
    function __construct()
    {
        $this->konek = $GLOBALS['connection'];
    }

    function viewOrder($orderid){
        $order = $this->konek->query("SELECT * FROM `cart` WHERE order_id = $orderid")->fetch_all(MYSQLI_ASSOC);
        return $order;
    }

    function setOrderDetails($orderid, $first_name, $last_name, $contact_num, $address, $paymentMethod){
        $details = $this->konek->query("UPDATE `orders` SET `first_name`='$first_name',`last_name`='$last_name',`contact_num`='$contact_num',`address`='$address', paymentmethod = '$paymentMethod' WHERE order_id = $orderid");
        return $details;
    }

    function getTotalAmount($orderid){
        $tot = $this->konek->query("SELECT `totalamount` FROM `orders` WHERE order_id = $orderid ")->fetch_all(MYSQLI_ASSOC);
        return $tot;
    }

    function addfeetototal($orderid, $fee){
        $q = $this->konek->query("SELECT totalamount from `orders` where order_id = '$orderid'");
        while ($item = mysqli_fetch_assoc($q)){
            $finalamount = $item['totalamount'] + $fee;
        }
        return $finalamount;
    }
    

    function getSummary($orderid){
        $sum = $this->konek->query("SELECT * from `orders` where order_id = '$orderid'")->fetch_all(MYSQLI_ASSOC);
        return $sum;
    }


    
}




?>