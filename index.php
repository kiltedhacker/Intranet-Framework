<?php
//Set Timezone
date_default_timezone_set('America/Phoenix');

//SESSION AND USER DETAILS
include "config/session.php";

$page = $_POST['pageView'];
$user = $_SESSION['username'];

$dsEpisodes = "SELECT id,string_date FROM decoding_security ORDER BY id DESC LIMIT 1";
$dsEpisodes_result = mysqli_query($portal, $dsEpisodes);
while($row = mysqli_fetch_array($dsEpisodes_result)){
   $dsEpisode = $row['id'];
   $dsDate = $row['string_date'];
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
    <link rel="icon" type="image/png" href="assets/img/favi.png" />

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Custom CSS -->
    <link href="assets/css/simple-sidebar.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/df396da02d.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include 'includes/menu.php';?>

<div id="main">
  <div id="content" style="overflow: auto;">
    <?php
    //SITEWIDE NOTIFICATIONS
    //Management Alerts
    //Not yet built out, but will utilize the site_alerts table in the Portal database.

    //New Podcast Episode - Displays if new episode submitted within the past 48 hours
    $cur_time = strtotime(now);
    $pub_time = $dsDate;
    if ($cur_time - $pub_time < 172800) {
      echo "<div class='container-fluid'><div class='alert alert-info'><p><b>New Podcast:</b> The latest episode of our podcast is now available! You can listen in Portal, <a href='https://itunes.apple.com/us/podcast/podcast-title/id123456789?mt=2' target='_blank'>iTunes</a>, <a href='https://playmusic.app.goo.gl/?ibi=com.google.PlayMusic&isi=691797987&ius=googleplaymusic&link=https://play.google.com/music/m/gplayid?t%3Dpodcast-title%26pcampaignid%3DMKT-na-all-co-pr-mu-pod-16' target='_blank'>Google Play</a>, <a href='https://open.spotify.com/show/podcast-identifier' target='_blank'>Spotify</a>, <a href='https://tunein.com/radio/podcast-title-p1032429/' target='_blank'>TuneIn</a>, <a href='https://www.stitcher.com/podcast/podcastowner/podcast-title?refid=stpr' target='_blank'>Stitcher</a>, or <a href='https://www.youtube.com/channel/channelid' target='_blank'>YouTube</a>.</p></div>";
    } else {
      echo "";
    }

    //CALL CONTENT
    if(!empty($_POST[pageView])) {
    	if($_POST[pageView] == "no") {
    		include "includes/noteam.php";
    	} elseif ($_POST[pageView] == "sl") {
    		include "includes/sales.php";
    	} elseif ($_POST[pageView] == "am") {
    		include "includes/am.php";
    	} elseif ($_POST[pageView] == "su") {
    		include "includes/su.php";
    	} elseif ($_POST[pageView] == "se") {
    		include "includes/sentinel.php";
    	} elseif ($_POST[pageView] == "or") {
    		include "includes/oracle.php";
    	} elseif ($_POST[pageView] == "an") {
    		include "includes/ansible.php";
    	} elseif ($_POST[pageView] == "la") {
    		include "includes/lantern.php";
    	} elseif ($_POST[pageView] == "ho") {
    		include "includes/hoshi.php";
      }
    } else {
      //Check if Account Management
      if ($permissions >= 10 and $permissions <= 19){
        include "includes/account_management.php";
      //Check if Support
      } elseif ($permissions >= 20 and $permissions <= 29){
        include "includes/support.php";
      //Check if Advanced Support
      } elseif ($permissions >=30 and $permissions<=39){
        include "includes/sentinel.php";
      //Check if Sales
      } elseif (!is_null($permissions) and $permissions<=9){
        include "includes/sales.php";
      //If no permissions, load login
      } elseif (is_null($permissions)){
        include "includes/noteam.php";
      }
    }
    ?>
  </div>
</div>

<?php include 'includes/footer.php';?>

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
