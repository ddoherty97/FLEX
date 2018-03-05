/**
 * createuser.js
 * This file contains functions that are used to ensure the user submits
 *      all required form fields on signup. It also changes form fields
 *      when appropriate
 * 
 * Author: Davis Doherty
 * Last Updated: 3/4/18 DD
 **/

/**
 * validateUserSubmission()
 * This method checks the required form fields to ensure they are
 *      all filled out and displays errors when they are not
 * Parameters:  None
 * Returns: TRUE if all form fields valid, FALSE otherwise
 * Exceptions: None
 **/
function validateUserSubmission()
{
    //get all form fields
    var fuID = document.getElementById("fuID").value.trim();              //fairfield id
    var email = document.getElementById("email").value.trim();            //new user email
    var username = document.getElementById("username").value.trim();      //new user username
    var pass = document.getElementById("password").value.trim();          //new user password
    var confirmpass = document.getElementById("cpassword").value.trim();  //confirmation of new user password
    var fName = document.getElementById("firstname").value.trim();        //new user first name
    var lName = document.getElementById("lastname").value.trim();         //new user last name
    var dob = document.getElementById("DOB").value.trim();                //new user date of birth
    var gender = document.getElementById("gender").value.trim();          //new user gender
    var heightft = document.getElementById("heightft").value.trim();      //new user height in feet
    var heightin = document.getElementById("heightin").value.trim();      //new user height in inches
    var weight = document.getElementById("weight").value.trim();          //new user weight
    var religion = document.getElementById("religion").value.trim();      //new user religious preference
    var phone = document.getElementById("phone").value.trim();            //new user phone number
    var classyear = document.getElementById("year").value.trim();         //new user class year
    var school = document.getElementById("school").value.trim();          //new user school
    var dept = document.getElementById("dept").value.trim();              //new user department
    var res = document.getElementById("res").value.trim();                //new user residency
    var maj1 = document.getElementById("major1").value.trim();            //new user first major
    var maj2 = document.getElementById("major2").value.trim();            //new user second major
    var maj3 = document.getElementById("major3").value.trim();            //new user third major
    var min1 = document.getElementById("minor1").value.trim();            //new user first minor
    var min2 = document.getElementById("minor2").value.trim();            //new user second minor
    var min3 = document.getElementById("minor3").value.trim();            //new user third minor
    var min4 = document.getElementById("minor4").value.trim();            //new user fourth minor
    var role = -1;                                                        //new user role (facstaff/student)

    //flag to ensure all data accurate
    var isValid = true;
    
    //ensure all fields are filled out and contain valid data
    if(fuID.length!=8 || isNaN(fuID))
    {
        //show error message and mark input invalid
        document.getElementById("fuID_error").innerHTML = "You must enter an 8 digit ID.";
        isValid = false;
    }//end if
    else
    {
        //hide error message
        document.getElementById("fuID_error").innerHTML = "";
    }//end else

    //ensure email is a valid email
    if(!isValidEmail(email))
    {
        //show error message and mark input invalid
        document.getElementById("email_error").innerHTML = "You must enter a valid Fairfield email address.";
        isValid = false;
    }//end if
    else
    {
        //determine user role
        role = getRoleFromEmail(email);

        //if not fairfield email
        if(role == -1)
        {
            //show error message and mark input invalid
            document.getElementById("email_error").innerHTML = "Non-Fairfield email addresses are not accepted.";
            isValid = false;
        }//end if
        else
        {
            //hide error message
            document.getElementById("email_error").innerHTML = "";
        }//end else
    }//end else

    //ensure username is submitted
    if(username==="")
    {
        //show error message and mark input invalid
        document.getElementById("username_error").innerHTML = "You must enter a username.";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("username_error").innerHTML = "";
    }//end else

    //confirm that both passwords are entered and are the same
    if(pass==="")
    {
        //show error message and mark input invalid
        document.getElementById("password_error").innerHTML = "You must enter a password.";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("password_error").innerHTML = "";

        if(confirmpass==="")
        {
            //show error message and mark input invalid
            document.getElementById("confirm_error").innerHTML = "You must confirm your password.";
            isValid = false;
        }//end if
        else
        {
            if(pass !== confirmpass)
            {
                //show error message and mark input invalid
                document.getElementById("confirm_error").innerHTML = "Passwords do not match!";
                isValid = false;
            }//end if
            else
            {
                document.getElementById("confirm_error").innerHTML = "";
            }//end else
        }//end else
    }//end else

    //ensure first name submitted
    if(fName==="")
    {
        //show error message and mark input invalid
        document.getElementById("fname_error").innerHTML = "You must enter your first name.";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("fname_error").innerHTML = "";
    }//end else

    //ensure last name submitted
    if(lName==="")
    {
        //show error message and mark input invalid
        document.getElementById("lname_error").innerHTML = "You must enter your last name.";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("lname_error").innerHTML = "";
    }//end else

    //ensure date submitted
    if(dob==="")
    {
        //show error message and mark input invalid
        document.getElementById("dob_error").innerHTML = "You must enter your date of birth.";
        isValid = false;
    }//end if
    else
    {
        //check to make sure valid date
        if(isValidDate(dob))
        {
            document.getElementById("dob_error").innerHTML = "";
        }//end if
        else
        {
            //show error message and mark input invalid
            document.getElementById("dob_error").innerHTML = "You must enter a valid date in the form yyyy-mm-dd.";
            isValid = false;
        }//end else
    }//end else

    //ensure user selected gender
    if(gender=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("gender_error").innerHTML = "You must select your gender.";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("gender_error").innerHTML = "";
    }//end else

    //ensure height is submitted
    if(heightft=="-1" || heightin=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("height_error").innerHTML = "You must select your height.";
        isValid = false;
    }//end if
    else
    {
        document.getElementById("height_error").innerHTML = "";
    }//end else

    //ensure phone number is submitted and valid
    if(!isValidPhone(phone))
    {
        //show error message and mark input invalid
        document.getElementById("phone_error").innerHTML = "You must enter a valid phone number.";
        isValid = false;
    }//end if
    else
    {
        //hide error message
        document.getElementById("phone_error").innerHTML = "";
    }//end else

    //ensure user supplied school
    if(school=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("school_error").innerHTML = "You must select your school.";
        isValid = false;
    }//end if
    else
    {
        //hide error message
        document.getElementById("school_error").innerHTML = "";
    }//end else

    //if student, ensure user suppied class year
    if(role==1 && classyear=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("class_error").innerHTML = "You must select your class year.";
        isValid = false;
    }//end if
    else
    {
        //hide error message
        document.getElementById("class_error").innerHTML = "";
    }//end else

    //if facstaff, ensure user supplied department
    if(role==0 && dept=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("dept_error").innerHTML = "You must select your department.";
        isValid = false;
    }//end if
    else
    {
        //hide error message
        document.getElementById("dept_error").innerHTML = "";
    }//end else

    //if student, ensure user supplied residence
    if(role==1 && res=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("res_error").innerHTML = "You must select your residence.";
        isValid = false;
    }//end if
    else
    {
        //hide error message
        document.getElementById("res_error").innerHTML = "";
    }//end else

    //if student, ensure user suppplied at least 1 major
    if(role==1 && maj1=="-1")
    {
        //show error message and mark input invalid
        document.getElementById("maj1_error").innerHTML = "You must select at least one major.";
        isValid = false;
    }//end if
    else
    {
        //hide error message
        document.getElementById("maj1_error").innerHTML = "";
    }//end else

    //return validity of form fields
    return isValid;
}//close validateUserSubmission

/**
 * isValidEmail()
 * This method checks to see if the supplied text is in the form
 *      of a valid email address
 * Parameters:  email->email address to validate
 * Returns: TRUE if valid email address, FALSE otherwise
 * Exceptions: None
 **/
function isValidEmail(address)
{
    //if submitted email does not match regular expression for emails
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(address))
    {
        return true;
    }//end if
    else
    {
        return false;
    }//end else
}//end isValidEmail

/**
 * getRoleFromEmail()
 * This method determines whether the supplied email address
 *      belongs to a facstaff member, student, or neither
 * Parameters:  address->email address to get role from
 * Returns: 0 if facstaff, 1 if student, -1 otherwise
 * Exceptions: None
 **/
function getRoleFromEmail(address)
{
    //facstaff email suffix
    if(address.includes("@fairfield.edu"))
    {
        return 0;
    }//end if

    //student email suffix
    else if(address.includes("@student.fairfield.edu"))
    {
        return 1;
    }//end if

    //if not fairfield email
    else
    {
        return -1;
    }//end else
}//close getRoleFromEmail

/**
 * isValidPhone()
 * This method checks to see if the supplied text is in the form
 *      of a valid phone number
 * Parameters:  number->phone number to validate
 * Returns: TRUE if valid phone number, FALSE otherwise
 * Exceptions: None
 **/
function isValidPhone(number)
{
     //if submitted phone number does not match regular expression for phones
     if (/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(number))
     {
         return true;
     }//end if
     else
     {
         return false;
     }//end else
}//close isValidPhoneNumber


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
 * showUserSpecificFields()
 * This method runs once the new user enters their email and will
 *      hide/show the relavent fields
 * Parameters:  None
 * Returns: None
 * Exceptions: None
 **/
function showUserSpecificFields()
{
    //get email field
    var email = document.getElementById("email").value.trim();

    //determine user role
    var role = getRoleFromEmail(email);

    //get all student fields
    var studentFields = document.getElementsByClassName("studentRole");

    //get all facstaff fields
    var facstaffFields = document.getElementsByClassName("facstaffRole");

    //if user is a student
    if(role == 1)
    {
        //hide all facstaff fields
        for(var i=0; i<facstaffFields.length; i++)
        {
            facstaffFields[i].style.display = "none";
        }//end for

        //show all student fields
        for(var i=0; i<studentFields.length; i++)
        {
            studentFields[i].style.display = "block";
        }//end for
    }//end if

    //if user is facstaff
    else if(role == 0)
    {
        //hide all student fields
        for(var i=0; i<studentFields.length; i++)
        {
            studentFields[i].style.display = "none";
        }//end for

        //show all facstaff fields
        for(var i=0; i<facstaffFields.length; i++)
        {
            facstaffFields[i].style.display = "block";
        }//end for
    }//end if

    //if not a fairfield user
    else
    {
        //hide all student fields
        for(var i=0; i<studentFields.length; i++)
        {
            studentFields[i].style.display = "none";
        }//end for

        //hide all facstaff fields
        for(var i=0; i<facstaffFields.length; i++)
        {
            facstaffFields[i].style.display = "none";
        }//end for
    }//end else
}//close showUserSpecificFields