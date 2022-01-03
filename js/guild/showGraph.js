// https://www.chartjs.org/docs/latest/
export function showGraph(target, attack = 0, health = 0, defense = 0, reaction = 0, agile = 0) {
    var __max = Math.max(attack, health, defense, reaction, agile);

    new Chart(target, {
        type: 'bar',
        data: {
            labels: [
                'Attack',
                'Health',
                'Defense',
                'Reaction',
                'Agile',
            ],
            datasets: [{
                label: 'Guild',
                data: [attack, health, defense, reaction, agile],
                fill: true,
                backgroundColor: 'rgba(135, 220, 233, 0.2)',
                borderColor: 'rgba(135, 220, 233, 0.8)',
                pointBackgroundColor: 'rgba(135, 220, 233, 0.8)',
                pointBorderColor: '#FFFFFF',
                pointHoverBackgroundColor: '#FFFFFF',
                pointHoverBorderColor: 'rgb(30, 132, 255)',
                pointLabelFontColor: '#FFFFFF',
            }]
        },
        options: {
            plugins: {
                legend: {
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