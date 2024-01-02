<script>
    const ctxPupilBMI = document.getElementById('myChartPupilGeneralBMI');
    const labelsPupilBMI = <?php echo isset($nsrArrayLabels) ? json_encode($nsrArrayLabels) : '[]'; ?>;
    const dataTotalPupilBMI = <?php echo isset($nsrBMIArrayPupil) ? json_encode($nsrBMIArrayPupil) : '[]'; ?>;

    let pupilBMIChartType = 'bar';

    const chartDataPupilBMI = {
        labels: labelsPupilBMI,
        datasets: [
            {
                label: 'BMI',
                data: dataTotalPupilBMI,
                backgroundColor: 'rgba(2, 117, 216, 0.7)',
                borderColor: 'rgb(255, 255, 255)',
                borderWidth: 2,
                type: pupilBMIChartType
            }
        ]
    };

    const chartOptionsPupilBMI = {
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
                        const label = labelsPupilBMI[dataIndex];
                        const valueTotal = dataTotalPupilBMI[dataIndex];

                        return `${label}: Total - ${valueTotal}`;
                    }
                }
            }
        }
    };

    const myPupilBMIChart = new Chart(ctxPupilBMI, {
        type: pupilBMIChartType,
        data: chartDataPupilBMI,
        options: chartOptionsPupilBMI
    });

    // Function to update the chart type
    function updatePupilBMIChartType(newTypePupilBMI) {
        chartDataPupilBMI.datasets.forEach(dataset => {
            dataset.type = newTypePupilBMI;
        });

        myPupilBMIChart.config.type = newTypePupilBMI;
        myPupilBMIChart.update();
    }

    // Event listener for select element change
    const chartTypePupilBMISelector = document.getElementById('myChartPupilGeneralBMIChartTypeSelector');
    chartTypePupilBMISelector.addEventListener('change', function() {
        const selectedPupilBMIChartType = this.value;
        updatePupilBMIChartType(selectedPupilBMIChartType);
    });

</script>

<script>
    const ctxPupilHFA = document.getElementById('myChartPupilGeneralHFA');
    const labelsPupilHFA = <?php echo isset($nsrArrayLabels) ? json_encode($nsrArrayLabels) : '[]'; ?>;
    const dataTotalPupilHFA = <?php echo isset($nsrHFAArrayPupil) ? json_encode($nsrHFAArrayPupil) : '[]'; ?>;

    let pupilHFAChartType = 'bar';

    const chartDataPupilHFA = {
        labels: labelsPupilHFA,
        datasets: [
            {
                label: 'HFA',
                data: dataTotalPupilHFA,
                backgroundColor: 'rgba(2, 117, 216, 0.7)',
                borderColor: 'rgb(255, 255, 255)',
                borderWidth: 2,
                type: pupilHFAChartType
            }
        ]
    };

    const chartOptionsPupilHFA = {
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
                        const label = labelsPupilHFA[dataIndex];
                        const valueTotal = dataTotalPupilHFA[dataIndex];

                        return `${label}: Total - ${valueTotal}`;
                    }
                }
            }
        }
    };

    const myPupilHFAChart = new Chart(ctxPupilHFA, {
        type: pupilHFAChartType,
        data: chartDataPupilHFA,
        options: chartOptionsPupilHFA
    });

    // Function to update the chart type
    function updatePupilHFAChartType(newTypePupilHFA) {
        chartDataPupilHFA.datasets.forEach(dataset => {
            dataset.type = newTypePupilHFA;
        });

        myPupilHFAChart.config.type = newTypePupilHFA;
        myPupilHFAChart.update();
    }

    // Event listener for select element change
    const chartTypePupilHFASelector = document.getElementById('myChartPupilGeneralHFAChartTypeSelector');
    chartTypePupilHFASelector.addEventListener('change', function() {
        const selectedPupilHFAChartType = this.value;
        updatePupilHFAChartType(selectedPupilHFAChartType);
    });

</script>