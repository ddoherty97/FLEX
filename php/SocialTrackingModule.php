<?php
	/**
     * Social Tracking Module (SocialTrackingModule.php)
     * This class allows the user to track their social activities
     * Author: Jaclyn Cuevas
     * Last Updated: 4/2/18 JC
     **/

	require_once("CommunicationModule.php");
	
	class SocialTrackingModule
	{
		private $comMod;    //communication module to interact with database
        private $dataOwner; //owner of the data
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the social tracking module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
		function __construct()
        {
            //create communication object
            $this->comMod = new CommunicationModule();

            //get owner of data if logged in
            if(isset($_SESSION['ffld_id']))
            {
                $this->dataOwner = $_SESSION["ffld_id"];
            }//end if
            else
            {
                echo "ERROR: This resource cannot be accessed unless logged in.<br>";
                exit();
            }//end else            
        }//close constructor
        
         /**
         * addSocialData()
         * This method adds the social data of the user
         * Parameters:  $date->date the user completed activity
		  * 			$name->name of activity
		  * 			$location->location of activity
		  * 			$startTime->time user started activity
		  * 			$endTime->time user ended activity
		  * 			$type->type of social activity the user completed
		  * 			$notes->other notes about social activity
         * Exceptions: user is not logged in
         **/
		function addSocialData($date, $name, $location, $startTime, $endTime, $type, $notes)
		{
			//calculate activity duration from start and end times
            $time = $startTime->diff($endTime);
			$hours = $time->format('%h');
			$minutes = $time->format('%i');
            $duration = ($hours * 60) + $minutes;
            
            date_default_timezone_set('America/New_York');
            $submitted = date("Y-m-d H:i:s");
			
            //build SQL to insert data into database
			$sql = "INSERT INTO SOCIAL_DATA    (SOCIAL_DATA_OWNER, SOCIAL_ACTIVITY_DATE, SOCIAL_ACTIVITY_DURATION, SOCIAL_ACTIVITY_TITLE, SOCIAL_ACTIVITY_LOCATION, SOCIAL_ACTIVITY_TYPE, SOCIAL_ACTIVITY_NOTES, SOCIAL_DATA_TIMESTAMP)
					VALUES 					   ('$this->dataOwner', '$date', '$duration', '$name', '$location', '$type', '$notes', '$submitted')";
					
			//query database
            $this->comMod->queryDatabase($sql);
		}//close addSocialData
    }//close SocialTrackingModule	
    
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $mod = new SocialTrackingModule();
    $date = date("2018-04-04");
    $start = new DateTime("15:15");
    $end = new DateTime("17:20");
	$location = "llbcc";
	$name = "name of event";
    $type = "test data";
    $notes = "test data notes here";

    $mod->addSocialData($date, $name, $location, $start, $end, $type, $notes);
?>