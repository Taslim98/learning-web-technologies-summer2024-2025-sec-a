<?php
session_start();
if(!isset($_SESSION['employer_id'])){
    header("Location: index.php");
    exit;
}
require_once('models/Employer.php');
$employers = Employer::all();
include('views/employer_view.php');
?>
