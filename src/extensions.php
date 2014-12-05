<?php

function str_starts_with($haystack, $needle) {
	$length = strlen($needle);
	return (substr($haystack, 0, $length) === $needle);
}

function str_ends_with($haystack, $needle) {
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}
	return (substr($haystack, -$length) === $needle);
}

function split_to_ints($input) {
	$ids = array();
	$parts = preg_split('`,`', $input);
	foreach ($parts as $part) {
		$id = filter_var($part, FILTER_VALIDATE_INT);
		if ($id) { $ids[] = $id; }
	}
	return $ids;
}

?>