// https://www.chartjs.org/docs/latest/
export function showGraph(target, attack = 0, health = 0, defense = 0, reaction = 0, agile = 0) {

    var label = ["1", "2", "3"];
    var val = [10, 20, 30];

    new Chart(target, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [{
                label: 'Guild',
                data: val,
                fill: true,

                backgroundColor: function(context) { return context.dataIndex % 2 ? 'rgba(135, 220, 233, 0.4)' : 'rgba(135, 220, 233, 0.2)'; },
                borderColor: 'rgba(135, 220, 233, 0.8)',

                borderWidth: 3,
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: '#FFFFFF',
                    }
                },
            },
            scales: {
                x: {
                    ticks: {
                        color: 'rgba(255, 255, 255, 1)',
                    }
                },
                y: {
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.5)',
                    }
                },
            },
        },
    });
}