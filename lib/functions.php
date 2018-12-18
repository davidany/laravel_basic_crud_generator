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
function send_to($direction)
{
	if (!headers_sent()) {
		header('Location: ' . $direction);
		exit;
	} else {
		print '<script type="text/javascript">';
	}
	print 'window.location.href="' . $direction . '";';
	print '</script>';
	print '<noscript>';
	print '<meta http-equiv="refresh" content="0;url=' . $direction . '" />';
	print '</noscript>';
}


function print_x($value)
{
	echo '<pre style="text-align:left;"><hr />';
	print_r($value);
	echo '</pre><hr />';
}



?>
