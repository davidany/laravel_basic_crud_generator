<?php

//post
function post($var)
{
	if (isset($_POST[$var])) {
		return $_POST[$var];
	} else {
		return null;
	}
}


//get
function get($var)
{
	if (isset($_GET[$var])) {
		return $_GET[$var];
	} else {
		return null;
	}
}


function print_x($value)
{
	echo '<pre style="text-align:left;"><hr />';
	print_r($value);
	echo '</pre><hr />';
}



?>
