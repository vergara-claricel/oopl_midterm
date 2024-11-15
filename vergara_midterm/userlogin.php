<?php
include('../vergara_midterm/classes/connection.php');
include('../vergara_midterm/classes/customer.php');


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $customer = new Customer($username, $password);
    $user = $customer->login();

    if($user){
        $_SESSION['username'] = $username;
        $userId = $user['id']; 
        $_SESSION['id'] = $userId;
        header("Location: /vergara_midterm/view/view_restaurant.php?user=$username&id=$userId");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to order</title>
    <link rel="stylesheet" href="../vergara_midterm/css/bootstrap.css">
    <style>

        body {
  background: #f4f4f4;
  background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url('../vergara_midterm/img/bg.jpg');
}


.container {
  margin-top: 30px
}
form {
  max-width: 350px;
  width: 100%;
  margin: 40px auto;
  background: #fff;
  position: relative;
  box-shadow: 0 5px 5px 0 rgba(50, 50, 50, 0.7);
}

.form-Wrapper::before, .form-Wrapper::after {
  background: #fff none repeat scroll 0 0;
  border: 1px solid #ccc;
  content: "";
  height: 100%;
  left: 0;
  position: absolute;
  top: 3.5px;
  transform: rotateZ(8deg);
  width: 100%;
  z-index: -1;
}
.form-group {
  padding: 20px 0;
  position: relative;
  margin-bottom: 0;
}
.form-control, .form-control:focus {
  border: none;
  box-shadow: none;
  padding-left: 0;
  border-bottom: 1px solid rgba(0, 0, 0, 0.26);
  border-radius: 0
}
.form-group label {
  position: absolute;
  width: 100%;
  left:0;
  right: 0;
  bottom: 0;
  overflow: hidden;
  pointer-events: none;
  top: 4px;
  color: rgba(0, 0, 0, 0.26);
}
.form-group.focused label {
  transition-duration: 0.2s;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  top: 4px;
  color: #ff6c00;
}

.form-group label::after {
  background-color: #ff6c00 ;
  bottom: 14px;
  content: "";
  height: 2px;
  left: 45%;
  position: absolute;
  transition-duration: 0.2s;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  visibility: hidden;
  width: 10px;
}

.headerbg{
    background: #2f4f4f;
    padding: 8px 0;
    text-align: center;
}

.headerbg img {
  /* color: #ff6c00;
  font-style: italic; */
  display: inline-block;
  margin: 0 auto; /* Center horizontally, with margin on the bottom */

  padding: 5px 0;
  height:80px;
  width:110;

 
}
.form-Wrapper {
    padding: 20px;
}

.form-group.focused label::after {
  left: 0;
  visibility: visible;
  width: 100%;
}
button.btn {
  background: #ff6c00;
  border: none;
  border-radius: 0;
  text-transform: uppercase;
 font-weight: bold;
  width: 180px;
  height: 45px;
  margin: 30px auto;
  display: block;
}
button.btn:hover, button.btn:focus {
  background:#e96800;
}

/*for slideDown animation*/

.slideDown {
    animation-duration: 1.5s;
    animation-name: slideDown;
    animation-timing-function: ease;
    visibility: visible !important;
}
@keyframes slideDown {
0% {
    transform: translateY(-100%);
}
50% {
    transform: translateY(8%);
}
65% {
    transform: translateY(-4%);
}
80% {
    transform: translateY(4%);
}
95% {
    transform: translateY(-2%);
}
100% {
    transform: translateY(0%);
}
}


    </style>
</head>
<body>

<div class='container'>
  <div class='row'>
    <div class='col-md-12'>
    <form class="slideDown" method="post">
        <div class="headerbg">
      <img src="../vergara_midterm/img/icon-removebg-preview.png" alt="Icon" id="icon">
      </div>
      <div class="form-Wrapper">
        <div class="form-group">            
            <input type="text" class="form-control" name="username">
          <label for="username">Username</label>
        </div>
        <div class="form-group">           
            <input type="password" class="form-control" name="password">
           <label for="password">Password</label>
        </div>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
      </div>
    </form>
    </div>
  </div>
</div>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script>
    jQuery(document).ready(function($) {

$(".form-control").focus(function(){
  $(this).parent().removeClass("not-focused");
  $(this).parent().addClass("focused");

 }).blur(function(){
      $(this).parent().removeClass("focused");
  $(this).parent().addClass("not-focused");
 })

}); 
   </script>
</body>
</html>