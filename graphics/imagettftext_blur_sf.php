<?php

define('ALIGN_LEFT',   0);
define('ALIGN_CENTER', 1);
define('ALIGN_RIGHT',  2);

function textSize(float $size, float $angle, string $font, string $text)
{
	$f = imagettfbbox($size, $angle, $font, $text);
	return ['height' => $f[1] - $f[5], 'width' => $f[4] - $f[0]];
}

function imagettftextblur(&$img, float $size, float $angle, int $x, int $y, int $shdwclr, string $fontfile, string $text, int $align=ALIGN_LEFT, int $shdwrds=0)
{
	if ($align)
	{
		$textSize = textSize($size, $angle, $fontfile, $text);
		$x = round($x - $align*$textSize['width']/2);
	}
	$count = min(63, $shdwrds**2)+1;
	$pts = sunflower($count, 2);
	$rgb = imagecolorsforindex($img, $shdwclr);
	$shdwclr = imagecolorallocatealpha($img, $rgb['red'], $rgb['green'], $rgb['blue'], (int)round(127-127/$count));
	foreach ($pts as $pt)
		imagettftext($img, $size, $angle, $x+$shdwrds*$pt[0], $y+$shdwrds*$pt[1], $shdwclr, $fontfile, $text);
}

function sunflower($n, $alpha)
{
	$points = [];
	$b = round($alpha*sqrt($n));
	$phi = (sqrt(5)+1)/2;
	for ($k=1; $k<=$n; ++$k)
	{
		$r = ($k > $n-$b) ? 1 : (sqrt($k-1/2)/sqrt($n-($b+1)/2));
		$theta = 2*M_PI*$k/$phi**2;
		$points[] = [$r*cos($theta), $r*sin($theta)];
	}
	return $points;
}

?>
