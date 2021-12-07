<style>
<?php include 'style.css';?>
</style>
<?php
    if(isset($_POST['delete'])) {
        $connect_err = "";
        $mysqli = new mysqli("mysql.eecs.ku.edu", "m185p865", "ashuPh7a", "m185p865");
        if ($mysqli->connect_errno) { 
            $connect_err = "Connect failed: " + $mysqli->connection_error + "\n";
            exit();
        }

        if ($connect_err == "") {
            echo "<h1>Deleted Posts</h1>";
            echo "<table>";
            echo "<tr><th>post_id</th></tr>";
            foreach($_POST['delete'] as $deleteid) {
                $query = "DELETE FROM Posts WHERE post_id=".$deleteid;
                if ($result = $mysqli->query($query)) {
                    echo "<tr><td>".$deleteid."</td></tr>";
                }
            }
            echo "</table>";
            $mysqli->close();
        } else {
            echo "<p>ERROR: " . $connect_err . "</p>";
        }
    } else {
        echo "<p>ERROR: Nothing was selected to be deleted</p>";
    }
?>