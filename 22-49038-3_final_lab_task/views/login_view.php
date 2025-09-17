<!DOCTYPE html>
<html>
<head>
    <title>Employer Login</title>
</head>
<body>
<h2>Employer Login</h2>
<?php if (isset($_GET['msg']) && $_GET['msg']=='registered') echo "<p style='color:green;'>Registration successful. Please login.</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" action="controllers/EmployerController.php" onsubmit="return validateLogin();">
    <input type="text" name="username" id="username" placeholder="Username"><br>
    <input type="password" name="password" id="password" placeholder="Password"><br>
    <button type="submit" name="login">Login</button>
</form>
<p><a href="register.php">Register Here</a></p>

<script>
function validateLogin(){
    let u=document.getElementById('username').value.trim();
    let p=document.getElementById('password').value.trim();
    if(u==""||p==""){alert("All fields required!");return false;}
    return true;
}
</script>
</body>
</html>
