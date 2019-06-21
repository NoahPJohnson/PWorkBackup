<?php
// Database credentials. Assuming you are running MySQL
//server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'prodigb3_npj');
define('DB_PASSWORD', 'ButterscotchRipple!');
define('DB_NAME', 'prodigb3_npjTest');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{
    //echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);
}
?>