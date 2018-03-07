<?php
    /**
	 * Profile.php
	 * This file is used to fill in the user profile with the data the user 
	 * input during the inital login.  This will allow the user to make changes to 
	 * their profile.
	 * 
	 * Author: Jaclyn Cuevas
	 * Last Updated: 3/7/18 JC 
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
	 
	//connect to communicaiton module to connect with database 
	$com = new CommunicationModule("b16_21592498_FLEX");
	 
	//query database for all user credentials 
	$result = mysqli_fetch_array($com->queryDatabase("SELECT * FROM USER_CREDENTIALS WHERE CRED_FFLD_ID='$ffldID'"));
	 
	 
	$ffldId = $result['USER_FFLD_ID'];
	$fname = $result['USER_FNAME'];
	$lname = $result['USER_LNAME'];
	$dob = $result['USER_DOB'];
	$gender = $result['USER_GENDER'];
	$heightft = $result['USER_HEIGHT'] / 12;
	$heightin = $result['USER_HEIGHT'] % 12;
	$weight = $result['USER_WEIGHT']; //may be null
	$religion = $result['USER_RELIGIOUS_PREFERENCE']; //may be null
	$phone = $result['USER_PHONE'];
	$email = $result['USER_EMAIL'];
	$class = $result['USER_CLASS_YEAR'];
	$school = $result['USER_SCHOOL'];
	$dept = $result['USER_DEPARTMENT'];
	$residence = $result['USER_RESIDENCE'];
	$maj1 = $result['USER_MAJOR1'];
	$maj2 = $result['USER_MAJOR2'];
	$maj3 = $result['USER_MAJOR3'];
	$min1 = $result['USER_MINOR1'];
	$min2 = $result['USER_MINOR2'];
	$min3 = $result['USER_MINOR3'];
	$min4 = $result['USER_MINOR4'];
	
	
	
	
	
	
	
	 
	 
?>