<html>
<head>
<title>cPanel SMART setup</title>
<style type="text/css">
html, body {
	width: 100%;
}

fieldset, legend {
	border: 1px black solid;
}

fieldset {
	margin: 10px;
	width: 50%;
}

legend {
	border-radius: 4px;
	padding: 4px;
}
</style>
</head>
<body>
	<form action="content/plugs/cpsmart/setup.php" method="post">
		<b>cPanel Details</b>
			<div class="alert alert-warning" role="alert">
		    <b>Note:</b> This is the cPanel credentials, not the FTP credentials you want to use.
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="server" placeholder="Server IP or Hostname">
				<input type="text" class="form-control" name="username" placeholder="Username">
				<input type="password" class="form-control" name="password" placeholder="Password">
				<label class="control-label" for="formGroupInputSmall">Site Details</label>
				<input type="text" class="form-control" name="siteId" placeholder="Site ID">
				<input type="text" class="form-control" name="domain" placeholder="Domain">
				<button type="submit" class="btn btn-block btn-primary" style="margin-top:5px;">Submit</button>
			</div>
	</form>
</body>
</html>
