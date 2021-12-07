<style>
<?php include 'style.css';?>
</style>
<?php
$connect_err = "";

$mysqli = new mysqli("mysql.eecs.ku.edu", "m185p865", "ashuPh7a", "m185p865");

if ($mysqli->connect_errno) { 
    $connect_err = "Connect failed: " + $mysqli->connection_error + "\n";
    exit();
}

if ($connect_err == "") {
    echo "<h1>Users</h1>";
    echo "<table>";
    echo "<tr><th>user_id</th></tr>";
    $query = "SELECT * FROM Users";
    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["user_id"] . "</td></tr>";
        }
        $result->free();
    }
    echo "</table>";
    $mysqli->close();
} else {
    echo "<p>ERROR: " . $connect_err . "</p>";
}
?>