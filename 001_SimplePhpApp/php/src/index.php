<?php

echo "Hello there, this is a PHP Apache container <br/><br/>";

//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
$host = 'db';

// Database use name
$user = 'admin';

//database user password
$pass = 'admin';

//database user password
$dbname = 'test_db';

// check the MySQL connection status
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL server successfully!";
}
