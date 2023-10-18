<?php
require_once 'connect.php';
session_start();

if ($_POST) {
    $nomed = $_POST['nome_dep'];


    $sql = "SELECT * FROM dep WHERE nome_dep = '$nomed'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($linha = $result->fetch_assoc()) {
            $_SESSION['alertdep'] = "<div style='color: red;'>Esse departamento já está cadastrado</div>";
            header('location:../cadastro_d.php');
        }
    } else {
        $sql = "INSERT INTO dep VALUE (null,'$nomed')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['alertdep'] = "<div style='color: green;'>Cadastro feito com sucesso</div>";
            header('location:../cadastro_d.php');
        }
    }
}
