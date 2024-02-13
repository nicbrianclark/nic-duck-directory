<?php

// Create connection to DB with mysqli_connect
// $conn = mysqli_connect("hostname","username", "password","database name");
$conn = mysqli_connect( "db:3306", "root", "root", "db" );

// Verify connection with mysqli_connect_errno and mysqli_connect_error
if( mysqli_connect_errno() ) {
    echo "Database error: " . mysqli_connect_error();
    exit();
}

?>