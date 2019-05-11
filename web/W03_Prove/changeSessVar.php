<?php
session_start();
$var = $_POST['var'];
if (!isset($_SESSION[$var]))
{
    $_SESSION[$var] = array();
}
$value = $_POST['value'];
$_SESSION[$var][$value] = !$_SESSION[$var][$value];
echo($_SESSION[$var][$value]);
?>