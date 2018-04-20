/**
 * screentimetracking.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the screen time tracking page
 * 
 * Author: Davis Doherty
 * Last Updated: 4/19/18 DD
 **/

/**
 * validateScreenTrackingSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateScreenTrackingSubmission()
{
    //get all form fields
    var date = document.getElementById("date").value.trim();
    var duration = document.getElementById("time").value.trim();
    var type = document.getElementById("device").value;

    //flag to ensure all data accurate
    var isValid = true;

    //ensure date in correct format
    if(date==="" || !isValidDate(date))
    {
         //show error message and mark input invalid
         document.getElementById("date_error").style.display = "block";
         isValid = false;
    }//end if
    else
    {
        document.getElementById("date_error").style.display = "none";
    }//end else

    //ensure time spent is provided and a number
    if(duration==="" || isNaN(duration))
    {
        //show error message and mark input invalid
        document.getElementById("time_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("time_error").style.display = "none";
    }//end else

    //ensure type of device is selected
    if(type == "-1")
    {
         //show error message and mark input invalid
         document.getElementById("device_error").style.display = "block";
         isValid = false;
    }//end if
    else
    {
        document.getElementById("device_error").style.display = "none";
    }//end else

    //return validity of form fields
    return isValid;
}//close validateScreenTrackingSubmission

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