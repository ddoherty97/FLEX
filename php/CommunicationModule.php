<?php
    /**
     * Communication Module (CommunicationModule.php)
     * This class allows communication to and from the database
     * Author: Davis Doherty
     * Last Updated: 2/17/18 DD
     **/

    //this class requires the database module
    require_once("DatabaseModule.php");

    class CommunicationModule
    {
        //database object to communicate with
        private $dbObject;

        /**
         * __construct()
         * This method connects to the database and selects the table
         * Parameters:  $databaseSelect->database to connect to
         * Exceptions: None
         **/
        public function __construct($databaseSelect)
        {
            //create database object
            $this->dbObject = new DatabaseModule($databaseSelect);
           
            //connect to database
            $this->dbObject->connectToServer();
        }//close constructor

        /**
         * sendToDatabase()
         * This method sends SQL statements to the database with the intention of updating
         *      data (i.e. using SET, UPDATE, etc.)
         * Parameters:  $query->formatted SQL statement to run on database
         * Returns: TRUE if query completed, FALSE otherwise
         * Exceptions: None
         **/
        public function sendToDatabase($query)
        {            
            //store in database as long as does not contain "DELETE"
            if(!stripos($query, "DELETE"))
            {
                return mysqli_query($this->dbObject->getConnection(), $query);
            }//end if
            else
            {
                return false;
            }//end else
        }//close sendToDatabase

        /**
         * getFromDatabase()
         * This method sends SQL statements to the database with the intention of selecting
         *      data (i.e. using SELECT)
         * Parameters:  $query->formatted SQL statement to run on database
         * Returns: TRUE if query completed, FALSE otherwise
         * Exceptions: None
         **/
        public function getFromDatabase($query)
        {            
            //store in database as long as does not contain "DELETE"
            if(!stripos($query, "DELETE"))
            {
                return mysqli_query($this->dbObject->getConnection(), $query);
            }//end if
            else
            {
                return false;
            }//end else
        }//close getFromDatabase
    }//close CommunicationModule
?>