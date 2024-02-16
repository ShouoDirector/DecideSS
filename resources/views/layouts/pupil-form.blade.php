<script>
    function submitPupilForm() {
        // Get form data
        let lastName = document.getElementById('lastName').value;
        let firstName = document.getElementById('firstName').value;
        let middleName = document.getElementById('middleName').value;
        let suffix = document.getElementById('suffix').value;
        let lrn = document.getElementById('lrn').value;
        let dateOfBirth = document.getElementById('date_of_birth').value;
        let gender = document.getElementById('gender').value;

        // Validate form data
        if (!lastName || !firstName || !lrn || !dateOfBirth) {
            alert('Please fill in first name, last name, and LRN fields.');
            return;
        }

        // Create an object with pupil details
        let newPupilDetails = {
            last_name: lastName,
            first_name: firstName,
            middle_name: middleName,
            suffix: suffix,
            lrn: lrn,
            date_of_birth: dateOfBirth, 
            gender: gender,
            // Added 'date_of_birth' field
            // Add other details as needed
        };

        // Save the details to local storage
        savePupilToLocalStorage(newPupilDetails);

        // Append a new row to the pupilDetailsDiv with the received details
        appendPupilRow(newPupilDetails);

        // Clear the form fields
        document.getElementById('lastName').value = '';
        document.getElementById('firstName').value = '';
        document.getElementById('middleName').value = '';
        document.getElementById('suffix').value = '';
        document.getElementById('lrn').value = '';
        document.getElementById('date_of_birth').value = '';
        document.getElementById('gender').value = '';
    }

    function savePupilToLocalStorage(pupilDetails) {
        // Retrieve existing data from local storage
        let existingData = JSON.parse(localStorage.getItem('pupilData')) || [];

        // Add the new pupil details to the existing data
        existingData.push(pupilDetails);

        // Save the updated data back to local storage
        localStorage.setItem('pupilData', JSON.stringify(existingData));
    }

    function appendPupilRow(pupilDetails) {
        // Check if pupilDetailsDiv already contains a table
        let existingTable = document.getElementById('pupilDetailsTable');
        let table;

        if (existingTable) {
            // If a table exists, use it to avoid repetition
            table = existingTable;
        } else {
            // If no table exists, create a new one
            table = document.createElement('table');
            table.id = 'pupilDetailsTable';
            table.className = 'table';

            // Add a header row with manual columns "Last Name", "First Name", "Middle Name", "Suffix", "LRN", and "Date of Birth"
            let headerRow = document.createElement('tr');

            // Add header cell for "Last Name"
            let lastNameHeaderCell = document.createElement('th');
            lastNameHeaderCell.innerText = 'Last Name';
            lastNameHeaderCell.className = 'p-1';
            headerRow.appendChild(lastNameHeaderCell);

            // Add header cell for "First Name"
            let firstNameHeaderCell = document.createElement('th');
            firstNameHeaderCell.innerText = 'First Name';
            firstNameHeaderCell.className = 'p-1';
            headerRow.appendChild(firstNameHeaderCell);

            // Add header cell for "Middle Name"
            let middleNameHeaderCell = document.createElement('th');
            middleNameHeaderCell.innerText = 'Middle Name';
            middleNameHeaderCell.className = 'p-1';
            headerRow.appendChild(middleNameHeaderCell);

            // Add header cell for "Suffix"
            let suffixHeaderCell = document.createElement('th');
            suffixHeaderCell.innerText = 'Suffix';
            suffixHeaderCell.className = 'p-1';
            headerRow.appendChild(suffixHeaderCell);

            // Add header cell for "LRN"
            let lrnHeaderCell = document.createElement('th');
            lrnHeaderCell.innerText = 'LRN';
            lrnHeaderCell.className = 'p-1';
            headerRow.appendChild(lrnHeaderCell);

            // Add header cell for "Date of Birth"
            let dateOfBirthHeaderCell = document.createElement('th');
            dateOfBirthHeaderCell.innerText = 'Date of Birth';
            dateOfBirthHeaderCell.className = 'p-1';
            headerRow.appendChild(dateOfBirthHeaderCell);

            // Add header cell for "Gender"
            let genderHeaderCell = document.createElement('th');
            genderHeaderCell.innerText = 'Gender';
            genderHeaderCell.className = 'p-1';
            headerRow.appendChild(genderHeaderCell);

            // Add header cell for actions
            let actionsHeaderCell = document.createElement('th');
            actionsHeaderCell.innerText = 'Actions';
            actionsHeaderCell.className = 'p-1';
            headerRow.appendChild(actionsHeaderCell);

            // Add the header row to the table
            table.appendChild(headerRow);

            // Append the table to pupilDetailsDiv
            document.getElementById('pupilDetailsDiv').appendChild(table);
        }

        // Add a row for the pupil details
        let pupilRow = document.createElement('tr');

        // Add cells for "Last Name", "First Name", "Middle Name", "Suffix", "LRN", and "Date of Birth"
        let lastNameCell = document.createElement('td');
        lastNameCell.className = 'p-1';
        let firstNameCell = document.createElement('td');
        firstNameCell.className = 'p-1';
        let middleNameCell = document.createElement('td');
        middleNameCell.className = 'p-1';
        let suffixCell = document.createElement('td');
        suffixCell.className = 'p-1';
        let lrnCell = document.createElement('td');
        lrnCell.className = 'p-1';
        let dateOfBirthCell = document.createElement('td');
        dateOfBirthCell.className = 'p-1';
        let genderCell = document.createElement('td');
        genderCell.className = 'p-1';

        // Create input fields for "Last Name", "First Name", "Middle Name", "Suffix", "LRN", and "Date of Birth"
        let lastNameInput = document.createElement('input');
        lastNameInput.type = 'text';
        lastNameInput.name = 'pupil[last_name][]';
        lastNameInput.className = 'form-control border border-primary mt-1 rounded-0';
        lastNameInput.value = pupilDetails.last_name || '';
        lastNameInput.required = true;

        let firstNameInput = document.createElement('input');
        firstNameInput.type = 'text';
        firstNameInput.name = 'pupil[first_name][]';
        firstNameInput.className = 'form-control border border-primary mt-1 rounded-0';
        firstNameInput.value = pupilDetails.first_name || '';
        firstNameInput.required = true;

        let middleNameInput = document.createElement('input');
        middleNameInput.type = 'text';
        middleNameInput.name = 'pupil[middle_name][]';
        middleNameInput.className = 'form-control border border-primary mt-1 rounded-0';
        middleNameInput.value = pupilDetails.middle_name || '';
        middleNameInput.required = true;

        let suffixInput = document.createElement('input');
        suffixInput.type = 'text';
        suffixInput.name = 'pupil[suffix][]';
        suffixInput.className = 'form-control border border-primary mt-1 rounded-0';
        suffixInput.value = pupilDetails.suffix || '';
        suffixInput.required = true;

        let lrnInput = document.createElement('input');
        lrnInput.type = 'text';
        lrnInput.name = 'pupil[lrn][]';
        lrnInput.className = 'form-control border border-primary mt-1 rounded-0';
        lrnInput.value = pupilDetails.lrn || '';
        lrnInput.required = true;

        let dateOfBirthInput = document.createElement('input');
        dateOfBirthInput.type = 'date'; // Use 'date' type for date input
        dateOfBirthInput.name = 'pupil[date_of_birth][]';
        dateOfBirthInput.className = 'form-control border border-primary mt-1 rounded-0';
        dateOfBirthInput.value = pupilDetails.date_of_birth || '';
        dateOfBirthInput.required = true;

        // Create a select field for "Gender"
        let genderSelect = document.createElement('input');
        genderSelect.type ='text';
        genderSelect.name = 'pupil[gender][]';
        genderSelect.className = 'form-control border border-primary mt-1 rounded-0';
        genderSelect.value = pupilDetails.gender || '';
        genderSelect.required = true;

        // Append the input fields to the cells
        lastNameCell.appendChild(lastNameInput);
        firstNameCell.appendChild(firstNameInput);
        middleNameCell.appendChild(middleNameInput);
        suffixCell.appendChild(suffixInput);
        lrnCell.appendChild(lrnInput);
        dateOfBirthCell.appendChild(dateOfBirthInput);
        genderCell.appendChild(genderSelect);

        // Append cells to the row
        pupilRow.appendChild(lastNameCell);
        pupilRow.appendChild(firstNameCell);
        pupilRow.appendChild(middleNameCell);
        pupilRow.appendChild(suffixCell);
        pupilRow.appendChild(lrnCell);
        pupilRow.appendChild(dateOfBirthCell);
        pupilRow.appendChild(genderCell);

        // Add a cell for actions
        let actionsCell = document.createElement('td');
        actionsCell.className = 'd-flex justify-content-center p-1';

        // Add a delete button
        let deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'btn btn-danger mt-1 rounded-0';

        // Create an <i> tag for the trash icon
        let trashIcon = document.createElement('i');
        trashIcon.className = 'ti ti-trash';

        // Append the <i> tag to the delete button
        deleteButton.appendChild(trashIcon);

        // Set the onclick event
        deleteButton.onclick = function () {
            deletePupilRow(this);
        };

        // Append the delete button to the actions cell
        actionsCell.appendChild(deleteButton);

        // Append the actions cell to the row
        pupilRow.appendChild(actionsCell);

        // Add the pupil row to the table
        table.appendChild(pupilRow);
    }

    function deletePupilRow(button) {
        // Traverse the DOM to find the corresponding table row
        let row = button.closest('tr');

        // Extract LRN from the row to identify the pupil to be deleted
        let lrn = row.querySelector('input[name="pupil[lrn][]"]').value;

        // Remove the row from the table
        row.remove();

        // Update local storage after deleting the specific row
        updatePupilLocalStorage(lrn);
    }

    // Add this function to check if there are rows in the table
    function hasPupilRows() {
        let table = document.getElementById('pupilDetailsTable');
        return table && table.rows.length > 1; // Assuming the first row is the header
    }

    // Modify the updateLocalStorage function to check for pupil rows before updating
    function updatePupilLocalStorage(lrnToDelete) {
        // Get existing data from local storage
        let existingData = JSON.parse(localStorage.getItem('pupilData')) || [];

        // Filter out the entry with the specified LRN
        let updatedData = existingData.filter(pupil => pupil.lrn !== lrnToDelete);

        // Save the updated data back to local storage
        localStorage.setItem('pupilData', JSON.stringify(updatedData));
    }

    // Load existing data from local storage on page load
    window.onload = function () {
        let existingData = JSON.parse(localStorage.getItem('pupilData')) || [];
        existingData.forEach(function (pupilDetails) {
            appendPupilRow(pupilDetails);
        });
    }

    // Modify the submitAllPupils function to check for pupil rows before submitting
    function submitAllPupils() {
        if (hasPupilRows()) {
            document.getElementById('massInsertPupilForm').submit();
        } else {
            alert('No records to insert.');
        }
    }

    function clearAllPupilData() {
        // Clear all pupil data from local storage
        localStorage.removeItem('pupilData');

        // Clear the table in the HTML
        clearPupilTable();
    }

    // Add this function to clear the table in the HTML
    function clearPupilTable() {
        let table = document.getElementById('pupilDetailsTable');
        if (table) {
            table.remove();
        }
    }
</script>
