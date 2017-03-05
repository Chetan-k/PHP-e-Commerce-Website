<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/10/16
 * Time: 2:14 PM
 */

include('LIB_project1.php');
require_once ("DB.class.php");

echo Header::html_header("BUY JERSEYS","main.css");

$ids = $_GET['id'];
$id = $pname = $desc = $price = $quant = $img = $sprice = "";

$db = new DB();
$data = $db->getSingleProduct($ids);

foreach ($data as $data1){

    $id = $data1['id'];
    $pname = $data1['pname'];
    $desc = $data1['description'];
    $price = $data1['price'];
    $quant = $data1['quantity'];
    $img = $data1['imagename'];
    $sprice = $data1['saleprice'];
}

$insertedrowcart = $db->insertCart($pname,$desc,$price,$quant,$img,$sprice);

//for updating the quantity after adding the product to the cart
$quant = $quant - 1;

$update = $db->updateQuantity($id,$quant);

echo "<h2 style='color: green'>Your selected item is added to the cart</h2>";
echo "<br>";
echo "<h4>To Shop More <a href='index.php'>Click Here!</a> </h4>";
echo "<br>";
echo "<h4>Proceed to Checkout <a href='cart.php'>Click Me!</a> </h4>";
?>