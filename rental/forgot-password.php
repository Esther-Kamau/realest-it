<?php
include "conn.php";


function check($data){
  $data= trim($data);
  $data= htmlspecialchars($data);
  $data= stripslashes($data);
  return $data;
}


if(isset($_POST["reset"])){
  $uname = check($_POST['username']);
  $pword = check($_POST['pword']);
  $cpword = check($_POST['cpword']);
  $query = "SELECT * FROM tenant WHERE u_name = '$uname'";
  $res = mysqli_query($con,$query);
  if(mysqli_num_rows($res) == 1){
    if ($pword != $cpword) {
      echo "<script type='text/javascript'>alert('Passwords don't match.');</script>";
    }else {
      if((strlen($pword) < 8) || (strlen($cpword) < 8)){
        echo "<script> alert('Password is too short.');</script>";
      }elseif(!($pword == '') || !($cpword == '')){
        $pword = md5($pword);
        $sql = "UPDATE tenant SET p_word ='$pword' WHERE u_name = '$uname'";
        if (mysqli_query($con, $sql)) {
          echo "<script> alert('Password has been changed successfully. New password will be effective upon new login.');</script>";
          echo '<style>body{display:none;}</style>';
          echo '<script>window.location.href = "u_change.php";</script>';
          mysqli_close($con);
          exit;
        }

      }
    }
  }else{
    echo "<script> alert('Username does not exist.');</script>";
  }

}



 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>RealEst-IT</title>
  <link rel="icon" href="icon.svg">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">

</head>

 <section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        

          <img src="./branding/logintemp.png" class="img-fluid" alt="Sample image">
        
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
      <!-- <a class="navbar-brand text-brand font-weight-bold" href="index.php">RealEst<span class="color-b">-IT</span></a> -->
      <a href="index.php">

        <img src="./branding/branding.png" style="height:50px" alt="">
      </a>

        <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
          
          <!-- UserName input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="form3Example3">UserName</label>

            <input type="text" id="form3Example3 " class="form-control form-control-lg" name="username" aria-describedby="emailHelp" value="<?php echo @$uname; ?>" placeholder="Username" required>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Password</label>
            <input type="password" id="form3Example4" class="form-control form-control-lg" name="pword" placeholder="Password" required>
         
          </div>
          <!-- repeat Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Repeat Password</label>
            <input type="password" id="form3Example4" class="form-control form-control-lg" name="cpword" placeholder="Confirm Password" required>
         
          </div>

          

         
            <!-- submit confirm reset password button -->

          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" class="btn btn-primary btn-lg" name="reset" value="Reset Password"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">
              <div class="text-center">
                    <a class="small font-weight-bold mt-4 pt-1" href="login.php">Login</a>
                  </div>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="register.php"
                class="link-danger">Register</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-center py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2022. All rights reserved.
    </div>
   
</section>


  <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
