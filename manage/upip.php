<?php
require "../config/session.php";

// Grab data
$ipuse=$_POST['ipuse'];
$r=$_POST['range'];
$range=mysqli_real_escape_string($portal, $r);

// Update database
if (empty($r)){
  //
} else {
  $sql = "UPDATE ip_lists SET ip_range='$range' WHERE ip_use='$ipuse'";
}

// Success or failure
if ($portal->query($sql) === TRUE) {
  echo "<meta http-equiv='refresh' content='3;url=/portal/manage/' />
        IP list updated successfully. Redirecting to Admin.";
} else {
  echo "<br><br>there was some sort of error";
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
