<?php
include 'admin_header.php';




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
  $landlord_id = $_SESSION['user_id'];


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

            $sql= "INSERT INTO `user`(`user_id`, `name`, `role`, `pno`, `u_name`, `pword`,`landlord_id`, `date_reg`) VALUES (' ','$name','$role','$pno','$uname','$pword','$landlord_id','$date_reg')";
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




  <div class="container">

    <div class="card o-hnameden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><b><b>REGISTRATION</b></b></h1>
              </div>

              <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-lg" name="Name" value="<?php echo @$name; ?>" placeholder="Name" required>
</div>
                  <div class="col-sm-6">
                  <input type="text" class="form-control form-control-lg" name="uName" value="<?php echo @$uname; ?>" placeholder="Username" required>
                </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-lg" name="pno1" value="<?php echo @$pno; ?>" placeholder="Phone Number e.g; 254717******" required>
                  </div>

                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select class="custom-select" name="role" id="durations" style="width:480px;"required>
                      <option  value = "" disabled selected>Role</option>
                      <!-- <option  value = "Administrator">Administrator</option> -->
                      <option value = "Landlord">Landlord</option>
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
                <a class="small" href="admin_home.php" style="primary;">Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
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
  <script type="text/javascript">
    $("#durations").on('change',function(){
      $('#terms option[value = 2]').attr('disabled',this.value == 3);
      $('#terms option[value = 4]').attr('disabled',this.value == 3);
      $('#terms option[value = 4]').attr('disabled',this.value == 6);

     });


  </script>
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
