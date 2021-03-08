<?php
session_start();
$_session['login']="incorreto";
header ("refresh:5; url=index.php");
session_start();
if(!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {	
}
else {
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login </a>';
	header ('refresh:2; url= login.php');
}