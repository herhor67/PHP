<?php

function str_contains_all(string $haystack, array $needles)
{
	foreach ($needles as $needle)
		if (strpos($haystack, $needle) === false)
			return false;
	return true;
}

?>
