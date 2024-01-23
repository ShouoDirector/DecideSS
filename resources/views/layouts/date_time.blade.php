<script>
    function updateDateTime() {
        var now = new Date();
        var formattedDateTime = now.toLocaleString('en-US', {
            weekday: 'long',
            month: 'long',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            hour12: true
        });

        $('#liveDateTime').text(formattedDateTime);
    }

    // Update every second (1000 milliseconds)
    setInterval(updateDateTime, 1000);

    // Initial update
    updateDateTime();

</script>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("userPassword");
        var toggleBtn = document.getElementById("togglePasswordBtn");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleBtn.innerHTML = '<i class="ti ti-eye-off fs-5"></i>';
        } else {
            passwordInput.type = "password";
            toggleBtn.innerHTML = '<i class="ti ti-eye fs-5"></i>';
        }
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var selectedPupilId = null;
    var selectedPupilName = null;

    var checkboxes = document.querySelectorAll('.pupil-checkbox');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                // Uncheck other checkboxes
                checkboxes.forEach(function (otherCheckbox) {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                });

                // Set the selected pupil ID
                selectedPupilId = checkbox.getAttribute('data-pupil-id');
                selectedPupilName = checkbox.getAttribute('data-full-name');
            } else {
                // If the checkbox is unchecked, reset the selected pupil ID
                selectedPupilId = null;
                selectedPupilName = null;
            }

            // Update the pupil_id input value
            document.getElementById('pupilId').value = selectedPupilId;
            document.getElementById('fullNameId').value = selectedPupilName;
        });
    });
});
</script>

<script>
    // Get selectors
    const dataSelector = document.getElementById('myChartsDataSelector');
    const bmiChartSelector = document.getElementById('myChartPupilGeneralBMIChartTypeSelector');
    const hfaChartSelector = document.getElementById('myChartPupilGeneralHFAChartTypeSelector');

    // Set default chart to BMI
    setChartVisibility('bmi');

    // Add event listener for data selector change
    dataSelector.addEventListener('change', function () {
        const selectedValue = dataSelector.value;
        setChartVisibility(selectedValue);
    });

    // Function to set chart visibility based on selected data
    function setChartVisibility(selectedValue) {
        if (selectedValue === 'bmi') {
            document.getElementById('ChartsForBMI').style.display = 'block';
            document.getElementById('chartsForHFA').style.display = 'none';
        } else if (selectedValue === 'hfa') {
            document.getElementById('ChartsForBMI').style.display = 'none';
            document.getElementById('chartsForHFA').style.display = 'block';
        }
    }
</script>