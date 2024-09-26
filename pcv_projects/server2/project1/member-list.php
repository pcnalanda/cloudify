<?php
include 'elements/common.php'; 

showServerIP();
// Select data from table
$sql = "SELECT * FROM members";
$result = executeQuery($sql);

if ($result->num_rows > 0) { ?>
<table align="center" border="1" cellpadding="3">
    <tr><th>Username</th><th>Email</th><th>Mobile</th></tr>
<?php
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["mobile"]. "</td><tr>";
    }
?>
</table>
<?php
} else {
    echo "0 results";
}

?>
