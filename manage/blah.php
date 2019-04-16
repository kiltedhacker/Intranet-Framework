<?php
//SESSION AND USER DETAILS
include "../config/session.php";

$iplist = "SELECT id,ip_use,ip_range FROM ip_lists";
$iplist_result = mysqli_query($portal, $iplist);

if (empty($_POST['iplists'])) {
  echo "<form action='' method='post'><div class='form-group'><select id='id' name='iplists' class='form-control' style='width: 100%;'>";
  while($ip = $iplist_result->fetch_assoc()) {
    echo "<option value='" . $ip['id'] . "' id='" . $ip['id'] . "'>" . $ip['ip_use'] . "</option>";
  }
  echo "</select><button class='btn btn-primary' name='$ip[id]' style='width: 100%; margin-left: 0px;'>Edit</button></div></form>";
} else {
  $iplists = $_POST['iplists'];
  $ipl = "SELECT id,ip_use,ip_range FROM ip_lists WHERE id=$iplists";
  $ipl_result = mysqli_query($portal, $iplist);
  //$ipsl = $ipl_result->query($ipl);
  echo "<form method='post' action='upip.php' id='iplist'><div class='form-control'>";
  if($ipl = $ipl_result->fetch_assoc()) {
    echo "<h2>" . $ipl['ip_use'] . "</h2><input type=hidden id='ipuse' name='ipuse' value='" . $ipl['ip_use'] . "' />" . $ipl['ip_range'] . "<br>";
    echo "<button class='btn btn-primary' style='width:100%; margin-left: 0px;'>Update</button></div></form>";
    }
}
?>
