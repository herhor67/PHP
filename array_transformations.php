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

function matrix_flip_vertical(array &$array)
{
	$maxRow   = count($array)-1;
	$maxRowIt = intdiv(count($array), 2)-1;
	for ($row=0; $row<=$maxRowIt; ++$row)
		[$array[$row], $array[$maxRow-$row]] = [$array[$maxRow-$row], $array[$row]];
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
	$maxRow   = count($array)-1;
	$maxRowIt = intdiv(count($array), 2)-1;
	for ($row=0; $row<=$maxRowIt; ++$row)
		[$array[$row], $array[$maxRow-$row]] = [array_reverse($array[$maxRow-$row]), array_reverse($array[$row])];
	if (($maxRow&1) == 0)
		$array[$maxRowIt+1] = array_reverse($array[$maxRowIt+1]);
	return true;
}

function matrix_transpose(array &$array)
{
	$maxRow = count($array)-1;
	$maxCol = max(array_map('count', $array))-1;
	for ($row=0; $row<=$maxRow; ++$row)
		for ($col=$row+1; $col<=$maxCol; ++$col)
			[$array[$row][$col], $array[$col][$row]] = [$array[$col][$row], $array[$row][$col]];
}

function matrix_transpose_sec(array &$array)
{
	$maxRow = count($array)-1;
	$maxCol = max(array_map('count', $array))-1;
	for ($row=0; $row<=$maxRow; ++$row)
		for ($col=$maxCol-$row-1; $col>=0; --$col)
			[$array[$row][$col], $array[$maxRow-$col][$maxCol-$row]] = [$array[$maxRow-$col][$maxCol-$row], $array[$row][$col]];
}

function matrix_rotate_clockwise(array &$array)
{
	matrix_flip_vertical($array);
	matrix_transpose($array);
}

function matrix_rotate_counterclockwise(array &$array)
{
	matrix_transpose($array);
	matrix_flip_vertical($array);
}

?>
