<?php
	/**
     * Spiritual Report Module (SpiritualReportModule.php)
     * The purpose of the Screen Time Report Module is to display the user’s screen time progress,
     *      as it relates to their goals, in a clean report that is easily interpreted.
     * Author: Davis Doherty
     * Last Updated: 3/28/18 DD
     **/

	require_once("CommunicationModule.php");
	
	class SpiritualReportModule
	{
		private $comMod;    //communication module to interact with database
        private $dataOwner; //owner of the report
		
		 /**
         * __construct()
         * This method initializes the tunnel between the communication module
         *      and the spiritual report module
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
         * getSpiritualEventProgress()
         * This method gets the progress of the spiritual event based on the user’s goals
         * Parameters:  none
         * Returns: double representing the percent of goal completion
         * Exceptions: a spiritual goal must be set
         **/
        function getSpiritualEventProgress()
        {

        }//close getSpiritualEventProgress

        /**
         * getSpiritualDurationProgress()
         * This method gets the progress of spiritual duration based on the user’s goals
         * Parameters:  none
         * Returns: double representing the percent of goal completion
         * Exceptions: a spiritual goal must be set
         **/
        function getSpiritualDurationProgress()
        {

        }//close getSpiritualDurationProgress

        /**
         * getSpiritualReport()
         * This method builds a report of all the spiritual events attended
         * Parameters:  $startDate->date to start selecting to add in the report
         *              $endDate->date to stop selecting to add in the report
         * Returns: SpiritualReport object of user’s spiritual data
         * Exceptions: none
         **/
        function getSpiritualReport($startDate, $endDate)
        {

        }//close getSpiritualReport
    }//close SpiritualReportModule
?>