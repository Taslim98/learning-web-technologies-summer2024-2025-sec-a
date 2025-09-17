<!DOCTYPE html>
<html>
<head>
    <title>Employer Registration</title>
</head>
<body>
<h2>Register as Employer</h2>

<form method="POST" action="controllers/EmployerController.php" onsubmit="return validateForm();">
    <input type="text" name="employer_name" id="employer_name" placeholder="Employer Name"><br>
    <input type="text" name="company_name" id="company_name" placeholder="Company Name"><br>
    <input type="text" name="contact_no" id="contact_no" placeholder="Contact No"><br>
    <input type="text" name="username" id="username" placeholder="Username"><br>
    <input type="password" name="password" id="password" placeholder="Password"><br>
    <button type="submit" name="register">Register</button>
</form>
<p><a href="index.php">Back to Login</a></p>

<script>
function validateForm(){
    let f=["employer_name","company_name","contact_no","username","password"];
    for(let i=0;i<f.length;i++){
        let v=document.getElementById(f[i]).value.trim();
        if(v==""){alert(f[i]+" cannot be empty");return false;}
    }
    return true;
}
</script>
</body>
</html>
