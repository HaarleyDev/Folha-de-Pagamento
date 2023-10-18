<?php require_once '../connect.php';?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Document</title>
  <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    #curve_chart {
      width: 100%;
      height: 500px;
      margin-top: 30px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
            .sitemap {
            margin-bottom: 20px;
            font-size: 14px;
            color: #999;
        }

        .sitemap a {
            text-decoration: none;
            color: #333;
        }

        .sitemap a:hover {
            text-decoration: underline;
        }
  </style>
</head>

<body>  <div class="sitemap">
            <a href="../../admin.php">Tela inicial</a> > <a href="../../grafico/grafico_d.php">Grafico departamental</a> > <a href="#">Grafico media salarial departamental</a>
        </div>
<div id="curve_chart"></div>
</body>

</html>
<script type='text/javascript'>
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Nomes', 'Media Salarial'],
      <?php 
      $dep = $_POST['departamento'];
       $sql = "SELECT f.nome, (SUM(p.salario_l)/COUNT(*)) as media, p.data_p
       FROM dep as d, func as f, pag as p
       WHERE f.id_d = $dep and d.id_dep = $dep and f.id_f = p.id_f Group by f.id_f Order by p.data_p desc"; 
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
        $data = $row['data_p'];
        $nome = $row['nome'];
        $salario = $row['media'];
      ?>
      ['<?php echo $nome; ?>', 0, <?php echo $salario; ?>],
      <?php 
       }
      ?>
    ]);

    var options = {
      title: 'Média Salarial departamental',
      curveType: '',
      legend: {
        position: 'bottom'
      },
      chartArea: {
        width: '80%',
        height: '70%'
      },
      hAxis: {
        title: 'Nome',
        textStyle: {
          fontSize: 15
        },
      },
      vAxis: {
        title: 'Média Salarial',
        titleTextStyle: {
          fontSize: 14,
          bold: true
        },
        textStyle: {
          fontSize: 12
        },
        format: 'currency',
        gridlines: {
          color: '#e6e6e6'
        }
      },
      colors: ['#1f77b4', '#ff7f0e']
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>