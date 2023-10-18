<?php require_once '../back/connect.php';
session_start();
    if ($_POST) {
        $token = $_POST['token'];
        $sql = "SELECT * FROM recu WHERE token = '$token'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['data'] > date('Y-m-d')) { ?>
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
            font-size: 20px;
            text-decoration: none;
            color: dodgerblue;
        }
</style>
                <div class="container">
                <p><a href="../admin.php">Tela Inicial</a> &raquo; <a href="redef.php">Redefinir senha</a> &raquo; <a href="redefinir.php">Inserir código redefinir senha</a> &raquo; <a href="#.php">Inserir nova senha</a></p>
                        <h2>Editar Senha</h2>
                        <form action="editsenha.php" method="post">
                            <label>Digite Sua Nova Senha: </label>
                            <input type="password" name="senha" placeholder="Minimo de 8 caracteres" maxlength="21" minlength="8" required>
                            <input type="hidden" name="id_f" value="<?php echo $row['id_f'] ?>" />
                            <button type="submit" name="qualquer">Salvar Alterações</button>
                            <input type="hidden" name="token" value="<?php echo $token ?>">
                            
                        </form>
                    </div>
                    <?php
                } else {
                    echo $_SESSION['token'] = "<div style='color: red;'>Tempo para redefinição de senha expirado. Tente novamente.</div>";
                    header('location:redefinir.php');
                    $sql4 = "DELETE FROM recu WHERE token = '$token'";
                    if ($conn->query($sql4) == TRUE) {
                    } else {
                        echo 'erro';
                    }
                }
            }
        } else {
            $_SESSION['token'] = "<div style='color: red;'>Digite o token corretamente!</div>";
            header('location:redefinir.php');
        }
    }

    ?>