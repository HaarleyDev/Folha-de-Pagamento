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
        <a href="../admin.php">Tela inicial</a> > <a href="../../funcionario/relatorio_m.php">Relatório por funcionario</a> > <a href="#">Relatorio do funcionario no mês referente</a>
        </div>
        <h1>Relatório mensal do funcionario</h1>
        <?php
        require_once '../connect.php';
        ?>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Horas trabalhadas</th>
                    <th>Valor por horas</th>
                    <th>Data pagamento</th>
                    <th>Salario liquido</th>
                </tr>
                <?php
                $mes = $_POST['mes'];

                $sql = "SELECT f.nome, p.trabalhadas_h, p.valor_h, p.data_p, p.salario_l from pag as p, func as f WHERE p.id_p = '$mes' and p.id_f = f.id_f";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . $row['trabalhadas_h'] . "</td>";
                        echo "<td>" . "R$ " . $row['valor_h'] . "</td>";
                        echo "<td>" . $row['data_p'] . "</td>";
                        echo "<td>" . "R$ " . $row['salario_l'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Ainda não possui pagamento";
                }
                ?>
            </thead>
        </table>
        <div style="text-align: center; margin-top: 20px;">
            <a class="btn" href="../../funcionario/relatorio_m.php">Voltar</a>
            <a class="btn" onclick="window.print()">Imprimir</a>
        </div>
    </div>
</body>

</html>