<script>
    const ctx1 = document.getElementById('myPieChartSectionTotalBMI');
    const labels1 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    const data1 = <?php echo isset($chartBySectionDataTotalByBMI) ? json_encode($chartBySectionDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupils1 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentages1 = data1.map(value => (value / dataTotalPupils1) * 100);

    new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: labels1,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages1,
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
                            const label = labels1[context.dataIndex];
                            const value = data1[context.dataIndex];
                            const percentage = percentages1[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx2 = document.getElementById('myBarChartSectionTotalBMI');
    const labels2 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    const data2 = <?php echo isset($chartBySectionDataTotalByBMI) ? json_encode($chartBySectionDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupils2 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentages2 = data2.map(value => (value / dataTotalPupils2) * 100);

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels2,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages2,
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
                            const label = labels2[context.dataIndex];
                            const value = data2[context.dataIndex];
                            const percentage = percentages2[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx3 = document.getElementById('myLineChartSectionTotalBMI');
    const labels3 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    const data3 = <?php echo isset($chartBySectionDataTotalByBMI) ? json_encode($chartBySectionDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupils3 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentages3 = data3.map(value => (value / dataTotalPupils3) * 100);

    new Chart(ctx3, {
        type: 'line',
        data: {
            labels: labels3,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages3,
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
                            const label = labels3[context.dataIndex];
                            const value = data3[context.dataIndex];
                            const percentage = percentages3[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx4 = document.getElementById('myPieChartSectionTotalHFA');
    const labels4 = <?php echo isset($chartBySectionLabelsHFA) ? json_encode($chartBySectionLabelsHFA) : '[]'; ?>;
    const data4 = <?php echo isset($chartBySectionDataTotalByHFA) ? json_encode($chartBySectionDataTotalByHFA) : '[]'; ?>;
    const dataTotalPupils4 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentages4 = data4.map(value => (value / dataTotalPupils4) * 100);

    new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: labels4,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages4,
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
                            const label = labels4[context.dataIndex];
                            const value = data4[context.dataIndex];
                            const percentage = percentages4[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx5 = document.getElementById('myBarChartSectionTotalHFA');
    const labels5 = <?php echo isset($chartBySectionLabelsHFA) ? json_encode($chartBySectionLabelsHFA) : '[]'; ?>;
    const data5 = <?php echo isset($chartBySectionDataTotalByHFA) ? json_encode($chartBySectionDataTotalByHFA) : '[]'; ?>;
    const dataTotalPupils5 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentages5 = data5.map(value => (value / dataTotalPupils5) * 100);

    new Chart(ctx5, {
        type: 'bar',
        data: {
            labels: labels5,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages5,
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
                            const label = labels5[context.dataIndex];
                            const value = data5[context.dataIndex];
                            const percentage = percentages5[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx6 = document.getElementById('myLineChartSectionTotalHFA');
    const labels6 = <?php echo isset($chartBySectionLabelsHFA) ? json_encode($chartBySectionLabelsHFA) : '[]'; ?>;
    const data6 = <?php echo isset($chartBySectionDataTotalByHFA) ? json_encode($chartBySectionDataTotalByHFA) : '[]'; ?>;
    const dataTotalPupils6 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentages6 = data6.map(value => (value / dataTotalPupils6) * 100);

    new Chart(ctx6, {
        type: 'line',
        data: {
            labels: labels6,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages6,
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
                            const label = labels6[context.dataIndex];
                            const value = data6[context.dataIndex];
                            const percentage = percentages6[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx7 = document.getElementById('myLineChartSectionTotalGenderBMI');
    const labels7 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    
    // Female data
    const dataFemale = <?php echo isset($chartBySectionFemaleDataTotalByBMI) ? json_encode($chartBySectionFemaleDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupilsFemale = <?php echo isset($totalFemalePupils) ? json_encode($totalFemalePupils) : '[]'; ?>;
    const percentagesFemale = dataFemale.map(value => (value / dataTotalPupilsFemale) * 100);

    // Male data
    const dataMale = <?php echo isset($chartBySectionMaleDataTotalByBMI) ? json_encode($chartBySectionMaleDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupilsMale = <?php echo isset($totalMalePupils) ? json_encode($totalMalePupils) : '[]'; ?>;
    const percentagesMale = dataMale.map(value => (value / dataTotalPupilsMale) * 100);

    new Chart(ctx7, {
        type: 'line',
        data: {
            labels: labels7,
            datasets: [
                {
                    label: 'Female',
                    data: percentagesFemale,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 3
                },
                {
                    label: 'Male',
                    data: percentagesMale,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 3
                }
            ]
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
                            const label = labels7[context.dataIndex];
                            const valueFemale = dataFemale[context.dataIndex];
                            const percentageFemale = percentagesFemale[context.dataIndex].toFixed(2) + '%';
                            const valueMale = dataMale[context.dataIndex];
                            const percentageMale = percentagesMale[context.dataIndex].toFixed(2) + '%';

                            return `${label}: Female - ${valueFemale} (${percentageFemale}), Male - ${valueMale} (${percentageMale})`;
                        }
                    }
                }
            }
        }
    });
</script>

<script>
    const ctx8 = document.getElementById('myBarChartSectionTotalGenderBMI');
    const labels8 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    
    // Female data
    const dataFemale8 = <?php echo isset($chartBySectionFemaleDataTotalByBMI) ? json_encode($chartBySectionFemaleDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupilsFemale8 = <?php echo isset($totalFemalePupils) ? json_encode($totalFemalePupils) : '[]'; ?>;
    const percentagesFemale8 = dataFemale8.map(value => (value / dataTotalPupilsFemale8) * 100);

    // Male data
    const dataMale8 = <?php echo isset($chartBySectionMaleDataTotalByBMI) ? json_encode($chartBySectionMaleDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupilsMale8 = <?php echo isset($totalMalePupils) ? json_encode($totalMalePupils) : '[]'; ?>;
    const percentagesMale8 = dataMale8.map(value => (value / dataTotalPupilsMale8) * 100);

    new Chart(ctx8, {
        type: 'bar',
        data: {
            labels: labels8,
            datasets: [
                {
                    label: 'Female',
                    data: percentagesFemale8,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                },
                {
                    label: 'Male',
                    data: percentagesMale8,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                }
            ]
        },
        options:  {
            scales: {
                x: { 
                    stacked: false,
                },
                y: {
                    beginAtZero: true,
                    stacked: false
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            const label = labels8[context.dataIndex];
                            const valueFemale = dataFemale8[context.dataIndex];
                            const percentageFemale = percentagesFemale8[context.dataIndex].toFixed(2) + '%';
                            const valueMale = dataMale8[context.dataIndex];
                            const percentageMale = percentagesMale8[context.dataIndex].toFixed(2) + '%';

                            return `${label}: Female - ${valueFemale} (${percentageFemale}), Male - ${valueMale} (${percentageMale})`;
                        }
                    }
                }
            }
        }
    });
</script>

