/**
 * dietarytracking.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the dietary tracking page
 * 
 * Author: Davis Doherty
 * Last Updated: 4/17/18 DD
 **/

/**
 * validateDietaryTrackingSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateDietaryTrackingSubmission()
{
    //get all form fields
    var date = document.getElementById("date").value.trim();
    var time = document.getElementById("time").value.trim();
    var type = document.getElementById("dataType").value;
    var items = document.getElementById("type").value.trim();
    var calories = document.getElementById("calories").value.trim();
    var water = document.getElementById("ounces").value.trim();

    //flag to ensure all data accurate
    var isValid = true;

    //ensure date in correct format
    if(date==="" || !isValidDate(date))
    {
         //show error message and mark input invalid
         document.getElementById("date_error").innerHTML = "You must enter a date in the format YYYY-MM-DD.";
         isValid = false;
    }//end if
    else
    {
        document.getElementById("date_error").innerHTML = "";
    }//end else

    //ensure time in correct format
    if(time==="" || !isValidTime(time))
    {
         //show error message and mark input invalid
         document.getElementById("time_error").innerHTML = "You must enter a valid military time.";
         isValid = false;
    }//end if
    else
    {
        document.getElementById("time_error").innerHTML = "";
    }//end else

    //ensure consumption type picked
    if(type=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("type_error").innerHTML = "You must select a consumption type.";
        isValid = false;
    }//end if

    //if calories selected
    else if(type=="CALORIES")
    {
        document.getElementById("type_error").innerHTML = "";

        //use subfunction to determine if calories valid
        if(!validateCalories(items, calories, "item_error", "calorie_error"))
        {
            isValid = false;
        }//end if
    }//end if

    //if water selected
    else if(type=="WATER")
    {
        document.getElementById("type_error").innerHTML = "";

        //use subfunction to determine if water valid
        if(!validateWater(water, "water_error"))
        {
            isValid = false;
        }//end if
    }//end if

    //if both selected
    else if(type=="BOTH")
    {
        document.getElementById("type_error").innerHTML = "";
        
        //use subfunction to determine if calories and water valid
        if(!validateCalories(items, calories, "item_error", "calorie_error") && !validateWater(water, "water_error"))
        {
            isValid = false;
        }//end if
    }//end if

    //return validity of form fields
    return isValid;
}//close validateDietaryTrackingSubmission

/**
 * isValidDate()
 * This method checks to see if the supplied text is in the form
 *      of a valid date with format yyyy-mm-dd
 * Parameters:  dateString->date to validate
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function isValidDate(dateString)
{
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    
    //invalid date format
    if(!dateString.match(regEx))
    {
        return false; 
    }//end if

    //valid date format
    else
    {
        var d = new Date(dateString);
        
        if(!d.getTime() && d.getTime()!==0)
        {
            //invalid date
            return false; 
        }//end if

        return d.toISOString().slice(0,10) === dateString;
    }//end else
}//close isValidDate

/**
 * isValidTime()
 * This method checks to see if the supplied text is in the form
 *      of military time
 * Parameters:  timeString->time to validate
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function isValidTime(timeString)
{
    var regEx = /^([01]\d|2[0-3]):?([0-5]\d)$/;
    
    //invalid time format
    if(!timeString.match(regEx))
    {
        return false; 
    }//end if

    //valid time format
    else
    {
        return true;
    }//end else
}//close isValidTime

/**
 * validateCalories()
 * This method checks to see if the supplied calorie information is valid
 * Parameters:  itemValue->description of consumed calories
 *              calValue->number of calories consumed
 *              itemError->id of item error div element
 *              calError->id of calorie error div element
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function validateCalories(itemValue, calValue, itemError, calError)
{
    //flag for valid data
    var calValid = true;

    //if no calorie description provided
    if(itemValue==="")
    {
        //show error message and mark input invalid
        document.getElementById(itemError).innerHTML = "You must enter at least one item consumed.";
        calValid = false;
    }//end if
    else
    {
        document.getElementById(itemError).innerHTML = "";
    }//end else

    //if no calorie intake provided
    if(calValue==="" || isNaN(calValue))
    {
        //show error message and mark input invalid
        document.getElementById(calError).innerHTML = "You must enter the number of calories consumed.";
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
        document.getElementById(errorID).innerHTML = "You must enter the number of ounces consumed.";
        waterValid = false;
    }//end if
    else
    {
        document.getElementById(errorID).innerHTML = "";
    }//end else

    return waterValid;
}//close validateWater