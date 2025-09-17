<!DOCTYPE html>
<html>
<head>
    <title>Employer Management</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<p>Welcome, <?= $_SESSION['username'] ?> | <a href="logout.php">Logout</a></p>
<h2>Employer Management</h2>

<!-- Add Employer -->
<form method="POST" action="controllers/EmployerController.php" onsubmit="return validateForm();">
    <input type="text" name="employer_name" id="employer_name" placeholder="Employer Name"><br>
    <input type="text" name="company_name" id="company_name" placeholder="Company Name"><br>
    <input type="text" name="contact_no" id="contact_no" placeholder="Contact No"><br>
    <input type="text" name="username" id="username" placeholder="Username"><br>
    <input type="password" name="password" id="password" placeholder="Password"><br>
    <button type="submit" name="add_employer">Add Employer</button>
</form>

<hr>

<!-- Search -->
<input type="text" id="search" placeholder="Search Employer...">
<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Company</th><th>Contact</th><th>Username</th><th>Password</th><th>Action</th>
        </tr>
    </thead>
    <tbody id="employerTable">
        <?php foreach($employers as $emp): ?>
        <tr>
            <td><?= $emp['id'] ?></td>
            <td><?= $emp['employer_name'] ?></td>
            <td><?= $emp['company_name'] ?></td>
            <td><?= $emp['contact_no'] ?></td>
            <td><?= $emp['username'] ?></td>
            <td><?= $emp['password'] ?></td>
            <td>
                <a href="controllers/EmployerController.php?delete=<?= $emp['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
function validateForm(){
    let fields=["employer_name","company_name","contact_no","username","password"];
    for(let i=0;i<fields.length;i++){
        let val=document.getElementById(fields[i]).value.trim();
        if(val===""){alert(fields[i]+" cannot be empty!");return false;}
    }
    return true;
}

$(document).ready(function(){
    $("#search").keyup(function(){
        var search=$(this).val();
        $.ajax({
            url: "controllers/EmployerController.php",
            method: "POST",
            data: {search:search},
            success:function(data){
                $("#employerTable").html(data);
            }
        });
    });
});
</script>
</body>
</html>
