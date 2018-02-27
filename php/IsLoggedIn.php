<?php
    /**
     * IsLoggedIn.php
     * This file, written in procedural language (not object-oriented), is used to
     * ensure that the user who browsed to the page is logged in to the application.
     * Users who are not logged in will be directed to the home page, and nothing
     * will happen to validated users. Note: This should be included at the top of
     * every php page to avoid the unauthorized running of scripts.
     * 
     * Author: Davis Doherty
     * Last Updated: 2/26/18 DD
     **/

    //get current time
	$now = time();

	//if no session is active (i.e. no session variables set yet),
	//OR last activity was greater than timeout time, logout of app
	if(!isset($_SESSION['cred_id']) || $now>$_SESSION['expire'])
		header("Location: ../php/logout.php");
	
	//if user logged in
	else
	{
		//get the current time and assign to session variable
		$_SESSION['last_activity'] = $now;

		//set next time for session to expire
        $_SESSION['expire'] = $_SESSION['last_activity'] + ($_SESSION['timeout'] * 60);
	}//end else
?>