<?php
// Enable error reporting for debugging during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Secure connection parameters
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ia_academy";

try {
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    // Stop execution and show the specific error
    die("<div style='color:red; font-family:sans-serif;'>
            <b>Database Error:</b> " . $e->getMessage() . "
         </div>");
}
?>