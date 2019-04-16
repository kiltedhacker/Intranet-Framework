<?php
// Initialize the session
session_start();

//CONNECT
require($_SERVER['DOCUMENT_ROOT'].'/portal/config/connect.php');

// DEFINE SESSION DETAIL
$user_pull = $_SESSION['username'];

//DEFINE USER DETAILS
$user_details = "SELECT * FROM users where username='$user_pull'";
$user_result = mysqli_query($link, $user_details);
while($row = mysqli_fetch_array($user_result)){
  $id = $row['id'];
  $username = $row['username'];
  $created_at = $row['created_at'];
  $permissions = $row['permissions'];
  $name = $row['name'];
  $status = $row['status'];
  $tool_portal = $row['tool_portal'];
  $department = $row['department'];
}

//exit if account disabled
if (empty($tool_portal)) {
  echo " ";
} elseif ($tool_portal != "yes") {
  header('Location:login.php?access=2');
  exit();
}

//show admin tools if permissions at least 80 and department is reseach
if (empty($permissions)) {
  $adm = "";
} elseif ($permissions >= "80")  {
  $adm = '<a href="//server/portal/manage"><i class="fa fa-server"></i> Admin Panel</a><br><a href="//server/portal/logout.php"> Sign Out</a>';
} elseif ($permissions < "80") {
  $adm = '<a href="//server/portal/logout.php"> Sign Out</a>';
} else {
  $adm = " ";
}
