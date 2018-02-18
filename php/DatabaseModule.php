<?php
    /**
     * Database Module (DatabaseModule.php)
     * This class toggles connection between the application and the MySQL database. The default
     *      credentials are hard-coded, but can be overridden if needed
     * Author: Davis Doherty
     * Last Updated: 2/17/18 DD
     **/

    class DatabaseModule
    {
        //set default values to load into object
        static private $defaultDbHost = "localhost";
        static private $defaultDbUser = "b16_21592418";
        static private $defaultDbPass = "FLEX123";
        
        private $dbHost;        //database host
        private $dbUser;        //database username
        private $dbPass;        //database password
        private $db;            //database to use

        /**
         * __construct()
         * This method loads the default database credentials into the object
         *      upon object creation
         * Parameters: None
         * Exceptions: None
         **/
        public function __construct()
        {
            $this->$dbHost = $defaultDbHost;
            $this->$dbUser = $defaultDbUser;
            $this->$dbPass = $defaultDbPass;
        }//close default constructor

        /**
         * setCredentials()
         * This method allows the user to override the default database credentials
         * Parameters:  $host->host server for the database
         *              $user->username for the database
         *              $pass->password for the database
         * Returns: None
         * Exceptions: None
         **/
        public function setCredentials($host, $user, $pass)
        {
            $this->$dbHost = $host;
            $this->$dbUser = $user;
            $this->$dbPass = $pass;
        }//close setCredentials

        /**
         * connectToServer()
         * This method uses the saved credentials (either default or overridden)
         *      to connect to the server and then stores the connection for
         *      later use
         * Parameters: None
         * Returns: The server connection, or FALSE if the connection failed
         * Exceptions: None
         **/
        public function connectToServer()
        {
            //connect to db, store connection, and return connection
            $this->$connection = mysqli_connect($dbHost, $dbUser, $dbPass);
            return $this->$connection;
        }//close connectToServer

        /**
         * selectDatabase()
         * This method stores the default database to run queries on
         * Parameters:  $db->database to connect to
         * Returns: TRUE if the database was selected, FALSE otherwise
         * Exceptions: None
         **/
        //select database of connected database
        public function selectDatabase($db)
        {
            //store database table
            $this->$dbTable = $table;

            //select database and store result
            return mysqli_select_db($connection,$db);
        }//close selectDatabase

        /**
         * getSQLError()
         * This method gets the last sql error of the connection
         * Parameters: None
         * Returns: The latest MySQLi error
         * Exceptions: None
         **/
        public function getSQLError()
        {
            return mysqli_error($this->$connection);
        }//close getSQLError
        
        /**
         * disconnectFromServer()
         * This method closes the connection from the database server
         * Parameters: None
         * Returns: TRUE upon successful disconnect, FALSE otherwise
         * Exceptions: None
         **/
        public function disconnectFromServer()
        {
            return mysqli_close($this->$connection);
        }//close disconnectFromServer
    }//close DatabaseModule
?>