<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Recuperação de Senha</title>
</head>
<body>
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
            font-size: 2em;
            margin: 2rem;
        }
        .container form{
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        form label{
            font-size: 26px;
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
            font-size: 20px;
            text-decoration: none;
            color: dodgerblue;
        }
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance:textfield;
}
</style>
    <div class="container">
    <p><a href="../admin.php">Tela Inicial</a> &raquo; <a href="redef.php">Redefinir senha</a> &raquo; <a href="#.php">Inserir codigo redefinir senha</a></p>   
    <h2>Código Redefinir senha</h2>
    <?php 
    session_start();
        if (isset($_SESSION['token'])){
            echo $_SESSION['token'];
            unset($_SESSION['token']);
          }
    ?>
    <br>
    <label>Verifique seu e-mail e digite o código enviado para continuar:</label>
    <form method="post" action="novasenha.php">
        <input type="number" name="token" min="2" placeholder="Código Recebido" required>
        <button type="submit">Recuperar</button>
    </form>
</div>
