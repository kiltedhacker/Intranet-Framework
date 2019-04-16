<?php
	$officeip = "SELECT * FROM ip_lists WHERE ip_use='Office'";
	$officeips = mysqli_query($portal, $officeip);
	while($office = mysqli_fetch_array($officeips)){
		$oip = $office['ip_range'];
	}

	$smartip = "SELECT ip_range FROM ip_lists WHERE ip_use='SMART'";
	$smartips = mysqli_query($portal, $smartip);
	while($smart = mysqli_fetch_array($smartips)){
		$sip = $smart['ip_range'];
	}

	$wafip = "SELECT ip_range FROM ip_lists WHERE ip_use='WAF'";
	$wafips = mysqli_query($portal, $wafip);
	while($waf = mysqli_fetch_array($wafips)){
		$wip = $waf['ip_range'];
	}
?>

<div class="container-fluid" style="overflow: auto;">
	<h1>Lantern</h1><hr>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Domain Lookup</h3>
				</div>
				<div class="panel-body">
					<?php include("extensions/domain-lookup/index.php"); ?>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Malware Trends</h3>
				</div>
				<div class="panel-body">
					<?php
					include "extensions/nostromo/index.php";
					?>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>FTP Template</h3>
				</div>
				<div class="panel-body">
					<?php
					//DISPLAY ADMIN FUNCTIONS
					if ($permissions >= 20) {
						include('extensions/cpsmart/index.php');
					} else {
						include('extensions/ftp-template/index.php');
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<a href="" data-toggle="modal" data-target="#ipModal">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>IP Ranges</h3>
					</div>
					<div class="panel-body text-center">
						<i class="fa fa-th-list fa-5x"></i>
					</div>
				</div>
			</a>
			<a href="" data-toggle="modal" data-target="#pgModal" onclick="passgenv2()">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Password Generator</h3>
					</div>
					<div class="panel-body text-center">
						<i class="fa fa-key fa-5x"></i>
					</div>
				</div>
			</a>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Phonetic Text</h3>
				</div>
				<div class="panel-body text-center">
					<?php
					include "extensions/phon-alpha/index.php";
					?>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Defanger</h3>
				</div>
				<div class="panel-body text-center">
					<?php
					include "extensions/defanger/index.php";
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- IP Ranges Modal -->
<div class="modal fade" id="ipModal" tabindex="-1" role="dialog" aria-labelledby="ipModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ipModalLabel">IP Ranges</h4>
      </div>
      <div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3>Scan &amp; Clean IP Addresses</h3>
							</div>
							<div class="panel-body">
							<div class="alert alert-warning" role="alert">
								Provide both the Manual Clean and Scan IPs for whitelisting.
							</div>
								<h2>Scan IPs</h2>
								<?php
									if (empty($smartip)) {
										echo "No Results";
									} else {
										echo $sip;
									}
								?>
									<h2>Manual Clean IPs</h2>
									<?php
										if (empty($officeip)) {
											echo "No Results";
										} else {
											echo $oip;
										}
									?>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3>WAF IP Addresses</h3>
							</div>
							<div class="panel-body">
								<?php
									if (empty($wafip)) {
										echo "No Results";
									} else {
										echo $wip;
									}
								?>
								<div class="alert alert-info" role="alert">
								  The last IP is IPv6, and may not be supported by all whitelists yet.
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-info" role="alert">
							If you need these CIDR ranges converted to a range of IP's, you can use the CIDR Converter in Hoshi to get the first and last IP of the range.
						</div>
					</div>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Password Generator Modal -->
<div class="modal fade" id="pgModal" tabindex="-1" role="dialog" aria-labelledby="pgModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="pgModalLabel">Secure Passwords</h4>
      </div>
      <div class="modal-body">
        <?php
					include 'extensions/passgen/index.php';
				?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
