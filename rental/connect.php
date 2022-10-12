<?php
$conn = @mysqli_connect("localhost", "root", "", "tuma_pesa");
if(!$conn){
  echo "Connection failed!".@mysqli_error($conn);
}
?>
