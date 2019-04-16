<?php
include("config/session.php");

$blue_query = "SELECT * FROM mal_trends where severity=1 and not(active_status=2)";
$blue_result = mysqli_query($viewer, $blue_query);
$blue_rows = mysqli_num_rows($blue_result);

$yellow_query = "SELECT * FROM mal_trends where severity=2 and not(active_status=2)";
$yellow_result = mysqli_query($viewer, $yellow_query);
$yellow_rows = mysqli_num_rows($yellow_result);

$red_query = "SELECT * FROM mal_trends where severity=3 and not(active_status=2)";
$red_result = mysqli_query($viewer, $red_query);
$red_rows = mysqli_num_rows($red_result);

$trend_query = "SELECT * FROM mal_trends where not(active_status=2) limit 10";
$trend_result = mysqli_query($viewer, $trend_query);
?>
<span class="data">
  <strong>
    <div class="row">
      <div class="col-md-2 col-md-offset-3 text-center">
        <span style="color: #D9534F;" title="Alerts are trends that we are actively researching. These are major trends that are active on a large number of websites, or are new trends with the potential to do a lot of harm.">Alert</span><br><?php echo $red_rows; ?>
      </div>
      <div class="col-md-2 text-center">
        <span style="color: #F0AD4E;" title="Watch items are trends that we are seeing, but need more examples of to determine the scope of the trend. These may turn into major trends, or may just be initial tests by attackers.">Watch</span><br><?php echo $yellow_rows; ?>
      </div>
      <div class="col-md-2 text-center">
        <span style="color: #5BC0DE;" title="Monitor items are new or interesting pieces of malware that may or may not turn into a trend. These items are not being actively researched, as we need more examples to determine the scope of the malware, or what the malware is doing.">Monitor</span><br><?php echo $blue_rows; ?>
      </div>
    </div>
  </strong>
<?php
while($row = mysqli_fetch_array($trend_result)){
$trend_id = $row['trend_id'];
$vieweromments = $row['comments'];
$date = $row['date'];
$time = $row['time'];
$severity = $row['severity'];
$nickname = $row['nickname'];
if ($severity === "1"){
  $sev ='<span style="color: #5BC0DE;" title="'.$vieweromments.'">'.$nickname.'</span>';
} elseif ($severity === "2"){
  $sev ='<span style="color: #F0AD4E;" title="'.$vieweromments.'">'.$nickname.'</span>';
} elseif ($severity === "3"){
  $sev ='<span style="color: #D9534F;" title="'.$vieweromments.'">'.$nickname.'</span>';
}
echo $sev." Added ".$date." at ".$time."<br>";
}
?>
</span>
