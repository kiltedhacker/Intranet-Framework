<?php
// Make sure SimplePie is included
require_once('/var/www/html/portal/php/autoloader.php');

// We'll process this feed with all of the default options.
$slfeed = new SimplePie();

// Set which feed to process.
$slfeed->set_feed_url(array(
  'http://blog.sitelock.com?feed=rss/?nocache=1',
  'https://wpdistrict.sitelock.com/blog/feed/?nocache=1',
	'https://michaelveenstra.com?feed=rss2'
));

// Set feed limit
$slfeed->set_item_limit(5);

// Set cache Location
$slfeed->set_cache_location('/var/www/html/portal/cache');

// Run SimplePie.
$slfeed->init();

// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$slfeed->handle_content_type();

// We'll process this feed with all of the default options.
$podfeed = new SimplePie();

// Set which feed to process.
$podfeed->set_feed_url('http://podcast964eb3.podigee.io/feed/mp3 ');

// Set feed limit
$podfeed->set_item_limit(10);

// Set cache Location
$podfeed->set_cache_location('/var/www/html/portal/cache');

// Run SimplePie.
$podfeed->init();

// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$podfeed->handle_content_type();

// We'll process this feed with all of the default options.
$feed = new SimplePie();

// Set which feed to process.
$feed->set_feed_url(array(
  'https://nakedsecurity.sophos.com/feed/',
  'https://www.wordfence.com/blog/feed/',
	'https://threatpost.com/feed/',
	'https://krebsonsecurity.com/feed/',
	'https://isc.sans.edu/rssfeed_full.xml'
));

// Set feed limit
$feed->set_item_limit(5);

// Set cache Location
$feed->set_cache_location('/var/www/html/portal/cache');

// Run SimplePie.
$feed->init();

// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();

// Let's begin our XHTML webpage code.  The DOCTYPE is supposed to be the very first thing, so we'll keep it on the same line as the closing-PHP tag.

?>
