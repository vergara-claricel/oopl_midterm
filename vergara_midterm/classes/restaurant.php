<?php 

class Restaurants{
    private $name;


    function __construct($name)
    {
        $this->name = $name;
    }

    public function getRestaurantName(){
        return $this->name;
    }
}


?>