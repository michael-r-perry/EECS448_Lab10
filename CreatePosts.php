<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$user = $_POST["username"];
$post = $_POST["post"];
$input_err = "";
$connect_err = "";
$user_err = "";

if ($user == "" || $post == "") {
    $input_err = "Username and Post cannot be empty!";
}

$mysqli = new mysqli("mysql.eecs.ku.edu", "m185p865", "ashuPh7a", "m185p865");

if ($mysqli->connect_errno) { 
    $connect_err = "Connect failed: " + $mysqli->connection_error + "\n";
    exit();
}

if (empty($input_err) && empty($connect_err))
{
    $query = sprintf("SELECT * FROM Users WHERE user_id = '%s'",
                      $mysqli->real_escape_string($user));
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) == 0) {
        $user_err = "Username does not match a current user!";
    } else {
        $query = sprintf("INSERT INTO Posts (content, author_id) VALUES ('%s', '%s')",
                          $mysqli->real_escape_string($post),
                          $mysqli->real_escape_string($user));
        if ($mysqli->query($query) === TRUE) {
            echo "<p>The post was successfully stored in the database.</p>";
        } else {
            $user_err = "Error occured while inserting post!";
        }
    }
}

$mysqli->close();

if (!empty($input_err) || !empty($connect_err) || !empty($user_err)) {
    echo "<p>The post was not successfully stored in the database.</p>";
    if (!empty($input_err)) echo "<p>ERROR: " . $input_err . "</p>";
    if (!empty($connect_err)) echo "<p>ERROR: " . $connect_err . "</p>";
    if (!empty($user_err)) echo "<p>ERROR: " . $user_err . "</p>";
}
?>