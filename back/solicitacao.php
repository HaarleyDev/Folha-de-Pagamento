<?php
session_start();
require_once 'connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


if ($_POST) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $tele = $_POST['telefone'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $pass = $_POST['pass'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    //FUNÇÃO PARA AVALIAR CPF VALIDO OU INVALIDO
    function validaCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    $sql = "SELECT * FROM func WHERE telefone = '$tele'";//verifica a tabela do funcionario
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($linha = $result->fetch_assoc()) {
            $_SESSION['alert'] = "<div style='color:red;'>Esse número já está cadastrado</div>";
            header('location:../solicitacao.php');
        }
    } else {
        $sql = "SELECT * FROM soli WHERE telefone = '$tele'";//verifica a tabela do funcionario
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($linha = $result->fetch_assoc()) {
                $_SESSION['alert'] = "<div style='color:red;'>Esse número já está cadastrado</div>";
                header('location:../solicitacao.php');
            }
        } else {
            $sql = "SELECT * FROM func WHERE cpf = '$cpf'"; //verifica a tabela do funcionario
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($linha = $result->fetch_assoc()) {
                    $_SESSION['alert'] = "<div style='color:red;'>Esse cpf já foi cadastrado</div>";
                    header('location:../solicitacao.php');
                }
            } else {
                $sql = "SELECT * FROM func WHERE email='$email'"; //verifica a tabela do funcionario
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($linha = $result->fetch_assoc()) {
                        $_SESSION['alert'] = "<div style='color:red;'>Esse e-mail já foi cadastrado</div>";
                        header('location:../solicitacao.php');
                    }
                } else {
                    $sql = "SELECT * FROM soli WHERE email = '$email'"; //verifica a tabela da solicitação
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($linha = $result->fetch_assoc()) {
                            $_SESSION['alert'] = "<div style='color:red;'>Esse email e-mail já foi cadastrado</div>";
                            header('location:../solicitacao.php');
                        }
                    } else {
                        $sql = "SELECT * FROM soli WHERE cpf = '$cpf'"; //verifica a tabela da solicitação
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($linha = $result->fetch_assoc()) {
                                $_SESSION['alert'] = "<div style='color:red;'>Esse cpf já foi cadastrado</div>";
                                header('location:../solicitacao.php');
                            }
                        } else {
                            if (validaCPF($cpf) == TRUE) { //validar se o cpf é valido ou não
                                $sql = "INSERT INTO soli VALUES(null,'$nome','$cpf','$email','$tele','$idade','$pass','$rua','$bairro','$cidade','$estado')"; //inseri o valor no banco de dados
                                if ($conn->query($sql) === TRUE) {
                                    $sql = "SELECT * FROM soli";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($linha = $result->fetch_assoc()) {
                                            $idsol = $linha['idsol'];


                                            //Receber informações no email do RH
                                            $mail = new PHPMailer(true);

                                            try {
                                                //Server settings
                                                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                                $mail->isSMTP();                                            //Send using SMTP
                                                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                                $mail->Username   = 'financecloudd@gmail.com';                     //SMTP username
                                                $mail->Password   = 'otnttzbwaxfrnpxt';                               //SMTP password
                                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                                //Recipients
                                                $mail->setFrom('financecloudd@gmail.com', 'Cloud Finance');
                                                $mail->addAddress('financecloudd@gmail.com', 'Cloud Finance');     //Add a recipient
                                                $mail->addReplyTo('financecloudd@gmail.com', 'Cloud Finance');
                                                $mail->addCC('financecloudd@gmail.com');
                                                $mail->addBCC('financecloudd@gmail.com');

                                                //Content

                                                $mail->isHTML(true);                                  //Set email format to HTML
                                                $mail->Subject = "Solicitacao de Cadastro";
                                                $mail->Body    = "     <head>
                                    <meta charset=UTF-8>
                                    <script src=https://unpkg.com/boxicons@2.1.4/dist/boxicons.js></script>
                                    <link href=https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css rel=stylesheet>
                                    <link rel=preconnect href=https://fonts.googleapis.com>
                                    <link rel=preconnect href=https://fonts.gstatic.com crossorigin>
                                    <link href=https://fonts.googleapis.com/css2?family=Abel&family=Pathway+Extreme:wght@500&display=swap rel=stylesheet>
                                    <script type=text/javascript src=https://www.gstatic.com/charts/loader.js></script>
                                    <script type=text/javascript src=http://files.rafaelwendel.com/jquery.js></script>
                                    <style>
                                    body {
                                        font-family: Abel, sans-serif;
                                        font-family: Pathway Extreme, sans-serif;
                                        padding: 0%;
                                        margin: 0%;
                                    }
                                    div.box_text{
                                        border-radius: 15px;
                                        position:absolute;
                                        top:50%;
                                        left:50%;
                                        transform:
                                        translate(-50%,-50%);
            
                                        border:1px solid black;
                                        margin:10px;
                                        padding:20px;
                                    }
                                </style>
                                </head>
                                <body>
                                <div class=box_text>
                                <center><div class=box_title>
                                <h1>Mais uma solicitação para Cloud Finance</h1>
                                </div> </center>
                                <center><h3>Algumas Informações de solicitação</h3></center>
                                <center><h1>Nome: $nome</h1></center>
                                <center><h1>cpf: $cpf</h1></center>
                                <center><h1>telefone: $tele</h1></center>
                                <center><h1>email: $email</h1></center>
                                <center><h1>idade: $idade</h1></center>
                                <center><td><a href='http://localhost/pagamentoFL/cadastro_s.php?id=" . $idsol . "'><button type='button' class='btn btn-info'>Cadastrar</button></a></td></center>
                                </div>
                                </body>
                                </html>";
                                                $mail->AltBody = 'sla';

                                                $mail->send();
                                            } catch (Exception $e) {
                                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                            }

                                            //Usuario receber o e-mail
                                            $mail = new PHPMailer(true);

                                            try {
                                                //Server settings
                                                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                                $mail->isSMTP();                                            //Send using SMTP
                                                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                                $mail->Username   = 'financecloudd@gmail.com';                     //SMTP username
                                                $mail->Password   = 'otnttzbwaxfrnpxt';                               //SMTP password
                                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                                //Recipients
                                                $mail->setFrom('financecloudd@gmail.com', 'Cloud Finance');
                                                $mail->addAddress($email, 'Destinatário');     //Add a recipient
                                                $mail->addCC('financecloudd@gmail.com');
                                                $mail->addBCC('financecloudd@gmail.com');

                                                //Content

                                                $mail->isHTML(true);                                  //Set email format to HTML
                                                $mail->Subject = "Solicitacao de Cadastro";
                                                $mail->Body    = "<!DOCTYPE html>
                                    <html lang='en'>
                                    <head>
                                        <meta charset='UTF-8'>
                                        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                        <title>Document</title>
                                    </head>
                                    <body>
                                        <h1>Sua solicitação foi feita com sucesso</h1><p></p>
                                        <h3>Iremos mandar a conclusão do seu cadastro neste e-mail.</h3>
                                        <p></p>
                                        <p>Aguarde</p>
                                    </body>
                                    </html>";
                                                $mail->AltBody = 'sla';

                                                $mail->send();
                                            } catch (Exception $e) {
                                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                            }
                                        }
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
                                            <h1>Solicitação enviada com sucesso!</h1>
                                            <p>Agradecemos sua solicitação. Enviaremos uma mensagem para $email <br> quando sua solicitação for aceita.</p>
                                            <div class='buttons'>
                                              <a href='../admin.php'><button class='button'>Tela Inicial</button></a>
                                              <a href='../solicitacao.php'><button class='button'>Voltar</button></a>
                                            </div>
                                          </div>
                                        </body>
                                        </html>
                                        ";
                                    }
                                }
                            } else {
                                $_SESSION['alert'] = "Esse cpf não existe ou está escrito errado, reveja e tente novamente.<br>";
                                header('location:../solicitacao.php');
                            }
                        }
                    }
                }
            }
        }
    }
}
