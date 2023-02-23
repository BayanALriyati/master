<?php 
 session_start();
 include '../components/connect.php' ;

//  $admin_id = $_SESSION['admin_id'];

//  if (!isset($admin_id)){
//    header('location:admin_login.php'); // Redirect To Dashboard Page
//   }

  // if (!isset($_SESSION['admin_id'])){
  //  header('location:admin_login.php'); // Redirect To Dashboard Page
  // }
 
 
 
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
     header('Location:dashboard.php'); // Redirect To Dashboard Page
     exit();
   }else{
     $message[] = 'incorrect username or password!';
  }
 
 }

include '../components/header.php';
include '../components/footer.php';

?>



<div class="heading-main">
  <h3>Login</h3>
  <p><a href="home.html">home </a> <span> / Login</span></p>
</div>



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
                     <i class="fas fa-envelope fa-3x mt-5 me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example3c">User Name</label>
                        <input type="text" id="LoginText" name="name" class="form-control" 
                            placeholder="Enter User Name" />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                     <i class="fas fa-lock fa-3x  mt-5 me-3 fa-fw"></i>
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


  <!-- <section class="vh-100 mt-5" style="background:url(../images/heading-bg.jpg);">
    <div class="container h-100">
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
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
  
                  <form class="mx-1 mx-md-4">
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-3x mt-5 me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <input type="email" id="form3Example3c" class="form-control" placeholder="Enter your " />
                      </div>
                    </div>
  
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-3x  mt-5 me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-2">
                        <label class="form-label" for="form3Example4c">Password</label>
                        <input type="password" id="form3Example4c" class="form-control" placeholder="Enter your password"/>
                      </div>
                    </div>
  
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <p>don't have an account ? <a href="./register.html">create one</a></p>
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="button" value="login" class="btn btn-danger-subtle text-black bg-danger-subtle  btn-lg">Register</button>
                    </div>
                    
                  </form>
                  
                </div>
                
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->



