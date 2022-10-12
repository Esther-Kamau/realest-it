
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
          <h1 class="h3 mb-2 text-gray-800" align = "center">Contracts</h1>

          <div class="card shadow mb-4">

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Contract ID</th>
                      <th>Name</th>
                      <th>House Name</th>
                      <th>Duration of Occupation in months</th>
                      <th>Total Rent(Ksh.)</th>
                      <th>Terms of Payment</th>
                      <th>Rent per Term(Tsh.)</th>
                      <th>Beginning of Contract</th>
                      <th>End of Contract</th>
                      <th>Date of signing the Contract</th>
                      <th>Contract Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql = "SELECT * FROM contract";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);

                    do{
                      $t_id = $row['tenant_id'];
                      $c_id = $row['contract_id'];
                      $query = "SELECT * FROM tenant WHERE tenant_id = '$t_id'";
                      $result1 = mysqli_query($con, $query);
                      $row1=mysqli_fetch_assoc($result1);
                      do{
                        $fname = $row1['fname'];
                        $lname = $row1['lname'];
                        $uname = $row1['u_name'];
                        $row1 = mysqli_fetch_assoc($result1);
                      }while ($row1);

                      $h_id = $row['house_id'];
                      $query1 = "SELECT * FROM house WHERE house_id = '$h_id'";
                      $result2 = mysqli_query($con, $query1);
                      $row2=mysqli_fetch_assoc($result2);
                      do{
                        $hname = $row2['house_name'];
                        $row2 = mysqli_fetch_assoc($result2);
                      }while ($row2);

                      $dur = $row['duration_month'];
                      $total1= 0;
                      $total = $row['total_rent'];
                      for ($i=1; $i <= mysqli_num_rows($result); $i++) {
                        $total1 += $total;
                      }
                      $term = $row['terms'];
                      $per = $row['rent_per_term'];
                      $start = $row['start_day'];
                      $end = $row['end_day'];
                      $sign = $row['date_contract_sign'];
                      $stat = $row['status'];
                      $cid = $row['contract_id'];
                      if ($stat == "Active") {
                        echo '<tr>';
                        echo '<td>'.$cid.'</td>';
                        echo '<td>'.$fname.' '.$lname.'<br/>('.$uname.')</td>';
                        echo '<td>'.$hname.'</td>';
                        echo '<td>'.$dur.'</td>';
                        echo '<td>'.number_format($total).'/=</td>';
                        echo '<td>'.$term.'</td>';
                        echo '<td>'.number_format($per).'/=</td>';
                        echo '<td>'.$start.'</td>';
                        echo '<td>'.$end.'</td>';
                        echo '<td>'.$sign.'</td>';
                        echo "<td style = 'color:green;'>".$stat."</td>";
                        echo "<td align = 'center'><a href='delete_contract.php?id=".$row['contract_id']."' class='btn btn-danger btn-circle'><i class='fas fa-trash'></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='edit_contract.php?id=".$row['tenant_id']."' class='btn btn-success btn-circle'><i class='fas fa-edit'></i></a></td>";
                        echo '</tr>';
                      }
                      else {
                        echo '<tr>';
                        echo '<td>'.$cid.'</td>';
                        echo '<td>'.$fname.' '.$lname.'<br/>('.$uname.')</td>';
                        echo '<td>'.$hname.'</td>';
                        echo '<td>'.$dur.'</td>';
                        echo '<td>'.number_format($total).'/=</td>';
                        echo '<td>'.$term.'</td>';
                        echo '<td>'.number_format($per).'/=</td>';
                        echo '<td>'.$start.'</td>';
                        echo '<td>'.$end.'</td>';
                        echo '<td>'.$sign.'</td>';
                        echo "<td style = 'color:red;'>".$stat."</td>";
                        echo "<td align = 'center'><a href='delete_contract.php?id=".$row['contract_id']."' class='btn btn-danger btn-circle'><i class='fas fa-trash'></i></a></td>";
                        echo '</tr>';
                      }




                      $row = mysqli_fetch_assoc($result);
                    }while ($row);


                     ?>

                  </tbody>
                </table>

                <hr>
                <br/>
                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                  <tbody>
                    <?php
                    $sql = "SELECT SUM(total_rent) FROM contract";
                    $query = mysqli_query($con,$sql);
                    $res = mysqli_fetch_assoc($query);

                    do {
                      $total = $res['SUM(total_rent)'];
                      $res = mysqli_fetch_assoc($query);
                    } while ($res);

                    echo '<tr>';
                    echo '<td><b><b>EXPECTED INCOME</b></b></td>';
                    echo "<td><b><b><span style = 'color:orange;'>Ksh. ".number_format($total).'/=</b></b></td>';
                    echo '</tr>';

                    $sql1 = "SELECT * FROM contract WHERE status = 'Active'";
                    $result1 = mysqli_query($con, $sql1);
                    echo '<tr>';
                    echo "<td><b><b>TOTAL NUMBER OF <span style = 'color:green;'>ACTIVE</span> CONTRACTS</b></b></td>";
                    echo "<td><b><b><span style = 'color:green;'>".mysqli_num_rows($result1)."</span></b></b></td>";
                    echo '</tr>';

                    $sql2 = "SELECT * FROM contract WHERE status = 'Inactive'";
                    $result2 = mysqli_query($con, $sql2);
                    echo '<tr>';
                    echo "<td><b><b>TOTAL NUMBER OF <span style = 'color:red;'>INACTIVE</span> CONTRACTS</b></b></td>";
                    echo "<td><b><b><span style = 'color:red;'>".mysqli_num_rows($result2)."</span></b></b></td>";
                    echo '</tr>';


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
            <span>REALEST-IT</span>
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

   <!-- Vendor JS Files -->
   <script src="assets/vendor/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/vendor/php-email-form/validate.js"></script>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- template main js file  -->
    <script src="js/main.js"></script>

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
