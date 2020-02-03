<?php

function str_contains_any(string $haystack, array $needles)
{
	foreach ($needles as $needle)
		if (strpos($haystack, $needle) !== false)
			return true;
	}
	return false;
}

?>
