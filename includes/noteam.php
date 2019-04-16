<?php
date_default_timezone_set('America/Phoenix');

//require_once 'config/connect.php';

$username = $password = "";
$username_err = $password_err = "";

$access_error = $_GET['access'];
if ($access_error != NULL) {
  $access_err = '<div class="alert alert-danger" role="alert"><strong>Error 104</strong><br> Account Disabled. Contact the administrator.</div>';
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }


    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

                            session_start();
                            $_SESSION['username'] = $username;
                            $last_login_gen = date('h:i:s')."_".date('Y/m/d')."_NOSTROMO";
                            $sql = "update users set last_login='$last_login_gen' where username='$username'";
                            if ($link->query($sql) === TRUE) {
                              header("Location: index.php");
                            } else {
                              echo "ERROR: DATABASE ERROR";
                              exit();
                            }
                            header("location: index.php");
                        } else{
                            $password_err = '<div class="alert alert-danger" role="alert"><strong>Error 101</strong><br> Please verify your email and password.</div>';
                        }
                    }
                } else{
                    $username_err = '<div class="alert alert-danger" role="alert"><strong> Error 102</strong><br> Please verify your email and password. Are you sure you have an SSO account?</div>';
                }
            } else{
                echo '<div class="alert alert-danger" role="alert"><strong>Error 103</strong><br> System Error, please try again or contact the administrator.</div>';
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<div class="container-fluid" style="overflow: auto;">
	<h1>Portal</h1><hr>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Portal Login</h3>
				</div>
				<div class="panel-body">
          It appears you are not currently logged in to Portal. In order to gain access to all features for your team, you will need to log in with your Weyland SSO account. If you have access to Nostromo, this will be the same username and password.<br>
					<center><a class="btn btn-primary" href="login.php">Log In to Portal</a><br><br>
          Don't have an account yet?<br><a class="btn btn-primary" href="http://server/weyland/register.php" target="_blank">Sign up here</a></center>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Our Podcast</h3>
				</div>
				<div class="panel-body">
					<?php
					echo "<iframe src='https://podcastid.podigee.io/".$dsEpisode."-new-episode/embed?context=external&theme=default' style='border: 0' border='0' height='100' width='100%'></iframe>";
					?>
				</div>
				<div class="panel-footer">
					Latest Episode of the Podcast
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Our YouTube</h3>
				</div>
				<div class="panel-body embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="http://www.youtube.com/embed?max-results=1&controls=1&showinfo=0&rel=0&listType=user_uploads&list=US" allowfullscreen></iframe>
				</div>
				<div class="panel-footer">
					Latest Video From Our YouTube Channel
				</div>
			</div>
		</div>
	</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
