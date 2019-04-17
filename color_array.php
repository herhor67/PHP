<?php

//generate array of $count colors, possibly different for human eye

function color_array($count)
{
	$return = [];
	for ($i=0; $i<$count; $i++)
	{
		$R = sin($i/$count*2*M_PI+0       )*127.5+127.5;
		$G = sin($i/$count*2*M_PI+2*M_PI/3)*127.5+127.5;
		$B = sin($i/$count*2*M_PI+4*M_PI/3)*127.5+127.5;
		$return[$i] = ['r'=> $R, 'g'=> $G, 'b'=> $B];
	}
	return $return;
}

?>
