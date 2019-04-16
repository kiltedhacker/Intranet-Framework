<?php
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		header('Location: setup-form.php');
	}

	function generatePassword($length = 12){
		$sets = array();
		$sets[] = 'abcdefghijklmnopqrstuvwxyz';
		$sets[] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$sets[] = '0123456789';
		$sets[] = '!@#$%&*?-';
		$all = '';
		$password = '';
		foreach($sets as $set)
		{
			$password .= $set[array_rand(str_split($set))];
			$all .= $set;
		}
		$all = str_split($all);
		for($i = 0; $i < $length - count($sets); $i++)
			$password .= $all[array_rand($all)];
		$password = str_shuffle($password);
		return $password;
	}

	require __DIR__ . '/vendor/autoload.php';
	use \cypheralmasy\CpSmart as CpSmart;
?>
<html>
<head>
<title>SMART setup results</title>
</head>
<body>
	<h1>Setup Results</h1>
	<pre><?php

try {

	$smart = new CpSmart([
		'server'	=>	$_POST['server'],
		'username'	=>	$_POST['username'],
		'password'	=>	$_POST['password'],
	]);

	$smart->initialize();
	$smart->setDomain($_POST['domain']);

	$ftpUser = 'kilted' . $_POST['siteId'];
	$ftpPass = generatePassword();
	$smart->createFtpUser($ftpUser, $ftpPass);

 	$ip = $smart->getIpAddress();
	$exclusions = $smart->getExclusions();

	echo "Success!\n\n";
	echo "New FTP details:\n";
	echo $ip . "\n";
	echo $ftpUser . "\n";
	echo $ftpPass . "\n";
	echo "/\n\n";
	echo "Exclusions:\n";
	echo implode("\n", $exclusions);

} catch (Exception $e){
	echo "There was an error!\n";
	echo $e->getMessage() . "\n";
	$errors = $smart->getErrors();
	for($i=0; $i < count($errors); $i++){
		echo $errors[$i] . "\n";
	}
}

?></pre>
</body>
</html>
