/**
 * screentimegoals.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the screen time goals page. 
 * 
 * Author: Jaclyn Cuevas
 * Last Updated: 4/18/18 JC
 **/

/**
 * validateScreenTimeGoalSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateScreenTimeGoalSubmission()
{
    //get all form fields
    var stGoal = document.getElementById("screenTimeGoal").value;  		//screen time goal
    	    
    //flag to ensure all data accurate
    var isValid = true;
    
    //ensure screen time goal is submitted
    if(stGoal === "" || isNaN(stGoal))
    {
        //show error message and mark input invalid
        document.getElementById("st_error").style.display = "block";
        isValid = false;
    }//end if
    
	else
	{
		document.getElementById("st_error").style.display = "none";
	}
    return isValid;
}//close validateScreenTimeGoalSubmission
