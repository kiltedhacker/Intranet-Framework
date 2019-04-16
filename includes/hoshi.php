<div class="container-fluid" style="overflow: auto;">
	<h1>Hoshi</h1><hr>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Encoders &amp; Decoders</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills nav-justified">
							<li role="presentation" class="active"><a data-toggle="tab" href="#b64">Base64</a></li>
							<li role="presentation"><a data-toggle="tab" href="#hex">HEX</a></li>
							<!--li role="presentation"><a data-toggle="tab" href="#oct">Octal</a></li>
							<li role="presentation"><a data-toggle="tab" href="#url">URL</a></li>
							<li role="presentation"><a data-toggle="tab" href="#char">Char</a></li-->
					</ul>
					<div class="tab-content">
						<div id="b64" class="tab-pane fade in active">
							<br>
							<?php include "extensions/decoders/b64.php" ?>
						</div>
						<div id="hex" class="tab-pane fade">
							<br>
							<?php include "extensions/decoders/hex.php" ?>
						</div>
						<div id="oct" class="tab-pane fade">
							<br>
							<?php include "extensions/decoders/oct.php" ?>
						</div>
						<div id="URL" class="tab-pane fade">
							<br>
							<?php include "extensions/decoders/url.php" ?>
						</div>
						<div id="char" class="tab-pane fade">
							<br>
							<?php include "extensions/decoders/char.php" ?>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					Transcode between plain text and encoded snippets
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Tools</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills nav-justified">
							<li role="presentation" class="active"><a data-toggle="tab" href="#strrev">StrRev</a></li>
							<li role="presentation"><a data-toggle="tab" href="#cidr">CIDR</a></li>
							<li role="presentation"><a data-toggle="tab" href="#esc">PHP Escape</a></li>
							<li role="presentation"><a data-toggle="tab" href="#r13">Rot13</a></li>
							<!--li class="invisible" role="presentation"><a data-toggle="tab" href="#r26">Rot26</a></li-->
					</ul>
					<div class="tab-content">
						<div id="strrev" class="tab-pane fade in active">
							<br>
							<?php include "extensions/decoders/strrev.php" ?>
						</div>
						<div id="cidr" class="tab-pane fade">
							<br>
							<?php include "extensions/decoders/cidr.php" ?>
						</div>
						<div id="esc" class="tab-pane fade">
							<br>
							<?php include "extensions/decoders/esc.php" ?>
						</div>
						<div id="r13" class="tab-pane fade">
							<br>
							<?php include "extensions/decoders/r13.php" ?>
						</div>
						<div id="r26" class="tab-pane fade">
							<br>
							<?php include "extensions/decoders/r26.php" ?>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					Tools for reversing strings, converting cidr ranges, adding PHP escape characters and converting Rot13
				</div>
			</div>
		</div>
	</div>
</div>
