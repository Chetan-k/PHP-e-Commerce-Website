<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/10/16
 * Time: 8:34 PM
 */

$email = $_POST['email'];
$password = $_POST['password'];

session_name("login");
session_start();

$_SESSION['email'] = $email;
$_SESSION['password'] = $password;

header("Location: admin.php");


?>