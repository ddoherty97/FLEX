<?php
	/**
     * Social Entry (SocialEntry.php)
     * A social entry object represents a row in the SOCIAL_DATA table which contains
     *      all the information for a single entry made using the Social Tracking Module.
     *      It's purpose is to be used in the Social Report Module as a concise way to
     *      represent a social "event".
     * Author: Jaclyn Cuevas
     * Last Updated: 4/10/18 JC
     **/

    class SocialEntry
    {
        private $entryID;       	//ID of the social entry in the database
        private $entryDate;     	//date of social entry
        private $activityTitle;     //title of social activity
        private $activityLocation;	//location of social activity
        private $activityDuration;	//duration of social activity
        private $activityType;		//type of social activity
		private $activityNotes;		//notes for social activity
        private $entrySubmitted;	//submitted date of entry

         /**
         * __construct()
         * This method creates social entry object with immutable attributes
         * Parameters:  $ID->ID of the social entry in the database
         *              $date->date of social entry
         *              $title->title of social activity
         *              $location->location of social activity
         *              $duration->duration of social activity
		 *				$type->type of social activity 
		 *				$notes-> notes on social activity 
         *              $submitted->submitted date of entry
         * Exceptions: none
         **/
        function __construct($ID, $date, $title, $location, $duration, $type, $notes, $submitted)
        {
            //if no location provided
            if($location=="")
            {
                $location = "No Location Provided";
            }//end if

            //if no notes provided
            if($notes=="")
            {
                $notes = "No Notes Provided";
            }//end if

            //assign constructor params to member variables
            $this->entryID = $ID;
            $this->entryDate = $date;
            $this->activityTitle = $title;
            $this->activityLocation = $location;
            $this->activityDuration = $duration;
			$this->activityType = $type;
			$this->activityNotes =  $notes;
            $this->entrySubmitted = $submitted;
        }//close constructor

        /**
         * getEntryID()
         * This method gets the ID of the social entry in the database
         * Parameters:  none
         * Returns: ID of the social entry in the database
         * Exceptions: none
         **/
        function getEntryID()
        {
            return $this->entryID;
        }//close getEntryID

        /**
         * getEntryDate()
         * This method gets the date of social entry
         * Parameters:  none
         * Returns: date of social entry
         * Exceptions: none
         **/
        function getEntryDate()
        {
            return $this->entryDate;
        }//close getEntryDate

        /**
         * getTitle()
         * This method gets the title of social activity
         * Parameters:  none
         * Returns: title of social activity
         * Exceptions: none
         **/
        function getTitle()
        {
            return $this->activityTitle;
        }//close getTitle

        /**
         * getLocation()
         * This method gets the location of social activity
         * Parameters:  none
         * Returns: location of social activity
         * Exceptions: none
         **/
        function getLocation()
        {
            return $this->activityLocation;
        }//close getLocation

        /**
         * getDuration()
         * This method gets the duration of social activity
         * Parameters:  none
         * Returns: duration of social activity
         * Exceptions: none
         **/
        function getDuration()
        {
            return $this->activityDuration;
        }//close getDuration
        
         /**
         * getType()
         * This method gets the type of social activity
         * Parameters:  none
         * Returns: type of social activity
         * Exceptions: none
         **/
        function getType()
        {
            return $this->activityType;
        }//close getType
        
         /**
         * getNotes()
         * This method gets the notes of social activity
         * Parameters:  none
         * Returns: note of social activity
         * Exceptions: none
         **/
        function getNotes()
        {
            return $this->activityNotes;
        }//close getNotes

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
    }//close SocialEntry
?>