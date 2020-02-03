<?php

function comp_short_strs($str1, $str2)
{
	if (strlen($str1)==0 || strlen($str2)==0)
		return 0;
	
	$s1clean = strtolower($str1);
	$s2clean = strtolower($str2);preg_replace("/[^A-Za-z]/", ' ', str_replace('-', '', $str1));
	unset($str1);
	unset($str2);
	
	$s1clean = preg_replace("/[!\"#\$%'\(\),\.:;\?@\[\\\]`{\|}~]/", '', $s1clean);
	$s1clean = preg_replace("/[^a-z0-9]/", ' ', $s1clean);
	$s1clean = preg_replace("/(\xC2\xA0|\n|\r|\t|\x0B)/iu", ' ', $s1clean);
	$s1clean = preg_replace("/ {2,}/", ' ', $s1clean);
	$s1clean = trim($s1clean);
	$s2clean = preg_replace("/[!\"#\$%'\(\),\.:;\?@\[\\\]`{\|}~]/", '', $s2clean);
	$s2clean = preg_replace("/[^a-z0-9]/", ' ', $s2clean);
	$s2clean = preg_replace("/(\xC2\xA0|\n|\r|\t|\x0B)/iu", ' ', $s2clean);
	$s2clean = preg_replace("/ {2,}/", ' ', $s2clean);
	$s2clean = trim($s2clean);
	
	$arr1 = explode(' ', $s1clean);
	$arr2 = explode(' ', $s2clean);
	$len1 = count($arr1);
	$len2 = count($arr2);
	unset($s1clean);
	unset($s2clean);
	
	if ($len2>$len1)
	{
		$t = $arr2;
		$arr2 = $arr1;
		$arr1 = $t;
		unset($t);
	}
	
	$occurences = array_count_values($arr2);
	unset($arr2);
	
	$percents = [];
	foreach($occurences as $word => $count)
	{
		$percents[$word] = 0;
		$percent1 = $percent2 = 0;
		foreach ($arr1 as $check)
		{
			similar_text($word, $check, $percent1);
			similar_text($word, $check, $percent2);
			$percmax = max($percent1, $percent2);
			if ($percmax > $percents[$word])
				$percents[$word] = $percmax;
		}
	}
	unset($arr1);
	$finalsim = 0;
	$finalsum = 0;
	foreach ($occurences as $word => $count)
	{
		$finalsim += $count*$percents[$word];
		$finalsum += $count;
	}
	return $finalsim/$finalsum;
}

?>
