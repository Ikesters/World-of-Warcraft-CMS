<?php
/* Compatible with TrinityCore       *
 * (c) 2011 Wheth <whethx@gmail.com> */

class Database extends Config { // Class regarding database operations
    
    function dbConnect() { // Function to connect to the database
        $config = Config::getConfig(); // Loads the array containing configuration data
        $this->db = mysql_connect($config['mysql_hostname'].':'.$config['mysql_port'], $config['mysql_username'], $config['mysql_password']);
        if (!$this->db) {
            die ('Could not connect to the MySQL Server.'); // Error message if connection failed
        }
    }
    
    function query($query) { // Executes a query
        return mysql_query($query, $this->db);
    }
    
    function fetchArray($result) { // Fetch a query into an array
        return mysql_fetch_array($result);
    }
    
    function rows($query) { // Count the rows in a query
        return mysql_num_rows($query);
    }
    
    function dbClose() { // Close the connection
        mysql_close($this->db);
    }
}
?>