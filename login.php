<?php
date_default_timezone_set('America/Phoenix');

require_once 'config/connect.php';

$username = $password = "";
$username_err = $password_err = "";

$access_error = $_POST['access'];
if ($access_error != NULL) {
  $access_err = '<div class="alert alert-danger" role="alert"><strong>Error 104</strong><br> Account Disabled. Contact the Research team</div>';
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
                            $last_login_gen = date('h:i:s')."_".date('Y/m/d')."_PORTAL";
                            $sql = "update users set last_login='$last_login_gen' where username='$username'";
                            if ($link->query($sql) === TRUE) {
                              header("Location: /portal/");
                            } else {
                              echo "ERROR: DATABASE ERROR";
                              exit();
                            }
                            header("location: /portal/");
                        } else{
                            $password_err = '<div class="alert alert-danger" role="alert"><strong>Error 101</strong><br> Please verify your email and password.</div>';
                        }
                    }
                } else{
                    $username_err = '<div class="alert alert-danger" role="alert"><strong> Error 102</strong><br> Please verify your email and password. Are you sure you have an SSO account?</div>';
                }
            } else{
                echo '<div class="alert alert-danger" role="alert"><strong>Error 103</strong><br> System Error, please try again or contact the Research team.</div>';
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Portal Login</title>
    <link rel="icon" type="image/ico" href="favi.ico" />
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/df396da02d.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="main_short" style="margin-top: 2%;">
      <div id="content" style="overflow: auto;">
        <div class="col-md-4 col-md-offset-4">
          <br>
          <center><img class="img-responsive" src="img/portal_lock.png" alt="logo"></center>
          <hr>
          <p class="well tinyfont"><b>What is Portal?</b><br>Portal is the tool we use to assist our teams navigate their day with as few roadblocks as possible. Any user can gain public access, having an SSO account greatly increases your toolset.</p>

          <hr>
          <p class="center" style="font-weight: bold;">Login to Portal using your SSO</p>
          <?php
          echo $username_err; echo $password_err; echo $access_err ?>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <input type="email" name="username" class="form-control forms" placeholder='&#xf007 Email Address' style="font-family:Arial, FontAwesome" autofocus>
          <input type="password" name="password" class="form-control forms" placeholder='&#xf023 Password' style="font-family:Arial, FontAwesome">
          <button type="submit" class="btn btn-block btn-primary" style="margin-bottom: 10px;">Login</button>
          </form>
        </div>
     </div>
   </div>

   <div id="main_short">
   <br>
   <div id="content" style="overflow: auto;">
   <span class="pull-right">&copy; <?php echo date('Y'); ?> <b>Kilted Hacker</b>. All Rights Reserved</span>
   </div>
   <br>
   </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    </body>
    </html>
