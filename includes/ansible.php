<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dsPrev = $dsEpisode - 1;

$int_feeds = "SELECT * FROM feeds WHERE feed_type = 'internal' ORDER BY save_date DESC";
$int_feeds_result = mysqli_query($portal, $int_feeds);

$ext_feeds = "SELECT * FROM feeds WHERE feed_type = 'external' ORDER BY save_date DESC";
$ext_feeds_result = mysqli_query($portal, $ext_feeds);
?>
<div class="container-fluid" style="overflow: auto;">
	<h1>Ansible</h1><hr>
	<div class="row">
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Podcast - Latest Episode</h3>
				</div>
				<div class="panel-body">
					<?php
					echo "<iframe src='https://podcastid.podigee.io/".$dsEpisode."-new-episode/embed?context=external&theme=default' style='border: 0' border='0' height='100' width='100%'></iframe>";
					?>
				</div>
				<div class="panel-footer">
					Our Podcast
				</div>
			</div>
    </div>
    <div class="col-md-2 text-center">
      <script>var subscribeButtonPodcastData = {"title":"Decoding Security","subtitle":"Web Security News and Information","description":"<p>Podcast Title is a bi-weekly podcast. Each episode offers security tips, commentary on the latest industry news and events, and exclusive insights from security experts.</p>","cover":"https://podigee.s3-eu-west-1.amazonaws.com/uploads/u1340/fileid.png","feeds":[{"type":"audio","format":"mp3","url":"http://podcastid.podigee.io/feed/mp3"},{"type":"audio","format":"aac","url":"http://podcastid.podigee.io/feed/aac"},{"type":"audio","format":"ogg","url":"http://podcastid.podigee.io/feed/vorbis"},{"type":"audio","format":"opus","url":"http://podcastid.podigee.io/feed/opus"}],"configuration":{"autoWidth":null,"color":"#C32328","enabled":true,"format":"cover","size":"big","style":"outline"}}</script><script class="podlove-subscribe-button" src="https://cdn.podlove.org/subscribe-button/javascripts/app.js" data-json-data="subscribeButtonPodcastData" data-language="en" data-color="#C32328" data-format="cover" data-size="big" data-style="outline"></script>
		</div>
		<div class="col-md-5">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3>Decoding Security - Previous Episode</h3>
				</div>
				<div class="panel-body">
					<?php
					echo "<iframe src='https://podcastid.podigee.io/".$dsPrev."-new-episode/embed?context=external&theme=default' style='border: 0' border='0' height='100' width='100%'></iframe>";
					?>
				</div>
				<div class="panel-footer">
					Research Podcast
				</div>
			</div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3>Our Blogs</h3>
				</div>
				<div class="panel-body" style="height: 472px; overflow: auto;">
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
          			Company Blogs
				</div>
			</div>
		</div>
    <div class="col-md-3">
      <div class="panel panel-default">
				<div class="panel-heading">
					<h3>External Blogs</h3>
				</div>
				<div class="panel-body" style="height: 472px; overflow: auto;">
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
					<h3>Our YouTube Channel</h3>
				</div>
				<div class="panel-body embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="http://www.youtube.com/embed?max-results=1&controls=1&showinfo=0&rel=0&listType=user_uploads&list=Us" allowfullscreen></iframe>
				</div>
				<div class="panel-footer">
					Latest Video From Our YouTube Channel
				</div>
			</div>
		</div>
	</div>
</div>
