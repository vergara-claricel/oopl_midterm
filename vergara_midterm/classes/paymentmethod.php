<?php
abstract class PaymentMethod{
    protected $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    abstract public function processTransaction();
    
}

class CreditCard extends PaymentMethod{
    private $ccnumber;

    public function __construct($amount, $ccnumber){
        parent::__construct($amount);
        $this->ccnumber = $ccnumber;
    }

    public function processTransaction()
    {
        echo "<p>Processed payment of PHP$this->amount from credit card #$this->ccnumber. </p>";
    }
}

class GCash extends PaymentMethod{
    private $gnumber;

    public function __construct($amount, $gnumber){
        parent::__construct($amount);
        $this->gnumber = $gnumber;
    }

    public function processTransaction()
    {
        echo "<p> Processed payment of PHP$this->amount from gcash number: $this->gnumber.</p>";
    }
}

class CashOnDelivery extends PaymentMethod{
    private $address;

    public function __construct($address, $amount){
        parent::__construct($amount);

        $this->address =$address;
    }

    public function processTransaction()
    {
        echo " <p> COD at $this->address with a total of: PHP$this->amount. </p>";
    }
}

?>
