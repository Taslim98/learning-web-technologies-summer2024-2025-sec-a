<?php
require_once('db.php');

class Employer {

    public static function all() {
        $con = getConnection();
        $sql = "SELECT * FROM employers";
        $res = mysqli_query($con, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }
        return $data;
    }

    public static function findByUsernameAndPassword($username, $password) {
        $con = getConnection();
        $sql = "SELECT * FROM employers WHERE username='$username' AND password='$password'";
        $res = mysqli_query($con, $sql);
        return mysqli_fetch_assoc($res);
    }

    public static function insert($name, $company, $contact, $username, $password) {
        $con = getConnection();
        $sql = "INSERT INTO employers (employer_name, company_name, contact_no, username, password)
                VALUES ('$name', '$company', '$contact', '$username', '$password')";
        return mysqli_query($con, $sql);
    }

    public static function update($id, $name, $company, $contact, $username, $password) {
        $con = getConnection();
        $sql = "UPDATE employers SET employer_name='$name', company_name='$company',
                contact_no='$contact', username='$username', password='$password' WHERE id=$id";
        return mysqli_query($con, $sql);
    }

    public static function delete($id) {
        $con = getConnection();
        $sql = "DELETE FROM employers WHERE id=$id";
        return mysqli_query($con, $sql);
    }

    public static function search($search) {
        $con = getConnection();
        $sql = "SELECT * FROM employers WHERE employer_name LIKE '%$search%' 
                OR company_name LIKE '%$search%' OR username LIKE '%$search%'";
        return mysqli_query($con, $sql);
    }
}
?>
