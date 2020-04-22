<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP-ADV-CHARTS</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/it.js" integrity="sha256-D8y560ZGsKY1LoAajKkQCG7y0Vkye361MH4yFv2K5kk=" crossorigin="anonymous"></script>
</head>

<body>
    <h2><span>Advanced Dashboard Charts</span> la dashboard che nessuno ha chiesto.</h2>
    <main>
        <div class="container">
            <h4>Fatturato mensile</h4>
            <canvas id="sales-line-chart"></canvas>
        </div>
        <div class="container">
            <h4>Vendite per venditore</h4>
            <canvas id="sales-pie-chart"></canvas>
        </div>
        <div class="container">
            <h4>Fatturato per Team</h4>
            <canvas id="teamsales-line-chart"></canvas>
        </div>
    </main>

    <script type="text/javascript">
    $(document).ready(function() {
        var salesLineChart = {};
        var salesPieChart = {};
        var teamsalesLineChart = {};

        guestLevel();
        employeeLevel();

        // *** FUNCTIONS ***
        function guestLevel() {
            var apiSettings = {
                "url": "server.php",
                "method": "GET"
            };

            $.ajax(apiSettings).done(function(data) {
                var dataFromApi = data;
                var arrayMonths = moment.months();
                lineChart($('#sales-line-chart'), arrayMonths, 'Fatturato mensile (€)', '#007ED6', '0', dataFromApi["fatturato"]["data"]);
            });
        };

        function employeeLevel() {
            var apiSettings = {
                "url": "server.php",
                "method": "GET"
            };

            $.ajax(apiSettings).done(function(data) {
                var dataFromApi = data;
                var salesManAmount = [];
                var labelsSalesMan = [];

                for (const [key, value] of Object.entries(dataFromApi["fatturato_by_agent"]["data"])) {
                    labelsSalesMan.push(key);
                    salesManAmount.push(value);
                }
                pieChart($('#sales-pie-chart'), salesManAmount, ["#52D726", "#007ED6", "#FF7300", "#FF0000"], labelsSalesMan);
            });
        };

        function lineChart(canvas, labels, label, borderColor, lineTension, data) {
            if ($.isEmptyObject(salesLineChart)) {
                salesLineChart = new Chart($(canvas), {
                    type: 'line', // The type of chart we want to create
                    data: { // The data for our dataset
                        labels: labels,
                        datasets: [{
                            label: label,
                            borderColor: borderColor,
                            lineTension: lineTension,
                            data: data
                        }]
                    },
                    options: { // Configuration options go here

                    }
                });
            } else {
                salesLineChart.data.labels = labels;
                salesLineChart.data.datasets[0].data = data;
                salesLineChart.update();
            }

        };

        function pieChart(canvas, data, backgroundColor, labels) {
            if ($.isEmptyObject(salesPieChart)) {
                salesPieChart = new Chart(canvas, {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: data,
                            backgroundColor: backgroundColor
                        }],

                        labels: labels
                    }
                });
            } else {
                salesPieChart.data.labels = labels;
                salesPieChart.data.datasets[0].data = data;
                salesPieChart.update();
            }
        };

    });
    </script>
</body>

</html>
