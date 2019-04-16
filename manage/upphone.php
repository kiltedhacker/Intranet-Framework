<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../config/session.php";

// Grab data
$department=$_POST['department'];
$ext=$_POST['extension'];
$extclean=htmlspecialchars($ext);
$extension=mysqli_real_escape_string($portal, $extclean);


// Update database
if (empty($department)){
  //
} else {
  $sql = "UPDATE departments SET extension='$extension' WHERE department='$department'";
}

// Success or failure
if ($portal->query($sql) === TRUE) {
  echo "<meta http-equiv='refresh' content='3;url=index.php' />
        Link updated successfully. Redirecting to Admin.";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
