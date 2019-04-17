<?php

//maps value from interval <A, B> to interval <C, D>
//f(A)=C, F(B)=D, F((A+B)/2)=(C+D)/2, etc...

function interval_map($val, $a, $b, $c, $d)
{
	return ($val-$a)*($c-$d)/($b-$a)+$c;
}

?>
