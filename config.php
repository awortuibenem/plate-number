<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "pnumber";


$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    $response = array(
        "error" => "yes",
        "errorMsg" => "Invalid db details"
    );

    echo json_encode($response);
}
?>
