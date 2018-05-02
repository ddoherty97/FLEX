/**
 * socialgoals.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the social goals page. 
 * 
 * Author: Jaclyn Cuevas
 * Last Updated: 4/18/18 JC
 **/

/**
 * validateSocialGoalSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateSocialGoalSubmission()
{
    //get all form fields
    var type = document.getElementById("eventType").value;  			//event type
    var otherType = document.getElementById("other").value.trim();		//other event type
    var time = document.getElementById("time").value.trim();  			//goal time
    var numDays = document.getElementById("numDays").value.trim();  	//number of days
    	    
    //flag to ensure all data accurate
    var isValid = true;
    
    if(type == "-1")
    {
    	//show error message and mark input invalid
        document.getElementById("type_error").style.display = "block";
        isValid = false;
    }
    //if other is selected
    else if(type == "0")
    {
    	document.getElementById("type_error").style.display = "none";
    	
        if(otherType === "")
        {
        	document.getElementById("other_error").style.display = "block";
        	isValid = false;
        }
        else
        {
        	document.getElementById("other_error").style.display = "none";
        }
    }//end else if
    
	else
	{
		document.getElementById("type_error").style.display = "none";
	}
	
	if(time === "" || isNaN(time) || time<=0)
	{
		document.getElementById("time_error").style.display = "block";
        isValid = false;
	}
	else
	{
		document.getElementById("time_error").style.display = "none";
	}
	
	if(numDays === "" || isNaN(numDays) || numDays<=0)
	{
		document.getElementById("numDays_error").style.display = "block";
        isValid = false;
	}
	else
	{
		document.getElementById("numDays_error").style.display = "none";
	}
	
    return isValid;
}//close validateSocialGoalSubmission
