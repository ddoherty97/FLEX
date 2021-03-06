<?php
	/**
     * Screen Time Tracking Module (ScreenTimeTrackingModule.php)
     * This class allows the user to track their fitness based activities
     * Author: Jaclyn Cuevas
     * Last Updated: 3/27/18 JC
     **/

	require_once("CommunicationModule.php");
	
	class ScreenTimeTrackingModule
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
		  * 			$time->time spent on device
		  * 			$device->device used
         * Exceptions: user is not logged in
         **/
		function addScreenTimeData($date, $time, $device)
		{
			
            
            date_default_timezone_set('America/New_York');
            $submitted = date("Y-m-d H:i:s");
			
            //build SQL to insert data into database
			$sql = "INSERT INTO SCREEN_TIME_DATA    (SCREEN_DATA_OWNER, SCREEN_DATA_DATE, SCREEN_DATA_DURATION, SCREEN_DATA_TYPE, SCREEN_DATA_TIMESTAMP)
					VALUES 					    ('$this->dataOwner', '$date', '$time', '$device', '$submitted')";
					
			//query database
            $this->comMod->queryDatabase($sql);
		}//close addFitnessData
    }//close FitnessTrackingModule	
?>