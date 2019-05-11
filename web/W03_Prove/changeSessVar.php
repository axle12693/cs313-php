<?php
session_start();
$var = $_POST['var'];
$value = $_POST['value'];
$_SESSION[$var][$value] = !$_SESSION[$var][$value];
echo($_SESSION[$var][$value]);
?>