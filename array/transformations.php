<?php

function matrix_display(array &$array)
{
	echo '<table>';
	foreach (array_keys($array) as $row)
	{
		echo '<tr>';
		foreach (array_keys($array[$row]) as $col)
			echo '<td>'.$array[$row][$col].'</td>';
		echo '</tr>';
	}
	echo '</table><br>';
}

function matrix_dump(array &$array)
{
	echo '<pre>';
	print_r($array);
	echo '</pre><br>';
}

function matrix_flip_vertical(array &$array)
{
	$maxRow   =  count($array) - 1;
	$maxRowIt = (count($array)>>1) - 1;
	for ($row=0; $row<=$maxRowIt; ++$row)
	{
		$temp = $array[$row];
		$array[$row] = $array[$maxRow-$row];
		$array[$maxRow-$row] = $temp;
	}
	return true;
}

function matrix_flip_horizontal(array &$array)
{
	$maxIter  = count($array)-1;
	for ($row=0; $row<=$maxIter; ++$row)
		$array[$row] = array_reverse($array[$row]);
	return true;
}

function matrix_flip_both(array &$array)
{
	$maxRow   =  count($array) - 1;
	$maxRowIt = (count($array)>>1) - 1;
	for ($row=0; $row<=$maxRowIt; ++$row)
	{
		$temp = $array[$row];
		$array[$row] = array_reverse($array[$maxRow-$row]);
		$array[$maxRow-$row] = array_reverse($temp);
	}
	if (($maxRow&1) == 0)
		$array[$maxRowIt+1] = array_reverse($array[$maxRowIt+1]);
	return true;
}

function matrix_transpose(array &$array)
{
	$maxRow = count($array)-1;
	$maxCol = max(array_map('count', $array))-1;
	$square = min($maxRow, $maxCol);
	for ($row=0; $row<=$square; ++$row)
		for ($col=$row+1; $col<=$square; ++$col)
		{
			$temp = $array[$row][$col];
			$array[$row][$col] = $array[$col][$row];
			$array[$col][$row] = $temp;
		}
	if ($maxCol > $maxRow)
		for ($row=0; $row<=$maxRow; ++$row)
			for ($col=$square+1; $col<=$maxCol; ++$col)
			{
				$array[$col][$row] = $array[$row][$col];
				unset($array[$row][$col]);
			}
	if ($maxRow > $maxCol)
		for ($row=$square+1; $row<=$maxRow; ++$row)
		{
			for ($col=0; $col<=$maxCol; ++$col)
				$array[$col][$row] = $array[$row][$col];
			unset($array[$row]);
		}
	return true;
}

function matrix_antitranspose(array &$array)
{
	return matrix_flip_both($array) && matrix_transpose($array);
}

function matrix_rotate_clockwise(array &$array)
{
	return matrix_flip_vertical($array) && matrix_transpose($array);
}

function matrix_rotate_anticlockwise(array &$array)
{
	return matrix_transpose($array) && matrix_flip_vertical($array);
}

?>
