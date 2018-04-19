<?php
   /**
     * Reset Password Front End (resetpassword.php)
     * This creates the user interface of the forgot password page.
	 * The user is either shown a confirmation message or asked to enter a new password.  
     * Author: Davis Doherty
     * Last Updated: 4/18/18 DD
     **/
   
    //file needs to communicate with database
    require_once("../../php/CommunicationModule.php");

    //initalize connection to communication module
    $communication = new CommunicationModule("b16_21592498_FLEX");

    //determine if confirmation message or setting new password
    $function = $_GET['func'];      //function of file  (confirmation / validation)
    $data = $_GET['data'];          //data to process   (username / token)
    $reset = "";                    //flag for reset status

    //validate a reset token
    if($function=="validate" && $data!="")
    {
        //search database for token
        $resetSQL = "SELECT CRED_ID FROM USER_CREDENTIALS WHERE CRED_PW_RESET_TOKEN='$data'";
        $resetUser = mysqli_fetch_array($communication->queryDatabase($resetSQL));
        
        //if valid token
        if(is_array($resetUser))
        {
            //set flag for GUI display
            $reset = "valid";
        }//end if

        //if token not found
        else
        {
            //set flag for GUI display
            $reset = "invalid";
        }//end else
    }//end if

    //reset a password
    else if($function == "reset")
    {
        //get credential ID and new pass from form
        $credID = $_POST['credID'];
        $newPass = $_POST['newPass'];
        $newPassC = $_POST['newPassC'];

        //ensure passwords match and were set
        if($newPass!="" && $newPass==$newPassC)
        {
            //hash password for storage
            $password = hash("sha512", $newPass);
            
            //update password in database
            $pwSQL = "UPDATE USER_CREDENTIALS SET CRED_PASS='$password' WHERE CRED_ID='$credID'";
            $communication->queryDatabase($pwSQL);

            //remove reset token
            $tokenSQL = "UPDATE USER_CREDENTIALS SET CRED_PW_RESET_TOKEN=NULL WHERE CRED_ID='$credID'";
            $communication->queryDatabase($tokenSQL);

            $reset = "pass";
        }//end if

        //if passwords don't match
        else
        {
            //set reset flag
            $reset = "fail";
        }//end else
    }//end if
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>FLEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/style.css">
        <script src="../../javascript/resetpassword.js"></script>
    </head>
    
    <body>
        <header>
            <a href="../home.php"><img src="../../images/antlers.png" alt="logo" height="50px" width="50px"/></a>
        </header>
        <main>
            <h1>FLEX</h1>
            <h2>Reset Your Password</h2>
                <br><br>
    <?php
        //if displaying a confirmation message
        if($function=="confirmation" && $data!="")
        {
            echo "<div>";
            echo "A message has been sent to the email address on file for <strong>$data</strong> with a link to reset your password. Click the link in your email to continue!";
            echo "</div>";
        }//end if
        
        //if token validated and need new password
        else if($reset == "valid")
        {
    ?>
            <div>
                Phew, that was a close one! Please enter your new password below to continue using FLEX.
                    <br><br>
                <form method="POST" action="?func=reset" onsubmit="return validatePasswordSubmission();">
                    <div>
                        <label for="newPass">New Password: </label>
                            <input id="newPass" name="newPass" type="password">
                    </div>
                    <div class="errorMSG" id="pass_error">You must enter a new password.</div>
                        <br>
                    <div>
                        <label for="newPassC">Re-enter Password: </label>
                            <input id="newPassC" name="newPassC" type="password">
                    </div>
                    <div class="errorMSG" id="confirm_error">The passwords do not match.</div>
                        <br>
                    <input type="hidden" name="credID" value="<?php echo $resetUser['CRED_ID']; ?>">
                    <input type="submit" value="Reset Password!">
                </form>
            </div>
    <?php
        }//end if

        //if token doesn't exist
        else if($reset == "invalid")
        {
            echo "<div>";
            echo "Uh oh! It looks like the link you clicked on may have been invalid. Please try to reset your password again.";
            echo "<br><br>";
            echo "<a href='login.php'>Preceed to Login Page</a>";
            echo "</div>";
        }//end if

        //if password reset
        else if($reset == "pass")
        {
            echo "<div>";
            echo "Success! Your password has been reset. You can now login to use FLEX.";
            echo "<br><br>";
            echo "<a href='login.php'>Preceed to Login Page</a>";
            echo "</div>";
        }//end if
        
        //if passwords didn't match
        else if($reset == "fail")
        {
            echo "<div>";
            echo "Uh oh! It looks like the passwords you entered didn't match. Please click the link in your email again.";
            echo "</div>";
        }//end if

        //if no/invalid parameters (i.e. not redirected from somewhere else)
        else
        {
            //redirect to login page
            //header("Location: login.php");
            //exit();
        }//end else
    ?>        
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