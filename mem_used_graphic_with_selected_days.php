<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <title>Grafico</title>
</head>

<body>
    <center>
    <div class="main">
        <div class="menu">
        <center>
            <nav>
                <ul>
                    <li><a href="mem_used_graphic_real_time.php">Real time</a></li>
                    <li><a href="mem_used_graphic_with_selected_days.php">Oldest chart</a></li>
                </ul>
            </nav>
        </center> 
        </div>
        <canvas id="myChart" width="1080" height="600"></canvas>
        <button id="stopButton" onclick="toggleUpdate()">Parar Atualização</button>

        <label for="dataFilter">Filtrar por data:</label>
        <select id="dataFilter" onchange="filterData(this.value)">
            <option value="5">Últimos 5 dias</option>
            <option value="15">Últimos 15 dias</option>
            <option value="30">Últimos 30 dias</option>
        </select>
    </div>
    </center>
    <?php
        $conn = new mysqli('localhost', 'lritzke', 'lritzke', 'graphic');

        if (isset($_GET['limit'])) {
            $limit = (int)$_GET['limit'];
            $query = "SELECT date, mem_used FROM informations WHERE date LIKE '%_10-00' AND DATE(date) >= DATE_SUB(CURDATE(), INTERVAL $limit DAY) ORDER BY date DESC";
        } else {
            $query = "SELECT date, mem_used FROM informations WHERE date LIKE '%_10-00' ORDER BY date DESC LIMIT 20";
        }

        $result = $conn->query($query);
        $labels = [];
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $labels[] = str_replace('_', ' ', $row['date']); // Para exibir a data formatada no gráfico
            $data[] = str_replace('%', '', $row['mem_used']);
        }
        $conn->close();
    ?>


    <script>
        var intervalId;
        var updating = true;
        var chartData = {
            labels: <?php echo json_encode($labels); ?>,
            data: <?php echo json_encode($data); ?>
        };

        function showUpdates(limit) {
            clearInterval(intervalId);
            var currentUrl = window.location.href;
            if (limit === 0) {
                window.location.href = currentUrl.split('?')[0];
            } else {
                var updatedUrl = currentUrl.split('?')[0] + '?limit=' + limit;
                window.location.href = updatedUrl;
            }
        }

        function toggleUpdate() {
            if (updating) {
                clearInterval(intervalId);
                document.getElementById('stopButton').textContent = "Continuar Atualização";
            } else {
                intervalId = setInterval(refresh, 60000);
                document.getElementById('stopButton').textContent = "Parar Atualização";
            }
            updating = !updating;
        }

        function createChart() {
            var canvas = document.getElementById('myChart');
            var ctx = canvas.getContext('2d');

            var maxYValue = Math.max(...chartData.data);

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        data: chartData.data,
                        label: 'Uso de memória',
                        borderColor: 'black',
                        backgroundColor: 'transparent',
                        pointBackgroundColor: 'darkgoldenrod'
                    }]
                },
                options: {
                    responsive: false, 
                    scales: {
                        y: {
                            min: 0,
                            max: 100,
                            ticks: {
                                stepSize: 10
                            }
                        }
                    }
                }
            });

            intervalId = setInterval(refresh, 60000);
        }

        function refresh() {
            window.location.reload();
        }

        function filterData(limit) {
            showUpdates(limit);
        }

        createChart();
    </script>
</body>
</html>
