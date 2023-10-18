<?php
require_once 'connect.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (!empty($_POST)) {
    $pass = $_POST['pass'];
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email =  $_POST['email'];
    $tel =  $_POST['telefone'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $Sdepartamento = $_POST['departamento'];
    $idsol = $_POST['idsol'];

    function validaCPF($cpf)
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
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

    $sql = "SELECT * FROM func WHERE  email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($linha = $result->fetch_assoc()) {
            $_SESSION['alert'] = "Esse nome de usuario($email) já foi cadastrado<br>";
            header('location:../solicitacao.php');
        }
    } else {
        $sql = "SELECT * FROM func WHERE cpf = '$cpf'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($linha = $result->fetch_assoc()) {
                $_SESSION['alert'] = "Esse cpf já foi cadastrado";
                header('location:../solicitacao.php');
            }
        } else {
            if (validaCPF($cpf) == TRUE) {
                $sql = "INSERT INTO func VALUES(null,'$Sdepartamento',0,'$nome','$pass','$cpf','$idade','$email','$tel','$rua','$bairro','$cidade','$estado')";
                if ($conn->query($sql) === TRUE) {
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
                        <h1>Cadastro de $nome foi feito com sucesso!</h1>
                        <p>A solicitação foi aceita e enviada para o e-mail do funcionário.</p>
                        <div class='buttons'>
                          <a href='../admin.php'><button class='button'>Tela Inicial</button></a>
                          <a href='../solicitacao.php'><button class='button'>Voltar</button></a>
                        </div>
                      </div>
                    </body>
                    </html>
                    ";

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
                        $mail->addAddress($email, 'Cloud Finance');     //Add a recipient
                        $mail->addReplyTo('financecloudd@gmail.com', 'Cloud Finance');
                        $mail->addCC('financecloudd@gmail.com');
                        $mail->addBCC('financecloudd@gmail.com');

                        //Content

                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = "Solicitacao de Cadastro";
                        $mail->Body    = "<h1>Olá $nome, Sua solicitação foi aceita!!!</h1>
                        <p>Login: $email</p>
                        <p>Senha: $pass</p>";
                        $mail->AltBody = 'sla';

                        $mail->send();

                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    $sql2 = "DELETE FROM soli WHERE idsol = {$idsol}";
                    if ($conn->query($sql2) === TRUE) {
                        
                    }
                } else {
                    $_SESSION['alert'] = "Esse cpf é invalido";
                    header('location:../solicitacao.php');
                }
            }
        }
    }
}
