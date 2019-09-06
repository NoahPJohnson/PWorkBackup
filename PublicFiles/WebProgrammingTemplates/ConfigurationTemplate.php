<?php
// Database credentials for a MySQL Database

define('DB_SERVER', '66.147.242.194');
define('DB_USERNAME', 'prodigb3_npj'); //Username with access to the database
define('DB_PASSWORD', 'Z&N@Pr0digal'); //Password for that username*****
define('DB_NAME', 'prodigb3_loginTest'); //The database on bluehost
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false)
{
    die("ERROR: Could NOT connect to " . DB_NAME . ".  " . mysqli_connect_error());
}
else
{
    //echo "Connected Successfully to " . DB_NAME . ".  Host info: " . mysqli_get_host_info($link);
}
?>