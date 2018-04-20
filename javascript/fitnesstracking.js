/**
 * fitnesstracking.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the fitness tracking page
 * 
 * Author: Davis Doherty
 * Last Updated: 4/19/18 DD
 **/

/**
 * validateFitnessTrackingSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateFitnessTrackingSubmission()
{
    //get all form fields
    var date = document.getElementById("date").value.trim();
    var fitType = document.getElementById("goalType").value;   
    var sTime = document.getElementById("sTime").value.trim();
    var eTime = document.getElementById("eTime").value.trim();
    var cardioType = document.getElementById("cardioType").value;
    var strengthType = document.getElementById("strengthType").value;
    var weightChange = document.getElementById("weightChange").value.trim();
    var milestone = document.getElementById("milestoneInput").value.trim();
    var label = document.getElementById("milestoneType").value;

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

    //ensure type of fitness is selected
    if(fitType=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("fitType_error").style.display = "block";
        isValid = false;
    }//end if

    //if cardio tracking
    else if(fitType == "CARDIO")
    {
        //hide fitness type error message
        document.getElementById("fitType_error").style.display = "none";

        //ensure start date and end date were submitted and valid
        if(!validateTimes(sTime, eTime, "start_error", "end_error"))
        {
            isValid = false;
        }//end if

        //ensure type of cardio selected
        if(cardioType == "-1")
        {
            //show error message and mark input invalid
            document.getElementById("cardioType_error").style.display = "block";
            isValid = false;
        }//end if
        else
        {
            document.getElementById("cardioType_error").style.display = "none";
        }//end else

        //validate milestone
        if(!validateMilestone(milestone, label, "milestone_error", "label_error"))
        {
            isValid = false;
        }//end if
    }//end if

    //if strength tracking
    else if(fitType == "STRENGTH")
    {
        //hide fitness type error message
        document.getElementById("fitType_error").style.display = "none";

        //ensure start date and end date were submitted and valid
        if(!validateTimes(sTime, eTime, "start_error", "end_error"))
        {
            isValid = false;
        }//end if

        //ensure type of strength selected
        if(strengthType == "-1")
        {
            //show error message and mark input invalid
            document.getElementById("strengthType_error").style.display = "block";
            isValid = false;
        }//end if
        else
        {
            document.getElementById("strengthType_error").style.display = "none";
        }//end else

        //validate milestone
        if(!validateMilestone(milestone, label, "milestone_error", "label_error"))
        {
            isValid = false;
        }//end if
    }//end if

    //if weight tracking
    else if(fitType == "WEIGHT")
    {
        //hide fitness type error message
        document.getElementById("fitType_error").style.display = "none";

        //ensure new weight submitted
        if(weightChange==="" || isNaN(weightChange))
        {
            //show error message and mark input invalid
            document.getElementById("weight_error").style.display = "block";
            isValid = false;
        }//end if
        else
        {
            document.getElementById("weight_error").style.display = "none";
        }//end else
    }//end if

    //return validity of form fields
    return isValid;
}//close validateFitnessTrackingSubmission

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
 * validateTimes()
 * This method validates the start and end times of the form
 * Parameters:  startValue->start time form value
 *              endValue->end time form value
 *              startError->ID of start time error div
 *              endError->ID of end time error div
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function validateTimes(startValue, endValue, startError, endError)
{    
    //flag to see if times are valid
    var validTimes = true;

    //ensure start time submitted and in proper format
    if(startValue==="" || !isValidTime(startValue))
    {
        //show error message and mark input invalid
        document.getElementById(startError).style.display = "block";
        validTimes = false;
    }//end if
    else
    {
        document.getElementById(startError).style.display = "none";
    }//end else

    //ensure end time submitted and in proper format
    if(endValue==="" || !isValidTime(endValue))
    {
        //show error message and mark input invalid
        document.getElementById(endError).style.display = "block";
        validTimes = false;
    }//end if
    else
    {
        document.getElementById(endError).style.display = "none";
    }//end else

    return validTimes;
}//close validateTimes

/**
 * validateMilestone()
 * This method validates the milestone of the form
 * Parameters:  milestoneValue->milestone form value
 *              labelValue->label for milestone
 *              milestoneError->ID of milestone error div
 *              labelError->ID of label error div
 * Returns: TRUE if valid date, FALSE otherwise
 * Exceptions: None
 **/
function validateMilestone(milestoneValue, labelValue, milestoneError, labelError)
{    
    //flag for milestone validity
    var mileValid = true;

    //ensure milestone submitted
    if(milestoneValue==="")
    {
        //show error message and mark input invalid
        document.getElementById(milestoneError).style.display = "block";
        mileValid = false;
    }//end if
    else
    {
        document.getElementById(milestoneError).style.display = "none";
    }//end else

    //ensure label chosen
    if(labelValue == "-1")
    {
        //show error message and mark input invalid
        document.getElementById(labelError).style.display = "block";
        mileValid = false;
    }//end if
    else
    {
        document.getElementById(labelError).style.display = "none";
    }//end else

    return mileValid;
}//close validateMilestone