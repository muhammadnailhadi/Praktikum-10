<!DOCTYPE html>
<html>
<head>
  <title>COVID-19 Asia Total Cases Bar Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    #covidChart {
      max-width: 700px;
      max-height: 700px;
    }
  </style>
</head>
<body>
  <canvas id="covidChart"></canvas>

  <?php
  // Koneksi ke database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "covid_asia";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Query data dari tabel covid_data
  $sql = "SELECT country, total_cases FROM data_covid";
  $result = $conn->query($sql);

  $countries = array();
  $total_cases = array();

  if ($result->num_rows > 0) {
    // Memasukkan data ke dalam array
    while($row = $result->fetch_assoc()) {
      array_push($countries, $row["country"]);
      array_push($total_cases, $row["total_cases"]);
    }
  }

  // Menutup koneksi ke database
  $conn->close();
  ?>

  <script>
    // Mengambil data dari PHP dan memasukkannya ke dalam variabel JavaScript
    var countries = <?php echo json_encode($countries); ?>;
    var total_cases = <?php echo json_encode($total_cases); ?>;

    // Membuat grafik bar menggunakan Chart.js
    var ctx = document.getElementById('covidChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: countries,
        datasets: [{
          label: 'Total COVID-19 Cases',
          data: total_cases,
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        legend: {
          display: false
        },
        title: {
          display: true,
          text: 'Total COVID-19 Cases by Country'
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>