<?php
	/**
     * Dietary Entry (DietaryEntry.php)
     * A dietary entry object represents a row in the DIETARY_DATA table which contains
     *      all the information for a single entry made using the Dietary Tracking Module.
     *      It's purpose is to be used in the Dietary Report Module as a concise way to
     *      represent a dietary "event".
     * Author: Davis Doherty
     * Last Updated: 4/7/18 DD
     **/

    class DietaryEntry
    {
        private $entryID;           //ID of the dietary entry in the database
        private $entryDate;         //date of dietary entry
        private $foodDesc;          //description of the food consumed
        private $numCals;           //number of calories consumed
        private $ouncesWater;       //ounces of water consumed
        private $entrySubmitted;    //submitted date of entry

         /**
         * __construct()
         * This method creates dietary entry object with immutable attributes
         * Parameters:  $ID->ID of the dietary entry in the database
         *              $date->date of dietary entry
         *              $desc->description of the food consumed
         *              $cals->number of calories consumed
         *              $ounces->ounces of water consumed
         *              $submitted->submitted date of entry
         * Exceptions: user is not logged in
         **/
        function __construct($ID, $date, $desc, $cals, $ounces, $submitted)
        {
            //assign constructor params to member variables
            $this->entryID = $ID;
            $this->entryDate = $date;
            $this->foodDesc = $desc;
            $this->numCals = $cals;
            $this->ouncesWater = $ounces;
            $this->entrySubmitted = $submitted;
        }//close constructor

        /**
         * getEntryID()
         * This method gets the ID of the dietary entry in the database
         * Parameters:  none
         * Returns: ID of the dietary entry in the database
         * Exceptions: none
         **/
        function getEntryID()
        {
            return $this->entryID;
        }//close getEntryID

        /**
         * getEntryDate()
         * This method gets the date of dietary entry
         * Parameters:  none
         * Returns: date of dietary entry
         * Exceptions: none
         **/
        function getEntryDate()
        {
            return $this->entryDate;
        }//close getEntryDate

        /**
         * getDescription()
         * This method gets the description of the food consumed
         * Parameters:  none
         * Returns: description of the food consumed
         * Exceptions: none
         **/
        function getDescription()
        {
            return $this->foodDesc;
        }//close getDescription

        /**
         * getCalories()
         * This method gets the number of calories consumed
         * Parameters:  none
         * Returns: number of calories consumed
         * Exceptions: none
         **/
        function getCalories()
        {
            return $this->numCals;
        }//close getCalories

        /**
         * getWater()
         * This method gets the ounces of water consumed
         * Parameters:  none
         * Returns: ounces of water consumed
         * Exceptions: none
         **/
        function getWater()
        {
            return $this->ouncesWater;
        }//close getWater

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
    }//close DietaryEntry
?>