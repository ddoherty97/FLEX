/**
 * spiritualgoals.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the spirutal goals page. 
 * 
 * Author: Jaclyn Cuevas
 * Last Updated: 4/18/18 JC
 **/

/**
 * validateSpiritualGoalSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateSpiritualGoalSubmission()
{
    //get all form fields
    var type = document.getElementById("spiritualGoalType").value;  			//goal type
    var durationGoal = document.getElementById("durationGoal").value.trim();	//duration goal
    var eventsGoal = document.getElementById("eventGoal").value.trim();  		//events goal
    var numDays = document.getElementById("numDays").value.trim();  			//number of days
    	    
    //flag to ensure all data accurate
    var isValid = true;
    
    if(type == "-1")
    {
    	//show error message and mark input invalid
        document.getElementById("type_error").style.display = "block";
        isValid = false;
    }
    //if duration is selected
    else if(type == "0")
    {
    	document.getElementById("type_error").style.display = "none";
    	
        if(durationGoal === "" || isNaN(durationGoal) || durationGoal<=0) 
        {
        	document.getElementById("duration_error").style.display = "block";
        	isValid = false;
        }
        else
        {
        	document.getElementById("duration_error").style.display = "none";
        }
    }//end else if
    
    //if events is selected
    else if(type == "1")
    {
    	document.getElementById("type_error").style.display = "none";
    	
        if(eventsGoal === "" || isNaN(eventsGoal) || eventsGoal<=0) 
        {
        	document.getElementById("events_error").style.display = "block";
        	isValid = false;
        }
        else
        {
        	document.getElementById("events_error").style.display = "none";
        }
    }//end else if

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
}//close validateSpiritualGoalSubmission
