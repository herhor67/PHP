<?php


define('ALIGN_LEFT',   0);
define('ALIGN_CENTER', 1);
define('ALIGN_RIGHT',  2);

function textSize(float $size, float $angle, string $font, string $text)
{
	$f = imagettfbbox($size, $angle, $font, $text);
	return ['height' => $f[1] - $f[5], 'width' => $f[4] - $f[0]];
}

function imagettftextalignborder(&$img, float $size, float $angle, int $x, int $y, int $txtcolor, string $fontfile, string $text, int $align=ALIGN_LEFT, int $brdrrds=0, int $brdrdx=0, int $brdrdy=0)
{
	if ($align)
	{
		$textSize = textSize($size, $angle, $fontfile, $text);
		$x = round($x - $align*$textSize['width']/2);
	}
	for($brdrx = $x+$brdrdx-abs($brdrrds); $brdrx <= $x+$brdrdx+abs($brdrrds); ++$brdrx)
		for($brdry = $y+$brdrdy-abs($brdrrds); $brdry <= $y+$brdrdy+abs($brdrrds); ++$brdry)
			imagettftext($img, $size, $angle, $brdrx, $brdry, $brdrclr, $fontfile, $text);
}

?>
