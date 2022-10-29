<?php
include "landlord_header.php";
include "nav.php";

           ?>


  <div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Units</h1>
</div>
<nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="landlord_properies.php" ><link type="image/png" sizes="16x16" rel="icon" href=".../icons8-plus-math-16.png"> Properties</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</nav>



<div class="container-fluid">
    
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<td></td>
						<th>Property Name</th>
						<th>Address</th>
						<th>Type of Property</th>
						<th>City</th>
						<th>Year Built</th>
						<th>Landlord's Contact</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$property_query = mysqli_query($con,"SELECT * FROM `properties` order by `property_id` DESC");		
					while($row = mysqli_fetch_assoc($property_query)){
						echo '<tr>
							<td><a href="#">[+]</a></td>
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
						</tr>';
						$property_units_query = mysqli_query($con," SELECT * FROM `units` WHERE `property_id`='".$row['property_id']."' ORDER BY id DESC");
						if(mysqli_num_rows($property_units_query)>0){
							echo '<tr>
								<td></td>
								<td colspan="8">
									<table class="table">
										<thead>
											<tr>
												<td>Unit Type</td>
												<td>Bedrooms</td>
												<td>Bathrooms</td>
												<td>Rent</td>
												<td>Deposit</td>
											</tr>
										</thead>
										<tbody>';		
											
											while ($row_unit = mysqli_fetch_assoc($property_units_query)){
												echo '<tr>
													<td>'.$row_unit['unit_type'].'</td>
													<td>'.$row_unit['bedroom'].'</td>
													<td>'.$row_unit['bathroom'].'</td>
													<td>'.$row_unit['rent'].'</td>
													<td>'.$row_unit['deposit'].'</td>
												</tr>';
											}
											echo '
										</tbody>
									</table>
								</td>
							</tr>';
						}
          
					}
					?>
				</tbody>
			</table>
		  
		  
		  
                           

<hr>
      <br/>
      <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
        <tbody>
          <?php
