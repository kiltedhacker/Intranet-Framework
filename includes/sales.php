<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$int_feeds = "SELECT * FROM feeds WHERE feed_type = 'internal' ORDER BY save_date DESC";
$int_feeds_result = mysqli_query($portal, $int_feeds);

$ext_feeds = "SELECT * FROM feeds WHERE feed_type = 'external' ORDER BY save_date DESC";
$ext_feeds_result = mysqli_query($portal, $ext_feeds);
?>

<div class="container-fluid" style="overflow: auto;">
	<h1>Sales</h1><hr>
	<div class="row">
		<div class="col-md-3">
			<!-- TOP 5 PANELS COMMENTED OUT UNTIL GOOGLE SHEETS API CAN BE UTILIZED TO PULL DATA -->
			<!-- div class="panel panel-default">
				<div class="panel-heading">
					<h3>Inbound Top 5</h3>
				</div>
				<div class="panel-body">
					Agent 1<br>
					Agent 2<br>
					Agent 3<br>
					Agent 4<br>
					Agent 5
				</div>
				<div class="panel-footer">
					Current Top Agents From Inbound
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Outbound Top 5</h3>
				</div>
				<div class="panel-body">
					Agent 1<br>
					Agent 2<br>
					Agent 3<br>
					Agent 4<br>
					Agent 5
				</div>
				<div class="panel-footer">
					Current Top Agents From Outbound
				</div>
			</div -->
			<a href="https://drive.google.com/drive/folders/folderid" target="_blank">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Rep Resources</h3>
					</div>
					<div class="panel-body text-center">
						<i class="fa fa-google fa-5x"></i>
					</div>
					<div class="panel-footer">
						Rep Resources in Google Drive
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Our Blogs</h3>
				</div>
				<div class="panel-body text-center" style="height: 250px; overflow: auto;">
					<?php
          while($row = mysqli_fetch_array($int_feeds_result)){
            $link = $row['link'];
            $title = $row['title'];
            $content = $row['content'];
             echo "<a href='".$link."' target='_blank'><code>".$title."</code></a><p>".$content."</p>";
             }
          ?>
				</div>
				<div class="panel-footer">
					Blogs by Us
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>External Blogs</h3>
				</div>
				<div class="panel-body text-center" style="height: 250px; overflow: auto;">
          <?php
          while($row = mysqli_fetch_array($ext_feeds_result)){
            $link = $row['link'];
            $title = $row['title'];
            $content = $row['content'];
             echo "<a href='".$link."' target='_blank'><code>".$title."</code></a><p>".$content."</p>";
             }
          ?>
				</div>
				<div class="panel-footer">
					Blogs by Other Industry Leaders
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

<?php
include "extensions/simple-pie/index.php";

$RSScleanup = "DELETE FROM feeds WHERE save_date > DATE_SUB(NOW(), INTERVAL 48 HOUR);";
mysqli_query($portal, $RSScleanup);

foreach ($slfeed->get_items() as $item):
	$dirty_title = $item->get_title();
	$title = mysqli_real_escape_string($portal, $dirty_title);
	$dirty_content = $item->get_description();
	$content = mysqli_real_escape_string($portal, $dirty_content);
	$dirty_link = $item->get_permalink();
	$link = mysqli_real_escape_string($portal, $dirty_link);
	$dirty_date = $item->get_date('j F Y | g:i a');
	$date = mysqli_real_escape_string($portal, $dirty_date);
  $RSStype = 'internal';

  $RSSquery = "INSERT IGNORE INTO feeds (title,content,link,display_date,feed_type) VALUES ('$title', '$content', '$link', '$date', '$RSStype')";
  mysqli_query($portal, $RSSquery);
endforeach;

foreach ($feed->get_items() as $item):
	$dirty_title = $item->get_title();
	$title = mysqli_real_escape_string($portal, $dirty_title);
	$dirty_content = $item->get_description();
	$content = mysqli_real_escape_string($portal, $dirty_content);
	$dirty_link = $item->get_permalink();
	$link = mysqli_real_escape_string($portal, $dirty_link);
	$dirty_date = $item->get_date('j F Y | g:i a');
	$date = mysqli_real_escape_string($portal, $dirty_date);
  $RSStype = "external";

  $RSSquery = "INSERT IGNORE INTO feeds (title,content,link,display_date,feed_type) VALUES ('$title', '$content', '$link', '$date', '$RSStype')";
  mysqli_query($portal, $RSSquery);
endforeach;

foreach ($podfeed->get_items() as $item):
	$dirty_title = $item->get_title();
	$title = mysqli_real_escape_string($portal, $dirty_title);
	$dirty_date = $item->get_date('j F Y | g:i a');
	$date = mysqli_real_escape_string($portal, $dirty_date);
	$dirty_str_date = $item->get_date('j F Y g:i a');
	$stringed_date = strtotime($dirty_str_date);
	$str_date = mysqli_real_escape_string($portal, $stringed_date);
  $podID = $dsEpisode + 1;

  $RSSquery = "INSERT IGNORE INTO decoding_security (id,title,display_date,string_date) VALUES ('$podID', '$title', '$date', '$str_date')";
  mysqli_query($portal, $RSSquery);
endforeach;
?>
