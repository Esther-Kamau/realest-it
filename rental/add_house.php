<?php
include "landlord_header.php";
include "nav.php";

// $con = mysqli_connect("localhost","root","","rental_v1");
//get all properties from properties table
$sql = "SELECT * FROM `properties`";
$all_properties = mysqli_query($con, $sql);


if(isset($_POST['submit'])){
  $id = mysqli_real_escape_string($con , $_POST['properties']);
  $house = mysqli_real_escape_string($con, $_POST['name']);
  $housetype = mysqli_real_escape_string($con, $_POST['housetype']);
  $block = mysqli_real_escape_string($con, $_POST['block']);
  $bedrooms = mysqli_real_escape_string($con, $_POST['bedrooms']);
  $bathrooms = mysqli_real_escape_string($con, $_POST['bathrooms']);
  $rent =  mysqli_real_escape_string($con, $_POST['rent']);
  $deposit = mysqli_real_escape_string($con, $_POST['deposit']);
  $manager_id = $_SESSION['user_id'];
  
  $alert_array = array();
  $alert_message='';
  
  $sql_insert = "INSERT INTO house(property_id, manager_id, house_name, house_type, block , bedroom ,bathrooms,rent, deposit) 
  VALUES ('$id','$manager_id','$house','$housetype','$block','$bedrooms','$bathrooms','$rent','$deposit')";
  


           if(mysqli_query($con, $sql_insert))
           {
            echo "House inserted successfully.";
           }
          //  mysqli_query($con, $sql);
          //  mysqli_close($con);
           
            //  echo "<script type='text/javascript'>alert('The house has been added successfully.');</script>";
            //  echo '<style>body{display:none;}</style>';
            //  echo '<script>window.location.href = "house_detail.php";</script>';

         
}

        
                    ?>


 
    
     <div id="content-wrapper" class="d-flex flex-column">

       <!-- Main Content -->
       <div id="content">

         <!-- Begin Page Content -->
         <div class="container-fluid">

           <!-- Page Heading -->
           <h1 class="h3 mb-2 text-gray-800">Add House</h1>

           <!-- DataTales Example -->
           <div class="card shadow border-left-primary mb-4">
             <div class="card-body">
               <div class="table-responsive">
                 <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

                   <tbody>
                    
                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                     <tr>
                        <td> Property Name:</td>
                        <td>
                          <select class='form-control form-control-user' name="properties">
                            <?php
                            //use a while loop to fetch data
                            //from $all_properties variable
                            //and display it in the dropdown
                            while($properties = mysqli_fetch_array(
                            $all_properties,MYSQLI_ASSOC)):;
                            
                            ?>
                            
                          <option value="<?php echo $properties['property_id'];
                          //the value we usually set is the primary key
                          ?>">
                          <?php echo $properties['property_name'];
                          //the text we usually set is the name of the property
                          ?>
                          <?php
                          endwhile;
                          //the while loop must be terminated
                          ?>
                      
                          </option>
                          </select>
                        </td>
                     </tr>
                       <tr>
                         <td>
                           House Name:
                         </td>
                         <td>
                          <input type='text' class='form-control form-control-user' name='name' required>
                        </td>
                       </tr>

                     <tr>
                       <td>
                         House Type:
                       </td>
                       <td>
                       <select class="form-control" name="housetype" id="housetype" required>
                                    <option value="Studio">Studio</option>
                                    <option value="Bedsitter">Bedsitter</option>
                                    <option value="Hostel Room">Hostel Room</option>
                                    <option value="Standalone">Stand-alone(bungalow,mansionnette)</option>
                                    <option value="Apartment">Apartment</option>

                       </td>
                     </tr>
                     <tr>
                       <td>
                         Block/section:
                       </td>
                       <td>
                       <input type='text' class='form-control form-control-user' name='block' required>
                       

                       </td>
                     </tr>
                     <tr>
                       <td>
                         Bedrooms:
                       </td>
                      <td>
                         <input class="form-control form-control-user" type="number" id="bedrooms" name="bedrooms" min="1" max="5">
                      </td>
                      </tr>
                      <tr>
                       <td>
                         Bathrooms:
                       </td>
                      <td>
                         <input class="form-control form-control-user" type="number" id="bedrooms" name="bathrooms" min="1" max="5">
                      </td>
                      </tr>
                       </td>
                     </tr>
                      <tr>
                        <td>
                          Monthly Rent:
                        </td>
                        <td>
                                <input class="form-control form-control-user" type="number" id="rent" name="rent" min="1" required>
                     <tr>
                     </td>
                      </tr>
                      <tr>
                        <td>
                          Deposit:
                        </td>
                        <td> 
                        <input class="form-control form-control-user" type="number" id="deposit" name="deposit" min="0">
                        </td>
                      </tr>
                     <td><input class='btn btn-primary btn-user btn-lg' type='submit' name='submit' value='Add House'></td>
                     </form>
                     <tr>
                   </tbody>
                   
                 </table>
               </div>
             </div>
           </div>

         </div>
         <!-- /.container-fluid -->

       </div>
       <!-- End of Main Content -->

      

     </div>
     <!-- End of Content Wrapper -->

   </div>
   
   <?php
include "footer.php";
?>