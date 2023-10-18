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
require_once '../back/connect.php';
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM soli WHERE idsol = {$id}";
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
        <form action="../back/excluir_s.php" method="post">
            <input type="hidden" name="idsol" value="<?php echo $data['idsol'] ?>" />
            <button type="submit">Confirmar</button>
            <a href="admin.php"><button type="button">Voltar</button></a>
        </form>
    </body>

    </html>
<?php
}
?>