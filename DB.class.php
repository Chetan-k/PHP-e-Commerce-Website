<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/8/16
 * Time: 6:53 PM
 */

class DB
{

    private $connection;

    function __construct()
    {
        require_once("../../../dbinfo.php");
        $this->connection = new mysqli($host, $user, $pass, $db);
        if ($this->connection->connect_error) {
            echo "Connection failed: " . mysqli_connect_error();
            die();
        }

    }//constructor

    //method for getting all sale products from the database
    function getAllSaleProducts(){
        $data = array();

        if ($stmt = $this->connection->prepare("select * from products where (SalePrice > 0)")){
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$pname,$desc,$price,$quantity,$imgname,$sprice);


            //fetch rows
            if($stmt->num_rows>0){
                while($stmt->fetch()){
                    $data[] = array("id"=>$id,
                        "pname"=>$pname,
                        "description"=>$desc,
                        "price"=>$price,
                        "quantity"=>$quantity,
                        "imagename"=>$imgname,
                        "saleprice"=>$sprice);
                }

            }

        }//all good
        return $data;

    }//getAllSaleProducts as an array

    //method for getting all featured products from the database
    function getAllFeaturedProducts(){
        $data = array();

        if ($stmt = $this->connection->prepare("select * from products where SalePrice < 0.01")){
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$pname,$desc,$price,$quantity,$imgname,$sprice);


            //fetch rows
            if($stmt->num_rows>0){
                while($stmt->fetch()){
                    $data[] = array("id"=>$id,
                        "pname"=>$pname,
                        "description"=>$desc,
                        "price"=>$price,
                        "quantity"=>$quantity,
                        "imagename"=>$imgname,
                        "saleprice"=>$sprice);
                }

            }

        }//all good
        return $data;
    }//getAllFeaturedProducts as an array

    //gets all the products from the database
    function getAllProducts(){
        $data = array();

        if ($stmt = $this->connection->prepare("select * from products;")){
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$pname,$desc,$price,$quantity,$imgname,$sprice);


            //fetch rows
            if($stmt->num_rows>0){
                while($stmt->fetch()){
                    $data[] = array("id"=>$id,
                        "pname"=>$pname,
                        "description"=>$desc,
                        "price"=>$price,
                        "quantity"=>$quantity,
                        "imagename"=>$imgname,
                        "saleprice"=>$sprice);
                }

            }

        }//all good
        return $data;
    }//getAllProducts as an array

    //inserts new products into products table until the sale products reach 5.
    function insertProduct($pname,$desc,$price,$quantity,$imgname,$sprice){

        $queryString = "insert into products (ProductName,Description,Price,Quantity,ImageName,SalePrice)
				values(?,?,?,?,?,?)";

        $insertId = "-1";
        if ($stmt=$this->connection->prepare($queryString)){
            $stmt->bind_param("ssdisd",$pname,$desc,$price,$quantity,$imgname,$sprice);
            $stmt->execute();
            $stmt->store_result();
            $insertId = $stmt->insert_id;

        }


        return $insertId;

    }

    //updates the existing products in the products table.
    function updateProduct($id,$pname,$desc,$price,$quantity,$img,$saleprice){
        $rows ="";
        if ($stmt = $this->connection->prepare("update products set ProductName='$pname', Description='$desc', Price='$price', Quantity='$quantity', ImageName='$img', SalePrice='$saleprice' where ProductID='$id'")) {
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->affected_rows;
        }//all good
        return $rows;

    }

    //gets an array of details of single product based on the id parameter passed.
    function getSingleProduct($id){
        $data = array();

        if ($stmt = $this->connection->prepare("select * from products where ProductID = $id")){
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$pname,$desc,$price,$quantity,$imgname,$sprice);


            //fetch rows
            if($stmt->num_rows>0){
                while($stmt->fetch()){
                    $data[] = array("id"=>$id,
                        "pname"=>$pname,
                        "description"=>$desc,
                        "price"=>$price,
                        "quantity"=>$quantity,
                        "imagename"=>$imgname,
                        "saleprice"=>$sprice);
                }

            }

        }//all good
        return $data;

    }//getSingleProduct as an array

    //inserts products into cart table.
    function insertCart($pname,$desc,$price,$quantity,$imgname,$sprice){
        $queryString = "insert into cart (ProductName,Description,Price,Quantity,ImageName,SalePrice)
				values(?,?,?,?,?,?)";

        $insertId = "-1";
        if ($stmt=$this->connection->prepare($queryString)){
            $stmt->bind_param("ssdisd",$pname,$desc,$price,$quantity,$imgname,$sprice);
            $stmt->execute();
            $stmt->store_result();
            $insertId = $stmt->insert_id;

        }


        return $insertId;

    }

    //gets total number of sale products present in the products table.
    function getNumSaleRows(){
        $rows = "";
        if ($stmt = $this->connection->prepare("select * from products where (SalePrice > 0)")) {
            $stmt->execute();
            $stmt->store_result();
            $rows =$stmt->num_rows;
        }//all good
        return $rows;

    }

    //updates the products present in the products table.
    function updateQuantity($id,$quantity){
        $rows ="";
        if ($stmt = $this->connection->prepare("update products set Quantity=$quantity where ProductID=$id")) {
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->affected_rows;
        }//all good
        return $rows;

    }

    //get all the products added to the cart in an array.
    function getAllCartProducts(){
        $data = array();

        if ($stmt = $this->connection->prepare("select * from cart;")){
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id,$pname,$desc,$price,$quantity,$imgname,$sprice);


            //fetch rows
            if($stmt->num_rows>0){
                while($stmt->fetch()){
                    $data[] = array("id"=>$id,
                        "pname"=>$pname,
                        "description"=>$desc,
                        "price"=>$price,
                        "quantity"=>$quantity,
                        "imagename"=>$imgname,
                        "saleprice"=>$sprice);
                }

            }

        }//all good
        return $data;

    }//getAllCartProducts as an array

    //on click of the button all the data in the cart table gets deleted from the database.
    function deleteCart(){
        if ($stmt = $this->connection->prepare("delete from cart;")) {
            $stmt->execute();
            $stmt->store_result();
        }//all good

    }

    //gets the number of rows in the cart table to check the cart.
    function getCartRows(){
        $rows = "";
        if ($stmt = $this->connection->prepare("select * from cart;")) {
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->num_rows;
        }//all good
        return $rows;

    }
}


?>