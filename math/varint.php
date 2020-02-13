<?php

function uRShift($int, $shft)
{
	return ($int >> $shft) & (PHP_INT_MAX >> ($shft-1));
}

function int2varInt(int $value)
{
	if ($value < 128)
		return [$value];
	$encodedBytes = [];
	while (($value & -128) != 0)
	{
		$encodedBytes[] = ($value & 0b01111111 | 0b10000000);
		$value = uRShift($value, 7);
	}
	$encodedBytes[] = $value;
	return $encodedBytes;
}

?>
