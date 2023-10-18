<?php
require_once 'connect.php';
if ($_POST) {
    $id = $_POST['id_f'];
    $sql = "DELETE FROM func WHERE id_f = {$id}";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Funcionario removido com sucesso!</p>";
        echo "<a href='../admin.php'><button type='button'>Voltar</button></a>";
    } else {
        echo "Erro ao excluir o registro: " . $conn->error;
    }
    $conn->close();
}
