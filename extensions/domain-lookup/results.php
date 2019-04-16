<div class="row" style="padding-top: 10px;">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?php echo "Site Information for " . $domain; ?>
      </div>
      <div class="panel-body">
        <?php
        include 'extensions/domain-lookup/parsing.php';
    		include 'extensions/domain-lookup/dns-info.php';
        echo "<center><a href='https://www.google.com/?q=site:".$domain."' target='_blank' class='btn btn-primary btn-block'>Google</a>
        <a href='https://web.archive.org/web/*/".$domain."' target='_blank' class='btn btn-primary btn-block'>Archive.org</a>
        <a href='https://www.sslshopper.com/ssl-checker.html?hostname=".$domain."' target='_blank' class='btn btn-primary btn-block'>SSL Shopper</a>
        <a href='https://who.is/whois/".$domain."' target='_blank' class='btn btn-primary btn-block'>Whois</a></center>";

        //CHECK SAFEBROWSER STATUS
        $wmtclientapp="slwmtbrowser";
        $wmtkey=AIzaSyDTQJ1FaagUFaa_bsXn8ybOiNovmv_VWSU;

        function safebrowsercall ($clientapp,$key,$url) {

        $query="https://sb-ssl.google.com/safebrowsing/api/lookup?client=".$clientapp."&key=".$key."&appver=1.5.2&pver=3.1&url=".$url;
        //echo $query;
        $safebrowsedata=file_get_contents($query);

        $url=trim(str_replace("http://www.", "", urldecode($url)));
        $url=trim(str_replace("http://", "", urldecode($url)));

        if ($safebrowsedata==""){
        echo "Safebrowsing Status: <font color='green'><b>Not Blacklisted In Google!</b></font><br>";
        }

        if ($safebrowsedata=="malware"){
        echo "Safebrowsing Status: <font color='red'><b>Blacklisted for Malware.</b></font><br><a target='_blank' href='https://www.stopbadware.org/request-review' class='ink-button sl-red'>Submit Deblacklisting Request</a><br>";
        }

        if ($safebrowsedata=="phishing"){
        echo "Safebrowsing Status: <font color='red'><b>Phishing Site.</b></font><br><a target='_blank' href='https://www.google.com/safebrowsing/report_error/' class='ink-button sl-red'>Submit For Phishing Removal</a><br>";
        }

        if ($safebrowsedata=="phishing,malware"){
        echo "Safebrowsing Status: <font color='red'><b>Malicious & Phishing site by Google!</b></font><br><a target='_blank' href='https://www.google.com/safebrowsing/report_error/' class='ink-button sl-red'>Submit For Phishing Removal</a><br><a target='_blank' href='https://www.stopbadware.org/request-review' class='ink-button sl-red'>Submit Deblacklisting Request</a><br>";
        //check DB and add to DB
        }
        }

        $wmturl=urlencode("http://www.".$_POST['url']);

        safebrowsercall ($wmtclientapp,$wmtkey,$wmturl);

        // CHECK SSL STATUS
        $original_parse=$domain;
        $response="";

        if ($fp = @fsockopen("ssl://{$original_parse}", 443, $errno, $errstr, 30)) {
          $msg  = 'GET / HTTP/1.1' . "\r\n";
          $msg .= 'Host: ' . $host . "\r\n";
          $msg .= 'Connection: close' . "\r\n\r\n";
          if ( fwrite($fp, $msg) ) {
            while ( !feof($fp) ) {
            $response .= fgets($fp, 1024);
            }
          }
          fclose($fp);
        } else {
          $response = false;
        }
        echo "<!-- SSLCHECK: " . htmlspecialchars($response) . "-->";
        if ($response==false) {
          echo "SSL Status: <b><font color='red'>SSL is Not Enabled</font></b><br>";
        } else {
          echo "SSL Status:<b> <font color='green'>SSL Enabled</font></b><br>";
        }





        // CHECK CMS VERSION
        //Set User Agent:
          $url='http://'.$domain;
          $opts = array(
            'http'=>array(
              'method'=>"GET",
              'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n" .
              "User Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36 SiteLockSpider\r\n"
            )
          );

          $context = stream_context_create($opts);
          $sitedata=file_get_contents($url, false, $context);

          //Check if site loads
          echo "Loading Status: ";
          if (strlen($sitedata) > 500) {
            echo "<font color='green'><b>Loading</b></font><br>";
          } else {
            echo "<font color='red'><b>Not Loading</b></font><br>";
          }

          if (preg_match("/Incapsula_Resource/i", $sitedata)) {
            echo "<div class='alert alert-danger' role='alert'><b>ERROR:</b> Incapsula blocked the request. CMS info is not available for this domain.</div>";
          } else {
            echo "Site CMS Info: ";

            $wpthemematch="/\/wp-content\/themes\/(.*?)\//i";
            preg_match("$wpthemematch",$sitedata,$wpmatch);

            if ($wpmatch[1]){
              echo "<b>Wordpress</b><br>";
              echo "WP Theme: <b><a href='http://www.google.com/?q=Wordpress Theme ".$wpmatch[1]."' target='_blank'>" .$wpmatch[1] . "</a></b>";
            }

            $joomlamthemematch="/\/templates\/(.*?)\//i";
            preg_match("$joomlamthemematch",$sitedata,$jmmatch);

            if ($jmmatch[1]){
              echo "<b>Joomla</b><br>";
              echo "Joomla Theme: <b>" .$jmmatch[1] . "</b>";
            }

            if (!$wpmatch[1] && !$jmmatch[1]) {
              echo "<font color='red'><b>Can't detect CMS info</b></font>";
            }
          }
        ?>
      </div>
    </div>
    <div class='alert alert-warning' role='alert'>DNS Results are not in real time and are queried from our local DNS Server</div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?php echo "DNS Information for ".$domain; ?>
      </div>
      <div class="panel-body">
        <a href='http://www.dnswatch.info/dns/dnslookup?la=en&host=<?PHP echo $domain; ?>&type=A&submit=Resolve' target='_blank' class='btn btn-primary btn-block'>DNS Watch (naked)</a>
        <a href='http://www.dnswatch.info/dns/dnslookup?la=en&host=<?PHP echo "ftp.".$domain; ?>&type=A&submit=Resolve' target='_blank' class='btn btn-primary btn-block'>DNS Watch (ftp)</a>
        <a href='http://www.dnswatch.info/dns/dnslookup?la=en&host=<?PHP echo "www.".$domain; ?>&type=A&submit=Resolve' target='_blank' class='btn btn-primary btn-block'>DNS Watch (www)</a>
        <a href='http://www.dnswatch.info/dns/dnslookup?la=en&host=<?PHP echo $domain; ?>&type=TXT&submit=Resolve' target='_blank' class='btn btn-primary btn-block'>DNS Watch (txt)</button></a>

        <?php
        // GET DNS DATA
        $dom_array = dns_get_record($domain);
        echo "Hostname: ".$dom_array[0][host]."<br>";
        echo "A Record: ".$dom_array[0][ip]."<br>";
        echo "Nameserver: ".$dom_array[1][target]."<br>";
        echo "Nameserver: ".$dom_array[2][target]."<br>";
        echo "TXT Record: ".$dom_array[6][txt]."<br>";

/*
        echo "<br><br><br>";
        echo "Array 1:<br>";
        print_r($dom_array[0]);
        echo "<br><br>";
        echo "Array 2:<br>";
        print_r($dom_array[1]);
        echo "<br><br>";
        echo "Array 3:<br>";
        print_r($dom_array[2]);
        echo "<br><br>";
        echo "Array 4:<br>";
        print_r($dom_array[3]);
        echo "<br><br>";
        echo "Array 5:<br>";
        print_r($dom_array[4]);
        echo "<br><br>";
        echo "Array 6:<br>";
        print_r($dom_array[5]);
        echo "<br><br>";
        echo "Array 7:<br>";
        print_r($dom_array[6]);
        echo "<br><br>";
        echo "Array 8:<br>";
        print_r($dom_array[7]);
        echo "<br><br>";
        echo "Array 9:<br>";
        print_r($dom_array[8]);
        echo "<br><br>";
        echo "Array 10:<br>";
        print_r($dom_array[9]);
        */

        ?>

        <?PHP //echo $dns_data; ?>
      </div>
    </div>
  </div>
</div>
