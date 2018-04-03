<?php
	/**
     * Spiritual Tracking Module (SpiritualTrackingModule.php)
     * This class allows the user to track their spiritual based activities
     * Author: Jaclyn Cuevas
     * Last Updated: 4/3/18 DD
     **/

	require_once("CommunicationModule.php");
	
	class SpiritualTrackingModule
	{
		private $comMod;    //communication module to interact with database
        private $dataOwner; //owner of the data
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the spiritual tracking module
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
         * addSpiritualData()
         * This method adds the spiritual data of the user
         * Parameters:  $date->date the user completed activity
		  * 			$startTime->time user started activity
		  * 			$endTime->time user ended activity
		  * 			$type->type of spiritual activity the user completed
		  * 			$notes->other notes about spiritual activity
         * Exceptions: user is not logged in
         **/
		function addSpiritualData($date, $name, $location, $startTime, $endTime, $type, $notes)
		{
			//calculate activity duration from start and end times
            $time = $startTime->diff($endTime);
			$hours = $time->format('%h');
			$minutes = $time->format('%i');
            $duration = ($hours * 60) + $minutes;
            
            date_default_timezone_set('America/New_York');
            $submitted = date("Y-m-d H:i:s");
			
            //build SQL to insert data into database
			$sql = "INSERT INTO SPIRITUAL_DATA  (SPIRITUAL_DATA_OWNER, SPIRITUAL_ACTIVITY_DATE, SPIRITUAL_ACTIVITY_TITLE, SPIRITUAL_ACTIVITY_LOCATION, SPIRITUAL_ACTIVITY_DURATION, SPIRITUAL_ACTIVITY_TYPE, SPIRITUAL_ACTIVITY_NOTES, SPIRITUAL_DATA_TIMESTAMP)
					VALUES 					    ('$this->dataOwner', '$date', '$name', '$location', '$duration', '$type', '$notes', '$submitted')";
					
            //query database
            $this->comMod->queryDatabase($sql);
		}//close addSpiritualData
    }//close SpiritualTrackingModule
?>