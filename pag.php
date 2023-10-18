<?php
    session_start();
    require_once 'back/connect.php';
    $user = $_SESSION['email'];
    $pass = $_SESSION['pass'];
    $tipo = $_SESSION['tipo'];
    
    if((!isset ($_SESSION['email']) == true) AND (!isset ($_SESSION['pass']) == true) AND $tipo == 1){
        header('location:admin.php');
    }else if ($tipo != 1){
        header('location:index.php');
        session_destroy();
    }
    $sql = "SELECT * FROM func WHERE tipo = 1";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($linha = $result->fetch_assoc()){
            $id_f = $linha['id_f'];
        }
    }
    $sql = "SELECT * FROM func WHERE id_f = '$id_f'";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($linha = $result->fetch_assoc()){
            $nome = $linha['nome'];
        }
    }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <center>
    
  
    <style>
    


    body{
        background-color: #f2f2f2;
        font-family:sans-serif, arial;
    }


        form{
            top:50%;
            transform: translate(20px, 100px);
            border-radius:14px;
            width:700px;
            margin:0;
            background-color:white;
            height:600px;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
          

        }
            input[type=text], select {
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            border: 2px solid transparent;
            border-radius:14px;
            background-color: #f2f2f2;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
            border: 1px solid #cccccc;
            transition: border-color 0.3s;
             }
           
                
            


            input[type=number] {
               
                width: 50%;
                padding: 12px 20px;
                margin: 8px 0;
                border: 2px solid transparent;
                border-radius:14px;
                background-color: #f2f2f2;
                box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
                border: 1px solid #cccccc;
                transition: border-color 0.3s;
             }
                
                

             button{
                font-size: 17px;
                width: 120px;
                border-radius: 10px;
                background-color:  #09567a;
                color: white;
                border: none;
                padding: 12px;
                cursor: pointer;
             }

             button:hover{
                transition: 0.3s;
                background-color: #063950;
             }#mes{
                border-radius:14px;
                width: 30%;
                padding: 12px 20px;
                margin: 8px 0;
                border: 2px solid transparent;
                background-color: #f2f2f2;
                box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
                border: 1px solid #cccccc;
             }
             input:focus{
             border-color: #15678d;
}

        
        </style>
</head>
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance:textfield;
}
</style>
<body>
   

<form action="back/pag.php" method="post">
    <br>
<h1>Lançamento de contra cheque</h1>
<?php
    if (isset($_SESSION['pag'])) {
      echo $_SESSION['pag'];
      unset($_SESSION['pag']);
    }
    ?>
    <p></p>
    <label><b>Mês referente</b></label><br>
    <?php 
    date_default_timezone_set('America/Fortaleza');
    ?>
    <input type="month" id="mes" name="data_p" min="<?php echo date("Y-m"); ?>" required><p></p>

    <label><b>Nome do funcionario</b></label><br>
    <select name="nome" required>
        <center><option value="" disabled selected>Selecione o Funcionario</option></center>
    <?php
        $sql = "SELECT f.nome, d.nome_dep, f.id_f
        FROM func as f, dep as d
        WHERE tipo = 0  and d.id_dep = f.id_d ORDER BY d.nome_dep, f.nome ";
        $result = $conn->query($sql);
        if($result->num_rows){
            while($linha = $result->fetch_assoc()){
                $id_f = $linha['id_f'];
                $nome = $linha['nome'];
                $nome_d = $linha['nome_dep'];
                echo "<option value=".$id_f.">".$nome." - ".$nome_d."</option>";
            }          
        
        }
        ?>
        </select><p></p>

        <label for="horasTrabalhadas"><b> Número de Horas Trabalhadas:</b></label><br>
        <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="trabalhadas_h" placeholder="Ex.000 Horas" step="0.01" min="1" required><p></p>

        <label for="valorHora"><b>Valor Hora de Trabalho:</b></label><br>
        <input type="number" name="valor_h" placeholder="Ex.0,00 R$" step="0.01" min="1" required><p></p>

        <button type="submit">Enviar</button>
        <button type="reset">Apagar</button>
        <a href="admin.php"><button type="button"> voltar</button></a>
    </form>
</body>
</html>