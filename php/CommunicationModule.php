<?php
    /**
     * Communication Module (CommunicationModule.php)
     * This class allows communication to and from the database
     * Author: Davis Doherty
     * Last Updated: 2/17/18 DD
     **/

    class CommunicationModule
    {
        private $dbConnection;    //database connection

        /**
         * __construct()
         * This method connects to the database and selects the table
         * Parameters:  $database->database to connect to
         * Exceptions: None
         **/
        public function __construct($database)
        {
            //create database object
            $database = new DatabaseModule();

            //connect to database and select table
            $this->dbConnection = $database->connectToServer();
            $database->selectDatabase($database);
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
                mysqli_query($this->dbConnection, $query);
                return true;
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
                mysqli_query($this->dbConnection, $query);
                return true;
            }//end if
            else
            {
                return false;
            }//end else
        }//close getFromDatabase
    }//close CommunicationModule
?>