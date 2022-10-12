<?php
session_start();
include "conn.php";
if($_SESSION['role'] != 'Landlord'){
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="landlord_home.php">
       <img src="./branding/branding.png" style="height:50px" alt="">
       </a>

       <!-- Divider -->

       <!-- Nav Item - Dashboard -->
       <li class="nav-item">
         <a class="nav-link" href="landlord_home.php">
           <i class="bi bi-grid"></i>
           
           <span>Dashboard</span></a>
       </li>

       <!-- Divider -->

       <!-- Heading -->

       <!-- Nav Item - Pages Collapse Menu -->
      

       <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
            <i class="bi bi-building"></i> 
            <span>Properties</span></a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <a class="collapse-item" href="landlord_properties.php">Properties</a>
             <a class="collapse-item" href="units.php">Units</a>
             <!-- <a class="collapse-item" href="change_cost.php">Change the Cost of the<br/>House</a> -->
             <!-- <a class="collapse-item" href="edit_house.php">Edit House Information</a> -->
           </div>
         </div>
        </li>
      

      

       
       <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
           <i class="fas fa-home fa-cog"></i>
           <span>House</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <a class="collapse-item" href="house_detail.php">House Information</a>
             <a class="collapse-item" href="add_house.php">Add a House</a>
             <a class="collapse-item" href="change_cost.php">Change the Cost of the<br/>House</a>
             <a class="collapse-item" href="edit_house.php">Edit House Information</a>
           </div>
         </div>
       </li>

       
       <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
           <i class="fas fa-user fa-cog"></i>
           <span>Tenants</span>
         </a>
         <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <!-- <h6 class="collapse-header">Details:</h6> -->
             <a class="collapse-item" href="tenant_detail.php">Tenant Information</a>
             <a class="collapse-item" href="tenant_contact.php">Tenants' Contact</a>
             <!-- <a class="collapse-item" href="admin_tenantIn.php">Tenant-In Details</a> -->
             <!-- <a class="collapse-item" href="admin_tenantOut.php">Tenant-Out Details</a> -->
             <a class="collapse-item" href="edit_tenant.php">Edit Tenant Information</a>
           </div>
         </div>
       </li>

        <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
           <i class="fas fa-clipboard-list"></i>
           <span>Contract</span>
         </a>
         <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <!-- <h6 class="collapse-header">Details:</h6> -->
             <a class="collapse-item" href="contract_detail.php">Contract Information</a>
             <a class="collapse-item" href="edit_contract.php">Edit Contract Information</a>
             <a class="collapse-item" href="edit_contract_part.php">Edit Contract Information<br/>(Part)</a>
           </div>
         </div>
       </li>
       <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
           <i class="fas fa-dollar-sign fa-cog"></i>
           <span>Payment</span>
         </a>
         <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
           <div class="bg-white py-2 collapse-inner rounded">
             <!-- <h6 class="collapse-header">Details:</h6> -->
             <a class="collapse-item" href="payment_detail.php">Payment Information</a>
             <a class="collapse-item" href="edit_pay.php">Edit Payment</a>
           </div>
         </div>
       </li>

       <!-- Nav Item - Charts -->
       <!-- <li class="nav-item">
         <a class="nav-link" href="form_out.php">
           <i class="fas fa-fw fa-clipboard-list"></i>
           <span>Tenant-Out form</span>
         </a>

       </li> -->


       <!-- Nav Item - Charts -->
       <!-- <li class="nav-item">

         <a class="nav-link" href="send-sms.php">
           <i class="fas fa-fw fa-comments"></i>
           <span>Messaging</span></a>
       </li> -->




       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
         <a class="nav-link" href="a_change.php">
           <i class="fas fa-fw fa-exchange-alt"></i>
           <span>Change Password</span>
         </a>

       </li>
       <hr class="sidebar-divider">
       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
         <a class="nav-link" href="a_register.php">
           <i class="fas fa-fw fa-user"></i>
           <span>Register Property Manager</span>
         </a>

       </li>

       <!-- Nav Item - Tables -->

       <!-- Divider -->
       <hr class="sidebar-divider d-none d-md-block">

       <!-- Sidebar Toggler (Sidebar) -->
       <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
       </div>

     </ul>
