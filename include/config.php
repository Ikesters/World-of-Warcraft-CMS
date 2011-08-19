<?php
/* Compatible with TrinityCore       *
 * (c) 2011 Wheth <whethx@gmail.com> */

class Config { // Class called when in need of data
    function getConfig() { // Function containing config data
        $config['mysql_hostname'] = ""; // MySQL Hostname
        $config['mysql_username'] = "";      // MySQL Username
        $config['mysql_password'] = "";    // MySQL Password
        $config['mysql_port'] = "";          // MySQL Port
        
        $config['auth_database'] = ""; // Trinity Auth Database
        $config['char_database'] = ""; // Trinity Characters Database
        return $config; // Return the array when this function is called
    }
}
?>