<?PHP
// CIDR OUTPUT
	if (isset($_POST['cidr']) || isset($_POST['ip2cidr'])){
?>
		<div class="jumbotron-functions">
			<div class="well">
				<h4 class="alert alert-heading"><?php if ($_POST['cidr']) { ?>IP Addresses from CIDR<?php } else if ($_POST['ip2cidr']) { ?>CIDR TO IP Address<?php } ?></h4>
				<div class="row">
					<div class="col-lg-12 text-justified jumbotron" style="padding:0px 10px 0px 20px; overflow:hidden;">
<?php
if ($_POST['cidr']) {
	$data=get_list_ip($_POST['cidr']);
		foreach($data as $cidrvalue){
			echo $cidrvalue . "<br>";
		}
	} else if ($_POST['ip2cidr']){
		//IP TO CIDR OURPUT
$range_one=explode('-', $_POST['ip2cidr']);
$rang_one[0]=trim($range_one[0]);
$rang_one[1]=trim($range_one[1]);
print implode("<br>", ip_range_to_subnet_array($range_one[0], $range_one[1]));
}
//IP TO CIDR OUTPUT


?>
					</div>
				</div>
			</div>
		</div>
<?php
}
// CIDR OUTPUT END



// PASSWORD GENERATOR OUTPUT
	if (isset($_POST['passgen'])){
?>

								<div class="jumbotron-functions">
									<div class="well">
										<h4 class="alert alert-heading">GENERATED PASSWORDS</h4>
											<div class="row">
												<div class="col-lg-12 text-center jumbotron" style="padding:0px 10px 0px 20px; overflow:hidden;">
<script>
function() {

    'use strict';

  // click events
  document.body.addEventListener('click', copy, true);

    // event handler
    function copy(e) {

    // find target element
    var
      t = e.target,
      c = t.dataset.copytarget,
      inp = (c ? document.querySelector(c) : null);

    // is element selectable?
    if (inp && inp.select) {

      // select text
      inp.select();

      try {
        // copy text
        document.execCommand('copy');
        inp.blur();

        // copied animation
        t.classList.add('copied');
        setTimeout(function() { t.classList.remove('copied'); }, 1500);
      }
      catch (err) {
        alert('please press Ctrl/Cmd+C to copy');
      }

    }

    }

})();
</script>
<?PHP

	if (isset($_POST['passgen'])) {
		echo "<br />";
		echo generateStrongPassword()."<br /><br />";
		echo generateStrongPassword()."<br /><br />";
		echo generateStrongPassword()."<br /><br />";
		echo generateStrongPassword()."<br /><br />";
		echo generateStrongPassword()."<br /><br />";
/*
		echo "<input type='text' id='pass1' style='border:none;' value='".generateStrongPassword()."'><button class='btn btn-sm btn-danger' data-copytarget='#pass1'>Copy</button><br /><br />";
		echo "<input type='text' id='pass2' style='border:none;' value='".generateStrongPassword()."'><button class='btn btn-sm btn-danger' data-copytarget='#pass2'>Copy</button><br /><br />";
		echo "<input type='text' id='pass3' style='border:none;' value='".generateStrongPassword()."'><button class='btn btn-sm btn-danger' data-copytarget='#pass3'>Copy</button><br /><br />";
		echo "<input type='text' id='pass4' style='border:none;' value='".generateStrongPassword()."'><button class='btn btn-sm btn-danger' data-copytarget='#pass4'>Copy</button><br /><br />";
		echo "<input type='text' id='pass5' style='border:none;' value='".generateStrongPassword()."'><button class='btn btn-sm btn-danger' data-copytarget='#pass5'>Copy</button><br /><br />";
*/
	}
?>
												</div> <!-- jumbotron -->
											</div> <!-- row -->
										</div> <!-- well -->
										</div> <!-- jumbotron-functions -->
<?php
	}

// ESCAPE CHARACTERS OUTPUT
	if (isset($_POST['escapecharacters'])){
?>
					<div class="jumbotron-functions">
						<div class="well">
							<h4 class="alert alert-heading">ESCAPED CHARACTER(S)</h4>
								<div class="row">
									<div class="col-lg-12 text-justified jumbotron" style="padding:0px 10px 0px 20px; overflow:hidden;">
<?php
		echo preg_quote($_POST['escapecharactersdata'], "/");
?>
									</div> <!-- jumbotron -->
								</div> <!-- row -->
							</div> <!-- well -->
							</div> <!-- jumbotron-functions -->
<?php
	}
?>
