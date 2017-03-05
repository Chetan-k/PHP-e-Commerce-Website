<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/6/16
 * Time: 10:49 AM
 */

include('LIB_project1.php');
require_once ("DB.class.php");

echo Header::html_header("Proj1-Admin","main.css");
$db = new DB();

session_name("login");
session_start();

if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    session_unset();
    session_destroy();
    if (($email == "admin@gmail.com" && $password == "password")){

?>

<?php
        $pname = $desc = $price = $quantity = $saleprice = "";
        $pnameErr = $descErr = $priceErr = $quantityErr = $salepriceErr = "";

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["name"])) {
                $pnameErr = "Product name is required";
            } else {
                $pname = test_input($_POST["name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $pname)) {
                    $pnameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["description"])) {
                $descErr = "Description is required";
            } else {
                $desc = test_input($_POST["description"]);
            }

            if (empty($_POST['price'])) {
                $priceErr = "Price is required";
            } else {
                $price = test_input($_POST['price']);
                if (!preg_match("/^[0-9]{1,2}[\.][0-9]{1,2}$/", $price)) {
                    $priceErr = "Please enter price in ##.## format";
                }
            }

            if (empty($_POST['quantity'])) {
                $quantityErr = "Please enter product quantity";
            } else {
                $quantity = test_input($_POST['quantity']);
                if (!preg_match("/^[0-9]*$/", $quantity)) {
                    $quantityErr = "Enter integers for quantity";
                }
            }

            if (empty($_POST['saleprice'])) {
                $salepriceErr = "Sale Price is required";
            } else {
                $saleprice = test_input($_POST['saleprice']);
                if (!preg_match("/^[0-9]{1,2}[\.][0-9]{1,2}$/", $saleprice)) {
                    $salepriceErr = "Please enter price in ##.## format";
                }
            }

            $idp = $_POST['productlist'];
            $img = $_POST['imagename'];

            $idp = (int)$idp;
            $constraint = $db->getNumSaleRows();

            if(($pnameErr =="") || ($descErr =="") || ($priceErr =="") || ($quantityErr =="") || ($salepriceErr == "")){
            if ($idp == 0){
                if($saleprice > 0) {
                    if($constraint < 5) {
                        $db->insertProduct($pname, $desc, $price, $quantity, $img, $saleprice);
                    }else{
                        echo "<h1 style='color: red'>Sale items are full</h1>";
                    }
                }else{
                    $db->insertProduct($pname, $desc, $price, $quantity, $img, $saleprice);
                }
            }else{
                if($saleprice > 0){
                    if($constraint < 5){
                        $db->updateProduct($idp,$pname,$desc,$price,$quantity,$img,$saleprice);
                    }else{
                        echo "<h1 style='color: red'>Sale items are full</h1>";
                    }
                }else {
                    $db->updateProduct($idp, $pname, $desc, $price, $quantity, $img, $saleprice);
                }
            }} else{
                echo "<h1>Please give correct values</h1>";
            }


        }
?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="editproductform" style="float: left; padding-top: 20px">
            <fieldset>
                <legend style="color: #2aabd2">Edit a Product:</legend>
                <label>Select a product to edit:</label>

                <select name="productlist">
                    <option selected>---</option>
                    <?php
                    $data = $db->getAllProducts();
                    foreach ($data as $data1){
                        ?>

                    <option value=<?php echo $data1['id'] ?> > <?php echo $data1['pname'] ?></option>
                    <?php } ?>
                </select><br>
                <label >Name:</label>
                <input type="text" name="name"><span class="error"><?php echo $pnameErr;?></span><br>
                <label>Description:</label>
                <textarea name="description">Enter text here....</textarea><span class="error"><?php echo $descErr;?></span><br>
                <label>Price:</label>
                <input type="text" name="price"><span class="error"><?php echo $priceErr;?></span><br><br>
                <label>Quantity:</label>
                <input type="text" name="quantity"><span class="error"><?php echo $quantityErr;?></span><br><br>
                <label>Sale Price:</label>
                <input type="text" name="saleprice"><span class="error"><?php echo $salepriceErr;?></span><br><br>
                <label>Image Name:</label>
                <input type="text" name="imagename" placeholder="Country.jpg"><br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="editproductform" style=" padding-left: 600px; padding-top: 20px">
            <fieldset>
                <legend style="color: #2aabd2">Add a Product:</legend>

                <label >Name:</label>
                <input type="text" name="name"><span class="error"><?php echo $pnameErr;?></span><br>
                <label>Description:</label>
                <textarea name="description">Enter text here....</textarea><span class="error"><?php echo $descErr;?></span><br>
                <label>Price:</label>
                <input type="text" name="price"><span class="error"><?php echo $priceErr;?></span><br><br>
                <label>Quantity:</label>
                <input type="text" name="quantity"><span class="error"><?php echo $quantityErr;?></span><br><br>
                <label>Sale Price:</label>
                <input type="text" name="saleprice"><span class="error"><?php echo $salepriceErr;?></span><br><br>
                <label>Image Name:</label>
                <input type="text" name="imagename" placeholder="ex1.jpg,ex2.jpg,ex3.jpg"><br><br>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
        <br>
        <hr>

<?php  ?>
<?php

    }
    else{
        echo "<h1>Invalid Login Credentials, Please login again</h1>";
    }

}
else{
    echo "<h1>You need to Login!!!</h1>";

}

?>

</body>
</html>