<?php

include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
// session_start();

// $admin_id = $_SESSION['admin_id'];

// $_SESSION['UserName'] = $_SESSION['admin_id'];

// if (isset($_SESSION['UserName'])){
//  echo 'welcome' . $_SESSION['UserName'];
//  header('Location: dashboard.php'); 
//  Redirect To Dashboard Page

// }else{
//  echo 'error';
//  header('Location: admin_login.php'); 
//  Redirect To Dashboard Page
// } 


include '../components/header.php';
include '../components/sidebar.php';
include '../components/navbar.php';
include '../components/footer.php';
?>




   

		 