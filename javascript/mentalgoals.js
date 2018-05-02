/**
 * mentalgoals.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the mental goals page. 
 * 
 * Author: Jaclyn Cuevas
 * Last Updated: 4/18/18 JC
 **/

/**
 * validateMentalGoalSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateMentalGoalSubmission()
{
    //get all form fields
    var type = document.getElementById("goalType").value;  								//goal type
    var counselingTime = document.getElementById("counselingTimeGoal").value.trim();  	//counseling time goal
    var stressLevel = document.getElementById("stressLevelGoal").value;  				//stress level goal
    var numDays = document.getElementById("numDays").value.trim(); 						//number of days
    	    
    //flag to ensure all data accurate
    var isValid = true;
    
    //ensure report type is submitted
    if(type == "-1")
    {
        //show error message and mark input invalid
        document.getElementById("type_error").style.display = "block";
        isValid = false;
    }//end if
    
    //if counseling selected 
    else if(type == "0")
    {
    	document.getElementById("type_error").style.display = "none";
    	
  		if(counselingTime === "" || isNaN(counselingTime) || counselingTime<=0)
  		{
  			//show error message and mark input invalid
        	document.getElementById("counseling_error").style.display = "block";
        	isValid = false;
  		}
  		else
  		{
  			document.getElementById("counseling_error").style.display = "none";
  		}
  		
  		if(numDays === "" || isNaN(numDays) || numDays<=0)
    	{
    		//show error message and mark input invalid
        	document.getElementById("numDays_error").style.display = "block";
        	isValid = false;
    	}
		else
		{
			document.getElementById("numDays_error").style.display = "none";
		}
    }//end counseling else if
    
    //if stress level selected 
    else if(type == "1")
    {
        document.getElementById("type_error").style.display = "none";
        
        if(stressLevel == "-1")
        {
        	document.getElementById("stress_error").style.display = "block";
        	isValid = false;
        }//end if
        else
        {
        	document.getElementById("stress_error").style.display = "none";
		}//end else
    }//end stress else if
    
    
    return isValid;
}//close validateMentalGoalSubmission
