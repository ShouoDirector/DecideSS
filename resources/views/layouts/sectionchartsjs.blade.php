<script>
    const ctx1 = document.getElementById('myPieChartSectionTotalBMI');
    const labels1 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    const data1 = <?php echo isset($chartBySectionDataTotalByBMI) ? json_encode($chartBySectionDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupils1 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentages1 = data1.map(value => (value / dataTotalPupils1) * 100);

    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: labels1,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages1,
                backgroundColor: [
                    'rgba(220, 53, 69, 0.6)',
                    'rgba(255, 193, 7, 0.6)',
                    'rgba(40, 167, 69, 0.6)',
                    'rgba(0, 123, 255, 0.6)',
                    'rgba(134, 134, 134, 0.6)'
                ],
                borderColor: 'rgba(255, 255, 255, 0)',
            }]
        },
        options: {
            scales: {},
            borderWidth: 6,
            borderRadius: 2,
            hoverBorderWidth: 0,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            const label = labels1[context.dataIndex];
                            const value = data1[context.dataIndex];
                            const percentage = percentages1[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        },
                    },
                },
            },
        }
    });
</script>

<script>
    const ctx10 = document.getElementById('myChartSectionGeneralBMI');
    const labels10 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    const dataTotal10 = <?php echo isset($chartBySectionDataTotalByBMI) ? json_encode($chartBySectionDataTotalByBMI) : '[]'; ?>;
    const dataMale10 = <?php echo isset($chartBySectionMaleDataTotalByBMI) ? json_encode($chartBySectionMaleDataTotalByBMI) : '[]'; ?>;
    const dataFemale10 = <?php echo isset($chartBySectionFemaleDataTotalByBMI) ? json_encode($chartBySectionFemaleDataTotalByBMI) : '[]'; ?>;
    const totalPupils10 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '0'; ?>;

    const percentagesTotal10 = dataTotal10.map(value => (value / totalPupils10) * 100);
    const percentagesMale10 = dataMale10.map(value => (value / totalPupils10) * 100);
    const percentagesFemale10 = dataFemale10.map(value => (value / totalPupils10) * 100);

    let bmiChartType = 'bar'; // Initial chart type

    const chartBMIData = {
        labels: labels10,
        datasets: [{
                label: 'Total',
                data: dataTotal10,
                backgroundColor: 'rgba(201, 203, 207, 0.7)',
                borderColor: 'rgb(201, 203, 207)',
                borderWidth: 2,
                type: bmiChartType
            },
            {
                label: 'Male',
                data: dataMale10,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 2,
                type: bmiChartType
            },
            {
                label: 'Female',
                data: dataFemale10,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 2,
                type: bmiChartType
            }
        ]
    };

    const chartBMIOptions = {
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
                        const dataIndex = context.dataIndex;
                        const label = labels10[dataIndex];
                        const valueTotal = dataTotal10[dataIndex];
                        const percentageTotal = percentagesTotal10[dataIndex].toFixed(2) + '%';
                        const valueMale = dataMale10[dataIndex];
                        const percentageMale = percentagesMale10[dataIndex].toFixed(2) + '%';
                        const valueFemale = dataFemale10[dataIndex];
                        const percentageFemale = percentagesFemale10[dataIndex].toFixed(2) + '%';

                        return `${label}: Total - ${valueTotal} (${percentageTotal}), Male - ${valueMale}, Female - ${valueFemale}`;
                    }
                }
            }
        }
    };

    const myBMIChart = new Chart(ctx10, {
        type: bmiChartType,
        data: chartBMIData,
        options: chartBMIOptions
    });

    // Function to update the chart type
    function updateBMIChartType(newTypeBMI) {
        chartBMIData.datasets.forEach(dataset => {
            dataset.type = newTypeBMI;
        });

        myBMIChart.config.type = newTypeBMI;
        myBMIChart.update();
    }

    // Event listener for select element change
    const chartTypeBMISelector = document.getElementById('myChartSectionGeneralBMIChartTypeSelector');
    chartTypeBMISelector.addEventListener('change', function() {
        const selectedBMIChartType = this.value;
        updateBMIChartType(selectedBMIChartType);
    });
</script>

<script>
    const ctx11 = document.getElementById('myPieChartSectionOverallHFA');
    const labels11 = <?php echo isset($chartBySectionLabelsHFA) ? json_encode($chartBySectionLabelsHFA) : '[]'; ?>;
    const data11 = <?php echo isset($chartBySectionDataTotalByHFA) ? json_encode($chartBySectionDataTotalByHFA) : '[]'; ?>;
    const dataTotalPupils11 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentages11 = data11.map(value => (value / dataTotalPupils11) * 100);

    new Chart(ctx11, {
        type: 'doughnut',
        data: {
            labels: labels11,
            datasets: [{
                label: 'Number of Pupils',
                data: percentages11,
                backgroundColor: [
                    'rgba(220, 53, 69, 0.6)',
                    'rgba(255, 193, 7, 0.6)',
                    'rgba(40, 167, 69, 0.6)',
                    'rgba(0, 123, 255, 0.6)',
                ],
                borderColor: 'rgba(255, 255, 255, 0)',
            }]
        },
        options: {
            scales: {},
            borderWidth: 6,
            borderRadius: 2,
            hoverBorderWidth: 0,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            const label = labels11[context.dataIndex];
                            const value = data11[context.dataIndex];
                            const percentage = percentages11[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        },
                    },
                },
            },
        }
    });
</script>

<script>
    const ctx12 = document.getElementById('myChartSectionGeneralHFA');
    const labels12 = <?php echo isset($chartBySectionLabelsHFA) ? json_encode($chartBySectionLabelsHFA) : '[]'; ?>;
    const dataTotal12 = <?php echo isset($chartBySectionDataTotalByHFA) ? json_encode($chartBySectionDataTotalByHFA) : '[]'; ?>;
    const dataMale12 = <?php echo isset($chartBySectionMaleDataTotalByHFA) ? json_encode($chartBySectionMaleDataTotalByHFA) : '[]'; ?>;
    const dataFemale12 = <?php echo isset($chartBySectionFemaleDataTotalByHFA) ? json_encode($chartBySectionFemaleDataTotalByHFA) : '[]'; ?>;
    const totalPupils12 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '0'; ?>;

    const percentagesTotal12 = dataTotal12.map(value => (value / totalPupils12) * 100);
    const percentagesMale12 = dataMale12.map(value => (value / totalPupils12) * 100);
    const percentagesFemale12 = dataFemale12.map(value => (value / totalPupils12) * 100);

    let chartType12 = 'bar'; // Initial chart type

    const chartData12 = {
        labels: labels12,
        datasets: [{
                label: 'Total',
                data: dataTotal12,
                backgroundColor: 'rgba(201, 203, 207, 0.7)',
                borderColor: 'rgb(201, 203, 207)',
                borderWidth: 2,
                type: chartType12
            },
            {
                label: 'Male',
                data: dataMale12,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 2,
                type: chartType12
            },
            {
                label: 'Female',
                data: dataFemale12,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 2,
                type: chartType12
            }
        ]
    };

    const chartOptions12 = {
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
                        const dataIndex = context.dataIndex;
                        const label = labels12[dataIndex];
                        const valueTotal = dataTotal12[dataIndex];
                        const percentageTotal = percentagesTotal12[dataIndex].toFixed(2) + '%';
                        const valueMale = dataMale12[dataIndex];
                        const percentageMale = percentagesMale12[dataIndex].toFixed(2) + '%';
                        const valueFemale = dataFemale12[dataIndex];
                        const percentageFemale = percentagesFemale12[dataIndex].toFixed(2) + '%';

                        return `${label}: Total - ${valueTotal} (${percentageTotal}), Male - ${valueMale}, Female - ${valueFemale}`;
                    }
                }
            }
        }
    };

    const myChart12 = new Chart(ctx12, {
        type: chartType12,
        data: chartData12,
        options: chartOptions12
    });

    // Function to update the chart type
    function updateChartType(newType) {
        chartData12.datasets.forEach(dataset => {
            dataset.type = newType;
        });

        myChart12.config.type = newType;
        myChart12.update();
    }

    // Event listener for select element change
    const chartTypeSelector12 = document.getElementById('myChartSectionGeneralHFAChartTypeSelector');
    chartTypeSelector12.addEventListener('change', function() {
        const selectedChartType12 = this.value;
        updateChartType(selectedChartType12);
    });
</script>




