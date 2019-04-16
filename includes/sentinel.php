<?php
$page = "se";
?>
<div class="container-fluid" style="overflow: auto;">
	<?php
	if ($permissions >= 30 && $permissions < 40) {
		echo "<h1>Advanced Support</h1><hr>";
	} else {
		echo "<h1>Sentinel</h1><hr>";
	}
	?>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Nostromo</h3>
				</div>
				<div class="panel-body">
					<?php include "extensions/nostromo/index.php"; ?>
				</div>
				<div class="panel-footer">
					Current Trends
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Formatters</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills nav-justified">
							<li role="presentation" class="active"><a data-toggle="tab" href="#fList">File List Formatter</a></li>
							<li role="presentation"><a data-toggle="tab" href="#lCompare">File List Comparison</a></li>
							<li role="presentation"><a data-toggle="tab" href="#mgrepID">Multigrep IDs</a></li>
							<li role="presentation"><a data-toggle="tab" href="#fRep">Find &amp; Replace</a></li>
							<li role="presentation"><a href="https://decode.company.com" target="_blank">Decoder</a></li>
					</ul>
					<div class="tab-content">
						<div id="fList" class="tab-pane fade in active">
							<?php include "extensions/file-list-formatter/index.php" ?>
						</div>
						<div id="lCompare" class="tab-pane fade">
							<?php include "extensions/file-list-comparison/index.php" ?>
						</div>
						<div id="mgrepID" class="tab-pane fade">
							<?php include "extensions/mgrep-sites/index.php" ?>
						</div>
						<div id="fRep" class="tab-pane fade">
							<?php include "extensions/find-replace/index.php" ?>
						</div>
						<!-- Decoder - Disabled Due to Not Loading Properly in Frame While Included in Tab Pane - Opening In New Tab Instead -->
						<!--div id="slDec" class="tab-pane fade">
							<iframe src="https://decode.company.com" width="100%" height="800px"></iframe>
						</div-->
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<a href="#"  data-toggle="modal" data-target="#sdlModal">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Downloads</h3>
					</div>
					<div class="panel-body text-center">
						<i class="fa fa-briefcase fa-5x"></i>
					</div>
				</div>
			</a>
			<a href="#"  data-toggle="modal" data-target="#trackModal">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Tracking</h3>
					</div>
					<div class="panel-body text-center">
						<i class="fa fa-table fa-5x"></i>
					</div>
				</div>
			</a>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Defanger</h3>
				</div>
				<div class="panel-body">
					<?php
					include "extensions/defanger/index.php";
					?>
				</div>
				<div class="panel-footer">
					Ensure a link doesn't become clickable
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<a href="#"  data-toggle="modal" data-target="#toolModal">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Tools</h3>
					</div>
					<div class="panel-body text-center">
						<i class="fa fa-wrench fa-5x"></i>
					</div>
				</div>
			</a>
			<a href="#"  data-toggle="modal" data-target="#trainModal">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Training</h3>
					</div>
					<div class="panel-body text-center">
						<i class="fa fa-graduation-cap fa-5x"></i>
					</div>
				</div>
			</a>
			<!--div class="panel panel-default">
				<div class="panel-heading">
					<h3>Notes</h3>
				</div>
				<div class="panel-body text-center">
					<i class="fa fa-heart fa-5x"></i>
				</div>
				<div class="panel-footer">
					Messages from Management
				</div>
			</div-->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>WordPress Downloader</h3>
				</div>
				<div class="panel-body">
					<!-- Begin WordPress Downloader -->
					<script>
					function getwpzip()
					{
						var version = document.getElementById('wpversion');
						var target = "https://wordpress.org/wordpress-";
						target += version.value;
						target += ".zip";
						window.open(target,'_blank');
					}
					function getwptar()
					{
						var version = document.getElementById('wpversion');
						var target = "https://wordpress.org/wordpress-";
						target += version.value;
						target += ".tar.gz";
						window.open(target,'_blank');
					}
					</script>

					<div style="text-align:right" class="w3-panel s7n-classic-fg">
					<input type="text" class='form-control' id="wpversion" placeholder="Version to download" style="width: 100%">
					<input type="submit" class="btn btn-block btn-primary" value="Download" onclick="getwpzip()">
					</div>
					<!-- End WordPress Downloader -->
				</div>
				<div class="panel-footer">
					Download any WordPress version from the repository
				</div>
			</div>
		</div>
	</div>
</div>

<!-- PAGE MODALS -->
<?php
$secdown = "SELECT id, title, link FROM links WHERE type='Sentinel Downloads'"; $sdconn = mysqli_query($portal, $secdown);
$tools = "SELECT id, title, link FROM links WHERE type='Sentinel Tools'"; $toolconn = mysqli_query($portal, $tools);
$tracking = "SELECT id, title, link FROM links WHERE type='Sentinel Tracking'"; $trackconn = mysqli_query($portal, $tracking);
$training = "SELECT id, title, link FROM links WHERE type='Sentinel Training'"; $tconn = mysqli_query($portal, $training);
?>
<!-- Download Modal -->
<div class="modal fade" id="sdlModal" tabindex="-1" role="dialog" aria-labelledby="sdlModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sdlModalLabel">Team Downloads</h4>
      </div>
      <div class="modal-body">
        <ul class="nav">
          <?php
          while($secdown = $sdconn->fetch_assoc()) {
            echo "<li><a href='" . $secdown['link'] . "' target=_blank>" . $secdown['title'] . "</a></li>";
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

<!-- Tracking Modal -->
<div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="trackModalLabel">Tracking</h4>
      </div>
      <div class="modal-body">
        <ul class="nav">
          <?php
          while($tracking = $trackconn->fetch_assoc()) {
            echo "<li><a href='" . $tracking['link'] . "' target=_blank>" . $tracking['title'] . "</a></li>";
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

<!-- Tools Modal -->
<div class="modal fade" id="toolModal" tabindex="-1" role="dialog" aria-labelledby="toolModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="toolModalLabel">Tools</h4>
      </div>
      <div class="modal-body">
        <ul class="nav">
          <?php
          while($tools = $toolconn->fetch_assoc()) {
            echo "<li><a href='" . $tools['link'] . "' target=_blank>" . $tools['title'] . "</a></li>";
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

<!-- Training Modal -->
<div class="modal fade" id="trainModal" tabindex="-1" role="dialog" aria-labelledby="trainModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="trainModalLabel">Training</h4>
      </div>
      <div class="modal-body">
        <ul class="nav">
          <?php
          while($training = $tconn->fetch_assoc()) {
            echo "<li><a href='" . $training['link'] . "' target=_blank>" . $training['title'] . "</a></li>";
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
