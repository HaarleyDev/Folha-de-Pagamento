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
<?php

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM soli WHERE idsol = {$id}";
    $result2 = $conn->query($sql2);
    $data = $result2->fetch_assoc();
?>
  <div class="form-container">
    <div class="logo">
      <h1 class="logo"><i class="bi bi-currency-exchange"></i> Cloud Finance </h1>
    </div>
    <?php
    if (isset($_SESSION['alert'])) {
      echo $_SESSION['alert'];
      unset($_SESSION['alert']);
    }
    ?>
    <h2>Cadastro Funcionario</h2>
    <form action="back/cadastro_s.php" method="POST">
      <div class="all">

        <div class="form-row">
          <label>Nome Completo</label>
          <input type="text" name="nome" placeholder="Nome Completo" maxlength="50" minlength="2" placeholder="Nome Completo" id="nome_contacto" oninput="converterPrimeiraLetraMaiuscula(this)" value=" <?php echo $data['nome'] ?>" required>
        </div>

        <div class="form-row">
        <label>Departamento do funcionario</label>
        <select name="departamento" required>
            <option value="" disabled selected>Selecione o departamento</option>
            <?php
            $sql = "SELECT * FROM dep";
            $result = $conn->query($sql);
            if ($result->num_rows) {
                while ($linha = $result->fetch_assoc()) {
                    echo "<option value=" . $linha['id_dep'] . ">" . $linha['nome_dep'] . "</option>";
                }
            }
            ?>
        </select>
        </div>

        <div class="form-row">
          <label>Idade</label>
          <input type="number" name="idade" min="1" placeholder="Idade" value="<?php echo $data['idade'] ?>" required>
        </div>

        <div class="form-row">
          <label>Rua</label>
          <input name="rua" type="text" id="rua" placeholder="Rua" readonly value="<?php echo $data['rua'] ?>" required>
        </div>

        <div class="form-row">
          <label>CPF</label>
          <input id="cpf" name="cpf" type="text" onkeyup="cpfCheck(this)" placeholder="Ex.xxx.xxx.xxx-xx" maxlength="14" minlength="5" onkeydown="javascript: fMasc( this, mCPF );" value="<?php echo $data['cpf'] ?>" required>
          <span id="cpfResponse"></span>
        </div>

        <div class="form-row">
          <label>Bairro</label>
          <input name="bairro" type="text" id="bairro" placeholder="bairro" readonly value="<?php echo $data['bairro'] ?>" required>
        </div>

        <div class="form-row">
          <label for="telefone">Telefone</label>
          <input type="text" id="telefone" name="telefone" onkeyup="handlePhone(event)" placeholder="Ex.(xx) xxxx-xxxx " maxlength="15" minlength="5" value="<?php echo $data['telefone'] ?>" required>
        </div>

        <div class="form-row">
          <label>Cidade</label>
          <input name="cidade" type="text" id="cidade" placeholder="Cidade" readonly value="<?php echo $data['cidade'] ?>" required>
        </div>

        <div class="form-row">
          <label>Email</label>
          <input type="email" name="email" placeholder="Ex.funcionario@email.com" maxlength="50" minlength="2" value="<?php echo $data['email'] ?>" required>
        </div>

        <div class="form-row">
          <label>Estado</label>
          <input name="estado" type="text" id="uf" placeholder="UF" readonly value="<?php echo $data['estado'] ?>" required>
        </div>


        <div class="form-row">
          <label>Senha</label>
          <div id="nivel"></div>
          <div id="requisitos"></div>
          <input type="password" name="pass" placeholder="Maximo 21 caracteres" maxlength="21" minlength="8" id="senha" onkeyup="senhaForca()" class="button" value="<?php echo $data['pass'] ?>" required>
          <input id="toggleSenha" type="checkbox">Mostrar senha</input>
          <p>
          <div class="progresso">
            <div id="barra-progresso" class="forte"></div>
            <div id="barra-progresso-texto"></div>
          </div>
        </div>

        <div class="form-row-senha">
        <input type="hidden" name="idsol" value="<?php echo $data['idsol'] ?>" />
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
<?php
    }else{
      header('location:admin.php');
    }
?>
<script src="js/main.js"></script>
<script>
  const toggleSenhaBtn = document.getElementById('toggleSenha');
  const senhaInput = document.getElementById('senha');

  toggleSenhaBtn.addEventListener('click', function() {
    if (senhaInput.type === 'password') {
      senhaInput.type = 'text';
      toggleSenhaBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
      senhaInput.type = 'password';
      toggleSenhaBtn.innerHTML = '<i class="fas fa-eye"></i>';
    }
  });
</script>
<script>
  function verificarForcaSenha() {
    const senha = document.getElementById('senha').value;
    const forca = calcularForcaSenha(senha);
    const nivel = obterNivelSenha(forca);
    const requisitos = obterRequisitosSenha(senha);
    exibirNivelSenha(nivel);
    exibirRequisitosSenha(requisitos);
    atualizarBarraProgresso(forca);
  }

  function calcularForcaSenha(senha) {
    let forca = 0;

    if (senha.length >= 8) {
      forca += 25;
    }
    if (senha.match(/[a-z]/) && senha.match(/[A-Z]/)) {
      forca += 25;
    }
    if (senha.match(/[0-9]/)) {
      forca += 25;
    }
    if (senha.match(/[!@#$%^&*]/)) {
      forca += 25;
    }

    return forca;
  }

  function obterNivelSenha(forca) {
    if (forca >= 75) {
      return 'Forte';
    } else if (forca >= 50) {
      return 'Média';
    } else if (forca >= 25) {
      return 'Fraca';
    } else {
      return 'Muito Fraca';
    }
  }

  function obterRequisitosSenha(senha) {
    const requisitos = [];

    if (senha.length < 8) {
      requisitos.push('Pelo menos 8 caracteres');
    }
    if (!senha.match(/[a-z]/)) {
      requisitos.push('Pelo menos 1 letra minúscula');
    }
    if (!senha.match(/[A-Z]/)) {
      requisitos.push('Pelo menos 1 letra maiúscula');
    }
    if (!senha.match(/[0-9]/)) {
      requisitos.push('Pelo menos 1 número');
    }
    if (!senha.match(/[!@#$%^&*]/)) {
      requisitos.push('Pelo menos 1 caractere especial');
    }

    return requisitos;
  }

  function exibirNivelSenha(nivel) {
    // document.getElementById('nivel').innerHTML = `Nível de Senha: ${nivel}`;
  }

  function exibirRequisitosSenha(requisitos) {
    const requisitosElement = document.getElementById('requisitos');
    requisitosElement.innerHTML = '';

    requisitos.forEach((requisito) => {
      const requisitoElement = document.createElement('p');
      requisitoElement.textContent = requisito;
      requisitosElement.appendChild(requisitoElement);
    });
  }

  function atualizarBarraProgresso(forca) {
    const barraProgresso = document.getElementById('barra-progresso');
    const barraProgressoText = document.getElementById('barra-progresso-texto');

    barraProgresso.style.width = `${forca}%`;
    barraProgressoText.textContent = `${forca}%`;

    barraProgresso.className = '';
    if (forca < 30) {
      barraProgresso.classList.add('fraca');
    } else if (forca < 50) {
      barraProgresso.classList.add('media');
    } else if (forca < 70) {
      barraProgresso.classList.add('intermediaria');
    } else {
      barraProgresso.classList.add('forte');
    }
  }

  // Adicionando o evento de entrada para o campo de senha
  document.getElementById('senha').addEventListener('input', verificarForcaSenha);
</script>