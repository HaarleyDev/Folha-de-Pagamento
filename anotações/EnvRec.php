<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Pathway+Extreme:wght@500&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type='text/javascript' src='http://files.rafaelwendel.com/jquery.js'></script>
    <style>
        body {
            font-family: 'Abel', sans-serif;
            font-family: 'Pathway Extreme', sans-serif;
            padding: 0%;
            margin: 0%;
        }

        button {
            font-size: 20px;
            padding: 5px;
            margin: 0px;
            box-shadow: 1px 1px 10px black;
            border: none;
            border-radius: 5px 5px;
        }
    </style>
</head>

<body>
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    require_once "php_action/db_connect.php";
    if ($_POST) {
        session_start();

        $cpf = $_POST['cpf'];
        $email = $_POST['email'];

        if ($cpf == null || $email == null) {
            $_SESSION['msg'] = "Complete Todos Os Campos";
            unset($_SESSION['code']);
            unset($_SESSION['cpf']);
            header("location:RecSenha.php");
        } else {
            header("location:AlterSenha.php");
            $code = rand(1000, 9999);
            $_SESSION['code'] = $code;
            $_SESSION['cpf'] = $cpf;

            $sql = "SELECT * FROM user WHERE email_user='$email' and cpf_user='$cpf'";

            $result = $connect->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nome = $row['nome_user'];
                    $email = $row['email_user'];
                }
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'mr027738@gmail.com';                     //SMTP username
                    $mail->Password   = 'mgrfgezqtgpymidu';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('mr027738@gmail.com', 'Tech For Us');
                    $mail->addAddress($email, $nome);
                    $mail->addReplyTo('mr027738@gmail.com', 'Information');

                    //Content
                    $mail->isHTML(true);        //Set email format to HTML


                    $mail->Subject = 'Recuperar Senha';
                    $body = "
                <head>
                    <meta charset=UTF-8>
                    <script src=https://unpkg.com/boxicons@2.1.4/dist/boxicons.js></script>
                    <link href=https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css rel=stylesheet>
                    <link rel=preconnect href=https://fonts.googleapis.com>
                    <link rel=preconnect href=https://fonts.gstatic.com crossorigin>
                    <link href=https://fonts.googleapis.com/css2?family=Abel&family=Pathway+Extreme:wght@500&display=swap
                        rel=stylesheet>
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
                        <h1>Olá, Aqui é a Tech For Us</h1>
                    </div> </center>
                    
                
                    <center><h3>Código De Recuperação De Senha:</h3></center>
                    <center><h1><div class=box_code>" . $code . "</div></h1></center>
                        
                </div>
                </body>
                
                </html>";

                    $mail->Body    = $body;
                    $mail->AltBody = '';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }
    ?>

</body>

</html>