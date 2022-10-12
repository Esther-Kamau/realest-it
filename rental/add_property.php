<?php
include "landlord_header.php";
include "nav.php";
?>
   

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Properties</h1>
           

          </div>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="landlord_properies.php"><link type="image/png" sizes="16x16" rel="icon" style="text-color:white" href=".../icons8-plus-math-16.png"> Properties</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
    
    <!-- <div class="card shadow border-left-primary mb-4"> -->
    <div class="card-body">
        <div class="table-responsive">
          <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

            <tbody>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                <tr>
                  <td>
                    Property Name:
                    <input type='text' class='form-control form-control-user' name='name' required></td>
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
                    <input type='text' class='form-control form-control-user' name='contact' required></td>
                </tr>
                  <!--<tr>-->
                  <!--  <td>-->
                  <!--   Type of Property:-->
                  <!--  <select class="form-control form-select " name="type" id="type" style="width:300px;" required>-->
                  <!--    <option value="Apartments" id="1">Apartment</option>-->
                  <!--    <option value="Mansionnettes" id="2">Mansionnette</option>-->
                  <!--    <option value="Bungalows" id="3">Bungalow</option>-->
                  <!--  </select>-->
                  <!--  </td>-->
                  <!--</tr>-->
                <tr>
                    <td>
                    <div class="heading-small no-description"> 
                        <h6 ng-bind=":: 'property.type_options.label' | trans">
                            Property type:</h6> 
                        </div>
                     <!-- <div > -->

<div class="d-flex flex-row justify-content-around">
<div class="p-4">
<!-- <custom-radio-type class="m-custom-radio"> -->
        <div class="d-flex row"> <!---->
        <div class="col-xs-24 col-sm-12">
            <div class="element form-radio radio radio-succes"> 
             <h3 >Single Unit type</h3>
              <small>
                Single family rentals (often abbreviated as SFR) are rentals in which there is only one rental associated to a specific address. This type of rental is usually used for a house, single mobile home, or a single condo. <b>This type of property does not allow to add any units/rooms

                </b></small> 
                <div> <input id="type-1" name="type" type="radio" ng-model="$ctrl.model" ng-value="item.key" async-change="$ctrl.radioClick()" ng-disabled="$ctrl.disabled" data-test="type-1" class="ng-pristine ng-untouched ng-valid ng-not-empty" value="1"> <label for="type-1" ng-bind-html=":: item.value" ng-click="$ctrl.callback({index: index + 1})">
                    Single Unit type</label> 
                </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
            </div>
</div>
<div class="p-4">
<div class="col-xs-24 col-sm-12" ng-repeat="(index, option) in $ctrl.options"> <!---->
        <div class="element form-radio radio radio-success" ng-class="{ 'required': $ctrl.required, 'no-title': !$ctrl.showTitle }" ng-repeat="item in option"> <!---->
        <h3 ng-if="$ctrl.showTitle" ng-bind=":: $ctrl.title + '.' + item.key | trans">
            Multi Unit type</h3><!----> <small ng-bind-html=":: $ctrl.description + '.' + item.key | trans">
                Multi-unit property are for rentals in which there are multiple rental units per a single address. This type of property is typically used for renting out rooms of a house, apartment units, office units, condos, garages, storage units, mobile home park and etc.</small> 
                <div> 
                    <input id="type-2" name="type" type="radio" ng-model="$ctrl.model" ng-value="item.key" async-change="$ctrl.radioClick()" ng-disabled="$ctrl.disabled" data-test="type-2" class="ng-pristine ng-untouched ng-valid ng-not-empty" value="2"> 
                    <label for="type-2" ng-bind-html=":: item.value" ng-click="$ctrl.callback({index: index + 1})">
                        Multi Unit type</label>
                     </div> 
                    </div><!----> 
                </div><!----> 
            </div> 
        <!-- </custom-radio-type> -->
</div>
</div>

<div class="p-l-24 d-flex"> 
   <!----> 
        </div><!---->
        
        </div>
                        <!-- </div> -->

                        <div class="form-check row d-flex gap:4">
                            <label><input type="radio" name="propertyType" value="singleUnit" class="form-check-input">Single Unit type</label>
                        </div>
                        
                        <label><input type="radio" name="propertyType" value="multiUnit">Multi Unit type</label>
                    </td>
                </tr>
                <tr class="singleUnit box">
                    <td>
                        <div class="">
                			<input type="hidden" name="unit_id[]" id="unit_id" value="'.$rows['id'].'">  
            			    <div class="form-group">
                                <label for="unittype">Type of Property</label>
                                <select class="form-control" name="unittype[]" id="unittype" required>
                                    <option value="Studio">Studio</option>
                                    <option value="Bedsitter">Bedsitter</option>
                                    <option value="Hostel Room">Hostel Room</option>
                                </select>
                            </div>
                            <div class="form-group">
                                        <label for="bedrooms">Bedrooms (between 1 and 5):</label>
                                        <input type="number" id="bedrooms" name="bedrooms[]" min="1" max="5">
                            </div>
                            <div class="form-group">
                                <label for="baths">Baths (between 1 and 5):</label>
                                <input type="number" id="baths" name="baths[]" min="1" max="5">
                            </div>
                            <div class="form-group">
                                <label for="rent">Market rent*</label>
                                <input type="number" id="rent" name="rent[]" min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="deposit">Deposit</label>
                                <input type="number" id="deposit" name="deposit[]" min="0">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="multiUnit box">
                    <td>
        				<div class="row">
        					<a class="unit_clone_add"><i class="fa fa-plus"></i> Add entry</a>
        				</div>
        				<?php
            			echo '
            			<div class="multiUnit_single">
                			<input type="hidden" name="unit_id[]" id="unit_id" value="'.$rows['id'].'">  
            			    <div class="form-group">
                                <label for="unittype">Type of Property</label>
                                <select class="form-control" name="unittype[]" id="unittype" required>
                                    <option value="Studio">Studio</option>
                                    <option value="Bedsitter">Bedsitter</option>
                                    <option value="Hostel Room">Hostel Room</option>
                                </select>
                            </div>
                            <div class="form-group">
                                        <label for="bedrooms">Bedrooms (between 1 and 5):</label>
                                        <input type="number" id="bedrooms" name="bedrooms[]" min="1" max="5">
                            </div>
                            <div class="form-group">
                                <label for="baths">Baths (between 1 and 5):</label>
                                <input type="number" id="baths" name="baths[]" min="1" max="5">
                            </div>
                            <div class="form-group">
                                <label for="rent">Market rent*</label>
                                <input type="number" id="rent" name="rent[]" min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="deposit">Deposit</label>
                                <input type="number" id="deposit" name="deposit[]" min="0">
                            </div>
                        </div>
                        ';
                        ?>
        	        </td>
    	        </tr>
               
                <tr>
                    <td>
                        <p>Please select contract status</p>
                        <select class="form-control form-select " name="contract" id="contract" style="width:300px;" required>
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
if(isset($_POST['name']) && isset($_POST["submit"])){
	if (empty($_POST['name']) || empty($_POST['propertyType'])){
        echo '<div id="alert_message" class="position" style="width:400px">
            <div class="alert alert-success" role="alert">Some Fields are empty</div>
        </div>';
    	exit;
	}
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
	
	$result=mysqli_query($con,"INSERT INTO `properties`(`property_name`, `Address`, `property_type`, `city`, `year_built`, `landlord_contact`, `contract_status`, `manager_id`) 
    VALUES ('$property_name','$Address','$property_type','$city','$year_built','$landlord_contact','$contract_status','$manager_id')");

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

    $someJSON = json_encode($array);
    
    mysqli_close($con);
    echo '<div id="alert_message" class="position" style="width:400px">
        <div class="alert alert-success" role="alert">'.$alert_message.'</div>
    </div>';
    echo '<script>window.location.href = "unit.php";</script>';
}
?>


<?php
include "footer.php";
?>