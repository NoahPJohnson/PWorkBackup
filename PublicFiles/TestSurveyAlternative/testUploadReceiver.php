<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();
    echo "Something made a POST request.";
}

?>