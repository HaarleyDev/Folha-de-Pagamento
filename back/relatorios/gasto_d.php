<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        margin-top: 40px;
        color: #333;
        font-size: 28px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .container {
        max-width: 1500px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        height: 300px;
        /* Aumente ou diminua este valor para ajustar a altura da tabela */
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #09567a;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
    }

    td {
        border-bottom: 1px solid #e0e0e0;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .total {
        text-align: center;
        margin-top: 20px;
        font-size: 20px;
        font-weight: bold;
        color: #09567a;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #09567a;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #063950;
    }

    form label {
        font-size: 17px;
    }

    form button {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        color: #fff;
        background-color: #09567a;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    form button:hover {
        background-color: #063950;
    }

    form input {
        width: 15%;
        padding: 0.5%;
        border-radius: 7px;
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
</style>

<body>
    <div class="container">
        <div class="sitemap">
            <a href="../../admin.php">Tela inicial</a> > <a href="../../gastos/gasto_d.php">Relatório departamental</a> > <a href="#">Relatório departamental de gastos</a>
        </div>
        <h1>Relatório departamental</h1>
        <?php require_once '../connect.php'; ?>
        <table border="1">

            <th>Nome</th>
            <th>Departamento</th>
            <th>Salario Liquido</th>
            <th>Mês pagamento</th>
            <?php

            $dep = $_POST['departamento'];

            $sql = "SELECT f.nome, d.nome_dep, p.salario_l, p.data_p
                FROM dep as d, func as f, pag as p
                WHERE f.id_d = $dep and d.id_dep = $dep and f.id_f = p.id_f ORDER BY f.nome, p.data_p DESC";
            $result = $conn->query($sql);
            $total = 0.0;
            if ($result->num_rows > 0) {
                while ($linha = $result->fetch_assoc()) {
                    $total += $linha['salario_l'];
                    echo "<tr>";
                    echo "<td>" . $linha['nome'] . "</td>";
                    echo "<td>" . $linha['nome_dep'] . "</td>";
                    echo "<td>" . "R$ " . $linha['salario_l'] . "</td>";
                    echo "<td>" . $linha['data_p'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td>Sem dados para apresentar<p></p></td></tr>";
            }
            ?>
        </table>
        <h2 class="total">Gasto Total: <?php echo "R$ " . number_format($total, 2, ',', '.'); ?></h2>
        <div style="text-align: center; margin-top: 20px;">
            <a class="btn" href="../../gastos/gasto_d.php">Voltar</a>
            <a class="btn" onclick="window.print()">Imprimir</a>
        </div>
    </div>
</body>

</html>