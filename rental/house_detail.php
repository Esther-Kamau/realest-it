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
                <span class="mr-2 d-none d-lg-inline text-black small"><?php

                include "conn.php";
                $uname = $_SESSION['username'];
                echo "<b><b>".$uname."</b></b>";

                  ?></span>
<i class="bi bi-person text-gray-900"></i>
          
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
          <h1 class="h3 mb-2 text-gray-800" align = "center">Houses</h1>

          <div class="card shadow mb-4">

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>House Name</th>
                      <th>Compartment</th>
                      <th>Rent per Month(Ksh.)</th>
                      <th>Status of the House</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql = "SELECT * FROM house";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);

                    do{
                      $hname = $row['house_name'];
                      $compartment = $row['compartment'];
                      $rent = $row['rent_per_month'];
                      $stat = $row['status'];
                      if ($stat == 'Occupied') {
                        echo '<tr>';
                        echo '<td>'.$hname.'</td>';
                        echo '<td>'.$compartment.'</td>';
                        echo '<td>'.number_format($rent).'/=</td>';
                        echo "<td style = 'color:green;'>".$stat."</td>";
                        echo "<td align = 'center'><a href='delete_house.php?id=".$row['house_id']."' class='btn btn-danger btn-circle'><i class='fas fa-trash'></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='edit_house.php?id=".$row['house_id']."' class='btn btn-success btn-circle'><i class='fas fa-edit'></i></a></td>";
                        echo '</tr>';
                      }
                      else {
                        echo '<tr>';
                        echo '<td>'.$hname.'</td>';
                        echo '<td>'.$compartment.'</td>';
                        echo '<td>'.number_format($rent).'/=</td>';
                        echo "<td style = 'color:red;'>".$stat."</td>";
                        echo "<td align = 'center'><a href='delete_house.php?id=".$row['house_id']."' class='btn btn-danger btn-circle'><i class='fas fa-trash'></i></a></td>";
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

                    $sql = "SELECT * FROM house";
                    $result = mysqli_query($con, $sql);
                    echo '<tr>';
                    echo '<td><b><b>TOTAL NUMBER OF HOUSES</b></b></td>';
                    echo '<td><b><b>'.mysqli_num_rows($result).'</b></b></td>';
                    echo '</tr>';

                    $sql1 = "SELECT * FROM house WHERE status = 'Occupied'";
                    $result1 = mysqli_query($con, $sql1);
                    echo '<tr>';
                    echo "<td><b><b>TOTAL NUMBER OF <span style = 'color:green;'>OCCUPIED</span> HOUSES</b></b></td>";
                    echo "<td><b><b><span style = 'color:green;'>".mysqli_num_rows($result1)."</span></b></b></td>";
                    echo '</tr>';

                    $sql2 = "SELECT * FROM house WHERE status = 'Empty'";
                    $result2 = mysqli_query($con, $sql2);
                    echo '<tr>';
                    echo "<td><b><b>TOTAL NUMBER OF <span style = 'color:red;'>EMPTY</span> HOUSES</b></b></td>";
                    echo "<td><b><b><span style = 'color:red;'>".mysqli_num_rows($result2)."</span></b></b></td>";
                    echo '</tr>';

                    $sql3 = "SELECT * FROM house WHERE compartment = 'Yes'";
                    $result3 = mysqli_query($con, $sql3);
                    echo '<tr>';
                    echo "<td><b><b>TOTAL NUMBER OF HOUSES <span style = 'color:green;'>WITH</span> COMPARTMENTS</b></b></td>";
                    echo "<td><b><b><span style = 'color:green;'>".mysqli_num_rows($result3)."</span></b></b></td>";
                    echo '</tr>';

                    $sql4 = "SELECT * FROM house WHERE compartment = 'No'";
                    $result4 = mysqli_query($con, $sql4);
                    echo '<tr>';
                    echo "<td><b><b>TOTAL NUMBER OF HOUSES <span style = 'color:red;'>WITHOUT</span> COMPARTMENTS</b></b></td>";
                    echo "<td><b><b><span style = 'color:red;'>".mysqli_num_rows($result4)."</span></b></b></td>";
                    echo '</tr>';


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
            <span>Copyright &copy; RealEst-It 2022</span>
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

   <!-- template main js file  -->
   <script src="js/main.js"></script>
   
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
