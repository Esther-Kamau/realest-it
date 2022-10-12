<?php
session_start();
include "conn.php";
if($_SESSION['role'] == 'Administator'){
  echo '<script>window.location.href = "login.php";</script>';
  exit();
}
 ?>
<!DOCTYPE html>
 <html lang="en">

 <head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>RealEst-IT</title>
  <link rel="icon" href="icon.svg">

   <!-- Custom fonts for this template -->
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="assets/css/styles2.css" rel="stylesheet">
   <link href="css/sb-admin-2.min.css" rel="stylesheet">

   <!-- Vendor CSS Files -->
  <link href="assets/vendor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/vendor/simple-datatables/style.css" rel="stylesheet">


   <!-- Custom styles for this page -->
   <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 </head>

 <body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">

     <!-- Sidebar -->
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

       <!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_home.php">
       <img src="./branding/branding.png" style="height:50px" alt="">
       </a>

       <!-- Divider -->

       <!-- Nav Item - Dashboard -->
       <li class="nav-item">
         <a class="nav-link" href="admin_home.php">
           <i class="bi bi-grid"></i>
           <span>Dashboard</span></a>
       </li>

      
    
       <hr class="sidebar-divider">
       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
         <a class="nav-link" href="l_register.php">
           <i class="fas fa-fw fa-user"></i>
           <span>Register</span>
         </a>

       </li>


       <!-- Divider -->
       <hr class="sidebar-divider d-none d-md-block">

       <!-- Sidebar Toggler (Sidebar) -->
       <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
       </div>

     </ul>
