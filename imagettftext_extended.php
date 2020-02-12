<?php

define('ALIGN_LEFT',   0);
define('ALIGN_CENTER', 1);
define('ALIGN_RIGHT',  2);

function textSize(float $size, float $angle, string $font, string $text)
{
	$f = imagettfbbox($size, $angle, $font, $text);
	return ['height' => $f[1] - $f[5], 'width' => $f[4] - $f[0]];
}

function extimagettftext(resource &$img, float $size, float $angle, int $x, int $y, int &$txtcolor, string $fontfile, string $text, int $align=ALIGN_LEFT, int &$shdwclr=null, int $shdwdx=0, int $shdwdy=0, int $shdwrds=0)
{
	if ($align)
	{
		$textSize = textSize($size, $angle, $font, $text);
		$x = round($x - $align*$textSize['width']/2);
	}
	if ($shdwclr && ($shdwrds || $shdwdx || $shdwdy))
		for($shdwx = $x+$shdwdx-abs($shdwrds); $shdwx <= $x+$shdwdx+abs($shdwrds); ++$shdwx)
			for($shdwy = $y+$shdwdy-abs($shdwrds); $shdwy <= $y+$shdwdy+abs($shdwrds); ++$shdwy)
				imagettftext($img, $size, $angle, $shdwx, $shdwy, $shdwclr, $fontfile, $text);
	return imagettftext($img, $size, $angle, $x, $y, $txtcolor, $fontfile, $text);
}

?>
