<?php include 'elements/common.php'; 

// Validate input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $mobile = test_input($_POST["mobile"]);

    // Insert data into table
    $sql = "INSERT INTO members (username, email, mobile, password) VALUES ('$username', '$email', '$mobile', '123456')";

    if (executeQuery($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

showServerIP();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
