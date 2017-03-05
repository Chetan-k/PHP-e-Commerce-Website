<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/10/16
 * Time: 5:54 PM
 */

require_once ("DB.class.php");
$db = new DB();
$db->deleteCart();
header("Location: cart.php");
?>