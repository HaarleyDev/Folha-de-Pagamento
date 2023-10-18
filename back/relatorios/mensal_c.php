<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php
    require_once '../connect.php';

    if ($_POST) {
        $mensal = $_POST['func_mensal'];
    }
    ?>
    <div class="container">
        <div class="sitemap">
        <a href="../admin.php">Tela inicial</a> > <a href="../../funcionario/relatorio_m.php">Relatório por funcionario</a> > <a href="#">Relatório por mês</a>
        </div>
        <h1>Selecione o mês referemte</h1>
        <form action="mensal.php" method="POST">
            <label>Selecione o mes referente</label>
            <select name='mes'>
            <option value="" disabled selected>Selecione o mês</option>
                <?php
                $sql = "SELECT * FROM pag WHERE id_f = '$mensal'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=" . $row['id_p'] . ">" . $row['data_p'] . "</option>";
                    }
                } else {
                    echo "Sem pagamento a apresentar";
                }
                ?>
            </select>
            <p></p>
            <button type="submit">Consultar</button>
            <a href="../../funcionario/relatorio_m.php"><button type="button">Voltar</button></a>
        </form>
    </div>
</body>

</html>