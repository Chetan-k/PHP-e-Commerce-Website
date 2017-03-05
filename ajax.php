<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/11/16
 * Time: 3:48 PM
 */

//getting the featured products based on the user page click. Uses ajax request

$connect = mysqli_connect("localhost","cxk1875","fr1end","cxk1875");

$record_per_page = 3;
$page = '';
$output = '';

if(isset($_POST["page"])){
    $page = $_POST["page"];
}else{
    $page = 1;
}

$start_from = ($page - 1)*$record_per_page;
$query = "SELECT * FROM products WHERE SalePrice < 0.01 ORDER BY ProductID ASC LIMIT $start_from,$record_per_page";
$result = mysqli_query($connect, $query);

while ($row = mysqli_fetch_array($result)){
    $output .= '<div style="float: left; width: 413px; padding: 8px">
                <img src="images/'.$row["ImageName"].'" style="float: left">
                <div style="padding-left: 158px">
                <p style="padding-top: 15px"><strong>Description: </strong>'.$row["Description"].'</p>
                <p style="padding-bottom: 0px"><strong>Price: $</strong>'.$row["Price"].'</p>
                <p style="padding-bottom: 0px"><strong>Quantity: </strong>'.$row["Quantity"].'</p>
                <a href="addCart.php?id='.$row["ProductID"].'"><button type="button">Add to cart</button></a>
                </div>
                </div>';
}

$output .= '<br><div align="center" style="clear: left;padding-top: 20px">';
$page_query = "SELECT * FROM products WHERE SalePrice < 0.01 ORDER BY ProductID ASC";
$page_result = mysqli_query($connect,$page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$record_per_page);

for($i=1; $i<=$total_pages; $i++){
    $output .= "<span class='pagination_link' style='cursor: pointer; padding: 6px; border: 1px solid #ccc;border-radius: 10px' id='".$i."'>".$i."</span>";

}

echo $output;
?>

