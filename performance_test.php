<?php

function memory2readable($size)
{
	$pref = ['','k','M','G','T','P'];
	$i = floor(log(max(abs($size),1),1024));
	return @round($size/pow(1024, $i), 2).$pref[$i].'B';
}

$prev_time = $beg_time = microtime(true);
$prev_mmry = memory_get_usage();

function perftest($all = false)
{
	global $prev_mmry, $prev_time, $beg_time;
	$curr_mmry = memory_get_usage();
	$curr_time = microtime(true);
	$r= '<table>'.PHP_EOL.
		($all?('<tr><td>Μ: </td><td>'.memory2readable($curr_mmry).'</td></tr>'.PHP_EOL):'').
		'<tr><td>ΔM:</td><td>'.memory2readable($curr_mmry-$prev_mmry).'</td></tr>'.PHP_EOL.
		($all?('<tr><td>Τ: </td><td>'.($curr_time-$beg_time).'s</td></tr>'.PHP_EOL):'').
		'<tr><td>ΔΤ:</td><td>'.($curr_time-$prev_time).'s</td></tr>'.PHP_EOL.
		'</table>';
	$prev_mmry = $curr_mmry;
	$prev_time = $curr_time;
	return $r;
}

?>
