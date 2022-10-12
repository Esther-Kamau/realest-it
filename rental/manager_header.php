<?php
session_start();
include "conn.php";

$user = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE u_name = '$user'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
do {
  $role = $row['role'];
  $row = mysqli_fetch_assoc($res);
} while ($row);
if(!$user && $role == 'Manager'){
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

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/styles2.css" rel="stylesheet">

  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/vendor/simple-datatables/style.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="manager_home.php">

      <img src="./branding/branding.png" style="height:50px" alt="">
      </a>

      <!-- Divider -->

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
           <i class="fas fa-home fa-cog"></i>
           <span>House</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <h6 class="collapse-header">Details:</h6>
             <a class="collapse-item" href="house_detail.php">House Information</a>
             <a class="collapse-item" href="add_house.php">Add a House</a>
             <a class="collapse-item" href="change_cost.php">Change the Cost of the<br/>House</a>
             <a class="collapse-item" href="edit_house.php">Edit House Information</a>
           </div>
         </div>
       </li>

      <li class="nav-item">
        <a class="nav-link" href="manager_home.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Tenant</span></a>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="list.php">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>List of Payments</span></a>
      </li>
      <hr class="sidebar-divider">

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="mform_out.php">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Tenant-Out form</span>
        </a>

      </li>
      <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="m_change.php">
          <i class="fas fa-fw fa-exchange-alt"></i>
          <span>Change Password</span>
        </a>

      </li>



      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->