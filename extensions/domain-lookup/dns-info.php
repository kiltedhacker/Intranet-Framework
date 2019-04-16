<?php
$i=0;
foreach ($urla as $urldata) {
  if ($i==0){
    $dnsr = dns_get_record($urldata, DNS_A + DNS_NS + DNS_CNAME + DNS_TXT);
    $dnsr[0]['host'] = htmlentities($dnsr[0]['host']); // XSS Fix
    $dnsr[0]['ip'] = htmlentities($dnsr[0]['ip']); // XSS Fix
    $dnsr[2]['target'] = htmlentities ($dnsr[2]['target']); // XSS Fix
    $dnsr[3]['target'] = htmlentities ($dnsr[3]['target']); // XSS Fix
    $dnsr[4]['txt'] = htmlentities ($dnsr[4]['txt']); // XSS Fix
    $dns_data="Hostname: " . $dnsr[0]['host'] . "<br> A Records: ". $dnsr[0]['ip'] . "<br> NS Server: " . $dnsr[2]['target'] . "<br> NS Server: " .  $dnsr[3]['target'] . "<br> TXT: ". $dnsr[4]['txt'];
    $current_ip=$dnsr[0]['ip'];
    $dns_data .= "<br><br>Additional A Records";
  } else {
    $dnsr = dns_get_record($urldata, DNS_A + DNS_CNAME);
    $dns_data .= $dnsr[0]['host'] . "<br>IP: ". $dnsr[0]['ip'];
  }
  $i++;
  unset($dnsr);
}
?>
