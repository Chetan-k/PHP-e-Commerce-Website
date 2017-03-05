<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/6/16
 * Time: 10:49 AM
 */

include('LIB_project1.php');
require_once ("DB.class.php");

echo Header::html_header("BUY JERSEYS","main.css");
?>
    <div id="header1" style="background-color: #c7ddef">
        <h1 style="text-align: center">Sale Items</h1>
    </div>

<?php
//for getting sale items
$db = new DB();
$data = $db->getAllSaleProducts();
foreach ($data as $data1){
?>
    <div>
        <div style="float: left; width: 413px; padding: 8px">
            <img src="images/<?php echo $data1['imagename']; ?>" style="float: left">
            <div style="padding-left: 158px">
            <p style="padding-top: 15px"><strong>Description: </strong><?php echo $data1['description']; ?></p>
            <p style="padding-bottom: 0px"><strong>Price: </strong><span>$</span><strike><?php echo $data1['price']; ?></strike></p>
            <p style="padding-bottom: 0px"><strong style="color: red">Sale Price: </strong><span>$</span><?php echo $data1['saleprice']; ?></p>
            <p style="padding-bottom: 0px"><strong>Quantity: </strong><?php echo $data1['quantity']; ?></p>
            <a href="addCart.php?id=<?php echo $data1['id']; ?>"> <button type="button">Add to cart</button></a>
            </div>
        </div>
    </div>
<?php } ?>
    <div><h4 style="color: #3e8f3e; clear: left">All the Jerseys are of "Large" size </h4></div>

<!--  featured items section-->
    <div style="background-color: #c7ddef">
        <h1 style="text-align: center">Featured Items</h1>
    </div>
    <div>
        <div class="table_responsive" id="pagination_data">
        </div>
    </div>
    <div><h4 style="color: #3e8f3e; clear: left">All the Jerseys are of "Large" size </h4></div>
<?php
    echo Header::footer_script();
?>

<!--Pagiantion for populating featured items, Uses ajax-->
<script>
$(document).ready(function () {
    load_data();
    function load_data(page) {
        $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{page:page},
            success:function (data) {
                $('#pagination_data').html(data);
                
            }
        })
        
    }
    $(document).on('click', '.pagination_link', function () {
       var page = $(this).attr("id");
        load_data(page);
    });
});
</script>




