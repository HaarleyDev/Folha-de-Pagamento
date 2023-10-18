<?php
require_once 'connect.php';
if ($_POST) {
    $id = $_POST['idsol'];
    $sql = "DELETE FROM soli WHERE idsol = {$id}";
    if ($conn->query($sql) === TRUE) {
        echo "<p>solicitação removido com sucesso!</p>";
        echo "<a href='../admin.php'><button type='button'>Voltar</button></a>";
    } else {
        echo "Erro ao excluir o registro: " . $conn->error;
    }
    $conn->close();
}
