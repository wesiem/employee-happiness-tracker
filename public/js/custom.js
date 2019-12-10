var type = 'bar';
var labels = ['Unhappy', 'Unemotional', 'Happy'];
var label = '# of Votes';
var bg_color = [
    'rgba(255, 99, 132, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(75, 192, 192, 0.2)'
];
var border_color = [
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(75, 192, 192, 1)'
];
var options = {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
};

$( document ).ready(function() {
    var votes_day_chart = new Chart(document.getElementById('votes_chart'), {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: chart_data,
                backgroundColor: bg_color,
                borderColor: border_color,
                borderWidth: 1
            }]
        },
        options: options
    });
});