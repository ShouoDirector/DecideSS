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

<script>
    $(document).ready(function() {
        // Function to toggle table columns based on checkbox state
        function toggleColumn(checkboxId, columnIndex) {
            var isChecked = $('#' + checkboxId).prop('checked');
            $('table tr').each(function() {
                $(this).find('th, td').eq(columnIndex).toggle(isChecked);
            });
        }

        // Attach change event listener to each checkbox
        $('input[type="checkbox"]').change(function() {
            var checkboxId = $(this).attr('id');
            switch (checkboxId) {
                case 'checkboxMasterlistLRN':
                    toggleColumn(checkboxId, 1); // LRN column index is 1
                    break;
                case 'checkboxMasterlistName':
                    toggleColumn(checkboxId, 2); // Name column index is 2
                    break;
                case 'checkboxMasterlistAge':
                    toggleColumn(checkboxId, 3); // Age column index is 3
                    break;
                case 'checkboxMasterlistGender':
                    toggleColumn(checkboxId, 4); // Gender column index is 4
                    break;
                case 'checkboxMasterlistAddress':
                    toggleColumn(checkboxId, 5); // Address column index is 5
                    break;
                case 'checkboxMasterlistGuardianName':
                    toggleColumn(checkboxId, 6); // Guardian Name column index is 6
                    break;
                case 'checkboxMasterlistGuardianContactNumber':
                    toggleColumn(checkboxId, 7); // Guardian Contact No column index is 7
                    break;
                case 'checkboxMasterlistActions':
                    toggleColumn(checkboxId, 8); // Actions No column index is 7
                    break;
                // Add more cases for additional checkboxes
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('input[name="gender"]').change(function () {
            var selectedGender = $('input[name="gender"]:checked').val();

            if (selectedGender === 'All') {
                $('#maleTable').show();
                $('#femaleTable').show();
            } else if (selectedGender === 'Male') {
                $('#maleTable').show();
                $('#femaleTable').hide();
            } else if (selectedGender === 'Female') {
                $('#maleTable').hide();
                $('#femaleTable').show();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function to toggle table columns based on checkbox state
        function toggleColumn(checkboxId, columnIndex) {
            var isChecked = $('#' + checkboxId).prop('checked');
            $('table tr').each(function() {
                $(this).find('th, td').eq(columnIndex).toggle(isChecked);
            });
        }

        // Attach change event listener to each checkbox
        $('input[type="checkbox"]').change(function() {
            var checkboxId = $(this).attr('id');
            switch (checkboxId) {
                case 'checkboxNSRName':
                    toggleColumn(checkboxId, 1); 
                    break;
                case 'checkboxNSRDateOfBirth':
                    toggleColumn(checkboxId, 2);
                    break;
                case 'checkboxNSRWeight':
                    toggleColumn(checkboxId, 3); 
                    break;
                case 'checkboxNSRHeight':
                    toggleColumn(checkboxId, 4); 
                    break;
                case 'checkboxNSRSex':
                    toggleColumn(checkboxId, 5); 
                    break;
                case 'checkboxNSRHeightSquared':
                    toggleColumn(checkboxId, 6); 
                    break;
                case 'checkboxNSRAge':
                    toggleColumn(checkboxId, 7);
                    break;
                case 'checkboxNSRBMI':
                    toggleColumn(checkboxId, 8);
                    break;
                case 'checkboxNSRBMICat':
                    toggleColumn(checkboxId, 9);
                    break;
                case 'checkboxNSRHFACat':
                    toggleColumn(checkboxId, 10);
                    break;
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function to toggle table columns based on checkbox state
        function toggleColumn(checkboxId, columnIndex) {
            var isChecked = $('#' + checkboxId).prop('checked');
            $('table tr').each(function() {
                $(this).find('th, td').eq(columnIndex).toggle(isChecked);
            });
        }

        // Attach change event listener to each checkbox
        $('input[type="checkbox"]').change(function() {
            var checkboxId = $(this).attr('id');
            switch (checkboxId) {
                case 'checkboxBLRN':
                    toggleColumn(checkboxId, 1); 
                    break;
                case 'checkboxBName':
                    toggleColumn(checkboxId, 2);
                    break;
                case 'checkboxBClass':
                    toggleColumn(checkboxId, 3); 
                    break;
                case 'checkboxBAdviser':
                    toggleColumn(checkboxId, 4); 
                    break;
                case 'checkboxBAction':
                    toggleColumn(checkboxId, 5); 
                    break;
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Function to toggle table columns based on checkbox state
        function toggleColumn(checkboxId, columnIndex) {
            var isChecked = $('#' + checkboxId).prop('checked');
            $('table tr').each(function() {
                $(this).find('th, td').eq(columnIndex).toggle(isChecked);
            });
        }

        // Attach change event listener to each checkbox
        $('input[type="checkbox"]').change(function() {
            var checkboxId = $(this).attr('id');
            
            // Switch based on checkboxId and call the toggleColumn function for the appropriate column index
            switch (checkboxId) {
                case 'checkboxGradeLevels':
                    toggleColumn(checkboxId, 0); // Assuming column index 0 corresponds to 'Grade Levels'
                    break;
                case 'checkboxTotalBeneficiaries':
                    toggleColumn(checkboxId, 1); // Assuming column index 1 corresponds to 'Total No of Beneficiaries'
                    break;
                case 'checkboxFeedingProgram':
                    toggleColumn(checkboxId, 3); // Assuming column index 2 corresponds to 'Feeding Program'
                    break;
                case 'checkboxImmunization':
                    toggleColumn(checkboxId, 4); // Assuming column index 4 corresponds to 'Immunization Vax Program'
                    break;
                case 'checkboxDeworming':
                    toggleColumn(checkboxId, 6); // Assuming column index 6 corresponds to 'Deworming Program'
                    break;
                case 'checkboxDentalCare':
                    toggleColumn(checkboxId, 8); // Assuming column index 8 corresponds to 'Dental Care Program'
                    break;
                case 'checkboxMentalHealthCare':
                    toggleColumn(checkboxId, 10); // Assuming column index 10 corresponds to 'Mental HealthCare Program'
                    break;
                case 'checkboxEyeCare':
                    toggleColumn(checkboxId, 12); // Assuming column index 12 corresponds to 'Eye Care Program'
                    break;
                case 'checkboxHealthWellness':
                    toggleColumn(checkboxId, 14); // Assuming column index 14 corresponds to 'Health & Wellness Program'
                    break;

                // Add more cases for other checkboxes as needed
            }
        });
    });
</script>
