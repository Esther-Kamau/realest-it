<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>


    <ul class="navbar-nav ml-auto">


      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-grey-900 small"><?php
//checks the role in the session and lists it
$uname = $_SESSION['username'];

$query = "SELECT * FROM tenant WHERE u_name = '$uname' ";
$result = mysqli_query($con, $query);
$row=mysqli_fetch_assoc($result);
do{
$fname = $row['fname'];
$lname = $row['lname'];
$full = $fname." ".$lname;
echo $full;
$row = mysqli_fetch_assoc($result);
}while ($row);

            ?></span>
<i class="bi bi-person text-gray-900"></i>
          <img class="img-profile rounded-circle" src="user.png">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>

      </li>

    </ul>

  
  </nav>