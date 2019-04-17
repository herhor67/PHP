<?php

//Inverse of error function - maps interval (-1, 1) to (-∞, ∞)
//approximated integral of normal/Gaussian distribution (e^-x^2)

function erf_inv($x)
{
	$A = (3*M_PI*(4-M_PI))/(8*(M_PI-3));
	$l = log(1-pow($x,2));
	$p = 2*$A*M_1_PI;
	$b = $p + 0.5*$l;
	return ($x<=>0)*sqrt(sqrt(pow($b,2)-$A*$l)-$b);
}

//Inverse probit function
function probit_inv($prb=0, $sigma=1, $mu=0)
{
	return $mu+$sigma*M_SQRT2*erf_inv($prb);
}

?>
