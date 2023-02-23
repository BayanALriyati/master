<?php

include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email= $_POST['email'];
    $fullName= $_POST['fullName'];
    $password= $_POST['new_pass'];

    // $curr_pass= $_POST['email'];

    $update_profile = $con->prepare("UPDATE `users` SET UserName = ? , Email =? , FulName = ? , Password =? , WHERE User_id =?  ");
    $update_profile->execute([$name , $email , $fullName , $admin_id]);
 
    $select_admin = $con->prepare("SELECT * FROM `users` WHERE User_id = $admin_id AND Role= 1");
    $select_admin->execute();
     $fetch_admin = $select_admin->fetchAll(PDO::FETCH_ASSOC);
     $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
 
    $prev_pass = $_POST['prev_pass'];
    $current_pass = $_POST['curr_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];
    if($current_pass == $empty_pass){
       $message[] = 'please enter old password!';
    }elseif($current_pass != $prev_pass){
       $message[] = 'old password not matched!';
    }elseif($new_pass != $confirm_pass){
       $message[] = 'confirm password not matched!';
    }else{
       if($new_pass != $empty_pass){
          $update_pass = $con->prepare("UPDATE `users` SET Password = ? WHERE User_id = ?");
          $update_pass->execute([$confirm_pass, $admin_id]);
          $message[] = 'password updated successfully!';
       }else{
          $message[] = 'please enter a new password!';
       }
    }
    
 }
 

include '../components/header.php';
include '../components/sidebar.php';
include '../components/navbar.php';
include '../components/footer.php';
?>

<div class="container">
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
<div class="row flex-lg-nowrap">
  <!-- <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
    <div class="card p-3">
      <div class="e-navlist e-navlist--active-bg">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link px-2 active" href="#"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Overview</span></a></li>
          <li class="nav-item"><a class="nav-link px-2" href="https://www.bootdey.com/snippets/view/bs4-crud-users" target="__blank"><i class="fa fa-fw fa-th mr-1"></i><span>CRUD</span></a></li>
          <li class="nav-item"><a class="nav-link px-2" href="https://www.bootdey.com/snippets/view/bs4-edit-profile-page" target="__blank"><i class="fa fa-fw fa-cog mr-1"></i><span>Settings</span></a></li>
        </ul>
      </div>
    </div>
  </div> -->
  <?php $select_admin = $con->prepare("SELECT * FROM `users` WHERE User_id = $admin_id");
   $select_admin->execute();
	$fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);?>
  <input type="hidden" name="prev_pass" value="<?= $fetch_admin['Password'];?> ">

  <div class="col">
    <div class="row">
      <div class="col mb-3 mt-5">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                      <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap" ><?= $fetch_admin['UserName'];?></h4>
                    <p class="mb-0"><?= $fetch_admin['Email'];?></p>
                    <div class="mt-2">
                      <button class="btn btn-block" type="button">
                        <i class="fa fa-fw fa-camera"></i>
                        <span>Change Photo</span>
                      </button>
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">administrator</span>
                    <div class="text-muted"><small>Joined 09 Dec 2017</small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <form class="form" method="POST">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Full Name</label>
                              <input class="form-control" type="text" name="fullName" value="<?= $fetch_admin['FullName']; ?>" required>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Username</label>
                              <input class="form-control" type="text" name="name" value="<?= $fetch_admin['UserName']; ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="text"  name="email" value="<?= $fetch_admin['Email']; ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>About</label>
                              <textarea class="form-control" rows="5" placeholder="My Bio"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Change Password</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Current Password</label>
                              <input class="form-control" type="password" name="curr_pass" placeholder="••••••" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" type="password" name="new_pass" placeholder="••••••" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                              <input class="form-control" type="password" name="confirm_pass" placeholder="••••••"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                        <div class="row">
                          <div class="col">                            
                            <div class="custom-controls-stacked px-3" class="imgUpdate">
                              <img src="../images/edit.png" class="imgUpdate">  
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-block" type="submit">Save Changes</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-3 mb-3 mt-5">
        <div class="card mb-3">
          <div class="card-body">
            <div class="px-xl-3">
              <button class="btn btn-block btn-secondary">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
              </button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h6 class="card-title font-weight-bold">Support</h6>
            <p class="card-text">Get fast, free help from our friendly assistants.</p>
            <button type="button" class="btn btn-primary">Contact Us</button>
          </div>
        </div>
      </div>
    </div>
    <?php
?>
  </div>

</div>
</div>