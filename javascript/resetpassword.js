/**
 * resetpassword.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields when resetting their password. 
 * 
 * Author: Davis Doherty
 * Last Updated: 4/18/18 DD
 **/

/**
 * validatePasswordSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validatePasswordSubmission()
{
    //get all form fields
    var password = document.getElementById("newPass").value;
    var confirm = document.getElementById("newPassC").value;
    
    //flag to ensure all data accurate
    var isValid = true;
    
    //ensure initial password is submitted
    if(password == "")
    {
        //show error message and mark input invalid
        document.getElementById("pass_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
        //hide error message
        document.getElementById("pass_error").style.display = "none";
       
        //if password submitted, make sure second one matches
        if(password != confirm)
        {
            //show error message and mark input invalid
            document.getElementById("confirm_error").style.display = "block";
            isValid = false;
        }//end if
        else
        {
            //hide error message
            document.getElementById("confirm_error").style.display = "none";
        }//end else
    }//end else

    return isValid;
}//close validatePasswordSubmission