<?php
include "landlord_header.php";
include "nav.php";
if (empty($_POST['property_id']) || empty($_POST['propertyType'])){
    echo '<div id="alert_message" class="position" style="width:400px">
        <div class="alert alert-success" role="alert">Unable to get the property</div>
    </div>';
    echo '<script>window.location.href = "landlord_properties.php";</script>';
}

$user_id=$_SESSION["user_id"];
$propertyId = intval($_GET['id']);

$property_query = mysqli_query($con,"SELECT * FROM `properties` WHERE `property_id`='$propertyId'");
$get_property = mysqli_fetch_assoc($property_query);

$id=isset($get_property['property_id']) ? $get_property['property_id'] : '';
$name=isset($get_property['property_name']) ? $get_property['property_name'] : '';
$Address = isset($get_property['Address']) ? $get_property['Address'] : '';
$property_type = isset($get_property['property_type']) ? $get_property['property_type'] : '';
$city = isset($get_property['city']) ? $get_property['city'] : '';
$year_built = isset($get_property['year_built']) ? $get_property['year_built'] : '';
$landlord_contact = isset($get_property['landlord_contact']) ? $get_property['landlord_contact'] : '';
$contract_status = isset($get_property['contract_status']) ? $get_property['contract_status'] : '';



$property_units_query = mysqli_query($con," SELECT * FROM `units` WHERE `property_id`='$propertyId' ORDER BY id DESC");
$property_units = array();
while ($row_user = mysqli_fetch_assoc($property_units_query)){
    $property_units[] = $row_user;
}
?>
   

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Properties</h1>
           

          </div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="landlord_properies.php" style="none"><link type="image/png" sizes="16x16" rel="icon" style="text-color:white" href=".../icons8-plus-math-16.png"> Properties</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
    
    <!-- <div class="card shadow border-left-primary mb-4"> -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'], ENT_QUOTES, 'utf-8');?>" method = "POST">
                    <tr>
                      <td>
                        Property Name:
                        <input type='text' class='form-control form-control-user' name='name' value="<?php echo $name;?>" required>
                        <input type='hidden' class='form-control form-control-user' name='property_id' value="<?php echo $id;?>">
                        </td>
                    </tr>
    
                    <tr>
                    <td>
                      Address:
                      <input type='text' class='form-control form-control-user' name='address' value="<?php echo $Address;?>" required></td>
                    </tr>
                    <tr>
                        <td>Type of Property:
                            <div class="form-check">
                                <label><input type="radio" name="propertyType" value="singleUnit" <?php if($property_type=="singleUnit"){echo "checked";}?> required class="form-check-input">Single Unit type</label>
                                <label><input type="radio" name="propertyType" value="multiUnit" <?php if($property_type=="multiUnit"){echo "checked";}?>  class="form-check-input">Multi Unit type</label>
                            </div>
                        </td>
                    </tr>
                    <?php
					if($property_type=="singleUnit"){?>
                    <tr class="multiUnit box">
                    <td>
    					<?php
    					foreach ($property_units as $rows) {
    					    $unit_type=$rows['unit_type'];
        					echo '
        					<div class="">
            					<input type="hidden" name="unit_id[]" id="unit_id" value="'.$rows['id'].'">  
        					    <div class="form-group">
                                    <label for="unittype">Type of Property</label>
                                    <select class="form-control" name="unittype[]" id="unittype" required>
                                        <option '.(($unit_type=="")?'selected="selected"':"").'>Select Level</option>
                                        <option value="Studio" '.(($unit_type=='Studio')?'selected="selected"':"").'>Studio</option>
                                        <option value="Bedsitter" '.(($unit_type=='Bedsitter')?'selected="selected"':"").'>Bedsitter</option>
                                        <option value="Hostel Room" '.(($unit_type=='Hostel Room')?'selected="selected"':"").'>Hostel Room</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bedrooms">Bedrooms (between 1 and 5):</label>
                                    <input type="number" id="bedrooms" name="bedrooms[]" min="1" max="5" value="'.$rows['bedroom'].'">
                                </div>
                                <div class="form-group">
                                    <label for="baths">Baths (between 1 and 5):</label>
                                    <input type="number" id="baths" name="baths[]" min="1" max="5" value="'.$rows['bathroom'].'">
                                </div>
                                <div class="form-group">
                                    <label for="rent">Market rent*</label>
                                    <input type="number" id="rent" name="rent[]" min="1" required value="'.$rows['rent'].'">
                                </div>
                                <div class="form-group">
                                    <label for="deposit">Deposit</label>
                                    <input type="number" id="deposit" name="deposit[]" min="0" value="'.$rows['deposit'].'">
                                </div>
                            </div>
                            ';
    					}
                        ?>
    	            </td>
    	            </tr>
                    <?php
                    }
                    if($property_type=="multiUnit"){?>
                    <tr class="multiUnit box">
                    <td>
    					<div class="row">
    						<a class="unit_clone_add"><i class="fa fa-plus"></i> Add entry</a>
    					</div>
    					
    					<?php
    					foreach ($property_units as $rows) {
    					    $unit_type=$rows['unit_type'];
        					echo '
        					<div class="multiUnit_single">
            					<input type="hidden" name="unit_id[]" id="unit_id" value="'.$rows['id'].'">  
        					    <div class="form-group">
                                    <label for="unittype">Type of Property</label>
                                    <select class="form-control" name="unittype[]" id="unittype" required>
                                        <option '.(($unit_type=="")?'selected="selected"':"").'>Select Level</option>
                                        <option value="Studio" '.(($unit_type=='Studio')?'selected="selected"':"").'>Studio</option>
                                        <option value="Bedsitter" '.(($unit_type=='Bedsitter')?'selected="selected"':"").'>Bedsitter</option>
                                        <option value="Hostel Room" '.(($unit_type=='Hostel Room')?'selected="selected"':"").'>Hostel Room</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bedrooms">Bedrooms (between 1 and 5):</label>
                                    <input type="number" id="bedrooms" name="bedrooms[]" min="1" max="5" value="'.$rows['bedroom'].'">
                                </div>
                                <div class="form-group">
                                    <label for="baths">Baths (between 1 and 5):</label>
                                    <input type="number" id="baths" name="baths[]" min="1" max="5" value="'.$rows['bathroom'].'">
                                </div>
                                <div class="form-group">
                                    <label for="rent">Market rent*</label>
                                    <input type="number" id="rent" name="rent[]" min="1" required value="'.$rows['rent'].'">
                                </div>
                                <div class="form-group">
                                    <label for="deposit">Deposit</label>
                                    <input type="number" id="deposit" name="deposit[]" min="0" value="'.$rows['deposit'].'">
                                </div>
                            </div>
                            ';
    					}
                        ?>
    	            </td>
    	            </tr>
    	            <?php
                    }
                    ?>
                    <tr>
                          <td>
                            City:
                            <input type='text' class='form-control form-control-user' name='city' value="<?php echo $city;?>" required></td>
                    </tr>
                    <tr>
                          <td>
                            Year Built:
                            <input type='text' class='form-control form-control-user' name='year' value="<?php echo $year_built;?>" required></td>
                    </tr>
                    <tr>
                          <td>
                            Landlord's Contact:
                            <input type='text' class='form-control form-control-user' name='contact' value="<?php echo $landlord_contact;?>" required></td>
                    </tr>
                    <tr>
                        <td>
                         Type of Property:
                         <p>Please select contract status</p>
        
                          <select class="form-control form-select " name="contract" id="contract" style="width:300px;" required>
                          <option value="Active" <?php if($contract_status=="Active"){echo "selected";}?>>Active</option>
                          <option value="Inactive" <?php if($contract_status=="Inactive"){echo "selected";}?>>Inactive</option>
                        </select>
                        </td>
                    </tr>
                    <tr><td><input class='btn btn-primary btn-user btn-lg' type='submit' name='submit' value='Add Property'></td></tr>
              
                </form>
            </tbody>
            </table>
        </div>
      </div>
</div>        
<?php
if(isset($_POST['property_id']) && isset($_POST["submit"])){
    if (empty($_POST['property_id']) || empty($_POST['propertyType'])){
    	echo '<div id="alert_message" class="position" style="width:400px">
            <div class="alert alert-success" role="alert">Some Fields are empty</div>
        </div>';
    	exit;
	}
	$property_id =  mysqli_real_escape_string($con, $_POST['property_id']);
    $property_name = mysqli_real_escape_string($con, $_POST['name']);
    $Address = mysqli_real_escape_string($con, $_POST["address"]);
    $property_type =  mysqli_real_escape_string($con, $_POST['propertyType']);
    $city = mysqli_real_escape_string($con, $_POST["city"]);
    $year_built = mysqli_real_escape_string($con, $_POST["year"]);
    $landlord_contact = mysqli_real_escape_string($con, $_POST["contact"]);
    $contract_status = mysqli_real_escape_string($con, $_POST["contract"]);
    $manager_id = $_SESSION['user_id'];
    
	$alert_array = array();
	$alert_message='';
	
	$result=mysqli_query($con,"UPDATE `properties` SET `property_name`='$property_name',`Address`='$Address',`property_type`='$property_type',`city`='$city',`year_built`='$year_built',
	`landlord_contact`='$landlord_contact',	`contract_status`='$contract_status',`manager_id`='$manager_id' WHERE `property_id`='$property_id'");

	if($result){
	   for($y=0;$y<count($_POST['rent']);$y++){
	       $unittype = $_POST['unittype'];
	       $bedrooms = $_POST['bedrooms'];
	       $baths = $_POST['baths'];
	       $rent = $_POST['rent'];
	       $deposit = $_POST['deposit'];
	        
	       if(isset($_POST['unit_id'][$y]) && !empty($_POST['unit_id'][$y])){
	           $unit_id=$_POST['unit_id'];
	           $unit_update=mysqli_query($con,"UPDATE `units` SET `unit_type`='$unittype[$y]',`bedroom`='$bedrooms[$y]',`bathroom`='$baths[$y]',`rent`='$rent[$y]',
	           `deposit`='$deposit[$y]',`UpdatedBy`='$manager_id',`UpdatedOn`=Now() WHERE `id`='$unit_id[$y]'");
	       }
	       else{
        	    $units_result=mysqli_query($con,"INSERT INTO `units`( `property_id`, `unit_type`, `bedroom`, `bathroom`, `rent`, `deposit`,`createdBy`,`CreatedOn`)
        	    VALUES ('$property_id','$unittype[$y]','$bedrooms[$y]','$baths[$y]','$rent[$y]','$deposit[$y]','$manager_id',Now())
        	");
	       }
        }
        $alert_array[] = array('response' => "200", 'response' => "Success");
        $alert_message = "Success";
	}
	else{
	    $alert_array[] = array('response' => "201", 'response' => "Error");
	    $alert_message = "Error";
	}

    $someJSON = json_encode($alert_array);

    mysqli_close($con);
    echo '<div id="alert_message" class="position" style="width:400px">
        <div class="alert alert-success" role="alert">'.$alert_message.'</div>
    </div>';
    echo '<script>window.location.href = "edit_property.php?id='.$property_id.'";</script>';
}
?>


<?php
include "footer.php";
?>