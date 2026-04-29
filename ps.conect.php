<?php
$dept_id   = $_POST["num"];
$name      = $_POST["name"];
$location  = $_POST["location"];
$phone_ext = $_POST["phone_ext"];

// Connecting to the database
$conn = mysqli_connect("localhost", "root", "", "final_db");

if ($conn == TRUE) {
    echo "Successfully connected to the Database.";
} 
else {
    echo "Failed to connect to the Database";
    die();     // die stays in else as you wanted
}
$stmt ="INSERT INTO 
`department`(`dep_id`, `name`, `location`, `phone_ext`) 
VALUES ('$dep_id', '$name', '$location', '$phone_ext')";
?>
