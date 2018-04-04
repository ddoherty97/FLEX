<?php
	/**
     * Fitness Tracking Module (FitnessTrackingModule.php)
     * This class allows the user to track their fitness based activities
     * Author: Jaclyn Cuevas
     * Last Updated: 3/27/18 JC
     **/

	require_once("CommunicationModule.php");
	
	class FitnessTrackingModule
	{
		private $comMod;    //communication module to interact with database
        private $dataOwner; //owner of the goal
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the fitness tracking module
         * Parameters: none
         * Exceptions: user is not logged in
         **/
		function __construct()
        {
            //create communication object
            $this->comMod = new CommunicationModule();

            //get owner of goal if logged in
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
         * addFitnessData()
         * This method adds the fitness data of the user
         * Parameters:  $date->date the user completed activity
		  * 			$startTime->time user started activity
		  * 			$endTime->time user ended activity
		  * 			$type->type of fitness activity the user completed
		  * 			$notes->other notes about fitness activity
         * Exceptions: user is not logged in
         **/
		function addFitnessData($date, $startTime, $endTime, $type, $milestone, $notes)
		{
			//calculate activity duration from start and end times
            $time = $startTime->diff($endTime);
			$hours = $time->format('%h');
			$minutes = $time->format('%i');
            $duration = ($hours * 60) + $minutes;
            
            date_default_timezone_set('America/New_York');
            $submitted = date("Y-m-d H:i:s");
			
            //build SQL to insert data into database
			$sql = "INSERT INTO FITNESS_DATA    (FITNESS_DATA_OWNER, FITNESS_ACTIVITY_DATE, FITNESS_ACTIVITY_DURATION, FITNESS_ACTIVITY_TYPE, FITNESS_ACTIVITY_MILESTONE, FITNESS_ACTIVITY_OTHER, FITNESS_ACTIVITY_SUBMITTED_TIME)
					VALUES 					    ('$this->dataOwner', '$date', '$duration', '$type', '$milestone', '$notes', '$submitted')";
					
			//query database
            $this->comMod->queryDatabase($sql);
		}//close addFitnessData
    }//close FitnessTrackingModule	
    
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $mod = new FitnessTrackingModule();
    $date = date("2018-03-15");
    $start = new DateTime("14:15");
    $end = new DateTime("15:20");
    $type = "test data";
    $notes = "test data notes here";

     $mod->addFitnessData($date, $start, $end, $type, $notes);
?>