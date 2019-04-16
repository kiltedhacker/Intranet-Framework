<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../config/session.php";

// Grab data
$title=htmlspecialchars($_POST['title']);
$titlee=addslashes($title);
$url=htmlspecialchars($_POST['url']);
$urle=addslashes($url);
$type=htmlspecialchars($_POST['type']);
$typee=addslashes($type);

// Update database
if (empty($title)){
  //
} else {
  $sql = "INSERT INTO links (title, link, type) VALUES ('" . $titlee . "', '" . $urle . "', '" . $typee . "')";
}
//$editconnect = mysqli_query($portal, $editlink);
// Success or failure
if ($portal->query($sql) === TRUE) {
  echo "<meta http-equiv='refresh' content='3;url=index.php' />
        Link updated successfully. Redirecting to Admin.";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
