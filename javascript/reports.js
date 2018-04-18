/**
 * reports.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on the reports page. 
 * 
 * Author: Jaclyn Cuevas
 * Last Updated: 4/18/18 JC
 **/

/**
 * validateReportSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateReportSubmission()
{
    //get all form fields
    var type = document.getElementById("reportType").value;  		//report type
    var start = document.getElementById("sDate").value.trim();      //start date
    var end = document.getElementById("eDate").value.trim();      	//end date
    
    //flag to ensure all data accurate
    var isValid = true;
    
    //ensure report type is submitted
    if(type == "-1")
    {
        //show error message and mark input invalid
        document.getElementById("type_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("type_error").style.display = "none";
    }//end else
    
    //ensure start date is submitted
    if(start === "" || !isValidDate(start))
    {
        //show error message and mark input invalid
        document.getElementById("start_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
       document.getElementById("start_error").style.display = "none";
    }//end else
    
     //ensure end date is submitted
    if(end === "" || !isValidDate(end))
    {
        //show error message and mark input invalid
        document.getElementById("end_error").style.display = "block";
        isValid = false;
    }//end if
    else
    {
       document.getElementById("end_error").style.display = "none";
    }//end else
    return isValid;
}//close validateReportSubmission


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