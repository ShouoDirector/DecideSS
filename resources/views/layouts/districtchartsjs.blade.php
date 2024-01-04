<script>
    const ctxDistrict1 = document.getElementById('myPieChartDistrictTotalBMI');
    const labelsDistrict1 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    const dataDistrict1 = <?php echo isset($chartBySectionDataTotalByBMI) ? json_encode($chartBySectionDataTotalByBMI) : '[]'; ?>;
    const dataTotalPupilsDistrict1 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentagesDistrict1 = dataDistrict1.map(value => (value / dataTotalPupilsDistrict1) * 100);

    new Chart(ctxDistrict1, {
        type: 'doughnut',
        data: {
            labels: labelsDistrict1,
            datasets: [{
                label: 'Number of Pupils',
                data: percentagesDistrict1,
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
                            const label = labelsDistrict1[context.dataIndex];
                            const value = dataDistrict1[context.dataIndex];
                            const percentage = percentagesDistrict1[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        },
                    },
                },
            },
        }
    });
</script>

<script>
    const ctxDistrict2 = document.getElementById('myPieChartDistrictOverallHFA');
    const labelsDistrict2 = <?php echo isset($chartBySectionLabelsHFA) ? json_encode($chartBySectionLabelsHFA) : '[]'; ?>;
    const dataDistrict2 = <?php echo isset($chartBySectionDataTotalByHFA) ? json_encode($chartBySectionDataTotalByHFA) : '[]'; ?>;
    const dataTotalPupilsDistrict2 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '[]'; ?>;
    const percentagesDistrict2 = dataDistrict2.map(value => (value / dataTotalPupilsDistrict2) * 100);

    new Chart(ctxDistrict2, {
        type: 'doughnut',
        data: {
            labels: labelsDistrict2,
            datasets: [{
                label: 'Number of Pupils',
                data: percentagesDistrict2,
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
                            const label = labelsDistrict2[context.dataIndex];
                            const value = dataDistrict2[context.dataIndex];
                            const percentage = percentagesDistrict2[context.dataIndex].toFixed(2) + '%';
                            return `${label}: ${value} (${percentage})`;
                        },
                    },
                },
            },
        }
    });
</script>

<script>
    const ctxDistrict3 = document.getElementById('myChartDistrictGeneralBMI');
    const labelsDistrict3 = <?php echo isset($chartBySectionLabelsBMI) ? json_encode($chartBySectionLabelsBMI) : '[]'; ?>;
    const dataTotalDistrict3 = <?php echo isset($chartBySectionDataTotalByBMI) ? json_encode($chartBySectionDataTotalByBMI) : '[]'; ?>;
    const dataMaleDistrict3 = <?php echo isset($chartBySectionMaleDataTotalByBMI) ? json_encode($chartBySectionMaleDataTotalByBMI) : '[]'; ?>;
    const dataFemaleDistrict3 = <?php echo isset($chartBySectionFemaleDataTotalByBMI) ? json_encode($chartBySectionFemaleDataTotalByBMI) : '[]'; ?>;
    const totalPupilsDistrict3 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '0'; ?>;

    const percentagesTotalDistrict3 = dataTotalDistrict3.map(value => (value / totalPupilsDistrict3) * 100);
    const percentagesMaleDistrict3 = dataMaleDistrict3.map(value => (value / totalPupilsDistrict3) * 100);
    const percentagesFemaleDistrict3 = dataFemaleDistrict3.map(value => (value / totalPupilsDistrict3) * 100);

    let bmiChartTypeDistrict3 = 'bar'; // Initial chart type

    const chartBMIDataDistrict3 = {
        labels: labelsDistrict3,
        datasets: [{
                label: 'Total',
                data: dataTotalDistrict3,
                backgroundColor: 'rgba(201, 203, 207, 0.7)',
                borderColor: 'rgb(201, 203, 207)',
                borderWidth: 2,
                type: bmiChartTypeDistrict3
            },
            {
                label: 'Male',
                data: dataMaleDistrict3,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 2,
                type: bmiChartTypeDistrict3
            },
            {
                label: 'Female',
                data: dataFemaleDistrict3,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 2,
                type: bmiChartTypeDistrict3
            }
        ]
    };

    const chartBMIOptionsDistrict3 = {
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
                        const label = labelsDistrict3[dataIndex];
                        const valueTotal = dataTotalDistrict3[dataIndex];
                        const percentageTotal = percentagesTotalDistrict3[dataIndex].toFixed(2) + '%';
                        const valueMale = dataMaleDistrict3[dataIndex];
                        const percentageMale = percentagesMaleDistrict3[dataIndex].toFixed(2) + '%';
                        const valueFemale = dataFemaleDistrict3[dataIndex];
                        const percentageFemale = percentagesFemaleDistrict3[dataIndex].toFixed(2) + '%';

                        return `${label}: Total - ${valueTotal} (${percentageTotal}), Male - ${valueMale}, Female - ${valueFemale}`;
                    }
                }
            }
        }
    };

    const myBMIChartDistrict3 = new Chart(ctxDistrict3, {
        type: bmiChartTypeDistrict3,
        data: chartBMIDataDistrict3,
        options: chartBMIOptionsDistrict3
    });

    // Function to update the chart type
    function updateBMIChartTypeDistrict3(newTypeBMIDistrict3) {
        chartBMIDataDistrict3.datasets.forEach(dataset => {
            dataset.type = newTypeBMIDistrict3;
        });

        myBMIChartDistrict3.config.type = newTypeBMIDistrict3;
        myBMIChartDistrict3.update();
    }

    // Event listener for select element change
    const chartTypeBMISelectorDistrict3 = document.getElementById('myChartDistrictGeneralBMIChartTypeSelector');
    chartTypeBMISelectorDistrict3.addEventListener('change', function() {
        const selectedBMIChartTypeDistrict3 = this.value;
        updateBMIChartTypeDistrict3(selectedBMIChartTypeDistrict3);
    });
</script>

<script>
    const ctxDistrict4 = document.getElementById('myChartDistrictGeneralHFA');
    const labelsDistrict4 = <?php echo isset($chartBySectionLabelsHFA) ? json_encode($chartBySectionLabelsHFA) : '[]'; ?>;
    const dataTotalDistrict4 = <?php echo isset($chartBySectionDataTotalByHFA) ? json_encode($chartBySectionDataTotalByHFA) : '[]'; ?>;
    const dataMaleDistrict4 = <?php echo isset($chartBySectionMaleDataTotalByHFA) ? json_encode($chartBySectionMaleDataTotalByHFA) : '[]'; ?>;
    const dataFemaleDistrict4 = <?php echo isset($chartBySectionFemaleDataTotalByHFA) ? json_encode($chartBySectionFemaleDataTotalByHFA) : '[]'; ?>;
    const totalPupilsDistrict4 = <?php echo isset($totalPupils) ? json_encode($totalPupils) : '0'; ?>;

    const percentagesTotalDistrict4 = dataTotalDistrict4.map(value => (value / totalPupilsDistrict4) * 100);
    const percentagesMaleDistrict4 = dataMaleDistrict4.map(value => (value / totalPupilsDistrict4) * 100);
    const percentagesFemaleDistrict4 = dataFemaleDistrict4.map(value => (value / totalPupilsDistrict4) * 100);

    let chartTypeDistrict4 = 'bar'; // Initial chart type

    const chartDataDistrict4 = {
        labels: labelsDistrict4,
        datasets: [{
                label: 'Total',
                data: dataTotalDistrict4,
                backgroundColor: 'rgba(201, 203, 207, 0.7)',
                borderColor: 'rgb(201, 203, 207)',
                borderWidth: 2,
                type: chartTypeDistrict4
            },
            {
                label: 'Male',
                data: dataMaleDistrict4,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 2,
                type: chartTypeDistrict4
            },
            {
                label: 'Female',
                data: dataFemaleDistrict4,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 2,
                type: chartTypeDistrict4
            }
        ]
    };

    const chartOptionsDistrict4 = {
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
                        const label = labelsDistrict4[dataIndex];
                        const valueTotal = dataTotalDistrict4[dataIndex];
                        const percentageTotal = percentagesTotalDistrict4[dataIndex].toFixed(2) + '%';
                        const valueMale = dataMaleDistrict4[dataIndex];
                        const percentageMale = percentagesMaleDistrict4[dataIndex].toFixed(2) + '%';
                        const valueFemale = dataFemaleDistrict4[dataIndex];
                        const percentageFemale = percentagesFemaleDistrict4[dataIndex].toFixed(2) + '%';

                        return `${label}: Total - ${valueTotal} (${percentageTotal}), Male - ${valueMale}, Female - ${valueFemale}`;
                    }
                }
            }
        }
    };

    const myChartDistrict4 = new Chart(ctxDistrict4, {
        type: chartTypeDistrict4,
        data: chartDataDistrict4,
        options: chartOptionsDistrict4
    });

    // Function to update the chart type
    function updateChartTypeDistrict4(newTypeDistrict4) {
        chartDataDistrict4.datasets.forEach(dataset => {
            dataset.type = newTypeDistrict4;
        });

        myChartDistrict4.config.type = newTypeDistrict4;
        myChartDistrict4.update();
    }

    // Event listener for select element change
    const chartTypeSelectorDistrict4 = document.getElementById('myChartSectionGeneralHFAChartTypeSelector');
    chartTypeSelectorDistrict4.addEventListener('change', function() {
        const selectedChartTypeDistrict4 = this.value;
        updateChartTypeDistrict4(selectedChartTypeDistrict4);
    });
</script>
