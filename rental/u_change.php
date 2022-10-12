<?php
include "tenant_header.php";
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

                $uname = @$_SESSION['username'];
                $query = "SELECT * FROM tenant WHERE u_name = '$uname' ";
                $result = mysqli_query($con, $query);
                $row=mysqli_fetch_assoc($result);
                do{
                  $fname = $row['fname'];
                  $lname = $row['lname'];
                  $full = $fname." ".$lname;
                  echo $full;

                  $row = mysqli_fetch_assoc($result);
                }while ($row);
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
          <h1 class="h3 mb-2 text-gray-800" align="center">Change Password</h1>

          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

                  <tbody>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                    <tr>
                      <td>
                        Old Password:
                      </td>
                      <td><input type='text' class='form-control form-control-user' name='change'></td>
                    </tr>
                    <tr>
                      <td>
                        New Password:
                      </td>
                      <td><input type='password' class='form-control form-control-user' name='change1'></td>
                    </tr>
                    <tr>
                      <td>
                        Repeat the new Password:
                      </td>
                      <td><input type='password' class='form-control form-control-user' name='change2'></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td><input class='btn btn-primary btn-user btn-lg' type='submit' name='submit' value='Change Password'></td>
                    </form>
                    <tr>
                    <?php
                    if (isset($_POST['submit'])) {
                      $query = "SELECT * FROM tenant WHERE u_name = '$uname' ";
                      $result1 = mysqli_query($con, $query);
                      $row=mysqli_fetch_assoc($result1);
                      do{
                        $id = $row['tenant_id'];
                        $pword = $row['p_word'];
                        $row = mysqli_fetch_assoc($result1);
                      }while ($row);
                      $old = md5($_POST['change']);
                      $new = check($_POST['change1']);
                      $rnew = check($_POST['change2']);
                      if($old == $pword){
                          if(!($rnew == $new)){
                          echo "<script> alert('Password does not match.');</script>";
                          }else{
                              if((strlen($rnew) < 8) || (strlen($new) < 8)){
                                echo "<script> alert('Password is too short.');</script>";
                              }elseif(!($rnew == '') || !($new == '')){
                                $new = md5($new);
                                $sql = "UPDATE tenant SET p_word ='$new' WHERE tenant_id = '$id'";
                                $result = mysqli_query($con, $sql);
                                echo "<script> alert('Password has been changed successfully. New password will be effective upon new login.');</script>";
                                echo '<style>body{display:none;}</style>';
                                echo '<script>window.location.href = "u_change.php";</script>';
                                exit;
                              }
                        }

                      }else{
                        echo "<script> alert('The old password is incorrect.');</script>";
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
          <a class="btn btn-primary" href="logout.php">Logout</a>
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

  <!-- Vendor JS Files -->
  <script src="assets/vendor/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/vendor/php-email-form/validate.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- template main js file  -->
  <script src="js/main.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
