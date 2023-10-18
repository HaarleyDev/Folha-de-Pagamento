
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorio por departamento</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 500px;
        padding: 40px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .sitemap {
        margin-bottom: 20px;
        font-size: 14px;
        color: #999;
    }

    .sitemap a {
        text-decoration: none;
        color: #333;
    }

    .sitemap a:hover {
        text-decoration: underline;
    }

    h1 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        font-size: 16px;
        margin-bottom: 10px;
        color: #333;
    }

    select {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
    }

    input[type="submit"] {
        padding: 12px 20px;
        font-size: 16px;
        background-color: #09567a;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #063950;
    }

    button {
        padding: 12px 20px;
        font-size: 16px;
        background-color: #09567a;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #063950;
    }
</style>
<body>
    <div class="container">
        <div class="sitemap">
            <a href="../admin.php">Tela inicial</a> > <a href="#">Relatório departamental</a>
        </div>
        <h1>Selecione departamento</h1>
        <form action="../back/relatorios/gasto_d.php" method="POST">
            <label>Nome do departamento </label>
            <select name="departamento" required>
                <option value="" disabled selected>Selecione o departamento</option>
                <?php
                $sql = "SELECT * FROM dep";
                $result = $conn->query($sql);
                if ($result->num_rows) {
                    while ($linha = $result->fetch_assoc()) {
                        echo "<option value=" . $linha['id_dep'] . ">" . $linha['nome_dep'] . "</option>";
                    }
                } else {
                    echo "Sem departamento cadastrado";
                }
                ?>
            </select>
            <p></p>
            <input type="submit" value="Consultar">
            <a href="../admin.php"><button type="button">Voltar</button></a>
        </form>
    </div>
</body>

</html>