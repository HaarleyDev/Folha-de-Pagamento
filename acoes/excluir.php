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
        <title>Remover Funcionário</title>
    </head>

    <body>
        <h3> Você realmente deseja remover?</h3>
        <form action="../back/excluir.php" method="post">
            <input type="hidden" name="id_f" value="<?php echo $data['id_f'] ?>" />
            <button type="submit">Confirmar</button>
            <a href="admin.php"><button type="button">Voltar</button></a>
        </form>
    </body>

    </html>
<?php
}
?>