<?php
include "landlord_header.php";
include "nav.php";
 ?>
 
 <div class="container-fluid">
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           

          </div>
          <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_home.php" >Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>

          <!-- Content Row -->
          <div class="row">

            <!-- Number of tenants card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of Tenants</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-80 d-flex justify-center"><?php
                      $sql = "SELECT * FROM tenant";
                      $query = mysqli_query($con,$sql);
                      $num = mysqli_num_rows($query);
                      echo $num;
                       ?></div>
                    </div>

                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-900"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- number of houses registered -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Number of Houses</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-900"><?php
                      $sql = "SELECT * FROM house";
                      $query = mysqli_query($con,$sql);
                      $num = mysqli_num_rows($query);
                      echo $num;
                       ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-home fa-2x text-gray-900"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- total income for that month-->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Income</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 ml-3 font-weight-bold text-gray-900"><?php
                          $sql = "SELECT SUM(amount) FROM payment";
                          $query = mysqli_query($con,$sql);
                          $res = mysqli_fetch_assoc($query);

                          do {
                            $total = $res['SUM(amount)'];
                            $res = mysqli_fetch_assoc($query);
                          } while ($res);

                          echo "Ksh.".number_format($total)."/=";
                           ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-900"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Active contracts -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Contracts</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                      $sql = "SELECT * FROM contract WHERE status = 'Active'";
                      $query = mysqli_query($con,$sql);
                      $num = mysqli_num_rows($query);
                      echo $num;
                       ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-900"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!-- line graph to show progress  -->
          <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Tenants',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11000, 32000, 45000, 32000, 34000, 52000, 41000]
                        }, {
                          name: 'Expenses',
                          data: [15000, 11000, 32000, 18000, 9000, 24000, 1100]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2022-09-19T00:00:00.000Z", "2022-09-19T01:30:00.000Z", "2022-09-19T02:30:00.000Z", "2022-09-19T03:30:00.000Z", "2022-09-19T04:30:00.000Z", "2022-09-19T05:30:00.000Z", "2022-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

                <!-- Recent transactions overview  -->
                <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recent Transactions <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Tenant Id</th>
                        <th scope="col">Tenant</th>
                        <!-- <th scope="col">Date</th> -->
                        <th scope="col">Payment</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">7</a></th>
                        <td>Brandon Jacob</td>
                        <!-- <td><a href="#" class="text-primary">At praesentium minu</a></td> -->
                        <td>Ksh64</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">1</a></th>
                        <td>Bridie Kessler</td>
                        <!-- <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td> -->
                        <td>Ksh47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">9</a></th>
                        <td>Ashleigh Langosh</td>
                        <!-- <td><a href="#" class="text-primary">At recusandae consectetur</a></td> -->
                        <td>Ksh147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">4</a></th>
                        <td>Angus Grady</td>
                        <!-- <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td> -->
                        <td>Ksh67</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">5</a></th>
                        <td>Raheem Lehner</td>
                        <!-- <td><a href="#" class="text-primary">Sunt similique distinctio</a></td> -->
                        <td>Ksh165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
              </div>
            </div
        
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; RealEst-It</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

<?php
include "footer.php";
?>