<style>
<?php include 'style.css';?>
</style>
<?php
$user = $_POST["user"];
$connect_err = "";

$mysqli = new mysqli("mysql.eecs.ku.edu", "m185p865", "ashuPh7a", "m185p865");

if ($mysqli->connect_errno) { 
    $connect_err = "Connect failed: " + $mysqli->connection_error + "\n";
    exit();
}

if ($connect_err == "") {
    echo "<h1>User Posts</h1>";
    echo "<table>";
    echo "<tr><th>post_id</th><th>content</th><th>author_id</th></tr>";
    $query = sprintf("SELECT * FROM Posts WHERE author_id = '%s' ORDER BY post_id",
                      $mysqli->real_escape_string($user));
    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["post_id"] . "</td><td>" . $row["content"] . "</td><td>" . $row["author_id"] . "</td></tr>";
        }
        $result->free();
    }
    echo "</table>";
    $mysqli->close();
} else {
    echo "<p>ERROR: " . $connect_err . "</p>";
}
?>