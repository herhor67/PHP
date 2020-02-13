<?php

function normal_dist_circle_rand($sigma=1, $mu=0)
{
	$ang = mt_rand()/mt_getrandmax()*2*M_PI;
	$rad = normal_dist_rand($sigma, $mu);
	return [$rad*cos($ang), $rad*sin($ang)];
}

?>
