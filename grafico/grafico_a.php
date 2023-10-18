<?php require_once '../back/connect.php'; ?>
<?php
session_start();
$user = $_SESSION['email'];
$pass = $_SESSION['pass'];
$tipo = $_SESSION['tipo'];

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['pass']) == true) and $tipo == 1) {
    header('location:admin.php');
} else if ($tipo != 1) {
  session_destroy();
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gráfico de Média Salarial</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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

<body>
  <div class="sitemap">
    <a href="../admin.php">Tela inicial</a> > <a href="#">Grafico media anual salarial</a>
  </div>
  <div id="curve_chart"></div>

</body>

</html>

<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Nomes', 'Média Salarial'],
      <?php
      @$pesquisa = $_GET['termo'];
      $sql = "SELECT f.nome, (SUM(p.salario_l) / COUNT(*)) as media, p.data_p
       FROM func as f,  pag as p
       WHERE p.id_f = f.id_f and f.nome LIKE '%$pesquisa%'
       GROUP BY f.id_f";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $data = $row['data_p'];
        $nome = $row['nome'];
        $salario = $row['media'];
      ?>['<?php echo $nome; ?>', 0, <?php echo $salario; ?>],
      <?php
      }
      ?>
    ]);

    var options = {
      title: 'Média Salarial Anual',
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