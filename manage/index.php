<?php
//Set Timezone
date_default_timezone_set('America/Phoenix');

//SESSION AND USER DETAILS
include "../config/session.php";

if ($permissions < 80 & $permissions != 9 & $permissions != 19 & $permissions != 29 & $permissions != 39) {
  header("Location: //server/portal");
  exit();
} else {
  echo "";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Portal 4</title>
    <link rel="icon" type="image/png" href="../assets/img/favi.png" />

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/df396da02d.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include '../includes/menu.php';?>

<div id="main">
  <div id="content" class="container-fluid" style="overflow: auto;">
    <h1>Admin</h1><hr>
    <div class="row">
  		<div class="col-md-6">
        <div class="panel panel-default">
					<div class="panel-heading">
						<h3>Phone Extensions</h3>
					</div>
					<div class="panel-body">
            <?php
            $phonelist = "SELECT id,department,extension FROM departments ORDER BY department";
            $phonelist_result = mysqli_query($portal, $phonelist);

            if (empty($_POST['ext'])) {
              echo "<form action='' method='post'><div class='form-group'><select id='id' name='ext' class='form-control' style='width: 100%;'>";
              while($phone = $phonelist_result->fetch_assoc()) {
                echo "<option value='" . $phone['id'] . "' id='" . $phone['id'] . "'>" . $phone['department'] . "</option>";
              }
              echo "</select><div><button class='btn btn-primary' style='width: 100%; margin-left: 0px;'>Edit</button></form></div></div>";
            } else {
            $phoneID = $_POST['ext'];
              $phoneupdate = "SELECT id,department,extension FROM departments WHERE id=$phoneID";
              $phoneupdate_result = mysqli_query($portal, $phoneupdate);
              echo "<form method='post' action='upphone.php' id='plist'><div class='form-group'>";
                if($phones = $phoneupdate_result->fetch_assoc()) {
                  echo "<div class='form-group'><input type=hidden id='department' name='department' value='" . $phones['department'] . "' />" . $phones['department'] . "<span class='pull-right'><input type='text' id='extension' name='extension' value='" . $phones['extension'] . "'></input></span></div>";
                  echo "<button class='btn btn-primary' style='width:100%; margin-left: 0px;'>Update</button></div></form>";
                }
            }
            ?>
					</div>
				</div>
        <div class="panel panel-default">
					<div class="panel-heading">
						<h3>IP Lists</h3>
					</div>
					<div class="panel-body">
            <?php
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
              echo "<form method='post' action='upip.php' id='iplist'><div class='form-group'>";
              if($ipl = $ipl_result->fetch_assoc()) {
                echo "<h2>" . $ipl['ip_use'] . "</h2><input type=hidden id='ipuse' name='ipuse' value='" . $ipl['ip_use'] . "' /><textarea style='width: 100%;' name='range'>" . $ipl['ip_range'] . "</textarea>";
                echo "<div class='alert alert-warning' role='alert'>Separate IPs and ranges with an HTML line break (&lt;br&gt;) so they show on individual lines in the list.</div>";
                echo "<button class='btn btn-primary' style='width:100%; margin-left: 0px;'>Update</button></div></form>";
              }
            }
            ?>
					</div>
				</div>
        <div class="panel panel-default">
					<div class="panel-heading">
						<h3>Link Lists</h3>
					</div>
					<div class="panel-body">
            <?php
            if (empty($_POST['stadd'])) {
              echo "<form action='' method='post'><div class='form-group'><input type='hidden'><button id='id' name='stadd' class='btn btn-primary' value='1' style='width: 100%; margin-left: 0px;'>Add New Link</button></div></form>";
            } else {
              echo "<form method='post' action='addlink.php' name='stadd' id='stadd'><div class='form-group'><input type='text' name='title' placeholder='Button Title' style='width: 100%;'></input><br><input type='text' name='url' placeholder='Full URL (be sure to include &quot;http://&quot; or &quot;https://&quot;)' style='width: 100%;'></input></div>
              <select id='id' name='type' class='form-control' style='width: 100%;'>";
              $linklist = "SELECT DISTINCT(type) AS type FROM links ORDER BY type";
              $linklist_result = mysqli_query($portal, $linklist);
              $type_clean = str_replace(' ', '', $linktype['type']);
              while($linktype = $linklist_result->fetch_assoc()) {
                echo "<option name='" . $type_clean . "' id='" . $type_clean . "' value='" . $linktype['type'] . "'>" . $linktype['type'] . "</option>";
              }
              echo "</select>
              <button class='btn btn-primary' style='width:100%; margin-left: 0px;'>Add Link</button></form>";
            }
            echo "<hr>";
            if (empty($_POST['stools'])) {
              $linklist = "SELECT id,title,type FROM links ORDER BY type";
              $linklist_result = mysqli_query($portal, $linklist);
              echo "<form action='' method='post'><div class='form-group'><select id='id' name='stools' class='form-control' style='width: 100%;'>";
              while($linklist = $linklist_result->fetch_assoc()) {
                echo "<option value='" . $linklist['id'] . "' id='" . $linklist['id'] . "'>" . $linklist['title'] . " | " . $linklist['type'] . "</option>";
              }
              echo "</select><button class='btn btn-primary' style='width: 100%; margin-left: 0px;'>Edit</button></div></form>";
            } else {
              $link_id = $_POST['stools'];
              $editlink = "SELECT id, title, link, type FROM links WHERE id=$link_id";
              $editconnect = mysqli_query($portal, $editlink);
              while($editlink = $editconnect->fetch_assoc()) {
                echo "<form method='post' action='uplink.php' name='stadd' id='stadd'>
                <div class='form-group'>
                <input type='text' name='title' value='" . $editlink['title'] . "' style='width: 100%;'></input><br>
                <input type='text' name='url' value='" . $editlink['link'] . "' style='width: 100%;'></input>
                <input type='hidden' name='id' value='" . $editlink['id'] . "'></input>
                </div>
                <button class='btn btn-primary' style='width:100%; margin-left: 0px;'>Update Link</button>
                </form>";
              }
            }
            ?>
					</div>
				</div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
					<div class="panel-heading">
						<h3>Alerts</h3>
					</div>
					<div class="panel-body">
						Coming Soon
					</div>
				</div>
        <div class="panel panel-default">
					<div class="panel-heading">
						<h3>Feature Requests</h3>
					</div>
					<div class="panel-body">
						For feature requests, or updates that aren't available within the admin panel, please email admin@company.com with your request. Some requests may require approval prior to beginning work.
					</div>
				</div>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php';?>

</div>
<!-- /#wrapper -->



<!-- Menu Toggle Script -->
<!-- script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script -->

</body>
</html>
