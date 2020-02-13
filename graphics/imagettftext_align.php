<?php

define('ALIGN_LEFT',   0);
define('ALIGN_CENTER', 1);
define('ALIGN_RIGHT',  2);

function textSize(float $size, float $angle, string $font, string $text)
{
	$f = imagettfbbox($size, $angle, $font, $text);
	return ['height' => $f[1] - $f[5], 'width' => $f[4] - $f[0]];
}

function imagettftextalign(&$img, float $size, float $angle, int $x, int $y, int &$txtcolor, string $fontfile, string $text, int $align=ALIGN_LEFT)
{
	if ($align)
	{
		$textSize = textSize($size, $angle, $fontfile, $text);
		$x = round($x - $align*$textSize['width']/2);
	}
	return imagettftext($img, $size, $angle, $x, $y, $txtcolor, $fontfile, $text);
}

?>
