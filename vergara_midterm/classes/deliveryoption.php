<?php 

require_once('connection.php');
$GLOBALS['connection'] = $connection;

class DeliveryMode{
    protected $deliveryTime;
    protected $deliveryfee;
    protected $db;

    function __construct($deliveryTime, $deliveryFee)
    {
        $this->deliveryfee = $deliveryFee;
        $this->deliveryTime = $deliveryTime;
        $this->db = $GLOBALS['connection'];
    }


}

class DeliveryVehicle extends DeliveryMode{

    public function __construct($deliveryTime = '35 minutes', $deliveryfee = 40){
        parent::__construct($deliveryTime, $deliveryfee);

    }

    public function getFee(){
        return $this->deliveryfee;
    }

    public function selectDeliveryMethod($deliverymethod, $orderId){
        
        $deli = $this->db->query("UPDATE `orders` set `deliverymode` = '$deliverymethod' where order_id = $orderId");
        return $deli;
    }

}

class BikeDelivery extends DeliveryMode {
    public function __construct($deliveryTime = '25 minutes', $deliveryfee = 20){
        parent::__construct($deliveryTime, $deliveryfee);
    }

    public function getFee(){
        return $this->deliveryfee;
    }

    public function selectDeliveryMethod($deliverymethod, $orderId){
        $deli = $this->db->query("UPDATE `orders` set `deliverymode` = '$deliverymethod' where order_id = $orderId");
        return $deli;
    }

}
?>