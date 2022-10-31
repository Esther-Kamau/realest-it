<?php
include "landlord_header.php";
include "nav.php";

$property_id = $_GET['id'];

?>
 <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>House Name</th>
            <th>House Type</th>
            <th>Block</th>
            <th>Bedrooms</th>
            <th>Bathrooms</th>
            <th>Rent</th>
            <th>Deposit</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $sql = "SELECT b.property_name, a.* FROM house a inner join properties b on a.property_id = b.property_id where a.property_id = '$property_id'";
          //$con: This is a variable that stores the connection to the database. It is created by mysqli_connect() function.
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_assoc($result);

          do{
       
            if ($row['status'] == 'Occupied') {
            
              echo '<tr>
							<td>'.$row['house_name'].'</td>
							<td>'.$row['house_type'].'</td>
							<td>'.$row['block'].'</td>
							<td>'.$row['bedrooms'].'</td>
							<td>'.$row['rent'].'</td>
							<td>'.$row['deposit'].'</td>
							<td>'.$row['status'].'</td>
                            <td>'?>
                            <form action="process.php" method="post">
                            <input type="hidden" name="house_id" value="<?php echo $row['id']; ?>">
                            <input type="tel" name="phone_number" value='' placeholder="Enter mpesa number">
                            <input type="submit" name="pay_rent" value="Pay Rent">
                            </form>
                            <?php
                            echo '
							<td><span '.(($row['status']=='Ocuppied')?'class="badge badge-success"':'class="badge badge-danger"').'>'.$row['status'].'</span></td>
							<td class="d-flex">
								<a href="edit_house.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></a>&nbsp&nbsp&nbsp
								<a href="delete_.php?id='.$row['property_id'].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>              
							</td>
              <td >
                <a href="viewhouse.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-eye"></i></a>&nbsp&nbsp&nbsp
              </td>
						</tr>';
            }
            else {
              echo '<tr>
							<td>'.$row['house_name'].'</td>
							<td>'.$row['Address'].'</td>
							<td>'.$row['property_type'].'</td>
							<td>'.$row['city'].'</td>
							<td>'.$row['year_built'].'</td>
							<td>'.$row['landlord_contact'].'</td>
                            <td>'?>
                            <form action="process.php" method="post">
                            <input type="hidden" name="house_id" value="<?php echo $row['id']; ?>">
                            <input type="tel" name="phone_number" value='' placeholder="Enter mpesa number">
                            <input type="submit" name="pay_rent" value="Pay Rent">
                            </form>
                            <?php
                            echo '
							<td><span '.(($row['status']=='Inactive')?'class="badge badge-danger"':'class="badge badge-danger"').'>'.$row['contract_status'].'</span></td>
							<td class="d-flex">
								<a href="edit_property.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-edit"></i></a>&nbsp&nbsp&nbsp
								<a href="delete_property.php?id='.$row['property_id'].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>              
							</td>
              <td >
                <a href="view_houses.php?id='.$row['property_id'].'" class="btn btn-success btn-circle"><i class="fas fa-eye"></i></a>&nbsp&nbsp&nbsp
              </td>
						</tr>';
            }




            $row = mysqli_fetch_assoc($result);
          }while ($row);


          
           ?> 
        </tbody>
      </table>
      
 