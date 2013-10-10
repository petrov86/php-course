<?php
$link = new mysqli("localhost", "root", "", "homework-03");
if($link ->connect_error)
	{
		die("There is a problem:<br />" . $link ->connect_error);
	}

	mysqli_set_charset($link, 'utf8'); 