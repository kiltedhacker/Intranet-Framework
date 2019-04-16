<?PHP include ('menu.php'); ?>
<form method="POST">
<textarea rows="10" cols="50" name="list_data"></textarea><br>
Site ID: <input type="text" name="siteid"> 
<input type="checkbox" name="append_siteid" value="1"> Append Site ID 
<input type="submit" value="submit">
</form>
<?PHP
if ($_POST['list_data']) {
	$data=explode(PHP_EOL, $_POST['list_data']);
	foreach ($data as $out_data){
	$outdata=preg_replace('/[\s]:[\s](.*?)$/i','', $out_data);
	if ($_POST['append_siteid']==1){
		echo "/var/ftp_scan/".$_POST['siteid']."/mirror/". $outdata . "<br>";
	} else {
		echo $outdata . "<br>";
	}
	}
}


?>