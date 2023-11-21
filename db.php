<?php
require "util/variaveis.php";

$con = pg_connect('host='.HOST.' port='.PORT.' dbname='.DATABASE_NAME.' user='.USER.' password='.PASSWORD);

if (!$con) {
    die("Connection failed: " . pg_connect_error());
}
?>
