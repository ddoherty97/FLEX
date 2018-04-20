/**
 * spiritualtracking.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the spiritual tracking page
 * 
 * Author: Davis Doherty
 * Last Updated: 4/19/18 DD
 **/

/**
 * validateSpiritualTrackingSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateSpiritualTrackingSubmission()
{
    //get all form fields
    var name = document.getElementById("title").value.trim();
    var date = document.getElementById("date").value.trim();
    var sTime = document.getElementById("sTime").value.trim();
    var eTime = document.getElementById("eTime").value.trim();
    var location = document.getElementById("location").value.trim();
    var type = document.getElementById("type").value.trim();   

    //flag to ensure all data accurate
    var isValid = true;

    //ensure title is provided
    if(name==="")
    {
        //show error message and mark input invalid
        document.getElementById("title_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("title_error").style.display = "none";
    }//end else
    
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
    
    //ensure start time in correct format
    if(sTime==="" || !isValidTime(sTime))
    {
        //show error message and mark input invalid
        document.getElementById("start_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("start_error").style.display = "none";
    }//end else

    //ensure end time in correct format
    if(eTime==="" || !isValidTime(eTime))
    {
         //show error message and mark input invalid
         document.getElementById("end_error").style.display = "block";
         isValid = false;
    }//end if
    else
    {
        document.getElementById("end_error").style.display = "none";
    }//end else

    //ensure location is provided
    if(location==="")
    {
        //show error message and mark input invalid
        document.getElementById("location_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("location_error").style.display = "none";
    }//end else

    //ensure event type selected
    if(type==="")
    {
        //show error message and mark input invalid
        document.getElementById("type_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("type_error").style.display = "none";
    }//end else

    //return validity of form fields
    return isValid;
}//close validateSpiritualTrackingSubmission

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