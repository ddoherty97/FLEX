/**
 * dietarygoals.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the dietary goals page. 
 * 
 * Author: Jaclyn Cuevas
 * Last Updated: 4/17/18 JC
 **/

/**
 * validateDietaryGoalSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateDietaryGoalSubmission()
{
    //get all form fields
    var type = document.getElementById("goalType").value;  				//goal type
    var calories = document.getElementById("calories").value.trim();    //calorie goal
    var water = document.getElementById("water").value.trim();      	//water goal
    
    //flag to ensure all data accurate
    var isValid = true;
    
    //ensure report type is submitted
    if(type == "-1")
    {
        //show error message and mark input invalid
        document.getElementById("type_error").innerHTML = "You must select a type of goal.";
        isValid = false;
    }//end if
    
    //if calories selected 
    else if(type == "0")
    {
    	//use subfunction to determine if calories valid
        if(!validateCalories(calories, "calorie_error"))
        {
            isValid = false;
        }//end if
        else
        {
            document.getElementById("type_error").innerHTML = "";
        }//end else
    }//end else if
    
    //if water selected 
    else if(type == "1")
    {
    	//use subfunction to determine if water valid
        if(!validateWater(water, "water_error"))
        {
            isValid = false;
        }//end if
        else
        {
            document.getElementById("type_error").innerHTML = "";
        }//end else
    }//end else if

    return isValid;
}//close validateDietaryGoalSubmission

/**
 * validateCalories()
 * This method checks to see if the supplied calorie information is valid
 * Parameters:  calValue->goal number of calories
 *              calError->id of calorie goal error div element
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function validateCalories(calValue, calError)
{
    //flag for valid data
    var calValid = true;

    //if no calorie intake provided
    if(calValue==="" || isNaN(calValue))
    {
        //show error message and mark input invalid
        document.getElementById(calError).innerHTML = "You must enter the goal number of calories.";
        calValid = false;
    }//end if
    else
    {
        document.getElementById(calError).innerHTML = "";
    }//end else

    return calValid;
}//close validateCalories

/**
 * validateWater()
 * This method checks to see if the supplied water intake information is valid
 * Parameters:  waterValue->ounces of water consumed
 *              errorID->id of error div element
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function validateWater(waterValue, errorID)
{
    //flag for valid data
    var waterValid = true;

    //if no water intake provided
    if(waterValue==="" || isNaN(waterValue))
    {
        //show error message and mark input invalid
        document.getElementById(errorID).innerHTML = "You must enter the goal number of ounces of water.";
        waterValid = false;
    }//end if
    else
    {
        document.getElementById(errorID).innerHTML = "";
    }//end else

    return waterValid;
}//close validateWater