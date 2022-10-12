<?php
include 'landlord_header.php';
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

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800" align = "center">Tenants' Contact</h1>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tenant's Name</th>
                      <th>Contact's Name</th>
                      <th>Occupation</th>
                      <th>Nature of the Relationshiip</th>
                      <th>Phone # 1</th>
                      <th>Phone # 2</th>
                      <th>Email</th>
                      <th>Postal Address</th>
                      <th>City</th>
                      <th>Region</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql = "SELECT * FROM tenant_contacts";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);

                    do{
                      $id = $row['tenant_id'];
                      $sql1 = "SELECT * FROM tenant WHERE tenant_id = '$id'";
                      $result1 = mysqli_query($con, $sql1);
                      $row1 = mysqli_fetch_assoc($result1);
                      do {
                        $fname = $row1['fname'];
                        $lname = $row1['lname'];
                        $row1 = mysqli_fetch_assoc($result1);
                      } while ($row1);

                      $cfname = $row['fname1'];
                      $clname = $row['lname1'];
                      $occ = $row['occupation1'];
                      $pno1 = $row['pno1'];
                      $pno2 = $row['pno2'];
                      if($pno2 == ""){
                        $pno2 = '-';
                      }
                      $pno3 = $row['pno3'];
                      $pno4 = $row['pno4'];
                      if($pno4 == ""){
                        $pno4 = '-';
                      }
                      $email = $row['e_address1'];
                      if($email == ""){
                        $email = '-';
                      }
                      $email1 = $row['e_address2'];
                      if($email1 == ""){
                        $email1 = '-';
                      }
                      $postal = $row['p_address1'];
                      $city = $row['city1'];
                      $region = $row['region1'];
                      $nature = $row['nature1'];


                      $cfname1 = $row['fname2'];
                      $clname1 = $row['lname2'];
                      $occ1 = $row['occupation2'];

                      $postal1 = $row['p_address2'];
                      $city1 = $row['city1'];
                      $region1 = $row['region2'];
                      $nature1 = $row['nature2'];

                      echo '<tr>';
                      echo '<td>'.$fname.' '.$lname.'</td>';
                      echo '<td>'.$cfname.' '.$clname.'</td>';
                      echo '<td>'.$occ.'</td>';
                      echo '<td>'.$nature.'</td>';
                      echo '<td>'.$pno1.'</td>';
                      echo '<td>'.$pno2.'</td>';
                      echo '<td>'.$email.'</td>';
                      echo '<td>'.$postal.'</td>';
                      echo '<td>'.$city.'</td>';
                      echo '<td>'.$region.'</td>';
                      echo '</tr>';

                      echo '<tr>';
                      echo '<td>'.$fname.' '.$lname.'</td>';
                      echo '<td>'.$cfname1.' '.$clname1.'</td>';
                      echo '<td>'.$occ1.'</td>';
                      echo '<td>'.$nature1.'</td>';
                      echo '<td>'.$pno3.'</td>';
                      echo '<td>'.$pno4.'</td>';
                      echo '<td>'.$email1.'</td>';
                      echo '<td>'.$postal1.'</td>';
                      echo '<td>'.$city1.'</td>';
                      echo '<td>'.$region1.'</td>';
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
        <!-- /.container-fluid -->

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
<!-- Vendor JS Files -->
<script src="assets/vendor/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/vendor/php-email-form/validate.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
