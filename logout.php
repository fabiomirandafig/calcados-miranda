<?php
session_start();
unset($_SESSION["uid"]);
unset($_SESSION["nome"]);
header("location:index.php");
?>