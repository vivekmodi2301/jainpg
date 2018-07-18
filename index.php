<?php
session_start();
	error_reporting(0);
	$theam="axixa";
	$mod="login";
	$do="login";
	include_once("config.php");
	include_once("function.php");
	
	include_once("header.php");
	include_once("excelwriter.inc.php");

	if(isset($_SESSION['login_details']) || isset($_SESSION['login_check']))
	{
		if(isset($_GET['mod'])){
			$mod=$_GET['mod'];
			$do=$_GET['do'];
		}
	}
	include_once("module/$mod/$do.php");
	include_once("footer.php");
?>