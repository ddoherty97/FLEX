<?php
	 /**
     * ResetPassowrd.php
     * This file, written in procedural language (not object-oriented), is used to reset
     * a user's password to the FLEX application. It will generate a reset token, email it
     * to the user, and then the user must click the email link to reset their password.
     * Author: Davis Doherty
     * Last Updated: 4/18/18 DD
     **/

    //include access to the communication module
    require_once("CommunicationModule.php");
	
	//only run if username was submitted
    if(isset($_GET['user']))
    {
        //get user to reset password of
        $user = $_GET['user'];

        //create communication module
        $com = new CommunicationModule("b16_21592498_FLEX");
        
        //see if user exists in database
        $emailSQL = "SELECT CRED_ID,CRED_USER,USER_EMAIL,USER_FNAME FROM USER_CREDENTIALS,USER_INFORMATION WHERE CRED_FFLD_ID=USER_FFLD_ID AND CRED_USER='$user'";
        $emailQuery = $com->queryDatabase($emailSQL);
        $userData = mysqli_fetch_array($emailQuery);
		
		//if user exists in system
		if(is_array($userData))
		{
            //get user's information
            $ID = $userData['CRED_ID'];         //user's ID
            $email = $userData['USER_EMAIL'];   //user's email address
            $name = $userData['USER_FNAME'];    //user's first name

            //generate reset token
            $token = md5(uniqid(rand(), true));

            //add reset token to database
            $tokenSQL = "UPDATE USER_CREDENTIALS SET CRED_PW_RESET_TOKEN='$token' WHERE CRED_ID='$ID'";
            $com->queryDatabase($tokenSQL);

            //build email to send to user
            $subject = "Reset Your FLEX Password";
            
            $headers = "MIME-Version: 1.0"."\n";
            $headers .= "Content-type: text/html; charset=UTF-8"."\n";
            $headers .= "From: FLEX by Fairfield <web@flex.com>";
           
            $message = "<html><body>";
            $message .= "Dear ".$name.",<br><br>";
            $message .= "You recently requested a new password for your FLEX user account. To reset your password, please click the link below.<br>";
            $message .= "<a href='http://flex.byethost16.com/pages/users/resetpassword.php?func=validate&data=".$token."'>Reset Password</a><br><br>";
            $message .= "Best Regards,<br>";
            $message .= "The FLEX Team";
            $message .= "<br><br><br></body></html>";

            //send reset email to user
            mail($email,$subject,$message,$headers);
    
            //redirect to confirmation page
            header("Location: ../pages/users/resetpassword.php?func=confirmation&data=".$user);
            exit();      
        }//end if
    }//end if

    //if no user submitted
    else
    {
        //redirect to home page
        header("Location: ../pages/home.php");
        exit();
    }//end else
?>