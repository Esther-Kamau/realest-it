<?php
include "landlord_header.php";
include "nav.php";




if(isset($_POST['submit'])){
    $property_name = mysqli_real_escape_string($con, $_POST['property_name']);
    $Address = mysqli_real_escape_string($con, $_POST["address"]);
    $city = mysqli_real_escape_string($con, $_POST["city"]);
    $year_built = mysqli_real_escape_string($con, $_POST["year"]);
    $landlord_contact = mysqli_real_escape_string($con, $_POST["landlord_contact"]);
    $property_type =  mysqli_real_escape_string($con, $_POST['property_type']);
    $contract_status = mysqli_real_escape_string($con, $_POST["contract_status"]);
    $manager_id = $_SESSION['user_id'];
    
    $alert_array = array();
    $alert_message='';
    
    $result=mysqli_query($con,"INSERT INTO properties(property_name, Address, city, year_built, landlord_contact,property_type, contract_status, manager_id) 
    VALUES ('$property_name','$Address','$city','$year_built','$landlord_contact','$property_type','$contract_status','$manager_id')");
    

    if($result){
        $property_id = mysqli_insert_id($con);
        for($y=0;$y<count($_POST['rent']);$y++){
            $unittype = $_POST['unittype'];
            $bedrooms = $_POST['bedrooms'];
            $baths = $_POST['baths'];
            $rent = $_POST['rent'];
            $deposit = $_POST['deposit'];
        	
        	$units_result=mysqli_query($con,"
        	INSERT INTO `units`( `property_id`, `unit_type`, `bedroom`, `bathroom`, `rent`, `deposit`,`createdBy`,`CreatedOn`)
        	VALUES ('$property_id','$unittype[$y]','$bedrooms[$y]','$baths[$y]','$rent[$y]','$deposit[$y]','$manager_id',Now())
        	");
    
        	if($units_result){
        	}
        	else{
        	}
        }
        $alert_array[] = array('response' => "200", 'response' => "Success");
        $alert_message = "Success";
    }
    else{
        $alert_array[] = array('response' => "201", 'response' => "Error");
        $alert_message = "Error";
    }

   // $someJSON = json_encode($array);
    
    mysqli_close($con);
    echo '<div id="alert_message" class="position" style="width:400px">
            <div class="alert alert-success" role="alert">'.$alert_message.'</div>
        </div>';
       echo '<script>window.location.href = "landlord_properties.php";</script>';
}
?>
   


<div class="container-fluid">

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="landlord_properies.php"><link type="image/png" sizes="16x16" rel="icon" style="text-color:white" href=".../icons8-plus-math-16.png">Add Properties</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
    
    <div class="card shadow border-left-primary mb-4">
    <div class="card-body">
        <div class="table-responsive">

          <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

            <tbody>
              <form action="add_property.php" method = "POST">
                <tr>
                  <td>
                    Property Name:
                    <input type='text' class='form-control form-control-user' name='property_name' required></td>
                </tr>

                <tr>
                    <td>
                      Address:
                      <input type='text' class='form-control form-control-user' name='address' required></td>
                </tr>
                <tr>
                    <td>
                    City:
                    <input type='text' class='form-control form-control-user' name='city' required></td>
                </tr>
                <tr>
                  <td>
                    Year Built:
                    <input type='text' class='form-control form-control-user' name='year' required></td>
                </tr>
                <tr>
                  <td>
                    Landlord's Contact:
                    <input type='text' class='form-control form-control-user' name='landlord_contact' required></td>
                </tr>
               
                <tr>
                    <td>
                 
                        <h6>
                            Property type:</h6> 
                        
                     

                     <div class="d-flex bg-white">
                        <!-- single unit type  -->
                        <div class="p-2 border-3  bg-white">
                        <div class="element form-radio radio radio-success"> 
             <h3 >Single Unit type</h3>
              <small>
                Single family rentals (often abbreviated as SFR) are rentals in which there is only one rental associated to a specific address. This type of rental is usually used for a house, single mobile home, or a single condo. <b>This type of property does not allow to add any units/rooms

                </b></small> 
                <div action="checkbox-form.php" method="POST" class="text-primary  ml-4 mt-3">
                     <input type="radio" class="form-check-input" name="property_type" value="Singleunit" onchange="propertyFunction()" > 
                     <label for="singleunit">
                    Single Unit</label> 
</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
            </div>
                        </div>
                        <!-- multi-unit type  -->
                        <div class="p-2 border-3  bg-white">
                        <div class="border-black"> 
        <h3>
            Multi Unit type</h3>
            <small>
                Multi-unit property are for rentals in which there are multiple rental units per a single address. This type of property is typically used for renting out rooms of a house, apartment units, office units, condos, garages, storage units, mobile home park and etc.</small> 
</b><small>
                <div action="checkbox-form.php" method="POST" class="text-primary ml-4 mt-3"> 
                    <input  type="radio" name="property_type" value="Multiunit" onchange="propertyFunction()"> 
                    <label for="multiunit">
                        Multi Unit</label>
                </div> 
                    </div>
                </div>
            </div> 
                        </div>
                     </div>
           
            
        
            <div id="singleunit"> 
                     <tr class="singleUnit box">
                         <td>
                        <div>
                			<input type="hidden" name="unit_id[]" id="unit_id" value="'.$rows['id'].'">  
            			    <div class="form-group">
                                <label for="unittype">Type of Property:Single Unit</label>
                                <select class="form-control" name="unittype[]" id="unittype" required>
                                    <option value="Studio">Studio</option>
                                    <option value="Bedsitter">Bedsitter</option>
                                    <option value="Hostel Room">Hostel Room</option>
                                    <option value="Standalone">Stand-alone(bungalow,mansionnette)</option>

                                </select>
                            </div>
                            <label for="bedrooms">Bedrooms (between 1 and 5):</label>
                            <div class="form-group">
                                        <input class="form-control form-control-user" type="number" id="bedrooms" name="bedrooms[]" min="1" max="5">
                            </div>
                            <div class="form-group">
                                <label for="baths">Baths (between 1 and 5):</label>
                                <input class="form-control form-control-user" type="number" id="baths" name="baths[]" min="1" max="5">
                            </div>
                            <div class="form-group">
                                <label for="rent">Monthly rent*</label>
                                <input class="form-control form-control-user" type="number" id="rent" name="rent[]" min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="deposit">Deposit</label>
                                <input class="form-control form-control-user" type="number" id="deposit" name="deposit[]" min="0">
                            </div>
                        </div>
                    </td>
                    </div> 
            

             <div id="multiunit" class="container text-dark bg-white">
                <tr class="multiUnit box">
                    <td>
        				<div class="row text-black" >
        					<a class="unit_clone_add"><i class="fa fa-plus"></i> Add entry</a>
        				</div>
        				
            		
            			<div class="multiUnit_single" id="multiunit" >
                			<input type="hidden" name="unit_id[]" id="unit_id" value="'.$rows['id'].'"> 
            			    <div class="form-group">
                                <label for="unittype text-bold">Type of Property:Multi-Unit</label>
                                <select class="form-control" name="unittype[]" id="unittype" required>
                                    <option value="Rooms">Rooms</option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="Bungalow">Bungalow</option>
                                    <option value="Mansionnette">Mansionnette</option>
                                </select>
                            </div>
                            

                                <label for="bedrooms">Bedrooms (between 1 and 5):</label>
                                <div class="form-group">
                                        <input  class="form-control form-control-user" type="number" id="bedrooms" name="bedrooms[]" min="1" max="5">
                            </div>
                            <label for="baths">Baths (between 1 and 5):</label>
                            <div class="form-group">
                                <input  class="form-control form-control-user" type="number" id="baths" name="baths[]" min="1" max="5">
                            </div>
                            
                            <label for="rent">Monthly rent</label>
                            <div class="form-group">
                                
                                <input class="form-control form-control-user" type="number" id="rent" name="rent[]" min="1" required>
                            </div>
                            <label for="deposit">Deposit</label>
                            <div class="form-group ">
                                <input class="form-control form-control-user" type="number" id="deposit" name="deposit[]" min="0">
                            </div>
                        </div>
                        
                
        	        </td>
    	        </tr>


                   
        
           
</div>


<div class="p-l-24 d-flex"> 
  

        
               
                <tr>
                    <td>
                        <p>Please select contract status</p>
                        <select class="form-control form-select " name="contract_status" id="contract" style="width:300px;" required>
                            <option value="Active" id="1">Active</option>
                            <option value="Inactive" id="2">Inactive</option>
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

// if(isset($_POST['name']) && isset($_POST["submit"])){
// 	if (empty($_POST['name']) || empty($_POST['propertyType'])){
//         echo '<div id="alert_message" class="position" style="width:400px">
//             <div class="alert alert-success" role="alert">Some Fields are empty</div>
//         </div>';
//     	exit;
// 	}
//     else{
    

//         // if(isset($_POST["submit"])){
//         //     $property_name = $_POST['property_name'];
//         //     $Address = $_POST["address"];
//         //     $city = $_POST["city"];
//         //     $year_built = $_POST["year"];
//         //     $landlord_contact =$_POST["landlord_contact"];
//         //     $property_type =  $_POST['property_type'];
//         //     $contract_status = $_POST["contract"];
//         //     $manager_id = $_SESSION['user_id'];
           
//             // $sql= "INSERT INTO properties VALUES ('','$property_name','$Address','$property_type','$city','$year_built','$landlord_contact','$contract_status','$manager_id')";
//             // mysqli_query($con, $sql);
//             // mysqli_close($con);
           
//             // $alert_array = array();
//             //  $alert_message='';

//             //  $result=mysqli_query($con,"INSERT INTO `properties`(`property_name`, `Address`, `city`, `year_built`, `landlord_contact`,'property_type', `contract_status`, `manager_id`) 
//             //  VALUES ('$property_name','$Address','$city','$year_built','$landlord_contact','$property_type','$contract_status','$manager_id')");

//         //     echo "<script type='text/javascript'>alert('The Property has been added successfully.');</script>";
//         //     // echo "<script type='text/javascript'>window.location.href = 'add_property.php';</script>";
//         //     echo '<style>body{display:none;}</style>';
//         //     echo '<script>window.location.href = "landlord_properties.php";</script>';

//         // }
       
//     $property_name = mysqli_real_escape_string($con, $_POST['property_name']);
//     $Address = mysqli_real_escape_string($con, $_POST["address"]);
//     $city = mysqli_real_escape_string($con, $_POST["city"]);
//     $year_built = mysqli_real_escape_string($con, $_POST["year"]);
//     $landlord_contact = mysqli_real_escape_string($con, $_POST["landlord_contact"]);
//     $property_type =  mysqli_real_escape_string($con, $_POST['property_type']);
//     $contract_status = mysqli_real_escape_string($con, $_POST["contract_status"]);
//     $manager_id = $_SESSION['user_id'];
    
// 	$alert_array = array();
// 	$alert_message='';
	
// 	$result=mysqli_query($con,"INSERT INTO `properties`(`property_name`, `Address`, `city`, `year_built`, `landlord_contact`,'property_type', `contract_status`, `manager_id`) 
//     VALUES ('$property_name','$Address','$city','$year_built','$landlord_contact','$property_type','$contract_status','$manager_id')");
    

// 	if($result){
// 	    $property_id = mysqli_insert_id($con);
// 	    for($y=0;$y<count($_POST['rent']);$y++){
// 	        $unittype = $_POST['unittype'];
// 	        $bedrooms = $_POST['bedrooms'];
// 	        $baths = $_POST['baths'];
// 	        $rent = $_POST['rent'];
// 	        $deposit = $_POST['deposit'];
        	
//         	$units_result=mysqli_query($con,"
//         	INSERT INTO `units`( `property_id`, `unit_type`, `bedroom`, `bathroom`, `rent`, `deposit`,`createdBy`,`CreatedOn`)
//         	VALUES ('$property_id','$unittype[$y]','$bedrooms[$y]','$baths[$y]','$rent[$y]','$deposit[$y]','$manager_id',Now())
//         	");
    
//         	if($units_result){
//         	}
//         	else{
//         	}
//         }
//         $alert_array[] = array('response' => "200", 'response' => "Success");
//         $alert_message = "Success";
// 	}
// 	else{
// 	    $alert_array[] = array('response' => "201", 'response' => "Error");
// 	    $alert_message = "Error";
// 	}

//     $someJSON = json_encode($array);
    
//     mysqli_close($con);
//    
//     }
// }


?>