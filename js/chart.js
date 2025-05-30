let chartInstance = null;

function loadChart(type) {
document.getElementById('dailyTab').classList.remove('active');
document.getElementById('weeklyTab').classList.remove('active');
document.getElementById(type + 'Tab').classList.add('active');

fetch(`../api/get_user_growth.php?type=${type}`)
    .then(res => res.json())
    .then(data => {
    const ctx = document.getElementById('growthChart').getContext('2d');
    if (chartInstance) chartInstance.destroy();

    chartInstance = new Chart(ctx, {
        type: 'line',
        data: {
        labels: data.labels,
        datasets: [{
            label: 'User Registrations',
            data: data.counts,
            borderColor: '#2b6cb0',
            backgroundColor: 'rgba(43, 108, 176, 0.1)',
            fill: true,
            tension: 0.4
        }]
        },
        options: {
        responsive: true,
        scales: {
            y: {
            beginAtZero: true,
            stepSize: 1
            }
        }
        }
    });
    })
    .catch(err => console.error("Failed to load chart:", err));
}