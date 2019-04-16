<?php
$urla=array();
$_POST['url']=htmlentities($_POST['url']); // XSS Fix
$_POST['url']=trim(str_replace("http://www.", "", $_POST['url']));
$_POST['url']=trim(str_replace("http://", "", $_POST['url']));

$urla[]=trim($_POST['url']);
$urla[]="ftp.".$urla[0];
$urla[]="www.".$urla[0];

$url_nonencoded=$_POST['url'];
$url_domain=$urla[0];

$_SESSION['url'] = htmlentities($_SESSION['url']); // XSS Fix

$_SESSION['url']=$urla[0];
?>
