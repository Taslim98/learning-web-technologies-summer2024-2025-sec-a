<?php
// When the button is clicked, handle the request
if (isset($_POST['login'])) {
    echo "<h3>Form Data:</h3>";
    print_r($_POST);   // this will print all form values
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <script>
        // JS function that triggers form submit
        function callPHP() {
            // Just showing that JS function is called
            alert("Login button clicked!");
            // Form will submit and PHP print_r() will execute
            return true;
        }
    </script>
</head>
<body>
    <h2>Login Form</h2>
    <form method="post" onsubmit="return callPHP();">
        <label>Email Address: </label>
        <input type="email" name="email" required><br><br>

        <label>Password: </label>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="login" value="Login">
        <input type="reset" value="Reset"><br><br>

        <p>Don’t have an account? <a href="signup.php">Sign Up</a></p>
    </form>
</body>
</html>
