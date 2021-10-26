<?php
function Conectarse() {
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "obligatorio";
	$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	return $link;
}
?>

