<?php

// extracts all JSONs from string
function extract_json($string)
{
  preg_match_all('/\{(?:[^{}]|(?R))*\}/x', $string, $matches);
  return $matches[0];
}


?>
