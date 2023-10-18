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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela cadastro</title>
  <link rel="stylesheet" href="css/barra_senha.css">
  <link rel="stylesheet" href="css/cadastro.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>
<style>
  #requisitosforca {
    color: red;
  }

  .progresso {
    width: 200px;
    height: 20px;
    background-color: #f1f1f1;
    border-radius: 5px;
    margin-top: 10px;
  }

  #barra-progresso {
    height: 100%;
    text-align: center;
    color: white;
    border-radius: 5px;
    transition: width 0.3s;
  }

  #barra-progresso-texto {
    line-height: 20px;
  }

  .fraca {
    background-color: #ff0000;
  }

  .media {
    background-color: #ffa500;
  }

  .intermediaria {
    background-color: #ffff00;
  }

  .forte {
    background-color: #00ff00;
  }

  .olho {
    height: 5px;
    width: 0px;
    position: relative;
    left: 180px;
    top: -43px;
  }

  .fas {
    position: relative;
    left: -7px;
    top: -8px;
  }
</style>

<body>
  <div class="form-container">
    <div class="logo">
      <h1 class="logo"><i class="bi bi-currency-exchange"></i> Cloud Finance </h1>
    </div>
    <?php
    if (isset($_SESSION['alertdep'])) {
      echo $_SESSION['alertdep'];
      unset($_SESSION['alertdep']);
    }
    ?>
    <h2>Cadastrar departamento</h2>
    <form action="back/cadastro_d.php" method="POST">
      <div class="all">
        <div class="form-row">
          <label>Nome departamento</label>
          <input type="text" name="nome_dep" placeholder="Nome Completo" maxlength="50" minlength="2" placeholder="Nome Completo" id="nome_contacto" oninput="converterPrimeiraLetraMaiuscula(this)" required>
        </div>
        <div class="form-row-senha">
          <input type="submit" value="Enviar">
          <a href="admin.php"><button type="button">Voltar</button></a>
        </div>
        <p></p>

      </div>
      <footer>
        <p>&copy; 2023 Cloud Finance. Todos os direitos reservados.</p>
      </footer>
    </form>
  </div>
</body>
</html>
<script src="js/main.js"></script>