<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/6/16
 * Time: 10:49 AM
 */

include('LIB_project1.php');
require_once ("DB.class.php");
echo Header::html_header("Proj1-Cart","main.css");
$db = new DB();
$num = $db->getCartRows();

?>
<?php if($num > 0){ ?>
<div id="header1" style="background-color: #c7ddef">
    <h1 style="text-align: center">Cart Items</h1>
</div>
<h3>Your Selected Products:</h3>

<?php

$data = $db->getAllCartProducts();
$stotal = 0;
$ftotal = 0;
$total = 0;
foreach ($data as $data1){
    if ($data1['saleprice'] > 0){
    ?>
    <div>
        <div style="float: left; width: 413px; padding: 8px">
            <div style="padding-left: 25px">
                <p style="padding-top: 15px"><strong style="color: #3c763d"><?php echo $data1['pname'] ?> </strong> </p>
                <p style="padding-bottom: 0px"><?php echo $data1['description'] ?></p>
                <p style="padding-bottom: 0px"><strong style="color: red">Quantity: 1 </strong><span>at price of $<?php echo $data1['saleprice'] ?> each.</span></p>
            </div>
        </div>
    </div>
    <hr style="clear: left">
    <div>
        <?php $stotal += $data1['saleprice'] ?>
    </div>

<?php }else{ ?>

        <div>
            <div style="float: left; width: 413px; padding: 8px">
                <div style="padding-left: 25px">
                    <p style="padding-top: 15px"><strong style="color: #3c763d"><?php echo $data1['pname'] ?> </strong> </p>
                    <p style="padding-bottom: 0px"><?php echo $data1['description'] ?></p>
                    <p style="padding-bottom: 0px"><strong style="color: red">Quantity: 1 </strong><span>at price $<?php echo $data1['price'] ?> each.</span></p>
                </div>
            </div>
        </div>
        <hr style="clear: left">
        <div>
            <?php $ftotal += $data1['price'];
                    $total = $stotal + $ftotal; ?>
        </div>

<?php } } ?>
<h2>Total cost of Products: $<?php echo $total;?></h2>
<form action='emptyCart.php' ><input type='submit' name='empty' value='Empty Cart' /></form>
<?php }else{ echo "<h2 style='color: red'>Your Cart is Empty!</h2>";
} ?>
<?php
echo Header::footer_script();
?>
