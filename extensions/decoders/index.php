<!-- BEGIN ADVANCED TOOLS INTERFACE-->
		<div class="row" id="advanced">
			<div id="advLeft"class="col-sm-12">
			<div class="jumbotron-functions">
                    <div class="col-lg-12 jumbotron" style="padding: 0 0 0 0;">
			<?PHP //if (isset($_SESSION['displayvalue'])) { echo $_SESSION['displayvalue']; } else { echo "none"; }?>
			
<!-- HIDING XSS TEST
			<label for="xss-test">XSS Test</label>
				<form method="post" action="index.php">
					<input type="text" name="xssurl" size="85" value="<?PHP // HIDING XSS TEST				echo $_SESSION['xssurl'];?>">
					<input type="hidden" name="xss_test">
					<input type="submit" class="btn btn-danger btn-sm" value="submit">
				</form>
				<p class="bg-warning">
					The XSS Test will not work if they are on the firewall
				</p>
-->
			<label for="esc-chars">CIDR to IP Range</label>
				<form method="post" action="overwatch.php">
					<div>
						<input type="text" name="cidr" style="width:100%; overflow:hidden;" placeholder="ex: 192.168.2.0/22">
					</div>
					<div class="text-right" style="padding-top:10px;">
						<input type="submit" class="btn btn-danger btn-sm" value="Submit" onclick="overwatchRefresh"><br />
					</div>
				</form>

			<label for="esc-chars">IP Range To CIDR</label>
				<form method="post" action="overwatch.php">
					<div>
						<input type="text" name="ip2cidr" style="width:100%; overflow:hidden;" value="" placeholder="ex: 192.168.2.10-192.168.2.55">
					</div>
					<div class="text-right" style="padding-top:10px;">
						<input type="submit" class="btn btn-danger btn-sm" value="Submit" onclick="overwatchRefresh"><br />
					</div>
				</form>

			<label for="b64-decode">Base64 Decode</label>
				<form method="post" action="overwatch.php">
					<div>
						<textarea name="base64decodedata" rows="10" style="width:100%; overflow:hidden;" value=""></textarea>
					</div>
					<div class="text-right" style="padding-top:10px;">
						<input type="hidden" name="base64decode">
						<input type="checkbox" name="encode" value="1"> Encode
						<input type="submit" class="btn btn-danger btn-sm" value="submit" onclick="overwatchRefresh"><br />
					</div>
				</form>

			<label for="esc-chars">Escape Characters</label>
				<form method="post" action="overwatch.php">
					<div>
						<input type="text" name="escapecharactersdata" style="width:100%; overflow:hidden;" value="">
					</div>
						<div class="text-right" style="padding-top:10px;">
						<input type="hidden" name="escapecharacters">
						<input type="submit" class="btn btn-danger btn-sm" value="Submit" onclick="overwatchRefresh"><br />
					</div>
				</form>

			</div> <!-- jumbotron -->

			</div> <!-- jumbotron-functions -->
			</div> <!-- advLeft -->
			
		</div> <!-- advanced -->

<!-- END ADVANCED TOOLS INTERFACE-->

<!-- [----- XSS Test Removed -----]	-->
