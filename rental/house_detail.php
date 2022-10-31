<?php
include "landlord_header.php";
include "nav.php";
?>
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

       

   <div class="container-fluid">

          <h1 class="h3 mb-2 text-gray-800" >Houses</h1>

          <div class="card shadow mb-4">

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Property Name</th>
                      <th>House Name</th>
                      <th>House Type</th>
                      <th>Block</th>
                      <th>Bedrooms</th>
                      <th>Bathrooms</th>
                      <th>Monthly Rent</th>
                      <th>Deposit</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql = "SELECT b.property_name, a.* FROM house a inner join properties b on a.property_id = b.property_id";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);

                    do{
                      $id = $row['property_name'];
                      $housename = $row['house_name'];
                      $housetype = $row['house_type'];
                      $block = $row['block'];
                      $bedrooms = $row['bedroom'];
                      $bathrooms = $row['bathrooms'];
                      $rent = $row['rent'];
                      $deposit = $row['deposit'];
                      $status = $row['status'];

                      if ($status == 'Occupied') {
                        echo '<tr>
              <td>'.$row['property_name'].'</td>
							<td>'.$row['house_name'].'</td>
							<td>'.$row['house_type'].'</td>
							<td>'.$row['block'].'</td>
							<td>'.$row['bedroom'].'</td>
							<td>'.$row['bathrooms'].'</td>
              <td>'.$row ['rent'].'</td>
              <td>'.$row['deposit'].'</td>
            
							<td><span '.(($row['status']=='Occupied')?'class="badge badge-success"':'class="badge badge-danger"').'>'.$row['status'].'</span></td>
							<td class="d-flex">
								<a href="edit_house.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></a>&nbsp&nbsp&nbsp
								<a href="delete_house.php?id='.$row['property_id'].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>              
							</td>
						</tr>';
           
                        
                      }
                      else {

                        echo '<tr>
                        
                        <td>'.$row['property_name'].'</td>
                        <td>'.$row['house_name'].'</td>
                        <td>'.$row['house_type'].'</td>
                        <td>'.$row['block'].'</td>
                        <td>'.$row['bedroom'].'</td>
                        <td>'.$row['bathrooms'].'</td>
                        <td>'.$row ['rent'].'</td>
                        <td>'.$row['deposit'].'</td>
                    
                        <td><span '.(($row['status']=='Empty')?'class="badge badge-danger"':'class="badge badge-danger"').'>'.$row['status'].'</span></td>
                        <td class="d-flex">
                          <a href="edit_house.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></a>&nbsp&nbsp&nbsp
                          <a href="delete_house.php?id='.$row['property_id'].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>              
                        </td>
                      </tr>';
                        
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

      <?php
include "footer.php";
?>