<?php
require_once 'connect.php';
if ($_POST) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $idade = $_POST['idade'];
    $id = $_POST['id_f'];
    $sql = "UPDATE func SET nome = '$nome', cpf = '$cpf', idade = '$idade', tipo = 0 WHERE id_f = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p> Atualização realizada com sucesso!</p>";
        echo "<a href='../acoes/editar.php?id=" . $id . "'><button type='button'>Editar</button>";
        echo "<a href='../admin.php'><button type='button'>Voltar</button>";
    } else {
        echo "Erro ao atualizar os dados do aluno: " . $conn->error;
    }
    $conn->close();
}
