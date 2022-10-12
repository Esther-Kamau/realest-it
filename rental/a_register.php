<?php
include "conn.php";

function check($data){
  $data= trim($data);
  $data= htmlspecialchars($data);
  $data= stripslashes($data);
  return $data;
}

if(isset($_POST["submit"])){

  $name = check($_POST['Name']);
  $uname = check($_POST['uName']);
  $pno = check($_POST['pno1']);
  $role = "Landlord";
  $pword = check($_POST['password']);
  $rpword = check($_POST['repeatPassword']);

  $date_reg = date('Y-m-d');
  if(is_numeric($name)){
    $nameErr = "The name should only contain letters!";
    echo "<script> alert('$nameErr');</script>";
  }elseif ((strlen($name)<3) || (strlen($name)>20)) {
    $nameErr = "The name is either too short or too long";
    echo "<script> alert('$nameErr');</script>";
  }else {
    if (!is_numeric($pno)) {
      $pnoErr = "The phone number should not contain letters";
      echo "<script> alert('$pnoErr');</script>";
    }elseif (strlen($pno) > 12) {
      $pnoErr = "The phone number is too long";
      echo "<script> alert('$pnoErr');</script>";
    }elseif (strlen($pno) < 12) {
      $pnoErr = "The phone number is too short";
      echo "<script> alert('$pnoErr');</script>";
    }else {

      $sql4 = "SELECT * FROM user WHERE u_name = '$uname'";
      $query = mysqli_query($con, $sql4);
      if(mysqli_num_rows($query) > 0){
        echo "<script> alert('Username exists!!');</script>";
      }else {
        if ((strlen($pword) < 8) || (strlen($rpword) < 8)) {
          echo "<script> alert('Password is too short');</script>";
        }
        elseif($pword == $rpword){
          $pword = md5($pword);

            $sql= "INSERT INTO `user`(`user_id`, `name`, `role`, `pno`, `u_name`, `pword`, `date_reg`) VALUES (' ','$name','$role','$pno','$uname','$pword','$date_reg')";
            mysqli_query($con, $sql);
            mysqli_close($con);
            echo "<script type='text/javascript'>alert('Registered successfully.');</script>";
            echo '<style>body{display:none;}</style>';
            echo '<script>window.location.href = "admin_home.php";</script>';

        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rental House Management System</title>
  <link rel="icon" href="rent.ico">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>



  <div class="container">

    <div class="card o-hnameden border-0 shadow-lg my-5 border-left-primary">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><b><b>PROPERTY MANAGER REGISTRATION</b></b></h1>
              </div>

              <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-lg" name="Name" value="<?php echo @$name; ?>" placeholder="Name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-lg" name="uName" value="<?php echo @$uname; ?>" placeholder="User Name" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-lg" name="pno1" value="<?php echo @$pno; ?>" placeholder="Phone Number e.g; 254717******" required>
                  </div>

                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select class="custom-select form-control form-control-lg" name="role" id="durations" style="width:480px;"required>
                      <option  value = "" disabled selected>Role</option>
                      <!-- <option  value = "Administrator">Administrator</option> -->
                      <option value = "Manager">Manager</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-lg" name="repeatPassword" placeholder="Repeat Password" required>
                  </div>
                </div>
                <hr>
              <center>

                <input class="btn btn-primary btn-lg btn-sm" type="submit" name="submit" value="Register Account">

              </center>

              </form>

              <div class="text-center">
                <a class="small" href="landlord_home.php" style="color:blue;">Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- All the input fields should be disabled by default. 
2. The radio button value is “Enable” when the user selects the “Student” option. 
3. The radio button value is “Disable” when the user selects the “Professional” option. 
4. The input fields should be enabled only when the radio button value is “Enable”. 
5. The input fields should be disabled only when the radio button value is “Disable”. 
6. The input fields that are enabled should be required. 
7. The input fields that are disabled should not be required. -->
  <script type="text/javascript">
    $('input[name = "radio"]').on('change', function()
    {
      $('input[name = "programme"]').attr('disabled', this.value != "Enable");
      $('input[name = "regno"]').attr('disabled', this.value != "Enable");
      $('input[name = "occupation"]').attr('disabled', this.value != "Disable");
      $('input[name = "programme"]').attr('required', this.value == "Enable");
      $('input[name = "regno"]').attr('required', this.value == "Enable");
      $('input[name = "occupation"]').attr('required', this.value == "Disable");
    });


  </script>
   <!-- The first line is to select the dropdown with the ID "durations"
2. The second line is to check if the value of the selected option is 3, and if it is, disable the option with value 2.
3. The third line is to check if the value of the selected option is 3, and if it is, disable the option with value 4.
4. The fourth line is to check if the value of the selected option is 6, and if it is, disable the option with value 4. -->
  <script type="text/javascript">
    $("#durations").on('change',function(){
      $('#terms option[value = 2]').attr('disabled',this.value == 3);
      $('#terms option[value = 4]').attr('disabled',this.value == 3);
      $('#terms option[value = 4]').attr('disabled',this.value == 6);

     });


  </script>
 <!-- . When the document is ready (i.e. when the page has loaded), run the function
2. Listen for a click on a checkbox
3. When a checkbox is clicked, deselect all other checkboxes -->
 <script>
    
$(document).ready(function(){
    $('input:checkbox').click(function() {
        $('input:checkbox').not(this).prop('checked', false);
    });
});
</script>

<script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-1.12.4.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


</body>

</html>
