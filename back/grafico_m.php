<?php require_once 'connect.php';?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Document</title>
  <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>

</head>

<body>
  <div id='curve_chart' style='width: 900px; height: 500px'></div>
</body>

</html>
<script type='text/javascript'>
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', ' ', 'Salario'],
      <?php 

      $mesgrafic = $_POST['mesgrafic'];

      $sql = "SELECT f.nome, p.salario_l, p.data_p FROM func as f,  pag as p WHERE f.id_f = p.id_f and p.id_f = f.id_f and p.id_p = '$mesgrafic'";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
        $data = $row['data_p'];
        $nome = $row['nome'];
        $salario = $row['salario_l'];
      ?>
      ['<?php echo $nome.'  '.$data; ?>', -0, <?php echo $salario; ?>],
      <?php 
       }
      ?>
    ]);

    var options = {
      title: 'Performace Salarial',
      curveType: '',
      legend: {
        position: 'bottom'
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>
