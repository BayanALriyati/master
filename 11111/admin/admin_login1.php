<?php 
 session_start();
//  dashboard.php
include '../components/connect.php' ;

 if (isset($_SESSION['admin_id'])){
  header('Location:dashboard.php'); // Redirect To Dashboard Page
 }



// Check If USER Coming From HTTP Post Request 
if ($_SERVER['REQUEST_METHOD']== 'POST'){

  $username= $_POST['name'];
  $password= $_POST['pass'];
  $hashedPass = sha1($password);
  // echo $hashedPass  ;
  // echo $username . ' ' . $password ;

  // Check If The USER Exist In Database

  $admin= $con->prepare("SELECT User_id,UserName,Password FROM 	users WHERE username=? AND password=? AND Role= 1");
  $admin->execute([$username,  $password]) ;
  $row = $admin->fetch(PDO::FETCH_ASSOC);
  // print_r($row);
  $count = $admin->rowCount();

  // If Count > 0 This Mean The Database Contain About This Username
  if ($count > 0){
    $_SESSION['admin_id'] =  $row['User_id']; // Register Session id(user) 
    header('Location:/dashboard.php'); // Redirect To Dashboard Page
    exit();
  }else{
    $message[] = 'incorrect username or password!';
 }

}
include '../components/header.php';
include '../components/footer.php';
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font- 
    awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

 <!-- login form  -->

 <section class="vh-100 mt-5" style="background:url(../images/heading-bg.jpg);">
    <div class="container h-100">
    <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="mt-5 d-flex justify-content-around alert alert-warning alert-dismissible fade show bg-danger-subtle">
            <div> 
               <span>'.$message.'</span>
            </div>   
            <div>
               <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
         </div>
         ';
      }
   }
?>
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-m-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img src="../images/logo-color.png"
                    class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login Admin</p>
  
                  <form class="mx-1 mx-md-4" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example3c">User Name</label>
                        <input type="text" id="LoginText" name="name" class="form-control" 
                            placeholder="Enter User Name" />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example4c">Password</label>
                        <input type="password" id="LoginPassword" name="pass" class="form-control" 
                            placeholder="Enter password"/>
                      </div>
                    </div>
  
                    <!-- <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <p>don't have an account ? <a href="./register.html">create one</a></p>
                    </div> -->

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" value="login" class="btn">Login</button>
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

<!-- End login form  -->

<!-- <script src="../layouts/js/admin.js"></script>
</body>
</html> -->