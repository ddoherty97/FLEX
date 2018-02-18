<?php
    /**
     * Communication Module (CommunicationModule.php)
     * This class allows communication to and from the database
     * Author: Davis Doherty
     * Last Updated: 2/18/18 DD
     **/

    //this class requires the database module
    require_once("DatabaseModule.php");

    class CommunicationModule
    {
        //database object to communicate with
        private $dbObject;

        //database to connect to
        private $database = "b16_21592498_FLEX";

        /**
         * __construct()
         * This method connects to the database and selects the table
         * Parameters: None
         * Exceptions: None
         **/
        public function __construct()
        {
            //create database object
            $this->dbObject = new DatabaseModule($this->database);
           
            //connect to database
            $this->dbObject->connectToServer();
        }//close constructor

        /**
         * queryDatabase()
         * This method sends SQL statements to the database
         * Parameters:  $query->formatted SQL statement to run on database
         * Returns: results of query if completed, FALSE otherwise
         * Exceptions: None
         **/
        public function queryDatabase($query)
        {            
            //query database as long as does not contain "DELETE FROM"
            if(stripos($query, "DELETE FROM") === FALSE)
            {
                return mysqli_query($this->dbObject->getConnection(), $query);
            }//end if
            else
            {
                return false;
            }//end else
        }//close queryDatabase

        /**
         * endCommunication()
         * This method closes the database connection and prevents resource leaks. This method
         *      should be called at the end of every file that creates a CommunicationModule
         * Parameters: None
         * Returns: TRUE if disconnected, FALSE otherwise
         * Exceptions: None
         **/
        public function endCommunication()
        {            
            return $this->dbObject->disconnectFromServer();
        }//close endCommunication
    }//close CommunicationModule
?>