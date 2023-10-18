<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Login</title>
</head>

<body>
    <div class="box">
        <div class="img-box">
            <br>
            <img src="img/logo.png" class="img-img">
        </div>
        <div class="form-box">
            <h2>LOGIN</h2><br>
            <p>Não possui uma conta?<a href="solicitacao.php"> Solicitar cadastro</a></p>
            <p>Esqueceu sua senha?<a href="senha/redef.php"> Recuperar senha</a></p>
            
            <form method="POST" action="back/login.php">

                <div class="input-group">
                    <label for="email"> E-mail </label>
                    <input type="text" name='email' id="email" placeholder="Digite o seu E-mail" required>
                </div>

                <div class="input-group">
                    <label for="senha"> Senha </label>
                    <input type="password" name='pass' id="senha" placeholder="Digite a sua Senha" required>
                </div>

                <div class="input-group">
                    <button>Entrar</button>
                </div>
                
                <footer>
                    <p>&copy; 2023 Cloud Finance. Todos os direitos reservados.</p>
                </footer>
            </form>
        </div>
    </div>

</body>

</html>