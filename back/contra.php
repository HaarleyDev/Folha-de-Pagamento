<link rel="stylesheet" href="../css/contra.css">
<?php
require_once 'connect.php';
if ($_POST) {
  $data = $_POST['data_p'];
  $id_f = $_POST['id_f'];

  

  $sql = "SELECT * FROM func WHERE tipo=0 and id_f = '$id_f'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($linha = $result->fetch_assoc()) {
      $nome = $linha['nome'];
      $cpf = $linha['cpf'];
      $idade = $linha['idade'];
      $id_d = $linha['id_d'];
    }
  }

  $sql = "SELECT * FROM dep WHERE id_dep = '$id_d'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($linha = $result->fetch_assoc()) {
      $nome_dep = $linha['nome_dep'];
    }
  }

  $sql = "SELECT * FROM pag where id_f='$id_f' and data_p='$data'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "
            <body>
  <div class='container'>
    <h1>Demonstrativo de Pagamento</h1>
    
    <table class='info-table'>
      <tr>
        <th>Nome: </th>
        <td>$nome</td>
      </tr>

      <tr>
        <th>CPF:</th>
        <td>$cpf</td>
      </tr>

      <tr>
        <th>Idade:</th>
        <td>$idade</td>
      </tr>

      <tr>
        <th>Departamento:</th>
        <td>$nome_dep</td>
      </tr>

      <tr>
      <th>Horas trabalhadas:</th>
      <td>" . $row['trabalhadas_h'] . " hora(s)</td>
      </tr>

      <tr>
      <th>Valor Hora:</th>
      <td> R$ " . $row['valor_h'] . "</td>
      </tr>
      
      <tr>
      <th>Mês referente:</th>
      <td>" . $data . "</td>
      </tr>

    </table>
    
    <h2>Detalhes do Pagamento</h2>
    
    <table class='payment-table'>
      <tr>
        <th>Descrição</th>
        <th>Valor</th>
      </tr>

      <tr>
        <td>Salário Bruto:</td>
        <td> R$ " . $row['salario_b'] . "</td>
      </tr>

      <tr>
        <td>Desconto IR:</td>
        <td> R$ " . $row['IR'] . "</td>
      </tr>

      <tr>
        <td>Desconto INSS:</td>
        <td> R$ " . $row['INSS'] . "</td>
      </tr>

      <tr>
      <td>Desconto FGTS:</td>
      <td> R$ " . $row['FGTS'] . "</td>
      </tr>
      
      <tr class='total-row'>
        <td>Total a Receber</td>
        <td> R$ " . $row['salario_l'] . "</td>
      </tr>
    </table>

    <div class='button-container'>
    <a href='../funcionario.php'><button type='button'>Voltar</button></a>
    <button onclick='window.print()'>Imprimir</button>
  </div>
  </div>
</body>
</html>
            ";
    }
  } else {
    echo "Sem dados";
  }
}

?>