<?php include 'elements/common.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var email = document.getElementById("email").value;
            var mobile = document.getElementById("mobile").value;

            // Validate username (non-empty)
            if (username === "") {
                alert("Username must be filled out");
                return false;
            }

            // Validate email (basic format)
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address");
                return false;
            }

            // Validate mobile number (10 digits)
            var mobilePattern = /^\d{10}$/;
            if (!mobilePattern.test(mobile)) {
                alert("Please enter a 10-digit mobile number");
                return false;
            }

            // If all validations pass, submit the form
            return true;
        }
    </script>
</head>
<body>
    
    <?php echo showServerIP(); ?>
    <form  onsubmit="return validateForm()" action="insert-data2.php" method="post">
        <table align="center">
            <tr><td colspan="2" align="center"><h2>Create Record</h2></td></tr>
           <tr><td>Username: </td><td><input type="text" id="username" name="username"></td></tr>
           <tr><td>Email: </td><td><input type="text" id="email" name="email"></td></tr>
           <tr><td>Mobile: </td><td><input type="text" id="mobile" name="mobile"></td></tr>
           <tr><td colspan="2"><input type="submit" value="Create"></td></tr>
        </table>
    </form>
</body>
</html>
