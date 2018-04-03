<?php
	/**
     * Mental Tracking Module (MentalTrackingModule.php)
     * This class allows the user to track their mental health based activities
     * Author: Jaclyn Cuevas
     * Last Updated: 4/2/18 JC
     **/

	require_once("CommunicationModule.php");
	
	class MentalTrackingModule
	{
		private $comMod;    //communication module to interact with database
        private $dataOwner; //owner of the data
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the mental tracking module
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
         * addMentalData()
         * This method adds the mental data of the user
         * Parameters:  $date->date user completed activity
		  * 			$startTime->time user started activity
		  * 			$endTime->time user ended activity
		  * 			$notes->notes about mental activity
		  * 			$level->stress level of user
		  * 			$factors->factors contributing to stress level
		  * 			$other->other notes about mental activity/stress level
         * Exceptions: user is not logged in
         **/
		function addMentalData($date, $startTime, $endTime, $notes, $level, $factors, $other)
		{
			//calculate activity duration from start and end times
            $time = $startTime->diff($endTime);
			$hours = $time->format('%h');
			$minutes = $time->format('%i');
            $duration = ($hours * 60) + $minutes;
            
            date_default_timezone_set('America/New_York');
            $submitted = date("Y-m-d H:i:s");
			
            //build SQL to insert data into database
			$sql = "INSERT INTO MENTAL_DATA    (MENTAL_DATA_OWNER, MENTAL_COUNSELING_DATE, MENTAL_COUNSELING_DURATION, MENTAL_COUNSELING_NOTES, MENTAL_STRESS_LEVEL, MENTAL_STRESS_FACTORS, MENTAL_STRESS_OTHER, MENTAL_DATA_TIMESTAMP)
					VALUES 					   ('$this->dataOwner', '$date', '$duration', '$notes', '$level', '$factors', '$other', '$submitted')";
					
			//query database
            $this->comMod->queryDatabase($sql);
		}//close addMentalData
    }//close MentalTrackingModule	
    
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    /*$mod = new FitnessTrackingModule();
    $date = date("2018-03-15");
    $start = new DateTime("14:15");
    $end = new DateTime("15:20");
    $type = "test data";
    $notes = "test data notes here";*/

    // $mod->addFitnessData($date, $start, $end, $type, $notes);
?>