
<?php
include 'landlord_header.php';
 ?>


    <!-- Content Wrapper -->
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
          <h1 class="h3 mb-2 text-gray-800" align = "center">Tenant-In Details</h1>

          <div class="card shadow mb-4">

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Contract ID</th>
                      <th>Name</th>
                      <th>Status of<br/>Keyholder</th>
                      <th>Status of<br/>Electricity Remote</th>
                      <th>Number of Bulbs</th>
                      <th>Status of<br/>Bulbs</th>
                      <th>Status of<br/>Paint</th>
                      <th>Status of<br/>Windows</th>
                      <th>Status of<br/>Toilet Sink</th>
                      <th>Status of<br/>Washing Sink</th>
                      <th>Status of<br/>Door Lock</th>
                      <th>Status of<br/>Toilet Door Lock</th>
                      <th>Comments</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql = "SELECT * FROM tenant_out";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);

                    do{
                      $c_id = $row['contract_id'];
                      $query = "SELECT * FROM contract WHERE contract_id = '$c_id'";
                      $result1 = mysqli_query($con, $query);
                      $row1=mysqli_fetch_assoc($result1);
                      do{
                        $t_id = $row1['tenant_id'];
                        $query = "SELECT * FROM tenant WHERE tenant_id = '$t_id'";
                        $result2 = mysqli_query($con, $query);
                        $row2=mysqli_fetch_assoc($result2);
                        do{
                          $fname = $row2['fname'];
                          $lname = $row2['lname'];
                          $uname = $row2['u_name'];
                          $row2 = mysqli_fetch_assoc($result1);
                        }while ($row2);
                        $row1 = mysqli_fetch_assoc($result1);
                      }while ($row1);

                      echo '<tr>';
                      echo '<td>'.$c_id.'</td>';
                      echo '<td>'.$fname.' '.$lname.'<br/>('.$uname.')</td>';
                      echo '<td>'.$row['stat_keyholder'].'</td>';
                      echo '<td>'.$row['stat_electricityRemote'].'</td>';
                      echo '<td>'.$row['no_bulbs'].'</td>';
                      echo '<td>'.$row['stat_bulbs'].'</td>';
                      echo '<td>'.$row['stat_paint'].'</td>';
                      echo '<td>'.$row['stat_Windows'].'</td>';
                      echo '<td>'.$row['stat_toiletSink'].'</td>';
                      echo '<td>'.$row['stat_washingSink'].'</td>';
                      echo '<td>'.$row['stat_doorLock'].'</td>';
                      echo '<td>'.$row['stat_toiletDoorLock'].'</td>';
                      echo '<td>'.$row['comments'].'</td>';
                      echo '<td>'.$row['date_reg'].'</td>';
                      echo '</tr>';
                      $row = mysqli_fetch_assoc($result);
                    }while ($row);
                     ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Realest-IT</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
      </div>

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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
