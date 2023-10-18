<?php
require_once 'connect.php';
session_start();
if ($_POST) {
    $cpf = $_POST['cpf'];
    $pass = $_POST['pass'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email =  $_POST['email'];
    $tel =  $_POST['telefone'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $Sdepartamento = $_POST['departamento'];



    function validaCPF($cpf){
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }


    $sql = "SELECT * FROM func WHERE  email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($linha = $result->fetch_assoc()) {
            $_SESSION['cad'] = "<div style='color: red'>Esse nome de usuario($email) já foi cadastrado</div>";
            header('location:../cadastro.php');
        }
    } else {
        $sql = "SELECT * FROM func WHERE cpf = '$cpf'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($linha = $result->fetch_assoc()) {
                $_SESSION['cad'] =  "<div style='color: red'>Esse cpf já foi cadastrado</div>";
                header('location:../cadastro.php');
            }
        } else {
            if (validaCPF($cpf) == TRUE) {
                $sql = "INSERT INTO func VALUES(null,'$Sdepartamento',0,'$nome','$pass','$cpf','$idade','$email','$tel','$rua','$bairro','$cidade','$estado')";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['cad'] = "<div style='color: green'>Cadastro feito com sucesso</div>";
                    header('location:../cadastro.php');
                }
            } else {
                $_SESSION['cad'] = "<div style='color: red'>CPF inserido está invalido</div>";
                header('location:../cadastro.php');
            }
        }
    }
} else {
    echo "Você precisa não pode acessar esse canal";
}
