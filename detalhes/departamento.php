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
<?php

?>
<!DOCTYPE html>
<html>

<head>
    <title>Tabela de departamentos</title>
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
            max-width: 800px;
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
            background-color: #99ccff;
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
            background-color: #99ccff;
            border: none;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0066cc;
        }

        footer {
            background-color: #f3f3f3;
            color: black;
            padding: 10px;
            text-align: center;
        }
        form label{
            font-size: 17px;
        }
        form button{
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
        form button:hover{
            background-color: #063950;
        }
        form input{
            width: 27%;
            padding: 0.5%;
            border-radius: 7px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tabela de Departamentos</h2>
        <form method="GET">
            <b><label for="termo">Pesquisar pelo departamento:</label></b>
            <input type="text" name="termo" id="termo" placeholder="Nome do departamento" required>
            <button type="submit">Pesquisar</button>
        </form><p></p>
        <table>
            <tr>
                <th>Departamento</th>
            </tr>

            <?php
            @$termoPesquisa = $_GET['termo'];
            $sql = "SELECT * FROM dep WHERE nome_dep LIKE '%$termoPesquisa%' ORDER BY nome_dep";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$row['nome_dep']."</td>";
                    echo "</tr>";
                }
            }else{
                echo "<tr><td>Sem dados apresentar</td></tr>";
            }
            ?>
        </table><p></p>

        <footer>
            <p>&copy; 2023 Cloud Finance. Todos os direitos reservados.</p>
        </footer>

        <div class="buttons">
            <a href="../admin.php"><button class="button">Voltar</button></a>
        </div>
    </div>
</body>

</html>