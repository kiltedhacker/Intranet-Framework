<?php
include 'extensions/ftp-template/passgen.php';
include 'extensions/ftp-template/dns.php';
?>

<script type="text/javascript">
// Multi-site
$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls form:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});
</script>

 <div class="row">
    <div class="controls">
      <form class="form-inline" role="form" name="form" action="" method="post">
        <div class="entry col-lg-12">
          <div class="control-group" id="fields">
            <input type="text" class="form-control" style="width:100%;" name="domain[]" placeholder="Domain">
            <label>
            <input type="text" class="form-control" style="width:100%;" name="siteid[]" placeholder="Site ID">
              <label>
                <input class="checkbox" type="checkbox" name="cpanel" value="on"> Include domain in username
              </label><br>
              <input class="checkbox" type="checkbox" name="siteInUser" value="on"> Include SiteID in username
              </label>
            <!--button class="btn btn-success btn-add" type="button"><span class="glyphicon glyphicon-plus"></span></button-->
            <button class="btn btn-primary btn-block" type="submit">Generate Template</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php
   if(empty($_POST['domain'])){
     echo "<div class='alert alert-warning' role='alert' style='margin-top: 10px;'>
       You will still need to create the actual FTP user, this only generates credentials to make things faster and easier.
     </div>";
   } else {
     echo "<div class='alert alert-info' role='alert' style='margin-top: 10px;'>";
     foreach (array_combine($_POST['domain'], $_POST['siteid']) as $domain => $siteid) {
             if ($siteid > 0) {
             echo $siteid . " / " . $domain;
             echo "<br><br>";
             }
             echo "FTP Information:";
             echo "<br>" . "Hostname: ";
             echo dnsDig($domain);
             if (isset($_POST['siteInUser'])) {$sid = $siteid;} else {$sid = "";}
             echo "<br>" . "Username: " . "sitelock" . $sid;
             if (isset($_POST['cpanel'])) { echo "@" . $domain; }
             echo "<br>" . "Password: " . random_str(12,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#%');
             //echo "&#10;" . "------------------------------------" . "&#10;";
     }
     echo "</div>";
   }
  ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- script src="../../assets/js/ie10-viewport-bug-workaround.js"></script -->
