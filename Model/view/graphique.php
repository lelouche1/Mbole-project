<?php
session_start();
include '/xampp/htdocs/mbole/connexion.php';



try {
    $query = $pdo->prepare("SELECT * FROM vols");
    $query->execute();
    $result = $query->fetchAll();
} catch (PDOException $e) {
    $erreur = $e->getMessage();
}

foreach ($result as $data){
    $depart[] = $data['lieu_depart'];
    $prix[] = $data['prix'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="styleres.css">
    stylegraph
    <title>Document</title>
</head>
<body>
<div style="width: 85%;">
  <canvas id="myChart"></canvas>
</div>

<script>

Chart.defaults.plugins.title.display = true;
Chart.defaults.plugins.title.text = "les destinations en fonction des prix";

</script>

<script>
  const labels = <?php echo json_encode($depart); ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: ['red','orange','salmon',
                        , 'blue','yellow','purple','green','tomato'],
      borderColor: 'rgb(255, 99, 132)',
      hoverBorderWidth: 4,
      data: <?php echo json_encode($prix); ?>,
    }],
    
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
        title: {
            display: true,
            text: "les destinations en fonction des prix",
            fontSize: 27
        }
    }
  };
</script>


<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
 

<!-- <script src="assets/js/graph.js"></script> -->
</body>
</html>