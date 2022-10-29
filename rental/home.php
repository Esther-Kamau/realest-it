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
                <span class="mr-2 d-none d-lg-inline text-grey-900 small"><?php
//checks the role in the session and lists it
$uname = $_SESSION['username'];

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
<i class="bi bi-person text-gray-900"></i>
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
          
          <p class="mb-4"><span style="color:red;">You Occupy <b><b>House: <?php
          $query = "SELECT * FROM tenant WHERE u_name = '$uname' ";
          $result1 = mysqli_query($con, $query);
          $row=mysqli_fetch_assoc($result1);
          do{
            $id = $row['tenant_id'];
            $row = mysqli_fetch_assoc($result1);
          }while ($row);
          $sql = "SELECT * FROM contract WHERE tenant_id = '$id'";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_assoc($result);
          do{
            $unit_id = $row['unit_id'];
            $sql1 = "SELECT * FROM units WHERE unit_id = '$unit_id'";
            $result1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            do{
              $name = $row1['unit_name'];

              $row1 = mysqli_fetch_assoc($result1);
            }while ($row1);
            $row = mysqli_fetch_assoc($result);
          }while ($row);
          echo $name;
          ?></b></b></span></p>

          <p class="mb-4">The information below shows the amount to be paid with respect with  the terms stated and their respective due dates.</p>

          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Due Date</th>
                      <th>Amount to be Paid (Ksh.)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM tenant WHERE u_name = '$uname' ";
                    $result1 = mysqli_query($con, $query);
                    $row=mysqli_fetch_assoc($result1);
                    do{
                      $id = $row['tenant_id'];
                      $row = mysqli_fetch_assoc($result1);
                    }while ($row);

                    $sql = "SELECT * FROM contract WHERE tenant_id = '$id' AND status = 'Active'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $total = 0;
                    do{
                      $hid = $row['house_id'];
                      $dur = $row['duration_month'];
                      $term = $row['terms'];
                      $div = $dur/$term;
                      $day = $row['start_day'];
                      $day1  = date("Y-m-d", strtotime($day. "+ 2 days"));
                      echo '<tr>';
                      echo '<td>'.$day1.'</td>';
                      echo '<td>'.number_format($row['rent_per_term']).'/=</td>';
                      echo '<tr>';
                      for ($i = $div; $i < $dur; $i += $div) {
                        echo '<tr>';
                        $date  = date("Y-m-d", strtotime("+".$i." months" , strtotime("$day")));
                        $date1  = date("Y-m-d", strtotime($date. "+ 2 days"));
                        echo '<td>'.$date1.'</td>';
                        echo '<td>'.number_format($row['rent_per_term']).'/=</td>';
                        echo '<tr>';
                      }

                      echo '<tr><td><b><b><b>TOTAL</b></b></b></td><td>'.number_format($row['total_rent']).'/=</td></tr>';

                      $row = mysqli_fetch_assoc($result);
                    }while ($row);


                     ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
            <!-- <p class="mb-4">For more information or help please kindly contact us through:<br/><br/><b>Phone Number: +255 (0) 756 777 777.<br/>Email Address: rhms123@hotmail.com.</b></p> -->

        </div>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Realestit</span>
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
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

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

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
