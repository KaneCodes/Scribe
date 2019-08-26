<?php
// Turns on output buffering
ob_start();
// Start a session variable
session_start();
// Set default timezone
$timezone = date_default_timezone_set("Europe/London");
// Database Connection
$connection = mysqli_connect("127.0.0.1", "root", "Storm12345", "scribe");
// Check connection
if(mysqli_connect_errno()) {
  echo "Failed to connect to database" . mysqli_connect_errno();
}
?>
