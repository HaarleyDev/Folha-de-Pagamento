
    <?php require_once '../back/connect.php';
    if($_POST){ //ATUALIZA A SENHA
        $senha = $_POST['senha'];
        $id = $_POST['id_f'];
        $token = $_POST['token'];
         $sql2 = "UPDATE func SET pass = '$senha' WHERE id_f = '$id'";
        if($conn -> query($sql2) === TRUE){
            echo "<!DOCTYPE html>
            <html>
            <head>
              <title>Tela de Agradecimento</title>
            </head>
            <style>
            .container {
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
              text-align: center;
              margin-top: 200px;
            }
            
            h1 {
              font-size: 32px;
              color: #333;
            }
            
            p {
              font-size: 24px;
              color: #666;
            }
            
            .buttons {
              margin-top: 20px;
            }
            
            .button {
              display: inline-block;
              padding: 10px 20px;
              background-color: #09567a;
              color: #fff;
              text-decoration: none;
              font-size: 18px;
              border-radius: 5px;
              margin-right: 10px;
              border: none;
              cursor: pointer;
            }
            
            .button:hover {
              background-color: #063950;
            }
            
            </style>
            <body>
              <div class='container'>
                <h1>Sua senha foi alterada com sucesso!</h1>
                <p>Sempre anote sua senha para não haver problemas de esquecê-la.</p>
                <div class='buttons'>
                  <a href='../index.php'><button class='button'>Tela Inicial</button></a>
                  <a href='redef.php'><button class='button'>Voltar</button></a>
                </div>
              </div>
            </body>
            </html>
            ";
           
            $sql3 = "DELETE FROM recu WHERE token = '$token'";
            if($conn -> query($sql3) == TRUE){
            }else{
                echo 'erro';
            }
    }else{
        echo "Erro! Tente novamente.";
    }}
        
?>