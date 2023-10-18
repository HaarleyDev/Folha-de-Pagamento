<?php
session_start();
require_once '../back/connect.php';
$user = $_SESSION['email'];
$pass = $_SESSION['pass'];
$tipo = $_SESSION['tipo'];

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['pass']) == true) and $tipo == 1) {
    header('location:admin.php');
} else if ($tipo != 1) {
    header('location:index.php');
}
?>
<?php
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM func WHERE id_f = {$id}";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $conn->close();
?>
    <html>

    <head>
        <style type="text/css">
            fieldset {
                width: 50%;
                margin: auto;
                margin-top: 100px;
            }

            table tr th {
                margin-top: 20px;
            }
        </style>
        <title></title>
    </head>

    <body>
        <fieldset>
            <legend>Editar Funcionário</legend>
            <form action="../back/editar.php" method="post">
                <table cellspacing='0' cellpadding="0">
                    <tr>
                        <th>Nome</th>
                        <td><input type="text" name="nome" placeholder="Nome" value="<?php echo $data['nome'] ?>"></td>
                    </tr>
                    <tr>
                        <th>CPF</th>
                        <td><input type="text" name="cpf" placeholder="CPF" value="<?php echo $data['cpf'] ?>"></td>
                    </tr>
                    <tr>
                        <th>Idade</th>
                        <td><input type="text" name="idade" placeholder="Idade" value="<?php echo $data['idade'] ?>"></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id_f" value="<?php echo $data['id_f'] ?>" />
                        <td><button type="submit">Salvar Alterações</button></td>
                        <td><a href="admin.php"><button type="button">Voltar</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>

    </html>
<?php
}
?>