<?php
/**
 * Created by PhpStorm.
 * User: CRK
 * Date: 10/9/16
 * Time: 6:22 PM
 */

include('LIB_project1.php');

echo Header::html_header("BUY JERSEYS","main.css");

?>

<h3 style="color: #5e5e5e">Please Provide your login details to add or edit a product!!!</h3>
<div class="container">

    <form class="form-signin" action="check.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div>


</body>
</html>
