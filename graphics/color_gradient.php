<?php

//original code from https://krazydad.com/tutorials/makecolors.php
//converted to PHP

function color_gradient($frR, $frG, $frB, $phR, $phG, $phB, $center=128, $width=127, $len=50)
{
	for ($i=0; $i<$len; ++$i)
	{
		$R = sin($frR*$i+$phR)*$width+$center;
		$G = sin($frG*$i+$phG)*$width+$center;
		$B = sin($frB*$i+$phB)*$width+$center;
		echo '<font color="'.rgb2hex($R,$G,$B).'">&#9608;</font>';
	}
}

?>
