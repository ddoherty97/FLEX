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
         *      and the fitness goal module
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
		function addFitnessData($date, $startTime, $endTime, $type, $notes)
		{
			//calculate activity duration from start and end times
			$time = $startTime->diff($endTime);
			$hours = $time->format('%h');
			$minutes = $time->format('%i');
			$duration = ($hours * 60) + $minutes;
			
			//build SQL to insert data into database
			$sql = "INSERT INTO table_name  (FITNESS_DATA_OWNER, FITNESS_ACTIVITY_DATE, FITNESS_ACTIVITY_DURATION, FITNESS_ACTIVITY_TYPE, FITNESS_ACTIVITY_OTHER)
					VALUES 					('$this->dataOwner', '$date', '$duration', '$type', '$notes')";
					
			//query database
            $this->comMod->queryDatabase($sql);
		}//close addFitnessData
	}//close FitnessTrackingModule	
?>