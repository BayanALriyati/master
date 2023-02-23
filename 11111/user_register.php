<?php

include '../components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = htmlspecialchars($name, ENT_QUOTES);
   $email = $_POST['email'];
   $email = htmlspecialchars($email, ENT_QUOTES);
   $pass = sha1($_POST['pass']);
   $pass =htmlspecialchars($pass, ENT_QUOTES);
   $cpass = sha1($_POST['cpass']);
   $cpass = htmlspecialchars($cpass, ENT_QUOTES);
   // $mobile = $_POST['mobile'];

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'Email <span style="color:red">Already</span> Exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm Password <span style="color:red">Not Matched</span>!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password, mobile) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $cpass, $mobile]);
         $message[] = 'Registered <span style="color:green">Successfully</span>, Login Now Please!';
      }
   }

   // $select_user_for_cart = $conn->prepare("SELECT * FROM `users` ORDER BY user_id DESC LIMIT 1");
   // $select_user_for_cart->execute();
   // if($select_user_for_cart->rowCount()>0){
   //    while($fetch_select_user_for_cart = $select_user_for_cart->fetch(PDO::FETCH_ASSOC)){
   //       $user_id = $fetch_select_user_for_cart['user_id'];
   //       $cart_array = $_SESSION['cart'];
   //       for( $i = 0 ; $i < count($cart_array) ; $i++){
   //          $sql = $conn->prepare("INSERT INTO cart (user_id , product_id , name , price , image , quantity)
   //                                  VALUES (?,?,?,?,?,?)");
   //          $sql->execute([$user_id , $cart_array[$i][0],$cart_array[$i][1],$cart_array[$i][2],$cart_array[$i][3],$cart_array[$i][4]]);
   //       }
   //       $fav_array = $_SESSION['cart'];
   //       for( $i = 0 ; $i < count($fav_array) ; $i++){
   //          $stm = $conn->prepare("INSERT INTO favorite (user_id , product_id)
   //                                  VALUES (?,?)");
   //          $stm->execute([$user_id , $fav_array[$i][0]]);
   //       }
   //    }
   // }

   // $_SESSION['cart']=[];
   // $_SESSION['fav']=[];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="./images/logo.png">

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->
   <style>
   <?php 
include("css/user.css");

?>
</style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- header section ends -->

<div class="heading-main">
    <h3>Register</h3>
    <p><a href="home.html">home </a> <span> / Register</span></p>
 </div>

<section class="w-100 vh-100 mt-5" style="background:url(./images/heading-bg.jpg);">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-20">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-m-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                    <img src="./images/logo-color.png"
                      class="img-fluid" alt="Sample image">
    
                  </div>
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
  
                  <form class="mx-1 mx-md-4">
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-3x mt-5 me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example1c">Your Name</label>
                        <input type="text" id="form3Example1c" class="form-control" />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-3x mt-5 me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <input type="email" id="form3Example3c" class="form-control" />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-3x mt-5 me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example4c">Password</label>
                        <input type="password" id="form3Example4c" class="form-control" />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-3x mt-5 me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                        <input type="password" id="form3Example4cd" class="form-control h" />
                      </div>
                    </div>
  
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="button" class="btn btn-danger-subtle text-black bg-danger-subtle  btn-lg">Register</button>
                    </div>
  
                  </form>
  
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>