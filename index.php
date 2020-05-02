<?php $acl_chart = $_GET['livello'];?>
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
            <h4>Vendite per agente</h4>
            <canvas id="sales-pie-chart"></canvas>
        </div>
        <div class="container">
            <h4>Fatturato per Team</h4>
            <canvas id="teamsales-line-chart"></canvas>
        </div>
    </main>
    <script type="text/javascript">
    var aclChart = "<?php echo $acl_chart; ?>";
    </script>
    <script src="js/main.js" charset="utf-8"></script>
</body>
</html>
