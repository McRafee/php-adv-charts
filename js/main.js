$(document).ready(function() {
    var salesLineChart = {};
    var salesPieChart = {};
    var teamsalesLineChart = {};

    console.log(aclChart); //debug

    switch (aclChart) {
        case "guest":
            guestLevel();
            break;
        case "employee":
            guestLevel();
            employeeLevel();
            break;
        case "clevel":
            guestLevel();
            employeeLevel();
            cLevel();
            break;
        default:
            alert("Inserisci un livello di accesso valido!");
    }

    // if (aclChart == "guest") {
    //     guestLevel();
    // } else if (aclChart == "employee") {
    //     guestLevel();
    //     employeeLevel();
    // } else if (aclChart == "clevel") {
    //     guestLevel();
    //     employeeLevel();
    //     cLevel();
    // } else {
    //     alert("Inserisci un livello di accesso valido!");
    // }

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

    function cLevel() {
        var apiSettings = {
            "url": "server.php",
            "method": "GET"
        };

        $.ajax(apiSettings).done(function(data) {
            var arrayMonths = moment.months();
            var dataFromApi = data;
            var dataTeam1 = {
                label: "Team 1",
                data: dataFromApi["team_efficiency"]["data"]["Team1"],
                pointBorderColor: 'green',
                pointBackgroundColor: 'rgba(255,150,0,0.5)',
                borderColor: "green",
                lineTension: "0"
            };
            var dataTeam2 = {
                label: "Team 2",
                data: dataFromApi["team_efficiency"]["data"]["Team2"],
                pointBorderColor: 'orange',
                pointBackgroundColor: 'rgba(255,150,0,0.5)',
                borderColor: "orange",
                lineTension: "0"
            };
            var dataTeam3 = {
                label: "Team 3",
                data: dataFromApi["team_efficiency"]["data"]["Team3"],
                pointBorderColor: 'blue',
                pointBackgroundColor: 'rgba(255,150,0,0.5)',
                borderColor: "blue",
                lineTension: "0"
            };
            var multiData = {
                labels: arrayMonths,
                datasets: [dataTeam1, dataTeam2, dataTeam3]
            };
            var arrayMonths = moment.months();
            multilineChart($('#teamsales-line-chart'), arrayMonths, 'Fatturato mensile (€)', '#007ED6', '0', multiData);
        });
    };

    function lineChart(canvas, labels, label, borderColor, lineTension, data) {
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
    };
    function multilineChart(canvas, labels, label, borderColor, lineTension, data) {
        salesLineChart = new Chart($(canvas), {
            type: 'line', // The type of chart we want to create
            data: data
        });
    };

    function pieChart(canvas, data, backgroundColor, labels) {
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
    };
});
