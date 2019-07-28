$(document).ready(function(){
        
    let myChart = document.getElementById('myChart').getContext('2d');
    let chart = new Chart(myChart, {
        type: 'doughnut',
        data: {
            labels: ['Listings', 'Condemn'],
            datasets: [{
                label: 'Total',
                data: [listings, condemn],
                backgroundColor: ['#111E6C', '#FF8900'],

            }]
        },
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            legend: {
                display: true
            },
        }
    });
    let myChart1 = document.getElementById('myChart1').getContext('2d');
        let chart1 = new Chart(myChart1, {
            type: 'horizontalBar',
            data: {
                labels: roles,
                datasets: [{
                    label: 'Total',
                    data: counter,
                    backgroundColor: ['#111E6C', '#FF8900', '#00ff89', '#8900ff', '#1e6c11', '#11c6e1', '#32116c', '#DCE0F9'],
    
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                legend: {
                    display: false
                },
            }
        })
});

