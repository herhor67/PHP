<?php

// strips all attributes from html string

function strip_attributes($html)
{
	  return preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $html);
}

?>
