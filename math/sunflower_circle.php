<?php

function sunflower($n, $alpha)
{
	$points = [];
	$b = round($alpha*sqrt($n));
	$phi = (sqrt(5)+1)/2;
	for ($k=1; $k<=$n; ++$k)
	{
		$r = radius($k, $n, $b);
		$theta = 2*M_PI*$k/$phi**2;
		$points[] = [$r*cos($theta), $r*sin($theta)];
	}
	return $points;
}

function radius($k, $n, $b)
{
	if ($k > $n-$b)
		return 1;
	else
		return sqrt($k-1/2)/sqrt($n-($b+1)/2);
}

?>
