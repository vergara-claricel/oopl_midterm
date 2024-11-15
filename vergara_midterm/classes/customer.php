<?php 
require_once('connection.php');
$GLOBALS['connection'] = $connection;

class Customer{
    private $username;
    private $password;
    private $db;

    function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->db = $GLOBALS['connection'];
    }

    function login(){
        $q1 = "SELECT * from users where `username` = '$this->username' and `password` = '$this->password'";
        $res = mysqli_query($this->db, $q1);
        $user = mysqli_fetch_assoc($res);
        return $user;
    }
}



?>