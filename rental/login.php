<?php
session_start();
include "conn.php";


function check($data){
  $data= trim($data);
  $data= htmlspecialchars($data);
  $data= stripslashes($data);
  $data = mysqli_real_escape_string($con , $data);
  return $data;
}


if(isset($_POST["login"])){
  $uname = $_POST['username'];
  $pword = md5($_POST['password']);
  //$rem = $_COOKIE['rememberme'];
  $sql = "SELECT * FROM tenant WHERE u_name = '$uname' AND p_word = '$pword'";
  $sql1 = "SELECT * FROM user WHERE u_name = '$uname' AND pword = '$pword'";
  $query = mysqli_query($con, $sql);
  $query1 = mysqli_query($con, $sql1);
  $row = mysqli_fetch_assoc($query);
  $row1 = mysqli_fetch_assoc($query1);
  do {
    $role = $row1['role'];
    $user_id = $row1['user_id'];
    $row1 = mysqli_fetch_assoc($query1);
  } while ($row1);

  do{
    $fname = $row['fname'];

    $lname = $row['lname'];

    $stat = $row['status'];

    $id = $row['tenant_id'];
    $sql2 = "SELECT * FROM contract WHERE tenant_id = '$id'";
    $query2 = mysqli_query($con, $sql2);
    $row1 = mysqli_fetch_assoc($query2);

    do{
      $end_date = $row1['end_day'];
      $h_id = $row1['house_id'];
      $row1 = mysqli_fetch_assoc($query2);
    }while ($row1);
    $row = mysqli_fetch_assoc($query);

  }while ($row);



  if ((mysqli_num_rows($query) == 1) || (mysqli_num_rows($query1) == 1)) {

    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;


    

    if($role == "Administrator"){
      $_SESSION['username'] = $uname;
      echo "<script type='text/javascript'>alert('Welcome $uname!');</script>";
      echo '<style>body{display:none;}</style>';
      echo '<script>window.location.href = "admin_home.php";</script>';

    }
    elseif ($role == "Landlord") {
      $_SESSION['username'] = $uname;
      echo "<90
      script type='text/javascript'>alert('Welcome $uname!');</script>";
      echo '<style>body{display:none;}</style>';
      echo '<script>window.location.href = "landlord_home.php";</script>';
    }
    elseif ($role == "Manager") {
      $_SESSION['username'] = $uname;
      echo "<script type='text/javascript'>alert('Welcome $uname!');</script>";
      echo '<style>body{display:none;}</style>';
      echo '<script>window.location.href = "manager_home.php";</script>';
    }

    else {

      if ($stat == 0) {
        $_SESSION['username'] = $uname;
        echo "<script type='text/javascript'>alert('Welcome $fname $lname!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "initial_payment.php";</script>';
      }elseif ($stat == 1) {
        $_SESSION['username'] = $uname;
        echo "<script type='text/javascript'>alert('Welcome $fname $lname!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "home.php";</script>';
      }elseif ($stat == 2) {
        $_SESSION['username'] = $uname;
        echo "<script type='text/javascript'>alert('Welcome $fname $lname!');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "waiting.php";</script>';
      }elseif((date('Y-m-d') > $end_date) && $stat == 1){
        $sql3 = "UPDATE tenant SET status = '3' WHERE tenant_id = '$id'";
        mysqli_query($con, $sql3);
        $sql5 = "UPDATE contract SET status ='Inactive' WHERE status = 'Active' AND tenant_id = '$id'";
        mysqli_query($con, $sql5);
        $sql5 = "UPDATE house SET status ='Empty' WHERE house_id = '$h_id'";
        mysqli_query($con, $sql5);
        $_SESSION['username'] = $uname;
        echo "<script type='text/javascript'>alert('Welcome $fname $lname! Your contract has expired. To access the system please renew the contract.');</script>";
        echo '<style>body{display:none; color:red;}</style>';
        echo '<script>window.location.href = "renew_contract.php";</script>';

      }elseif ($stat == 3) {
        $_SESSION['username'] = $uname;
        echo "<script type='text/javascript'>alert('Welcome $fname $lname! Your contract has expired. To access the system please renew the contract.');</script>";
        echo '<style>body{display:none;}</style>';
        echo '<script>window.location.href = "renew_contract.php";</script>';
      }
    }
    mysqli_close($con);
    $uname = "";


  }else {
    echo "<script style = 'color:red;'> alert('Incorrect Username or Password!!!')</script>";
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
      <a href="index.php">

        <img src="./branding/branding.png" style="height:50px" alt="">
      </a>

        <!-- <h1 class="text-black font-weight-bold">Login</h1> -->

        <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
          
          <!-- UserName input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="form3Example3">UserName</label>

            <input type="text" id="form3Example3 " class="form-control form-control-lg" name="username" aria-describedby="emailHelp" value="<?php echo @$uname; ?>" placeholder="Username">
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Password</label>
            <input type="password" id="form3Example4" class="form-control form-control-lg" name="password" placeholder="Password">
         
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox for remember me -->

            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
              </label>
            </div>
            <a href="forgot-password.php" class="text-body">Forgot password?</a>
          </div>
            <!-- submit login button -->

          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" class="btn btn-primary btn-lg" name="login" value="Login"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="register.php"
                class="link-danger">Register</a></p>
          </div>

        </form>
      </div>
    </div>
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
