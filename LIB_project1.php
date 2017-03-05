/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/6/16
 * Time: 1:06 PM
 */

<?php
class Header{

    static function html_header($title="Untitled",$styles=""){
        $string = <<<END
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>$title</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/$styles">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container" style="height: 75px">
            <a href="index.php"><img src="images/cricket.jpg" style="float: left"></a>
            <a href="index.php" class="navbar-brand"><h4 style="position: relative; left: 30px" >JERSEYS' SHOP</h4></a>
            <ul class="nav navbar-nav" style="position:relative; top: 10px; left: 40px">
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>
 <div id="headerWrapper">
     <div id="mainImage"></div>
 </div>\n
END;
        return $string;
    }

    static function footer_script(){
      $string = <<<END
</body>
</html>

END;
      return $string;
    }

} // end class
?>
