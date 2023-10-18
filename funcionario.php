<!DOCTYPE html>
<html>
<head>
  <title>Página de Pagamento</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #e1e1e1; /* Cor de fundo do site */
    }
    
    h1 {
      color: #333;
      margin-bottom: 20px;
    }
    
    h2 {
      color: #333;
      margin-top: 30px;
    }
    
    p {
      margin-bottom: 20px;
    }
    
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
    }
    
    th {
      background-color: #333;
      color: white;
      font-weight: bold;
    }
    
    td {
      text-align: center;
    }
    
    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    
    .info-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    
    .info-container p {
      font-size: 16px;
      margin-bottom: 5px;
    }
    
    
    .payment-table {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    
    .payment-table thead th {
      padding: 12px;
    }
    
    .payment-table tbody td {
      padding: 12px;
    }
    
    .button-container {
      margin-top: 20px;
      text-align: center;
    }
    
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff; /* Cor do botão */
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin: 0 10px;
      cursor: pointer;
      transition: background-color 0.3s ease; /* Transição suave ao passar o mouse */
    }
    
    .button:hover {
      background-color: #0056b3; /* Cor do botão ao passar o mouse */
    }
  </style>
</head>
<body>
  <?php
    session_start();
    require_once 'back/connect.php';
    $user = $_SESSION['email'];
    $pass = $_SESSION['pass'];
    $tipo = $_SESSION['tipo'];

    if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['pass']) == true) and $tipo == 1) {
      header('location:funcionario.php');
  } else if ($tipo != 1) {
      session_destroy();
      header('location:index.php');
  }
    $user = $_SESSION['email'];
    ?>
    <div class="button-container">
        <a href='sair.php' class="button">Sair</a>
    </div>

    <?php
    $sql = "SELECT * FROM func WHERE tipo = 0 and email = '$user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_u = $row['id_f'];
            $nome = $row['nome'];
            echo "<h3>Olá Funcionário $nome</h3>";
        }
    }
    ?>

  <?php
    $sql = "SELECT f.nome, d.nome_dep, f.cpf, f.idade, f.email, f.telefone
FROM func as f, dep as d
WHERE tipo = 0 and d.id_dep = f.id_d and f.id_f = '$id_u'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nome = $row['nome'];
            $dep = $row['nome_dep'];
            $cpf = $row['cpf'];
            $idade = $row['idade'];
            $email = $row['email'];
            $tel = $row['telefone'];
        }
    }
    ?>
  
  <div class="info-container">
    <h2>Informações Pessoais</h2>
    <p><strong>Nome:  </strong> <?php echo $nome; ?></p>
    <p><strong>Idade:  </strong> <?php echo $idade; ?></p>
    <p><strong>Departamento:</strong> <?php echo $dep; ?></p>
    <p><strong>CPF: </strong> <?php echo $cpf; ?></p>
    <p><strong>Email: </strong> <?php echo $email; ?></span></p>
    <p><strong>Telefone: </strong> <?php echo $tel; ?></p>
  </div>
<form method="GET">
  <label>Pesquisa pelo mês: </label>
  <input type="text" name="termo">
  <button type="submit">Pesquisar</button>
</form>

  <div class="payment-table">
    <table class="table">
      <thead>
        <tr>
          <th>Mês Referente</th>
          <th>Salário Bruto</th>
          <th>IR</th>
          <th>INSS</th>
          <th>FGTS</th>
          <th>Vale Transporte</th>
          <th>Horas Trabalhadas</th>
          <th>Valor da Hora</th>
          <th>Salário Líquido</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require_once 'back/connect.php';
        @$termoPesquisa = $_GET['termo'];
        $sql = "SELECT * FROM pag WHERE id_f = '$id_u' and data_p LIKE '%$termoPesquisa%' order by data_p desc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $row['data_p']
        ?>
            <form action="back/contra.php" method="POST">
              <input type="hidden" name="id_f" value="<?php echo $row["id_f"]; ?>">
              <?php
              echo "
          <tr>
          <td>" . $row["data_p"] . "</td> 
          <td>" . $row["salario_b"] . "</td> 
          <td>" . $row["IR"] . "</td>
          <td>" . $row["INSS"] . "</td>
          <td>" . $row["FGTS"] . "</td>
          <td>" . $row["Vale_t"] . "</td>
          <td>" . $row["trabalhadas_h"] . "</td>
          <td>" . $row["valor_h"] . "</td> 
          <td>" . $row["salario_l"] . "</td>
          <td>
          <button name='data_p' value=" . $row['data_p'] . " type='submit' class='button'>Contra-Cheque</button><br></td>
          </form></tr>";
          }
        } else {
          echo "<tr><td colspan='10'><center>Sem Dados a apresentar</center></td></tr>";
        } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
