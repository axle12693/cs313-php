<?php
session_start();
$var = $_POST['var'];
if (!isset($_SESSION[$var]))
{
    $_SESSION[$var] = array();
}
$value = $_POST['value'];
$_SESSION[$var][$value] = !$_SESSION[$var][$value];
echo(json_encode(array($var, $value, $$_SESSION[$var][$value]));
?>