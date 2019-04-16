<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../config/session.php";

// Grab data
$linkid=htmlspecialchars($_POST['id']);
$linkide=htmlspecialchars($linkid);
$title=htmlspecialchars($_POST['title']);
$titlee=addslashes($title);
$url=htmlspecialchars($_POST['url']);
$urle=addslashes($url);


// Update database
if (empty($title)){
  //
} else {
  $sql = "UPDATE links SET title='$titlee', link='$urle' WHERE id='$linkide'";
}

// Success or failure
if ($portal->query($sql) === TRUE) {
  echo "<meta http-equiv='refresh' content='3;url=index.php' />
        Link updated successfully. Redirecting to Admin.";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
