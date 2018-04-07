/**
 * login.js
 * This file contains functions that are used on the login screen. * 
 * Author: Davis Doherty
 * Last Updated: 4/7/18 DD
 **/

/**
 * resetPassword()
 * This method gather's the user's ID and redirects to the reset password script
 * Parameters:  None
 * Returns: void
 * Exceptions: None
 **/
function resetPassword()
{
    //get user ID
    var userID = document.getElementById("formUser").value;

    //if user ID submitted
    if(userID != "")
    {
        //URL to redirect to if user submitted
        var redirectURL = "../../php/ResetPassword.php?user="+userID;

        //redirect to password reset page
        window.location.href = redirectURL;
    }//end if

    //if no user id in login
    else
    {
        alert("You must enter your user ID to reset your password!");
    }//end else
}//close resetPassword