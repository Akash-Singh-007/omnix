<?php
//Connect to the database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "omnix";

// $servername = "sql310.epizy.com";
// $username = "epiz_30428887";
// $password = "RE5EKC39TVohod";
// $database = "epiz_30428887_omnix";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    echo "we are not connected"; // if connection is not done.
}
