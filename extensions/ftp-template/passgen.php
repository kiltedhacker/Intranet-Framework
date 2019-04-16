<?php
function contains_int($str) {

	$ints = array("0","1","2","3","4","5","6","7","8","9");
	foreach ($ints as $int) {
		if (strpos($str, $int) !== FALSE) {
		    return true;
		}
	}
	return false;
}
function contains_spc($str) {
	$spcs = array("!","@","#","$","%");
	foreach ($spcs as $spc) {
		if (strpos($str, $spc) !== FALSE) {
		    return true;
		}
	}
	return false;
}

function good_pass($str) {
	if(contains_spc($str) && contains_int($str)) return true;
        return false;
}

function gen_str($length, $keyspace) {
	$str = '';
	$max = mb_strlen($keyspace, '8bit') - 1;
	for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[random_int(0, $max)];
	}
	return $str;
}
function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#%$') {
	$str = '';

	while(!good_pass($str)) {
		$str = gen_str($length, $keyspace);
	}
	return $str;
}
?>
