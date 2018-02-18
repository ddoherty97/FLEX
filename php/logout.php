<?php
     /**
     * logout.php
     * This file, written in procedural language (not object-oriented), can be called from anywhere to
     *      log a user out of the system.
     * Author: Davis Doherty
     * Last Updated: 2/17/18 DD
     **/
    
    session_start();                    //temporarily start a php session
	session_unset();					//destroy all php variables
	session_destroy();					//destroy php session
	$_SESSION = array();				//override any existing stored information
	
	$redirectURL = "../index.php";		//url where to redirect user after successful logout
	header("location:".$redirectURL);	//redirect user after successful logout
?>