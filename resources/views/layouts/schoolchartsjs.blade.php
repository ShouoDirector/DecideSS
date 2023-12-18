<script>
    const ctx1 = document.getElementById('myPieChartSchool');
    // Assuming $chartLabels and $chartData are PHP variables containing your data
    const labels = <?php echo isset($chartBySchoolLabels) ? json_encode($chartBySchoolLabels) : '[]'; ?>;

    // Check if $chartBySchoolData is defined, otherwise set it to an empty array
    const data = <?php echo isset($chartBySchoolData) ? json_encode($chartBySchoolData) : '[]'; ?>;

    const dataTotalPupils = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;

    // Calculate percentages
    const percentages = data.map(value => (value / dataTotalPupils) * 100);

    new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 205, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(201, 203, 207, 0.7)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            const label = labels[context.dataIndex];
                            const value = data[context.dataIndex];
                            const percentage = percentages[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        }
                    }
                }
            }
        }
    });
</script>


<script>
    const ctx2 = document.getElementById('myBarChartSchool');
    // Assuming $chartLabels and $chartData are PHP variables containing your data
    const labels2 = <?php echo isset($chartBySchoolLabels) ? json_encode($chartBySchoolLabels) : '[]'; ?>;

    const data2 = <?php echo isset($chartBySchoolData) ? json_encode($chartBySchoolData) : '[]'; ?>;

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels2,
            datasets: [{
                label: 'Number of Pupils',
                data: data2,
                backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(255, 205, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(201, 203, 207, 0.7)'
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    const ctx3 = document.getElementById('myLineChartSchool');
    // Assuming $chartLabels and $chartData are PHP variables containing your data
    const labels3 = <?php echo isset($chartBySchoolLabels) ? json_encode($chartBySchoolLabels) : '[]'; ?>;

    const data3 = <?php echo isset($chartBySchoolData) ? json_encode($chartBySchoolData) : '[]'; ?>;

    new Chart(ctx3, {
        type: 'line',
        data: {
            labels: labels3,
            datasets: [{
                label: 'Number of Pupils',
                data: data3,
                backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(255, 205, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(201, 203, 207, 0.7)'
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>