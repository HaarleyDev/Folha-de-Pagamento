<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Recuperação de Senha</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f2f2f2;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .container{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 90px 45px;
            width: 500px;
            background-color: #fff;
            border-radius: 15px;
        }
        .container h2{
            color: black;
            font-size: 2.5em;
            margin: 2rem;
        }
        .container form{
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        form label{
            font-size: 20px;
            margin-bottom: 4px;
        }
        form input{
            padding: 15px;
            outline: none;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        form button{
            padding: 17px;
            font-size: 17px;
            border: 2px solid;
            border-radius: 15px;
            cursor: pointer;
            border: none;
            color: white;
            background-color: #09567a;
        }
        a{
            text-decoration: none;
            font-size: 20px;
            color: dodgerblue;
        }
</style>
</head>
<body>
    <div class="container">
    <p><a href="../admin.php">Tela Inicial</a> &raquo; <a href="#.php">Redefinir senha</a></p>
    <h2>Redefinir senha</h2>
    <?php 
    session_start();
        if (isset($_SESSION['recuperar'])){
            echo $_SESSION['recuperar'];
            unset($_SESSION['recuperar']);
          }
    ?>
    <br>
    <form method="POST" action="recuperar.php">
        <label>Insira e-mail de login:</label>
        <input type="email" name="email" placeholder="Email Válido Cadastrado" required>
        <button type="submit">Restaurar</button>
    </form>
</div>
</body>
</html>
