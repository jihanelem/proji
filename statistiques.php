<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}


$sql = "SELECT matiere, SUM(nombre_heures) AS total_absences FROM absence GROUP BY matiere";
$result = $conn->query($sql);


$data = array();

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "matiere" => $row["matiere"],
            "total_absences" => $row["total_absences"]
        );
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Statistiques d'absence</title>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        
        <canvas id="chart"></canvas>
    </div>

    <script>
    
    var data = <?php echo json_encode($data); ?>;

    
    var labels = [];
    var absences = [];

    data.forEach(function(item) {
        labels.push(item.matiere);
        absences.push(item.total_absences);
    });

  
    var ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: absences,
                backgroundColor: ['red', 'blue', 'green', 'yellow', 'orange'] 
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Heures absentes par matière'
            }
        }
    });
    </script>
</body>
</html>

