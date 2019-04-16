<?php
$user = $_SESSION['username'];

//Define Sidebar Buttons by Team

//ANSIBLE
if ($permissions >= 10) {
  $ansible = "<li><form action='' method='post'><input type='hidden' name='pageView' value='an'><button class='btn btn-block btn-black'><i class='fa fa-newspaper-o fa-2x'></i><br>Ansible</i></button></form></li>";
} else {
  $ansible = "";
}

//SENTINEL
if ($permissions >= 30) {
  $sentinel = "<li><form action='' method='post'><input type='hidden' name='pageView' value='se'><button class='btn btn-block btn-black'><i class='fa fa-wrench fa-2x'></i><br>Sentinel</i></button></form></li>";
} else {
  $sentinel = "";
}

//LANTERN
if ($permissions >= 10) {
  $lantern = "<li><form action='' method='post'><input type='hidden' name='pageView' value='la'><button class='btn btn-block btn-black'><i class='fa fa-lightbulb-o fa-2x'></i><br>Lantern</i></button></form></li>";
} else {
  $lantern = "";
}

//HOSHI
if ($permissions >= 30) {
  $hoshi = "<li><form action='' method='post'><input type='hidden' name='pageView' value='ho'><button class='btn btn-block btn-black'><i class='fa fa-code fa-2x'></i><br>Hoshi</i></button></form></li>";
} else {
  $hoshi = "";
}

//SALES ADMIN
if ($permissions >= 10) {
  $admin = "<li><a href='https://url' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-usd fa-2x'></i><br>Sales Admin</i></button></a></li>";
} elseif ($permissions >= 0 and !is_null($permissions)) {
  $admin = "<li><a href='https://url' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-usd fa-2x'></i><br>Sales Admin<br><small>Customer<br>Accounts</span></i></button></a></li>";
} else {
  $admin = "";
}

//eSign Live
if ($permissions < 10 and !is_null($permissions)) {
  $esign = "<li><a href='https://apps.esignlive.com/a/login?destination=/a/dashboard' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-file-o fa-2x'></i><br>eSign<br><small>Contract<br>Management</small></i></button></a></li>";
} elseif ($permissions < 20 and $permissions >= 10) {
  $esign = "<li><a href='https://apps.esignlive.com/a/login?destination=/a/dashboard' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-file-o fa-2x'></i><br>esign</i></button></a></li>";
} else {
  $esign = "";
}

//CRM
if ($permissions < 10 and !is_null($permissions)) {
  $crm = "<li><a href='http://url' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-users fa-2x'></i><br>CRM<br><small>Customer<br>Management</small></i></button></a></li>";
} elseif ($permissions < 40 and $permissions >= 10) {
  $crm = "<li><a href='http://url' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-users fa-2x'></i><br>CRM</i></button></a></li>";
} else {
  $crm = "";
}

//PHONE SYSTEM
if ($permissions < 10 and !is_null($permissions)) {
  $phones = "<li><a href='https://phoneURL/Login/' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-phone fa-2x'></i><br>Phones<br><small>Phone<br>System</small></i></button></a></li>";
} elseif ($permissions < 40 and $permissions >= 10) {
  $phones = "<li><a href='https://phoneURL/Login/' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-phone fa-2x' style='color: #fff'></i><br>Phones</i></button></a></li>";
} else {
  $phones = "";
}

//PAYROLL
if ($permissions < 10) {
  $paycom = "<li><a href='https://payrollURL' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-clock-o fa-2x'></i><br>Paycom<br><small>Payroll &<br>Timeclock</small></i></button></a></li>";
} elseif ($permissions >= 10) {
  $paycom = "<li><a href='https://payrollURL' target='_blank'><button class='btn btn-block btn-black'><i class='fa fa-clock-o fa-2x'></i><br>Paycom</i></button></a></li>";
} else {
  $paycom = "";
}

//Define Top Menu Buttons
$phonelist = "SELECT department,extension FROM departments";
$phonelist_result = mysqli_query($portal, $phonelist);

$resourcelist = "SELECT id, title, link, type FROM links WHERE type = 'Resources Menu' ORDER BY title";
$resourcelist_result = mysqli_query($portal, $resourcelist);

?>
<div id="wrapper">
  <!-- Sidebar -->
  <div id="sidebar-wrapper" style="overflow: hidden;">
    <ul class="sidebar-nav">
      <?php
      echo $ansible;
      echo $sentinel;
      echo $lantern;
      echo $hoshi;
      echo $admin;
      echo $esign;
      echo $crm;
      echo $phones;
      echo $paycom;
      ?>
    </ul>
  </div>
  <!-- /#sidebar-wrapper -->

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="navbar-collapse collapse">
      <div class="nav-brand pull-left">
        <a href="//server/portal">
          <img src="//server/portal/assets/img/portal_lock.png" class="logo_name">
        </a>
      </div>
    <div class="navbar-collapse collapse pull-right">
      <ul class="nav navbar-nav">
        <li><a href="http://mail.google.com/" target="_blank">Email</a></li>
        <li><a href="http://calendar.google.com/" target="_blank">Calendar</a></li>
        <li><a href="http://drive.google.com/" target="_blank">Drive</a></li>
<?php
        if (!is_null($permissions)){
          echo "<li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Resources <span class='caret'></span></a>
          <ul class='dropdown-menu'>";
            while($rlist = mysqli_fetch_array($resourcelist_result)){
              $title = $rlist['title'];
              $links = $rlist['link'];
              $resources = "<li><a href='".$links."' target='_blank'>".$title."</a></li>";
              echo $resources;
            }
          echo "</ul>
        </li>
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>Extensions <span class='caret'></span></a>
          <ul class='dropdown-menu'>";
            while($plist = mysqli_fetch_array($phonelist_result)){
              $department = $plist['department'];
              $extension = $plist['extension'];
              $extensions = "<li class='text-center'><a href='#'>".$department."<br><kbd>".$extension."</kbd></a></li>";
              echo $extensions;
            }
          echo"</ul>
        </li>
        <li><a href='#' data-toggle='modal' data-target='#dlModal'>Downloads</a></li>";
      } else {
        echo "";
      }
      ?>

      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<!-- DOWNLOADS MODAL -->
<?php
$down = "SELECT id, title, link FROM links WHERE type='Downloads Menu'";
$dconn = mysqli_query($portal, $down);
?>
<div class="modal fade" id="dlModal" tabindex="-1" role="dialog" aria-labelledby="dlModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="dlModalLabel">Downloads</h4>
      </div>
      <div class="modal-body">
        <ul class="nav">
          <?php
          while($down = $dconn->fetch_assoc()) {
            echo "<li><a href='" . $down['link'] . "' target='_blank'>" . $down['title'] . "</a></li>";
          }
          ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- END DOWNLOADS MODAL -->
