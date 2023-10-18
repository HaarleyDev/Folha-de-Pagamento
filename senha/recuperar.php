<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Recuperação de Senha</title>
</head>
<body>
<?php
date_default_timezone_set('America/Fortaleza');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once '../back/connect.php';
require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   //ENVIA O EMAIL
  // Escapa o e-mail para evitar SQL injection
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $data = strtotime("+ 1 day");
  $dataf = date("Y-m-d", $data);

  // Verifica se o e-mail existe no banco de dados
  $sql = "SELECT * FROM func WHERE email = '$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // Gera um token de redefinição de senha
    $token = rand(1,99999999);
    while($row = $result->fetch_assoc()){
          $idf = $row['id_f'];
          $nome = $row['nome'];
    }


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPAuth = true;
$mail->Username = 'financecloudd@gmail.com';
$mail->Password = 'otnttzbwaxfrnpxt';
$mail->setFrom('financecloudd@gmail.com', 'Cloud Finance');
$mail->addAddress($email, 'Destinatário');
$mail->addReplyTo('financecloudd@gmail.com', 'Cloud Finance');
$mail->addCC('financecloudd@gmail.com', 'Cloud Finance');
$mail->addBCC('financecloudd@gmail.com', 'Cloud Finance');

$mail->isHTML(true); 
$mail->Subject = 'Recuperação de Senha';
$mail->Body = "Olá $nome, esse é seu código para redefinir sua senha:<br>".$token;
$mail->AltBody = 'Recuperção de Senha';

if($mail->send()){
    header('location: redefinir.php');
  }
    echo "<a href='../index.php'><button>Voltar</button></a>";

$sql = "INSERT INTO recu VALUES(null,'$token','$idf','$email','$dataf')";
    $conn->query($sql);

  // Fecha a conexão com o banco de dados
  unset($mail);
  }else{
    $_SESSION['recuperar'] = "<div style='color: red;'>E-mail não encontrado na nossa base de dados.<br>certifique-se que seu e-mail está escrito correto.</div>";
    header('location:redef.php');
  }
}else{
    echo "<br><code>Insira o Email Cadastrado para redefinir a senha.</code>";
  }


?>

