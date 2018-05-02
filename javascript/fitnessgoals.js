/**
 * fitnessgoals.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the fitness goals page. 
 * 
 * Author: Jaclyn Cuevas
 * Last Updated: 4/18/18 JC
 **/

/**
 * validateFitnessGoalSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateFitnessGoalSubmission()
{
    //get all form fields
    var type = document.getElementById("goalType").value;  					//goal type
    var cardioType = document.getElementById("cardioType").value;  			//cardio goal type
    var strengthType = document.getElementById("strengthType").value;  		//strength goal type
    var weightType = document.getElementById("weightType").value;  			//weight goal type
    var distanceGoal = document.getElementById("distance").value.trim();	//distance goal
    var speedGoal = document.getElementById("speed").value.trim();			//speed goal
    var timeGoal = document.getElementById("time").value.trim();			//time goal
    var strengthGoal = document.getElementById("maxWeight").value.trim();	//strength goal
    var weightGoal = document.getElementById("weightDif").value.trim(); 	//weight goal
    var numDays = document.getElementById("numDays").value.trim(); 			//number of days
    	    
    //flag to ensure all data accurate
    var isValid = true;
    
    //ensure report type is submitted
    if(type == "-1")
    {
        //show error message and mark input invalid
        document.getElementById("type_error").style.display = "block";
        isValid = false;
    }//end if
    
    //if cardio selected 
    else if(type == "CARDIO")
    {
        document.getElementById("type_error").style.display = "none";
        
        //if no cardio type selected
        if(cardioType == "-1")
        {
        	document.getElementById("cardio_error").style.display = "block";
        	isValid = false;
        }//end if
        //if distance goal selected
        else if(cardioType == "DISTANCE")
        {
        	document.getElementById("cardio_error").style.display = "none";
        	
        	//if distance goal not provided
        	if(distanceGoal === "" || isNaN(distanceGoal) || distanceGoal<=0)
        	{
        		//show error message and mark input invalid
        		document.getElementById("distance_error").style.display = "block";
        		isValid = false;
        	}//end if
        	else
    		{
        		document.getElementById("distance_error").style.display = "none";
    		}//end else
        }
        //if speed goal selected 
		else if(cardioType == "SPEED")
    	{
    		document.getElementById("cardio_error").style.display = "none";
    		
    		//if speed goal not provided
        	if(speedGoal === "" || isNaN(speedGoal) || speedGoal<=0)
        	{
        		//show error message and mark input invalid
        		document.getElementById("speed_error").style.display = "block";
        		isValid = false;
        	}//end if
        	else
    		{
        		document.getElementById("speed_error").style.display = "none";
    		}//end else
    	}//end else if
    	//if time goal selected 
    	else if(cardioType == "TIME")
    	{
    		document.getElementById("cardio_error").style.display = "none";
    		
        	//if distance goal not provided
        	if(timeGoal === "" || isNaN(timeGoal) || timeGoal<=0)
        	{
        		//show error message and mark input invalid
        		document.getElementById("time_error").style.display = "block";
        		isValid = false;
        	}//end if
        	else
    		{
        		document.getElementById("time_error").style.display = "none";
    		}//end else
    	}//end else if
    }//end cardio else if
    
    //if strength selected 
    else if(type == "STRENGTH")
    {
        document.getElementById("type_error").style.display = "none";
        
		//if no strength type selected
        if(strengthType == "-1")
        {
        	document.getElementById("strengthType_error").style.display = "block";
        	isValid = false;
        }//end if
        
        //if strength type selected
        else
        {
        	document.getElementById("strengthType_error").style.display = "none";
		}//end else
		
		//if strength goal not provided
		if(strengthGoal === "" || isNaN(strengthGoal) || strengthGoal<=0)
		{
			//show error message and mark input invalid
			document.getElementById("strengthGoal_error").style.display = "block";
			isValid = false;
		}//end if 
		else
		{
			document.getElementById("strengthGoal_error").style.display = "none";
		}//end else
    }//end else if
    
    //if weight selected
    else if(type == "WEIGHT")
    {
        document.getElementById("type_error").style.display = "none";

		if(weightType == "-1")
        {
        	document.getElementById("weightType_error").style.display = "block";
        	isValid = false;
        }//end if
        
        //if weight type selected
        else
        {
        	document.getElementById("weightType_error").style.display = "none";
        }//end else
        	//if weight goal not provided
        if(weightGoal === "" || isNaN(weightGoal) || weightGoal<=0)
        {
        	//show error message and mark input invalid
        	document.getElementById("weightGoal_error").style.display = "block";
        	isValid = false;
        }//end if 
        else
        {
        	document.getElementById("weightGoal_error").style.display = "none";
        }//end else
        
    }//end else if
    
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
    return isValid;
}//close validateFitnessGoalSubmission
