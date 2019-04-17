<?php

//Function to generate random value with standard deviation $sigma and average value $mu
function normal_dist_rand($sigma=1, $mu=0)
{
	$x = mt_rand()/mt_getrandmax()*2-1;
	$A = (3*M_PI*(4-M_PI))/(8*(M_PI-3));
	$l = log(1-pow($x,2));
	$p = 2*$A*M_1_PI;
	$b = $p + 0.5*$l;
	return $mu+$sigma*M_SQRT2*($x<=>0)*sqrt(sqrt(pow($b,2)-$A*$l)-$b);
}

?>
