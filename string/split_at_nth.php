<?php

function split_at_nth(string $delimiter, string $string, int $occurence = 1, bool $include = false)
{
	if ($occurence < 1)
		return ['', $string];
	if (empty($string))
		return ['', ''];
	$pos = 0;
	$delen = strlen($delimiter);
	while (($pos = strpos($string, $delimiter, $pos+$delen))!==false && --$occurence >= 0) { }
	if ($pos === false)
		return [$string, ''];
	else
		return [substr($string, 0, $pos), substr($string, $pos+!$include*$delen)];
}

?>
