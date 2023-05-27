<!DOCTYPE html>
<html>
<head>
  <title>COVID-19 Asia Total Cases Statistics</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    #barChart {
      max-width: 700px;
      max-height: 700px;
    }
    #lineChart {
      max-width: 700px;
      max-height: 700px;
    }
    #pieChart {
      max-width: 700px;
      max-height: 700px;
    }
    #doughnutChart {
      max-width: 700px;
      max-height: 700px;
    }
  </style>
</head>
<body>
  <canvas id="barChart"></canvas>
  <canvas id="lineChart"></canvas>
  <canvas id="pieChart"></canvas>
  <canvas id="doughnutChart"></canvas>

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
    var barCtx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: countries,
        datasets: [{
          label: 'Total Cases',
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
          text: 'Total Cases by Country (Bar Chart)'
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Membuat grafik garis menggunakan Chart.js
    var lineCtx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: countries,
        datasets: [{
          label: 'Total Cases',
          data: total_cases,
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          fill: false
        }]
      },
      options: {
        responsive: true,
        legend: {
          display: false
        },
        title: {
          display: true,
          text: 'Total Cases by Country (Line Chart)'
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Membuat grafik pie menggunakan Chart.js
    var pieCtx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(pieCtx, {
      type: 'pie',
      data: {
        labels: countries,
        datasets: [{
          label: 'Total Cases',
          data: total_cases,
          backgroundColor: [
            'rgba(100, 99, 132, 0.5)',
            'rgba(300, 162, 235, 0.5)',
            'rgba(150, 206, 86, 0.5)',
            'rgba(350, 192, 192, 0.5)',
            'rgba(153, 102, 255, 0.5)',
            'rgba(255, 159, 64, 0.5)',
            'rgba(255, 99, 132, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(75, 192, 192, 0.5)'
          ],
          borderColor: [
            'rgba(100, 99, 132, 1)',
            'rgba(300, 162, 235, 1)',
            'rgba(150, 206, 86, 1)',
            'rgba(350, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        legend: {
          position: 'right'
        },
        title: {
          display: true,
          text: 'Total Cases by Country (Pie Chart)'
        }
      }
    });

    // Membuat grafik doughnut menggunakan Chart.js
    var doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
    var doughnutChart = new Chart(doughnutCtx, {
      type: 'doughnut',
      data: {
        labels: countries,
        datasets: [{
          label: 'Total Cases',
          data: total_cases,
          backgroundColor: [
            'rgba(100, 99, 132, 0.5)',
            'rgba(300, 162, 235, 0.5)',
            'rgba(150, 206, 86, 0.5)',
            'rgba(350, 192, 192, 0.5)',
            'rgba(153, 102, 255, 0.5)',
            'rgba(255, 159, 64, 0.5)',
            'rgba(255, 99, 132, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(75, 192, 192, 0.5)'
          ],
          borderColor: [
            'rgba(100, 99, 132, 1)',
            'rgba(300, 162, 235, 1)',
            'rgba(150, 206, 86, 1)',
            'rgba(350, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        legend: {
          position: 'right'
        },
        title: {
          display: true,
          text: 'Total Cases by Country (Doughnut Chart)'
        }
      }
    });
  </script>
</body>
</html>