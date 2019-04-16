<?php
// Connect to SSO
$link = mysqli_connect("server:3306","user","ppassword", "database")
    or die("<b>SSO Error:</b><br>" . mysqli_connect_error());

//Connect to Portal full access
$portal = mysqli_connect("server:3306","user","ppassword", "database")
    or die("<b>Portal Error:</b><br>" . mysqli_connect_error());

//Connect to trends viewer access
$viewer = mysqli_connect("server:3306","user","ppassword", "database")
    or die("Can't connect to database server");
?>
