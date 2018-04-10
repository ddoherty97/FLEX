<?php
	/**
     * Screen Time Entry (ScreenTimeEntry.php)
     * A screen time entry object represents a row in the SCREEN_TIME_DATA table which contains
     *      all the information for a single entry made using the Screen Time Tracking Module.
     *      It's purpose is to be used in the Screen Time Report Module as a concise way to
     *      represent a screen time "event".
     * Author: Jaclyn Cuevas
     * Last Updated: 4/9/18 JC
     **/

    class ScreenTimeEntry
    {
        private $entryID;           //ID of the screen time entry in the database
        private $entryDate;         //date of screen time entry
        private $screenType;		//type of screen used
        private $screenDuration;	//time spent on screen
        private $entrySubmitted;    //submitted date of entry

         /**
         * __construct()
         * This method creates a screen time entry object with immutable attributes
         * Parameters:  $ID->ID of the screen time entry in the database
         *              $date->date of screen time entry
         *              $type->type of screen used
         *              $duration->time spent on screen
         *              $submitted->submitted date of entry
         * Exceptions: none
         **/
        function __construct($ID, $date, $type, $duration, $submitted)
        { 
            //assign constructor params to member variables
            $this->entryID = $ID;
            $this->entryDate = $date;
            $this->screenType = $type;
            $this->screenDuration = $duration;
            $this->entrySubmitted = $submitted;
        }//close constructor

        /**
         * getEntryID()
         * This method gets the ID of the screen time entry in the database
         * Parameters:  none
         * Returns: ID of the screen time entry in the database
         * Exceptions: none
         **/
        function getEntryID()
        {
            return $this->entryID;
        }//close getEntryID

        /**
         * getEntryDate()
         * This method gets the date of screen time entry
         * Parameters:  none
         * Returns: date of screen time entry
         * Exceptions: none
         **/
        function getEntryDate()
        {
            return $this->entryDate;
        }//close getEntryDate

        /**
         * getType()
         * This method gets the type of screen used
         * Parameters:  none
         * Returns: type of screen used
         * Exceptions: none
         **/
        function getType()
        {
            return $this->screenType;
        }//close getType

        /**
         * getDuration()
         * This method gets the time spent using a screen
         * Parameters:  none
         * Returns: time using a screen
         * Exceptions: none
         **/
        function getDuration()
        {
            return $this->screenDuration;
        }//close getDuration

        /**
         * getTimestamp()
         * This method gets the submitted date of entry
         * Parameters:  none
         * Returns: submitted date of entry
         * Exceptions: none
         **/
        function getTimestamp()
        {
            return $this->entrySubmitted;
        }//close getTimestamp
    }//close ScreenTimeEntry
?>