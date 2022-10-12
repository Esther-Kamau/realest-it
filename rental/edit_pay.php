<?php
include "landlord_header.php";
?>
     <div id="content-wrapper" class="d-flex flex-column">

       <!-- Main Content -->
       <div id="content">

         <!-- Topbar -->
         <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

           <!-- Sidebar Toggle (Topbar) -->
           <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
             <i class="fa fa-bars"></i>
           </button>


           <ul class="navbar-nav ml-auto">


             <div class="topbar-divider d-none d-sm-block"></div>

             <!-- Nav Item - User Information -->
             <li class="nav-item dropdown no-arrow">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php

                 include "conn.php";
                 $uname = $_SESSION['username'];
                 echo "<b><b>".$uname."</b></b>";

                   ?></span>
                 <img class="img-profile rounded-circle" src="user.png">
               </a>
               <!-- Dropdown - User Information -->
               <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                   <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                   Logout
                 </a>

             </li>

           </ul>

         </nav>
         <!-- End of Topbar -->

         <!-- Begin Page Content -->
         <div class="container-fluid">
           <h1 class="h3 mb-2 text-gray-800" align="center">Edit Payment.</h1>
           <p style="color:red;"><b><b>Please choose a particular payment to change from the table showing payment information.</b></b></p>

           <div class="card shadow mb-4">
             <div class="card-body">
               <div class="table-responsive">
                 <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

                   <tbody>
                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                       <tr>
                         <td>
                           Payment ID:
                         </td>
                         <td><input type='text' class='form-control form-control-user' name='id' value = "<?php echo  @$_GET['id']; ?>" readonly></td>
                       </tr>
                       <tr>
                         <td>
                           Payment From:
                         </td>
                         <td>
                           <select class="custom-select" name="from" id="terms" style="width:300px;">
                             <option value = "January <?php echo date('Y'); ?>">January <?php echo date('Y'); ?></option>
                             <option value = "February <?php echo date('Y'); ?>">February <?php echo date('Y'); ?></option>
                             <option value = "March <?php echo date('Y'); ?>">March <?php echo date('Y'); ?></option>
                             <option value = "April <?php echo date('Y'); ?>">April <?php echo date('Y'); ?></option>
                             <option value = "May <?php echo date('Y'); ?>">May <?php echo date('Y'); ?></option>
                             <option value = "June <?php echo date('Y'); ?>">June <?php echo date('Y'); ?></option>
                             <option value = "July <?php echo date('Y'); ?>">July <?php echo date('Y'); ?></option>
                             <option value = "August <?php echo date('Y'); ?>">August <?php echo date('Y'); ?></option>
                             <option value = "September <?php echo date('Y'); ?>">September <?php echo date('Y'); ?></option>
                             <option value = "October <?php echo date('Y'); ?>">October <?php echo date('Y'); ?></option>
                             <option value = "November <?php echo date('Y'); ?>">November <?php echo date('Y'); ?></option>
                             <option value = "December <?php echo date('Y'); ?>">December <?php echo date('Y'); ?></option>
                             <option value = "January <?php echo date('Y')+1; ?>">January <?php echo date('Y')+1; ?></option>
                             <option value = "February <?php echo date('Y')+1; ?>">February <?php echo date('Y')+1; ?></option>
                             <option value = "March <?php echo date('Y')+1; ?>">March <?php echo date('Y')+1; ?></option>
                             <option value = "April <?php echo date('Y')+1; ?>">April <?php echo date('Y')+1; ?></option>
                             <option value = "May <?php echo date('Y')+1; ?>">May <?php echo date('Y')+1; ?></option>
                             <option value = "June <?php echo date('Y')+1; ?>">June <?php echo date('Y')+1; ?></option>
                             <option value = "July <?php echo date('Y')+1; ?>">July <?php echo date('Y')+1; ?></option>
                             <option value = "August <?php echo date('Y')+1; ?>">August <?php echo date('Y')+1; ?></option>
                             <option value = "September <?php echo date('Y')+1; ?>">September <?php echo date('Y')+1; ?></option>
                             <option value = "October <?php echo date('Y')+1; ?>">October <?php echo date('Y')+1; ?></option>
                             <option value = "November <?php echo date('Y')+1; ?>">November <?php echo date('Y')+1; ?></option>
                             <option value = "December <?php echo date('Y')+1; ?>">December <?php echo date('Y')+1; ?></option>
                           </select>
                         </td>
                       </tr>
                       <tr>
                         <td>
                           To:
                         </td>
                         <td>
                           <select class="custom-select" name="to" id="terms" style="width:300px;">
                             <option value = "January <?php echo date('Y'); ?>">January <?php echo date('Y'); ?></option>
                             <option value = "February <?php echo date('Y'); ?>">February <?php echo date('Y'); ?></option>
                             <option value = "March <?php echo date('Y'); ?>">March <?php echo date('Y'); ?></option>
                             <option value = "April <?php echo date('Y'); ?>">April <?php echo date('Y'); ?></option>
                             <option value = "May <?php echo date('Y'); ?>">May <?php echo date('Y'); ?></option>
                             <option value = "June <?php echo date('Y'); ?>">June <?php echo date('Y'); ?></option>
                             <option value = "July <?php echo date('Y'); ?>">July <?php echo date('Y'); ?></option>
                             <option value = "August <?php echo date('Y'); ?>">August <?php echo date('Y'); ?></option>
                             <option value = "September <?php echo date('Y'); ?>">September <?php echo date('Y'); ?></option>
                             <option value = "October <?php echo date('Y'); ?>">October <?php echo date('Y'); ?></option>
                             <option value = "November <?php echo date('Y'); ?>">November <?php echo date('Y'); ?></option>
                             <option value = "December <?php echo date('Y'); ?>">December <?php echo date('Y'); ?></option>
                             <option value = "January <?php echo date('Y')+1; ?>">January <?php echo date('Y')+1; ?></option>
                             <option value = "February <?php echo date('Y')+1; ?>">February <?php echo date('Y')+1; ?></option>
                             <option value = "March <?php echo date('Y')+1; ?>">March <?php echo date('Y')+1; ?></option>
                             <option value = "April <?php echo date('Y')+1; ?>">April <?php echo date('Y')+1; ?></option>
                             <option value = "May <?php echo date('Y')+1; ?>">May <?php echo date('Y')+1; ?></option>
                             <option value = "June <?php echo date('Y')+1; ?>">June <?php echo date('Y')+1; ?></option>
                             <option value = "July <?php echo date('Y')+1; ?>">July <?php echo date('Y')+1; ?></option>
                             <option value = "August <?php echo date('Y')+1; ?>">August <?php echo date('Y')+1; ?></option>
                             <option value = "September <?php echo date('Y')+1; ?>">September <?php echo date('Y')+1; ?></option>
                             <option value = "October <?php echo date('Y')+1; ?>">October <?php echo date('Y')+1; ?></option>
                             <option value = "November <?php echo date('Y')+1; ?>">November <?php echo date('Y')+1; ?></option>
                             <option value = "December <?php echo date('Y')+1; ?>">December <?php echo date('Y')+1; ?></option>
                           </select>
                         </td>
                       </tr>

                     <tr>
                     <td></td>
                     <td><input class='btn btn-success btn-user btn-lg' type='submit' name='submit' value='Submit'></td>
                     </form>
                    </tr>
                     <?php
                     if (isset($_POST['submit'])) {
                       $id = $_POST['id'];
                       $from = $_POST['from'];
                       $to = $_POST['to'];

                       $sql1 = "UPDATE payment SET pay_from= '$from', pay_to= '$to' WHERE payment_id = '$id'";
                       if(mysqli_query($con, $sql1)){
                         echo "<script type='text/javascript'>alert('Updated Successfully!!!');</script>";
                         echo '<style>body{display:none;}</style>';
                         echo '<script>window.location.href = "payment_detail.php";</script>';
                         exit;
                       }



                     }
                      ?>

                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
         <!-- /.container-fluid -->

       </div>
       <!-- End of Main Content -->

       <!-- Footer -->
       <footer class="sticky-footer bg-white">
         <div class="container my-auto">
           <div class="copyright text-center my-auto">
             <span>Copyright &copy; RHMS 2019</span>
           </div>
         </div>
       </footer>
       <!-- End of Footer -->

     </div>
     <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
         <div class="modal-footer">
           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
           <a class="btn btn-success" href="logout.php">Logout</a>
         </div>
       </div>
     </div>
   </div>

   <script>
     if ( window.history.replaceState ) {
       window.history.replaceState( null, null, window.location.href );
     }
   </script>


   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="js/sb-admin-2.min.js"></script>

   <!-- Page level plugins -->
   <script src="vendor/datatables/jquery.dataTables.min.js"></script>
   <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/demo/datatables-demo.js"></script>

 </body>

 </html>
