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
        private $dbHost;        //database host
        private $dbUser;        //database username
        private $dbPass;        //database password
        private $db;            //database to use
        private $connection;    //connection to mysqli server
        
        /**
         * __construct()
         * This method loads the default database credentials into the object
         *      upon object creation
         * Parameters:  $database->name of the database to connect to
         * Exceptions: None
         **/
        public function __construct($database)
        {
            $this->dbHost = "sql201.byethost16.com";
            $this->dbUser = "b16_21592498";
            $this->dbPass = "FLEX123";
            $this->db = $database;
        }//close constructor

        /**
         * setCredentials()
         * This method allows the user to override the default database credentials
         * Parameters:  $host->host address for the server
         *              $user->username for the server
         *              $pass->password for the server
         *              $database->database to connect to
         * Returns: None
         * Exceptions: None
         **/
        public function setCredentials($host, $user, $pass, $database)
        {
            $this->dbHost = $host;
            $this->dbUser = $user;
            $this->dbPass = $pass;
            $this->db = $database;
        }//close setCredentials

        /**
         * connectToServer()
         * This method uses the saved credentials (either default or overridden)
         *      to connect to the server and then stores the connection for
         *      later use
         * Parameters: None
         * Returns: None
         * Exceptions: None
         **/
        public function connectToServer()
        {
            //if there's no current connection
            if(!isset($this->connection) || $this->connection==false)
            {
                //connect to db server and store connection
                $this->connection = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->db);
            }//end if
        }//close connectToServer

        /**
         * query()
         * This method queries the database connection
         * Parameters:  $sql->SQL statement to query database
         * Returns: The result of the MySQLi query
         * Exceptions: None
         **/
        public function query($sql)
        {
            //sanitize input
            $query = mysqli_real_escape_string($this->connection, $sql);

            //query database and return result
            return mysqli_query($this->connection, $query);
        }//close query

        /**
         * getSQLError()
         * This method gets the last sql error of the connection
         * Parameters: None
         * Returns: The latest MySQLi error
         * Exceptions: None
         **/
        public function getSQLError()
        {
            return mysqli_error($this->connection);
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
            return mysqli_close($this->connection);
        }//close disconnectFromServer
    }//close DatabaseModule
?>