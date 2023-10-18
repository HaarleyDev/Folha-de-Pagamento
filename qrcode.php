<?php require_once 'back/connect.php'; ?>
<?php
session_start();
$user = $_SESSION['email'];
$pass = $_SESSION['pass'];
$tipo = $_SESSION['tipo'];

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['pass']) == true) and $tipo == 1) {
    header('location:admin.php');
} else if ($tipo != 1) {
  session_destroy();
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Pathway+Extreme:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Abel', sans-serif;
            font-family: 'Pathway Extreme', sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
            margin: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        div.produto {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        div.text {
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        div.text:hover {
            transform: translateY(-5px);
        }

        img.qrcode {
            width: 200px;
            height: 200px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .sitemap {
            margin-bottom: 20px;
            font-size: 18px;
            color: #999;
        }

        .sitemap a {
            text-decoration: none;
            color: #333;
        }

        .sitemap a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h2>Informações dos Funcionários</h2>
    <div class="container">
        <div class="sitemap">
            <a href="admin.php">Tela inicial</a> > <a href="#">QRcode dos funcionarios</a>
        </div>
        <div class="produto">
            <?php
            require_once('post_qr_code/phpqrcode/qrlib.php');
            require_once "back/connect.php";
            $sql = "SELECT * FROM func";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $qrCodeName = "qrcode/imagem_qrcode_{$row['nome']}.png";

                    $code =
                        "Nome do funcionário: " . $row['nome'] .
                        "\nCPF do funcionário: " . $row['cpf'] .
                        "\nIdade: " . $row['idade'] .
                        "\nE-mail: " . $row['email'] .
                        "\nTelefone: " . $row['telefone'] .
                        "\n--------------Endereços---------------" .
                        "\nRua: " . $row['rua'] .
                        "\nCidade: " . $row['cidade'] .
                        "\nEstado: " . $row['estado'];

                    QRcode::png($code, $qrCodeName);
            ?>
                    <div class="text">
                        <h3><?php echo $row['nome'] ?></h3>
                        <img src="<?php echo $qrCodeName; ?>" class="qrcode">
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>