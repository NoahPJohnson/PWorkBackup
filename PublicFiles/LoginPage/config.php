<?php
// Database credentials for a MySQL Database

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'prodigb3_npj'); //Username with access to the database
define('DB_PASSWORD', 'ButterscotchRipple!'); //Password for that username
define('DB_NAME', 'prodigb3_loginTest'); //The database on bluehost
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{
    echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);
}
?>