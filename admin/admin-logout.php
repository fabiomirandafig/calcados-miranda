<?php

session_start();

if (isset($_SESSION["id_admin"])) {
	session_destroy();
	header("location:login.php");
}else{
	header("location:index.php");
}

?>