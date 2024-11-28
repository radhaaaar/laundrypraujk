<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = ($_POST['password']);

$queryLogin = mysqli_query(
    $koneksi,
    "SELECT * FROM user WHERE email='$email'"
);
if (mysqli_num_rows($queryLogin)  > 0) {
    $rowUser = mysqli_fetch_assoc($queryLogin);
    if ($rowUser['password'] == $password) {
        $_SESSION['NAMA'] = $rowUser['name'];
        $_SESSION['ID'] = $rowUser['id'];
        // $_SESSION['id_level'] = $rowUser['id_level'];
        header("location:index.php?login=berhasil");
    } else {
        header("location:login.php?error=login");
    }
} else {
    header("location:login.php?error=login");
}
