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

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
   
    echo "begin<br>";

    //include access to the communication module
    require_once("CommunicationModule.php");

    //only run if form was submitted
    if(isset($_POST['fuID']))
    {
        echo "post set<br>";

        //establish connection to communication module for database connection
        $com = new CommunicationModule("b16_21592498_FLEX");
        
        //flag to ensure proper valudation of all fields
        $isValid = true;
        
        //get submitted form data
        $ffldID = $_POST['fuID'];           //fairfield id
        $user = $_POST['username'];         //new username
        $pass = $_POST['password'];         //new password
        $fName = $_POST['firstname'];       //first name
        $lName = $_POST['lastname'];        //last name
        $dob = $_POST['DOB'];               //date of birth
        $gender = $_POST['gender'];         //gender
        $heightft = $_POST['heightft'];     //height in ft
        $heightin = $_POST['heightin'];     //height in inches
        $weight = $_POST['weight'];         //weight in pounds
        $religion = $_POST['religion'];     //religious prefrence
        $phone = $_POST['phone'];           //phone number
        $email = $_POST['email'];           //email
        $class = $_POST['year'];            //student class year
        $school = $_POST['school'];         //school
        $dept = $_POST['dept'];             //department
        $residence = $_POST['res'];         //campus residence
        $maj1 = $_POST['major1'];           //primary major
        $maj2 = $_POST['major2'];           //other major
        $maj3 = $_POST['major3'];           //other major
        $min1 = $_POST['minor1'];           //primary minor
        $min2 = $_POST['minor2'];           //other minor
        $min3 = $_POST['minor3'];           //other minor
        $min4 = $_POST['minor4'];           //other minor

        echo "all values collected<br>";

        echo "analysing ffld id<br>";
        //ensure fairfield id is 8 characters long and only numbers
        if(strlen($ffldID) == 8 && ctype_digit($ffldID))
        {
            
            //escape ID since user inputted
            $ffldID = $com->sanitizeString($ffldID);

            //check to see if user with fairfield ID already exists
            $result = mysqli_fetch_array($com->queryDatabase("SELECT * FROM USER_CREDENTIALS WHERE CRED_FFLD_ID='$ffldID'"));

            if(is_array($result))
            {
                //flag data as incomplete
                $isValid = false;
                echo "invalid: ffld id exists<br>";
            }//end if
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
            echo "invalid: ffld is not formatted correctly<br>";
        }//end else

        echo "analysing username<br>";

        //check if username submitted
        if($user != "")
        {
            //trim username of new user to size, then sanitize since user input
            $user = $com->sanitizeString(substr(trim($user),0));

            //ensure new username not taken yet
            $result = mysqli_fetch_array($com->queryDatabase("SELECT * FROM USER_CREDENTIALS WHERE CRED_USER='$user'"));
            if(is_array($result))
            {
                //flag data as incomplete
                $isValid = false;
                echo "invalid: username taken<br>";
            }//end if
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else
        
        echo "analysing password<br>";

        //ensure password submitted
        if($pass != "")        
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
        if($fName!="" && $lName!="")
        {
            //trim first and last names of new user to size, then sanitize since user input
            $fName = $com->sanitizeString(substr(trim($fName),0));
            $lName = $com->sanitizeString(substr(trim($lName),0));
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else

        //ensure date of birth submitted
        if($dob != "")
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
       
        echo "analysing height<br>";

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
        if($weight != "")
        {
            //convert weight to integer, then sanitize since user input
            $weight = (int) $com->sanitizeString(substr(trim($weight),0));

             //if weight cannot be converted
            if($weight==0)
            {
                //flag data as incomplete
                $isValid = false;
            }//end if
        }//end if

        echo "analysing phone<br>";

        //ensure phone number submitted
        if($phone != "")
        {
            //NEED TO FIX PHONE
            //var_dump($phone);
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else
       
        echo "analysing email<br>
        ";
        //ensure email submitted
        if($email != "")
        {
            //NEED TO FIX EMAIL
            //var_dump($email);
        }//end if
        else
        {
            //flag data as incomplete
            $isValid = false;
        }//end else

        echo "determining role<br>";

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

        echo "determining to proceed<br>role=".$role.", valid=".$isValid."<br>";
        var_dump($isValid);

        //if role in fairfield and data is valid, begin to build sql statements
        if($isValid && $role!="-1")
        {
            echo "building sql statements<br>";

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
                //redirect to home page
                header("Location: ../pages/createuser.php?newaccount=success");
            }//end if
            else
            {
                //reload account creation page
                echo "userCreated=".$userCreated."<br>credCreated=".$credCreated."<br>";
                echo "userSQL=".$createUserSQL."<br>";
                echo "credSQL=".$createCredSQL."<br>";
                
                //header("Location: ../page/createuser.php?newaccount=fail");
            }//end else
        }//end if
    }//end if

    //if no form submitted
    else
    {
        //redirect to home page
        header("Location: ../page/home.php");
    }//end else
?>