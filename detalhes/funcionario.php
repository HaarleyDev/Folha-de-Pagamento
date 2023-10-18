<?php require_once '../back/connect.php'; ?>
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
<html>

<head>
    <title>Tabela de funcionários</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 9000px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #09567a;
            color: #fff;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            background-color: #09567a;
            border: none;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #063950;
        }

        footer {
            background-color: #f3f3f3;
            color: black;
            padding: 10px;
            text-align: center;
        }

        .editar {
            display: inline-block;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            background-color: #428bca;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .editar:hover {
            background-color: #009ACD;
        }

        .excluir {
            display: inline-block;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            background-color: #d9534f;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .excluir:hover {
            background-color: #CD3333;
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
    </style>
</head>

<body>
    <div class="container">
        <h2>Tabela de Funcionários</h2>
        <form method="GET">
            <b><label for="termo">Pesquisar pelo nome:</label></b>
            <input type="text" name="termo" id="termo" placeholder="Nome do funcionário" required>
            <button type="submit">Pesquisar</button>
        </form>
        <p></p>
        <table>
            <tr>
                <th>Nome</th>
                <th>Departamento</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Cpf</th>
                <th>idade</th>
                <th>Editar</th>
                <th>Excluir</th>

            </tr>

            <?php
            @$termoPesquisa = $_GET['termo'];

            $sql = "SELECT f.nome, d.nome_dep, f.email, f.telefone, f.cpf, f.id_f, f.idade
            FROM func as f, dep as d
            WHERE id_dep = id_d and id_d = id_dep and f.nome LIKE '%$termoPesquisa%' ORDER BY d.nome_dep";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['nome_dep'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['telefone'] . "</td>";
                    echo "<td>" . $row['cpf'] . "</td>";
                    echo "<td>" . $row['idade'] . "</td>";
                    echo "<td> <a href=../acoes/editar.php?id=" . $row['id_f'] . "><button type='button' class = 'editar'>Editar</button></a><br></td>
                          <td> <a href=../acoes/excluir.php?id=" . $row['id_f'] . "><button type='button' class = 'excluir'>Excluir</button></a><br></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'><center>Sem Dados a apresentar</center></td></tr>";
            }
            ?>
        </table>
        <p></p>

        <footer>
            <p>&copy; 2023 Cloud Finance. Todos os direitos reservados.</p>
        </footer>

        <div class="buttons">
            <a href="../admin.php"><button class="button">Voltar</button></a>
        </div>
    </div>
</body>

</html>