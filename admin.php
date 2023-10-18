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
$sql = "SELECT * FROM func WHERE email = '$user'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $log = $row['nome'];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <div id="header">
        <h2 class="bv">Bem vindo(a) <?php echo $log; ?> ao Recursos Humanos</h2>
    </div>

    <div class="menu-bar">
        <h1 class="logo"><i class="bi bi-currency-exchange"></i> Cloud Finance </h1>
        <ul>
            <li><a href="pag.php">Fazer Pagamentos</a></li>
            <li><a href="#">Cadastrar <i class="fas fa-caret-down"></i></a>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="cadastro.php">Funcionários</a></li>
                        <li><a href="cadastro_d.php">Departamentos</a></li>
                </div>
            </li>
            <li><a href="#">Relatórios <i class="fas fa-caret-down"></i></a>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="#">Gastos</a><i class="fas fa-caret-right"></i></a>
                            <div class="dropdown-menu-1">
                                <ul>
                                    <li><a href="gastos/gasto_a.php">Anual</a></li>
                                    <li><a href="gastos/gasto_m.php">Mensal</a></li>
                                    <li><a href="gastos/gasto_d.php">Departamentais</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">Gráficos</a><i class="fas fa-caret-right"></i></a>
                            <div class="dropdown-menu-1">
                                <ul>
                                    <li><a href="grafico/grafico_a.php">Anual</a></li>
                                    <li><a href="grafico/grafico_d.php">Departamentais</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">Funcionário</a><i class="fas fa-caret-right"></i></a>
                            <div class="dropdown-menu-1">
                                <ul>
                                    <li><a href="funcionario/relatorio_a.php">Anual</a></li>
                                    <li><a href="funcionario/relatorio_m.php">Mensal</a></li>
                                </ul>
                            </div>
                        </li>
                </div>
            <li><a href="qrcode.php">QrCode</a></li>
        </ul>
        <a href="sair.php"><button type="button" class="sair">Sair</button></a>
    </div>



    <div id="content">
        <div class="card">
            <center>
                <h2><i class="bi bi-person-circle"></i> Total de Funcionários</h2>
            </center>
            <center>
                <p>
                    <?php
                    $sql = "SELECT COUNT(*) as total from func where tipo=0";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                    }
                    ?>
                </p>
            </center>
            <center><a class="details-link" href="detalhes/funcionario.php">Ver detalhes</a></center>
        </div>

        <div class="card">
            <center>
                <h2><i class="bi bi-building-check"></i> Total de Departamentos</h2>
            </center>
            <center>
                <p>
                    <?php
                    $sql = "SELECT COUNT(*) as total from dep";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                    }
                    ?>
                </p>
            </center>
            <center><a class="details-link" href="detalhes/departamento.php">Ver detalhes</a></center>
        </div>

        <div class="card">
            <center>
                <h2><i class="bi bi-cash-coin"></i> Total de Pagamentos</h2>
            </center>
            <center>
                <p>
                    <?php
                    $sql = "SELECT COUNT(*) as total from pag";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                    }
                    ?>
                </p>
            </center>
            <center><a class="details-link" href="detalhes/pagamentos.php">Ver detalhes</a></center>
        </div>
    </div>

    <center>
        <h1>Solicitação de Cadastro</h1>
    </center><br>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Idade</th>
                <th>Cadastrar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM soli";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row['nome'] . "</td>
                    <td>" . $row['email'] . "</td>" .
                        "<td>" . $row['cpf'] . "</td>" .
                        "<td>" . $row['telefone'] . "</td>" .
                        "<td>" . $row['idade'] . "</td>
                    <td><a href='cadastro_s.php?id=" . $row['idsol'] . "'><button type='button' class='btn btn-info'>Cadastrar</button></a></td>
                    <td><a href='excluir_s.php?id=" . $row['idsol'] . "'><button type='button' class='btn btn-danger'>Excluir Solicitação</button></a></td>
                </tr>";
                }
            } else {
                echo "<td colspan='6'><center>Sem dados</center></td>";
            }

            ?>
        </tbody>
    </table>
</body>

</html>