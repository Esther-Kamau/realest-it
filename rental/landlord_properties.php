<?php
include "landlord_header.php";
include "nav.php";


           ?>

  

  <div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Properties</h1>
	</div>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="landlord_properies.php" ><link type="image/png" sizes="16x16" rel="icon" href=".../icons8-plus-math-16.png"> Properties</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
    
    
     <a type="button" class="btn btn-primary btn-lg mb-3" href="add_property.php">Add Property</a>


<div class="container-fluid">



<div class="card shadow mb-4">

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Property Name</th>
            <th>Address</th>
            <th>Type of Property</th>
            <th>City</th>
            <th>Year Built</th>
            <th>Landlord's Contact</th>
            <th>Status</th>
            <th>Action</th>
            <th>View Houses</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $sql = "SELECT * FROM properties";
          //$con: This is a variable that stores the connection to the database. It is created by mysqli_connect() function.
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_assoc($result);

          do{
            $property_name = $row['property_name'];
            $Address= $row['Address'];
            $property_type= $row['property_type'];
            $city = $row['city'];
            $year_built = $row['year_built'];
            $landlord_contact = $row['landlord_contact'];
            $contract_status = $row['contract_status'];
            if ($contract_status == 'Active') {
            
              echo '<tr>
							<td>'.$row['property_name'].'</td>
							<td>'.$row['Address'].'</td>
							<td>'.$row['property_type'].'</td>
							<td>'.$row['city'].'</td>
							<td>'.$row['year_built'].'</td>
							<td>'.$row['landlord_contact'].'</td>
							<td><span '.(($row['contract_status']=='Active')?'class="badge badge-success"':'class="badge badge-danger"').'>'.$row['contract_status'].'</span></td>
							<td class="d-flex">
								<a href="edit_property.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></a>&nbsp&nbsp&nbsp
								<a href="delete_property.php?id='.$row['property_id'].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>              
							</td>
              <td >
                <a href="viewhouse.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-eye"></i></a>&nbsp&nbsp&nbsp
              </td>
						</tr>';
            }
            else {
              echo '<tr>
							<td>'.$row['property_name'].'</td>
							<td>'.$row['Address'].'</td>
							<td>'.$row['property_type'].'</td>
							<td>'.$row['city'].'</td>
							<td>'.$row['year_built'].'</td>
							<td>'.$row['landlord_contact'].'</td>
							<td><span '.(($row['contract_status']=='Inactive')?'class="badge badge-danger"':'class="badge badge-danger"').'>'.$row['contract_status'].'</span></td>
							<td class="d-flex">
								<a href="edit_property.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></a>&nbsp&nbsp&nbsp
								<a href="delete_property.php?id='.$row['property_id'].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>              
							</td>
              <td >
                <a href="viewhouse.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-eye"></i></a>&nbsp&nbsp&nbsp
              </td>
						</tr>';
            }




            $row = mysqli_fetch_assoc($result);
          }while ($row);


          
           ?> 
        </tbody>
      </table>
      
    </div>
  </div>
</div>

</div>

<hr>
                <br/>
                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                  <tbody>
<?php


          $sql = "SELECT * FROM properties";
          $result = mysqli_query($con, $sql);
          echo '<tr>';
          echo '<td><b><b>TOTAL NUMBER OF PROPERTIES</b></b></td>';
          echo '<td><b><b>'.mysqli_num_rows($result).'</b></b></td>';
          echo '</tr>';

          $sql1 = "SELECT * FROM  properties WHERE contract_status = 'Active'";
          $result1 = mysqli_query($con, $sql1);
          echo '<tr>';
          echo "<td><b><b>TOTAL NUMBER OF <span style = 'color:green;'>ACTIVE</span> CONTRACTS</b></b></td>";
          echo "<td><b><b><span style = 'color:green;'>".mysqli_num_rows($result1)."</span></b></b></td>";
          echo '</tr>';

          $sql2 = "SELECT * FROM properties WHERE contract_status = 'Inactive'";
          $result2 = mysqli_query($con, $sql2);
          echo '<tr>';
          echo "<td><b><b>TOTAL NUMBER OF <span style = 'color:red;'>INACTIVE </span>CONTRACTS</b></b></td>";
          echo "<td><b><b><span style = 'color:red;'>".mysqli_num_rows($result2)."</span></b></b></td>";
          echo '</tr>';

          // $sql3 = "SELECT * FROM house WHERE compartment = 'Yes'";
          // $result3 = mysqli_query($con, $sql3);
          // echo '<tr>';
          // echo "<td><b><b>TOTAL NUMBER OF HOUSES <span style = 'color:green;'>WITH</span> COMPARTMENTS</b></b></td>";
          // echo "<td><b><b><span style = 'color:green;'>".mysqli_num_rows($result3)."</span></b></b></td>";
          // echo '</tr>';

          // $sql4 = "SELECT * FROM house WHERE compartment = 'No'";
          // $result4 = mysqli_query($con, $sql4);
          // echo '<tr>';
          // echo "<td><b><b>TOTAL NUMBER OF HOUSES <span style = 'color:red;'>WITHOUT</span> COMPARTMENTS</b></b></td>";
          // echo "<td><b><b><span style = 'color:red;'>".mysqli_num_rows($result4)."</span></b></b></td>";
          // echo '</tr>';


           ?>

        </tbody>
      </table>



</div> 









<?php
include "footer.php";
?>