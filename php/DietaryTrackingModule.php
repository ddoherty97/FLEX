<?php
	/**
     * Dietary Tracking Module (DietaryTrackingModule.php)
     * This class allows the user to track their dietary based information
     * Author: Jaclyn Cuevas
     * Last Updated: 4/3/18 DD
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
		function addDietaryData($date, $typeOfFood, $calories, $ounces)
		{
            date_default_timezone_set('America/New_York');
            $submitted = date("Y-m-d H:i:s");
			
            //build SQL to insert data into database
			$sql = "INSERT INTO DIETARY_DATA    (DIET_DATA_OWNER, DIET_DATE, DIET_TITLE, DIET_TIMESTAMP, DIET_CALORIES, DIET_WATER)
                    VALUES 					    ('$this->dataOwner', '$date', '$typeOfFood', '$submitted', ";
                    
                    //if no calories consumed
                    if($calories == 0)
                    {
                        $sql .= "NULL, ";
                    }//end if
                    else
                    {
                        $sql .= "'$calories', ";
                    }//end else

                    //if no water consumed
                    if($ounces == 0)
                    {
                        $sql .= "NULL)";
                    }//end if
                    else
                    {
                        $sql .= "'$ounces')";
                    }//end else
			//query database
            $this->comMod->queryDatabase($sql);
		}//close addDietaryData
    }//close DietaryTrackingModule	
?>