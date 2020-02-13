<?php

//returns RGB array generated using hue circle

function color_array_hsl($count)
{
	$return = [];
	for ($i=0; $i<$count; $i++)
	{
		$arr = hsl2rgb($i*360/$count, 1, 0.5);
    
		$return[$i] = ['r'=> $arr[0], 'g'=> $arr[1], 'b'=> $arr[2]];
	}
	return $return;
}

?>
