<?Php require_once 'back/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela cadastro</title>
  <link rel="stylesheet" href="css/barra_senha.css">
  <link rel="stylesheet" href="css/solicitacao.css">
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

  input[type=checkbox] {
    accent-color: #09567a;
  }
  @keyframes load{
    to{transform: rotate(360deg);}
  }
  .pre{
    width: 80px;
    height: 80px;
    background-image: url("img/carregando.png");
    background-position: center;
    background-size: contain;
    animation: load 2s infinite linear;
  }
  .box-load{
    position: absolute;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<body onload="loading()">
  <div class="box-load">
    <div class="pre"></div>
  </div>
  <div class="content">
    <div class="form-container">
      <div class="logo">
        <h1 class="logo"><i class="bi bi-currency-exchange"></i> Cloud Finance </h1>
      </div>
      <?php
      session_start();
      if (isset($_SESSION['alert'])) {
        echo $_SESSION['alert'];
        unset($_SESSION['alert']);
      }
      ?>
      <h2>Solicitação cadastro</h2>
      <form action="back/solicitacao.php" method="POST">
        <div class="all">

          <div class="form-row">
            <label>Nome Completo</label>
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="50" minlength="2" id="nome_contacto" oninput="converterPrimeiraLetraMaiuscula(this)" required>
          </div>

          <div class="form-row">
            <label>Cep</label>
            <input name="cep" type="text" id="cep" value="" maxlength="9" onblur="pesquisacep(this.value);" onkeyup="handleZipCode(event)" placeholder="Ex.xxxxx-xxx" required>
          </div>

          <div class="form-row">
            <label>Idade</label>
            <input type="number" name="idade" min="1" placeholder="Idade" required>
          </div>

          <div class="form-row">
            <label>Rua</label>
            <input name="rua" type="text" id="rua" placeholder="Rua" readonly required>
          </div>

          <div class="form-row">
            <label>CPF</label>
            <input id="cpf" name="cpf" type="text" onkeyup="cpfCheck(this)" placeholder="Ex.xxx.xxx.xxx-xx" maxlength="14" minlength="5" onkeydown="javascript: fMasc( this, mCPF );" required>
            <span id="cpfResponse"></span>
          </div>

          <div class="form-row">
            <label>Bairro</label>
            <input name="bairro" type="text" id="bairro" placeholder="Bairro" readonly required>
          </div>

          <div class="form-row">
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" onkeyup="handlePhone(event)" placeholder="Ex.(xx) xxxx-xxxx " maxlength="15" minlength="5" required>
          </div>

          <div class="form-row">
            <label>Cidade</label>
            <input name="cidade" type="text" id="cidade" placeholder="Cidade" readonly required>
          </div>

          <div class="form-row">
            <label>Email</label>
            <input type="email" name="email" placeholder="Ex.funcionario@email.com" maxlength="50" minlength="2" required>
          </div>

          <div class="form-row">
            <label>Estado</label>
            <input name="estado" type="text" id="uf" placeholder="UF" readonly required>
          </div>


          <div class="form-row">
            <label>Senha</label>
            <div id="nivel"></div>
            <div id="requisitos"></div>
            <input type="password" name="pass" placeholder="Máximo 21 caracteres" maxlength="21" minlength="8" id="senha" onkeyup="senhaForca()" class="button" required>
            <input id="toggleSenha" type="checkbox">Mostrar senha</input>

            <p>
            <div class="progresso">
              <div id="barra-progresso" class="forte"></div>
              <div id="barra-progresso-texto"></div>
            </div>
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
  </div>
</body>

</html>
<script src="js/acoes.js"></script>
<script>
  function loading(){
    document.getElementsByClassName('box-load')[0].style.display="none"
  }
</script>