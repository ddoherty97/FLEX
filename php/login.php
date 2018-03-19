<?php
    /**
     * login.php
     * This file, written in procedural language (not object-oriented), should be included at the
     *      beginning of the login webpage. It will process the username/password form fields to
     *      validate user login.
     * Author: Davis Doherty
     * Last Updated: 3/19/18 DD
     **/
   
    //file needs to communicate with database
    require_once("CommunicationModule.php");

    //start a new php session if one is not yet active
	if(!isset($_SESSION)) 
    {
        session_start();
    }//end if

    //if user is already logged in, redirect to home page
    if(isset($_SESSION["cred_id"]))
    {
        header("Location: ../home.html");
    }//end if

    //initalize connection to communication module
    $communication = new CommunicationModule("b16_21592498_FLEX");

    //initialize error message to user
	$message="";

    //name of username and password form field
    $formUsernameName = "formUser";
    $formPasswordName = "formPass";

	//if user has submitted login form
	if(count($_POST)>0)
	{	
		//collect supplied credentials
        $user = $_POST[$formUsernameName];
        $pass = $_POST[$formPasswordName];

		//hash password to encript
        $password = hash("sha512", $pass);

		//check to see if valid user credentials
		$loginQuery = "SELECT * FROM USER_CREDENTIALS WHERE CRED_USER='$user' AND BINARY CRED_PASS='$password'";
        $queryResult = $communication->queryDatabase($loginQuery);
        
        //convert query result into array
        $userRow = mysqli_fetch_array($queryResult);
		
		//if a row contains both username and password
		if(is_array($userRow))
		{
            //set default logout time
            $timeoutMin = 30;
            
            //set session variables
			$_SESSION["cred_id"] = $userRow['CRED_ID'];                             //id of record in database
            $_SESSION["user_name"] = $userRow['CRED_USER'];                         //username from database
			$_SESSION['ffld_id'] = $userRow['CRED_FFLD_ID'];                        //fairfield id used to link to user table
			$_SESSION['last_login'] = $userRow['CRED_LAST_LOGIN'];                  //last login date of user
			$_SESSION["last_activity"] = time();                                    //last time user loaded a page
            $_SESSION["expire"] = $_SESSION['last_activity'] + ($timeoutMin * 60);  //when to autologout user (30 minutes)
            $_SESSION["timeout"] = $timeoutMin;                                     //save timeout duration for later scripts
            header("Location: ../home.php");                                        //once logged in, go to home page
		}//end if
		
		//if no matching user, display error message
        else
        {
            $message = "Incorrect Username or Password! Please Try Again.";
        }//end else
	}//end if
?>