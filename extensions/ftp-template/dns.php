<?php

//dnsDig

function dnsDig($dname) {
$mail = getFTPARecord("mail." . $dname);
$ftp = getFTPARecord("ftp." . $dname);
$cpanel = getFTPARecord("cpanel." . $dname);
$ip = gethostbyname($dname);
$long =  ip2long($ip);

//IP RANGE 111.111.111.111/21
$low_ip = ip2long("111.111.111.111");
$high_ip = ip2long("111.111.111.111");

//IP RANGE 111.111.111.111/18
$low_ip_a = ip2long("111.111.111.111");
$high_ip_a = ip2long("111.111.111.111");

//IP RANGE 111.111.111.111/19
$low_ip_b = ip2long("111.111.111.111");
$high_ip_b = ip2long("111.111.111.111");

//IP RANGE 111.111.111.111/21
$low_ip_c = ip2long("111.111.111.111");
$high_ip_c = ip2long("111.111.111.111");

//IP RANGE 111.111.111.111/22
$low_ip_d = ip2long("111.111.111.111");
$high_ip_d = ip2long("111.111.111.111");

//IP RANGE 111.111.111.111/22
$low_ip_e = ip2long("111.111.111.111");
$high_ip_e = ip2long("111.111.111.111");

//IP RANGE 111.111.111.111/22
$low_ip_f = ip2long("111.111.111.111");
$high_ip_f = ip2long("111.111.111.111");

if ($long <= $high_ip && $low_ip <= $long) {
echo $ftp;
  if ($ftp == 0) {
  echo $cpanel;
    if ($cpanel == 0) {
    echo $mail;
    }
  }
}
elseif ($long <= $high_ip_a && $low_ip_a <= $long) {
echo $ftp;
  if ($ftp == 0) {
  echo $cpanel;
    if ($cpanel == 0) {
    echo $mail;
    }
  }
}
elseif ($long <= $high_ip_b && $low_ip_b <= $long) {
echo $ftp;
  if ($ftp == 0) {
  echo $cpanel;
    if ($cpanel == 0) {
    echo $mail;
    }
  }
}
elseif ($long <= $high_ip_c && $low_ip_c <= $long) {
echo $ftp;
  if ($ftp == 0) {
  echo $cpanel;
    if ($cpanel == 0) {
    echo $mail;
    }
  }
}
elseif ($long <= $high_ip_d && $low_ip_d <= $long) {
echo $ftp;
  if ($ftp == 0) {
  echo $cpanel;
    if ($cpanel == 0) {
    echo $mail;
    }
  }
}
elseif ($long <= $high_ip_e && $low_ip_e <= $long) {
echo $ftp;
  if ($ftp == 0) {
  echo $cpanel;
    if ($cpanel == 0) {
    echo $mail;
    }
  }
}
elseif ($long <= $high_ip_f && $low_ip_f <= $long) {
echo $ftp;
  if ($ftp == 0) {
  echo $cpanel;
    if ($cpanel == 0) {
    echo $mail;
    }
  }
}
else {
//If the firewall was not detected, return the naked domain A record
return $ip;
}

}

//getWWWCname

function getWWWCname($ip) {

$www_domain = "www." . $_POST["domain"];
$www_cname = dns_get_record("www." . $_POST["domain"], DNS_CNAME);

while ($www_cname[0]['target']) {
  echo $www_domain . " " . "CNAME: " . $www_cname[0]['target'];
  $www_cname = dns_get_record($www_cname[0]['target'], DNS_CNAME);
}

}

//getTwoARecords

function getTwoARecords($ip) {
$www_domain = $_POST["domain"];
$dnsrecords = dns_get_record($_POST["domain"], DNS_A);

while ($dnsrecords[0]['ip']) {
  echo $www_domain . " " . "A Record: " . $dnsrecords[0]['ip'] . "&#10;";
  echo $www_domain . " " . "A Record: " . $dnsrecords[1]['ip'];
$dnsrecords = dns_get_record($dnsrecords[0]['ip'], DNS_A);
}

}

//getFTPARecord

function getFTPARecord($domain) {
$dns = dns_get_record($domain, DNS_ANY);
foreach($dns as $d) {
    return $d['ip'];
    break;
    }
}


//getOtherARecord

function getOtherARecord($domain) {
$dns = dns_get_record($domain, DNS_ANY);
foreach($dns as $d) {
    echo $d['host'];
    echo " " . "A Record: " . $d['ip'];
    break;
    }
}

//If the site has cpanel, check the box and it will append @domain.com to the username

function hasCpanel() {
$domain = $_POST["domain"];

if (isset($_POST['cpanel'])) {
echo "@" . $domain;

}

}
?>
