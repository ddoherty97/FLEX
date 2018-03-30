<?php
	/**
     * Dietary Tracking Module (DietaryTrackingModule.php)
     * This class allows the user to track their dietary based information
     * Author: Jaclyn Cuevas
     * Last Updated: 3/30/18 JC
     **/

	require_once("CommunicationModule.php");
	
	class DietaryTrackingModule
	{
		private $comMod;    //communication module to interact with database
        private $dataOwner; //owner of the goal
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the dietary tracking module
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
         * addDietaryData()
         * This method adds the fitness data of the user
         * Parameters:  $date->date the user completed activity
		  * 			$time->time user consumed food/water
		  * 			$typeOfFood->type of food user consumed
		  * 			$calories->number of calories user consumed
		  * 			$ouncesOfWater->number of ounces of water user drank
         * Exceptions: user is not logged in
         **/
		function addDietaryData($date, $time, $typeOfFood, $calories, $ounces)
		{
            
            date_default_timezone_set('America/New_York');
            $submitted = date("Y-m-d H:i:s");
			
            //build SQL to insert data into database
			$sql = "INSERT INTO DIETARY_DATA    (DIET_DATA_OWNER, DIET_DATE, DIET_TIME, DIET_TITLE, DIET_CALORIES, DIET_WATER, DIET_TIMESTAMP)
					VALUES 					    ('$this->dataOwner', '$date', '$time', '$typeOfFood', '$calories', '$ounces', '$submitted')";
					
			//query database
            $this->comMod->queryDatabase($sql);
		}//close addDietaryData
    }//close DietaryTrackingModule	
    
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $mod = new DietaryTrackingModule();
    $date = date("2018-03-15");
    $start = new DateTime("14:15");
    $end = new DateTime("15:20");
    $type = "test data";
    $notes = "test data notes here";

    // $mod->addDietaryData($date, $start, $end, $type, $notes);
?>