<?php
    /**
     * CreateUser.php
     * This file, written in procedural language (not object-oriented), is used to add
     * a user to the FLEX application. It will process the create user form fields on
     * the profile.html page. Note: This is intended to be an action script
     * 
     * Author: Davis Doherty
     * Last Updated: 2/28/18 DD
     **/

    //include script to ensure no unauthorized access
    //require("IsLoggedIn.php");

    //display php errors
    $ERRORS_ON = false;
    
    if($ERRORS_ON)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }//end if

    //include access to the communication module
    require_once("CommunicationModule.php");

    //only run if form was submitted
    if(isset($_POST['fuID']))
    {
        //establish connection to communication module for database connection
        $com = new CommunicationModule("b16_21592498_FLEX");
        
        //flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $ffldID = trim($_POST['fuID']);           //fairfield id
        $user = trim($_POST['username']);         //new username
        $pass = trim($_POST['password']);         //new password
        $fName = trim($_POST['firstname']);       //first name
        $lName = trim($_POST['lastname']);        //last name
        $dob = trim($_POST['DOB']);               //date of birth
        $gender = trim($_POST['gender']);         //gender
        $heightft = trim($_POST['heightft']);     //height in ft
        $heightin = trim($_POST['heightin']);     //height in inches
        $weight = trim($_POST['weight']);         //weight in pounds
        $religion = trim($_POST['religion']);     //religious prefrence
        $phone = trim($_POST['phone']);           //phone number
        $email = trim($_POST['email']);           //email
        $class = trim($_POST['year']);            //student class year
        $school = trim($_POST['school']);         //school
        $dept = trim($_POST['dept']);             //department
        $residence = trim($_POST['res']);         //campus residence
        $maj1 = trim($_POST['major1']);           //primary major
        $maj2 = trim($_POST['major2']);           //other major
        $maj3 = trim($_POST['major3']);           //other major
        $min1 = trim($_POST['minor1']);           //primary minor
        $min2 = trim($_POST['minor2']);           //other minor
        $min3 = trim($_POST['minor3']);           //other minor
        $min4 = trim($_POST['minor4']);           //other minor

        //ensure fairfield id is 8 characters long and only numbers
        if(strlen($ffldID)==8 && ctype_digit($ffldID))
        {
            //escape ID since user inputted
            $ffldID = $com->sanitizeString($ffldID);

            //check to see if user with fairfield ID already exists
            $result = mysqli_fetch_array($com->queryDatabase("SELECT * FROM USER_CREDENTIALS WHERE CRED_FFLD_ID='$ffldID'"));

            if(is_array($result))
            {
                //flag data as incomplete
                $isValid = false;
                header("Location: ../pages/createuser.php?status=fail-id");
                exit();
            }//end if
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else

        //ensure email submitted
        if(!empty($email))
        {
            //escape email since user inputted
            $email = $com->sanitizeString(substr($email,0,50));

            //if email not formatted properly
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                //flag data as incomplete
                $isValid = false;
            }//end if

            //if email formatted properly, check for uniqueness
            else
            {
                //check to see if user with email already exists
                $result = mysqli_fetch_array($com->queryDatabase("SELECT * FROM USER_INFORMATION WHERE USER_EMAIL='$email'"));

                if(is_array($result))
                {
                    //flag data as incomplete
                    $isValid = false;
                    header("Location: ../pages/createuser.php?status=fail-email");
                    exit();
                }//end if
            }//else
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else
        
        //check if username submitted
        if(!empty($user))
        {
            //trim username of new user to size, then sanitize since user input
            $user = $com->sanitizeString(substr($user,0,80));

            //ensure new username not taken yet
            $result = mysqli_fetch_array($com->queryDatabase("SELECT * FROM USER_CREDENTIALS WHERE CRED_USER='$user'"));
            if(is_array($result))
            {
                //flag data as incomplete
                $isValid = false;
                header("Location: ../pages/createuser.php?status=fail-user");
                exit();
            }//end if
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else
        
        //ensure password submitted
        if(!empty($pass))        
        {
            //hash password to encript
            $pass = hash("sha512", $pass);
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else

        //ensure first and last names submitted
        if(!empty($fName) && !empty($lName))
        {
            //trim first and last names of new user to size, then sanitize since user input
            $fName = $com->sanitizeString(substr($fName,0,50));
            $lName = $com->sanitizeString(substr($lName,0,50));
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else

        //ensure date of birth submitted
        if(!empty($dob))
        {
            //convert user inputted date of birth to datetime object
            $dob = date_create_from_format('Y-m-d', $dob);
            
            //if date cannot be converted
            if($dob===false)
            {
                //flag data as incomplete
                $isValid = false;
            }//end if
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else
       
        //ensure height was submitted in totality
        if($heightft!="-1" && $heightin!="-1")
        {
            //convert height from feet and inches to only inches
            $height = ($heightft * 12) + $heightin;
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else

        //check if weight submitted
        if(!empty($weight))
        {
            //convert weight to integer, then sanitize since user input
            $weight = (int) $com->sanitizeString(substr($weight,0,3));

             //if weight cannot be converted
            if($weight==0)
            {
                //flag data as incomplete
                $isValid = false;
            }//end if
        }//end if

        //ensure phone number submitted
        if(!empty($phone))
        {
            //sanitize phone since user submitted
            $phone = $com->sanitizeString(substr($phone,0,15));

            //validate phone is in proper format
            if (preg_match('/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/', $phone) != 1)
            {
                //flag data as incomplete
                $isValid = false;
            }//end if
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else

        //determine user role
        if(strpos($email, '@fairfield.edu') !== false)
        {
            //faculty email
            $role = 0;
        }//end if
        else if(strpos($email, '@student.fairfield.edu') !== false)
        {
           //student email
           $role = 1;
        }//end if
        else
        {
            //not a fairfield email
            $role = "-1";
            $isValid = false;
        }//end else
   
        //ensure fields submitted that require no action
        if($gender=="-1" || $school=="-1")
        {
            //flag data as incomplete
            $isValid = false;
        }//end if

        //if role in fairfield and data is valid, begin to build sql statements
        if($isValid && $role!="-1")
        {
            //build sql statement based on role and required fields
            $createUserSQL = "INSERT INTO USER_INFORMATION VALUES ('$ffldID', '$fName', '$lName', '".date_format($dob,"Y-m-d")."', '$gender', '$phone', '$email', '$school', '$role', NULL, '$height', ";
            $createCredSQL = "INSERT INTO USER_CREDENTIALS (CRED_USER, CRED_PASS, CRED_FFLD_ID) VALUES ('$user', '$pass', '$ffldID')";

            //add fields that apply to all users but are not required
            if($weight == "")
            {
                $createUserSQL = $createUserSQL."NULL, ";
            }//end if
            else
            {
                $createUserSQL = $createUserSQL."'$weight', ";
            }//end else

            if($religion == "-1")
            {
                $createUserSQL = $createUserSQL."NULL, ";
            }//end if
            else
            {
                $createUserSQL = $createUserSQL."'$religion', ";
            }//end else

            //continue to build sql based on role
            if($role == 0)    //facstaff
            {
                $createUserSQL = $createUserSQL."'$dept', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ";
            }//end if

            //student
            else if($role == 1)
            {
                $createUserSQL = $createUserSQL."NULL, '$class', '$residence', '$maj1', ";

                //test second major
                if($maj2 == "-1")
                {
                    $createUserSQL = $createUserSQL."NULL, ";
                }//end if
                else
                {
                    $createUserSQL = $createUserSQL."'$maj2', ";
                }//end else

                //test third major
                if($maj3 == "-1")
                {
                    $createUserSQL = $createUserSQL."NULL, ";
                }//end if
                else
                {
                    $createUserSQL = $createUserSQL."'$maj3', ";
                }//end else

                //test first minor
                if($min1 == "-1")
                {
                    $createUserSQL = $createUserSQL."NULL, ";
                }//end if
                else
                {
                    $createUserSQL = $createUserSQL."'$min1', ";
                }//end else

                //test second minor
                if($min2 == "-1")
                {
                    $createUserSQL = $createUserSQL."NULL, ";
                }//end if
                else
                {
                    $createUserSQL = $createUserSQL."'$min2', ";
                }//end else

                //test third minor
                if($min3 == "-1")
                {
                    $createUserSQL = $createUserSQL."NULL, ";
                }//end if
                else
                {
                    $createUserSQL = $createUserSQL."'$min3', ";
                }//end else

                //test fourth minor
                if($min4 == "-1")
                {
                    $createUserSQL = $createUserSQL."NULL, ";
                }//end if
                else
                {
                    $createUserSQL = $createUserSQL."'$min4', ";
                }//end else
            }//end if

            //concluse sql by filling in linked account info
            $createUserSQL = $createUserSQL."NULL, NULL, NULL, NULL, NULL, NULL)";

            //flag for database query results
            $userCreated;
            $credCreated;

            //create new user profile
            $userCreated = $com->queryDatabase($createUserSQL);

            //if user created successfully
            if($userCreated)
            {
                //create credentials
                $credCreated = $com->queryDatabase($createCredSQL);
            }//end if

            //if user profile and account successfully created
            if($userCreated && $credCreated)
            {
                header("Location: ../pages/createuser.php?status=success");
                exit();
            }//end if
            else
            {                
                header("Location: ../pages/createuser.php?status=fail-server");
                exit();
            }//end else
        }//end if
        else
        {
            header("Location: ../pages/createuser.php?status=fail-unknown");
            exit();
        }//end else
    }//end if

    //if no form submitted
    else
    {
        //redirect to home page
        header("Location: ../pages/home.php");
    }//end else
?>