<?php 
	/**
     * Login Front End (reports.php)
     * This creates the user interface of the login page.
	 * The user is able to login, create an account or change their password.  
     * Author: Jaclyn Cuevas
     * Last Updated: 4/11/18 DD
     **/

    require("../../php/login.php");
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FLEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/style.css">
    </head>
    
    <body>
        <header>
            <a href="../home.php"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a>
        </header>
        <main>
        <h1>
            FLEX    
        </h1>

        <form method="POST" action="">
            <label for="formUser">Username: </label>
            	<input type="text" id="formUser" name="formUser"><br><br>
            <label for="formPass">Password: </label>
            	<input type="password" name="formPass"><br><br>
            <input type="submit" value="Login"><br>
            <?php echo $message."<br>";?>
        </form>
        
        <div>
            <a href="createuser.php" alt="Create Account">Create Account</a> |
            <a href="javascript:resetPassword();" alt="Forgot Password">Forgot Password</a>
        </div>
        
        </main>
        <footer>
            <div class="leftFootCol">
                &copy; 2018
                    <br>
                Fairfield University
            </div>
            <div class="rightFootCol">
                1073 North Benson Road
                    <br>
                Fairfield, CT 06824
            </div>
            <div class="clear"></div>
        </footer>
    </body>
</html>
