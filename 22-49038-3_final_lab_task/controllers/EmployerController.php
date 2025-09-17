<?php
session_start();
require_once('../models/Employer.php');

// LOGIN
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $user = Employer::findByUsernameAndPassword($username, $password);
    if ($user) {
        $_SESSION['employer_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../employer.php");
        exit;
    } else {
        $error = "Invalid username or password";
        include('../views/login_view.php');
        exit;
    }
}

// REGISTER
if (isset($_POST['register'])) {
    $name = trim($_POST['employer_name']);
    $company = trim($_POST['company_name']);
    $contact = trim($_POST['contact_no']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    Employer::insert($name, $company, $contact, $username, $password);
    header("Location: ../index.php?msg=registered");
    exit;
}

// ADD Employer from dashboard
if (isset($_POST['add_employer'])) {
    $name = $_POST['employer_name'];
    $company = $_POST['company_name'];
    $contact = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    Employer::insert($name, $company, $contact, $username, $password);
    header("Location: ../employer.php");
    exit;
}

// UPDATE Employer
if (isset($_POST['update_employer'])) {
    $id = $_POST['id'];
    $name = $_POST['employer_name'];
    $company = $_POST['company_name'];
    $contact = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    Employer::update($id, $name, $company, $contact, $username, $password);
    header("Location: ../employer.php");
    exit;
}

// DELETE Employer
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    Employer::delete($id);
    header("Location: ../employer.php");
    exit;
}

// SEARCH Ajax
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $res = Employer::search($search);
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['employer_name']}</td>
                <td>{$row['company_name']}</td>
                <td>{$row['contact_no']}</td>
                <td>{$row['username']}</td>
                <td>{$row['password']}</td>
                <td>
                  <a href='../employer.php?edit={$row['id']}'>Edit</a> |
                  <a href='../controllers/EmployerController.php?delete={$row['id']}'>Delete</a>
                </td>
              </tr>";
    }
    exit;
}
?>
