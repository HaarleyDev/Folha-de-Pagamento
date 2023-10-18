<?php
require_once "connect.php";
session_start();

$user = $_POST['email'];
$pass = $_POST['pass'];

$result = $conn->query("SELECT * FROM `func` WHERE `email` = '$user' AND `pass` = '$pass'");
while ($row = $result->fetch_assoc()) {
    $id = $row['id_f'];
    $tipo = $row['tipo'];
}
if ($tipo == 1) {
    $_SESSION['id_f'] = $id;
    $_SESSION['email'] = $user;
    $_SESSION['pass'] = $pass;
    $_SESSION['tipo'] = $tipo;
    header('location:../admin.php');
} else {
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $user;
        $_SESSION['pass'] = $pass;
        $_SESSION['id_f'] = $id;
        $_SESSION['tipo'] = $tipo;
        header('location:../funcionario.php');
    } else {
        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        header('location:../index.php');
    }
}
