<?php
//Generates N evenly distributed points inside unit circle.
//Original code @ https://stackoverflow.com/a/28572551/7321403

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
