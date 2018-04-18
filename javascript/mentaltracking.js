/**
 * mentaltracking.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the mental tracking page
 * 
 * Author: Davis Doherty
 * Last Updated: 4/18/18 DD
 **/

/**
 * validateMentalTrackingSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateMentalTrackingSubmission()
{
    //get all form fields
    var date = document.getElementById("date").value.trim();
    var sTime = document.getElementById("sTime").value.trim();
    var eTime = document.getElementById("eTime").value.trim();
    var type = document.getElementById("dataType").value;
    var counseling = document.getElementById("notes").value.trim();
    var stress = document.getElementById("level").value.trim();

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

    //ensure start time in correct format
    if(sTime==="" || !isValidTime(sTime))
    {
        //show error message and mark input invalid
        document.getElementById("sTime_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("sTime_error").style.display = "none";
    }//end else

    //ensure end time in correct format
    if(eTime==="" || !isValidTime(eTime))
    {
         //show error message and mark input invalid
         document.getElementById("eTime_error").style.display = "block";
         isValid = false;
    }//end if
    else
    {
        document.getElementById("eTime_error").style.display = "none";
    }//end else

    //ensure consumption type picked
    if(type=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("type_error").style.display = "block";
        isValid = false;
    }//end if

    //if counseling selected
    else if(type=="COUNSELING")
    {
        document.getElementById("type_error").style.display = "none";

        //use subfunction to determine if counseling input valid
        if(!validateCounseling(counseling, "cNotes_error"))
        {
            isValid = false;
        }//end if
    }//end if

    //if stress selected
    else if(type=="STRESS")
    {
        document.getElementById("type_error").style.display = "none";

        //use subfunction to determine if stress level input valid
        if(!validateStress(stress, "stress_error"))
        {
            isValid = false;
        }//end if
    }//end if

    //if both selected
    else if(type=="BOTH")
    {
        document.getElementById("type_error").style.display = "none";
        
        //use subfunction to determine if counseling and stress input valid
        if(!validateCounseling(counseling, "cNotes_error") && !validateStress(stress, "stress_error"))
        {
            isValid = false;
        }//end if
    }//end if

    //return validity of form fields
    return isValid;
}//close validateMentalTrackingSubmission

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
 * validateCounseling()
 * This method checks to see if the supplied counseling session information is valid
 * Parameters:  cTypeValue->counseling type
 *              cTypeError->id of counseling type error div element
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function validateCounseling(cTypeValue, cTypeError)
{
    //if no counseling type provided
    if(cTypeValue==="")
    {
        //show error message and mark input invalid
        document.getElementById(cTypeError).style.display = "block";
        return false;
    }//end if
    else
    {
        document.getElementById(cTypeError).style.display = "none";
        return false;
    }//end else
}//close validateCounseling

/**
 * validateStress()
 * This method checks to see if the supplied stress level information is valid
 * Parameters:  stressValue->stress level
 *              errorID->id of error div element
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function validateStress(stressValue, errorID)
{
    //if no water intake provided
    if(stressValue == "-1")
    {
        //show error message and mark input invalid
        document.getElementById(errorID).style.display = "block";
        return false;
    }//end if
    else
    {
        document.getElementById(errorID).style.display = "none";
        return true;
    }//end else
}//close validateStress