<?php
session_start();
$var = $_POST['var'];
if (!isset($_SESSION[$var]))
{
    $_SESSION[$var] = array();
}
$value = $_POST['value'];
$_SESSION[$var][$value] = !$_SESSION[$var][$value];
echo("Var: " . $var . "<br>Value: " . $value . "<br>T/F: " . $_SESSION[$var][$value]);
?>