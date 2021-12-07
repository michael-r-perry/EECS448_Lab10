<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$user = $_POST["username"];
$user_err = "";
$connect_err = "";
$duplicate_err = "";

if ($user == "") {
    $user_err = "Username cannot be empty!";
}

$mysqli = new mysqli("mysql.eecs.ku.edu", "m185p865", "ashuPh7a", "m185p865");

if ($mysqli->connect_errno) { 
    $connect_err = "Connect failed: " + $mysqli->connection_error + "\n";
    exit();
}

if (empty($user_err) && empty($connect_err))
{
    $query = "INSERT INTO Users (user_id) VALUES ('" . $user . "')";
    if ($mysqli->query($query) === TRUE) {
        echo "<p>The user was successfully stored in the database.</p>";
    } else {
        $duplicate_err = "User is already stored in the database";
    }
}

$mysqli->close();

if (!empty($user_err) || !empty($connect_err) || !empty($duplicate_err)) {
    echo "<p>The user was not successfully stored in the database.</p>";
    if (!empty($user_err)) echo "<p>ERROR: " . $user_err . "</p>";
    if (!empty($connect_err)) echo "<p>ERROR: " . $connect_err . "</p>";
    if (!empty($duplicate_err)) echo "<p>ERROR: " . $duplicate_err . "</p>";
}
?>