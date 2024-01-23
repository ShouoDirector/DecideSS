<script>
    function submitMasterListForm() {
        // Get form data
        let pupilId = document.getElementById('pupilId').value;
        let fullNameId = document.getElementById('fullNameId').value;
        let classId = document.getElementById('classId').value;
        let promoted = document.getElementById('promoted').value;
        let transferred = document.getElementById('transferred').value;
        let repeated = document.getElementById('repeated').value;
        let dropped = document.getElementById('dropped').value;

        if (!pupilId || !classId) {
            alert('Please fill in first name, last name, in the search field first.');
            return;
        }

        // Create an object with master list details
        let newMasterListDetails = {
            pupil_id: pupilId,
            fullName_Id: fullNameId,
            class_id: classId,
            promoted: promoted,
            transferred: transferred,
            repeated: repeated,
            dropped: dropped,
        };

        // Save the details to local storage
        saveMasterListToLocalStorage(newMasterListDetails);

        // Append a new row to the masterListDetailsDiv with the received details
        appendMasterListRow(newMasterListDetails);

        // Clear the form fields
        document.getElementById('pupilId').value = '';
        document.getElementById('fullNameId').value = '';
        document.getElementById('classId').value = '';
        document.getElementById('promoted').value = 'No'; // Set default value for enums
        document.getElementById('transferred').value = 'No';
        document.getElementById('repeated').value = 'No';
        document.getElementById('dropped').value = 'No';
    }

    function saveMasterListToLocalStorage(masterListDetails) {
        // Retrieve existing data from local storage
        let existingData = JSON.parse(localStorage.getItem('masterListData')) || [];

        // Add the new master list details to the existing data
        existingData.push(masterListDetails);

        // Save the updated data back to local storage
        localStorage.setItem('masterListData', JSON.stringify(existingData));
    }

    function appendMasterListRow(masterListDetails) {
        // Check if masterListDetailsDiv already contains a table
        let existingTable = document.getElementById('masterListDetailsTable');
        let table;

        if (existingTable) {
            // If a table exists, use it to avoid repetition
            table = existingTable;
        } else {
            // If no table exists, create a new one
            table = document.createElement('table');
            table.id = 'masterListDetailsTable';
            table.className = 'table';

            // Add a header row with manual columns "Pupil ID", "Class ID", "Promoted", "Transferred", "Repeated", and "Dropped"
            let headerRow = document.createElement('tr');

            // Add header cell for "Pupil ID"
            let pupilIdHeaderCell = document.createElement('th');
            pupilIdHeaderCell.innerText = 'Pupil ID';
            pupilIdHeaderCell.className = 'p-1 d-none';
            headerRow.appendChild(pupilIdHeaderCell);

            let pupilNameHeaderCell = document.createElement('th');
            pupilNameHeaderCell.innerText = 'Pupil Name';
            pupilNameHeaderCell.className = 'p-1';
            headerRow.appendChild(pupilNameHeaderCell);

            // Add header cell for "Class ID"
            let classIdHeaderCell = document.createElement('th');
            classIdHeaderCell.innerText = 'Class ID';
            classIdHeaderCell.className = 'p-1 d-none';
            headerRow.appendChild(classIdHeaderCell);

            // Add header cell for "Promoted"
            let promotedHeaderCell = document.createElement('th');
            promotedHeaderCell.innerText = 'Promoted';
            promotedHeaderCell.className = 'p-1';
            headerRow.appendChild(promotedHeaderCell);

            // Add header cell for "Transferred"
            let transferredHeaderCell = document.createElement('th');
            transferredHeaderCell.innerText = 'Transferred';
            transferredHeaderCell.className = 'p-1';
            headerRow.appendChild(transferredHeaderCell);

            // Add header cell for "Repeated"
            let repeatedHeaderCell = document.createElement('th');
            repeatedHeaderCell.innerText = 'Repeated';
            repeatedHeaderCell.className = 'p-1';
            headerRow.appendChild(repeatedHeaderCell);

            // Add header cell for "Dropped"
            let droppedHeaderCell = document.createElement('th');
            droppedHeaderCell.innerText = 'Dropped';
            droppedHeaderCell.className = 'p-1';
            headerRow.appendChild(droppedHeaderCell);

            // Add header cell for actions
            let actionsHeaderCell = document.createElement('th');
            actionsHeaderCell.innerText = 'Actions';
            actionsHeaderCell.className = 'p-1';
            headerRow.appendChild(actionsHeaderCell);

            // Add the header row to the table
            table.appendChild(headerRow);

            // Append the table to masterListDetailsDiv
            document.getElementById('pupilMasterlistDetailsDiv').appendChild(table);
        }

        // Add a row for the master list details
        let masterListRow = document.createElement('tr');

        // Add cells for "Pupil ID", "Class ID", "Promoted", "Transferred", "Repeated", and "Dropped"
        let pupilIdCell = document.createElement('td');
        pupilIdCell.className = 'p-1 d-none';
        let pupilNameCell = document.createElement('td');
        pupilNameCell.className = 'p-1';
        let classIdCell = document.createElement('td');
        classIdCell.className = 'p-1 d-none';
        let promotedCell = document.createElement('td');
        promotedCell.className = 'p-1';
        let transferredCell = document.createElement('td');
        transferredCell.className = 'p-1';
        let repeatedCell = document.createElement('td');
        repeatedCell.className = 'p-1';
        let droppedCell = document.createElement('td');
        droppedCell.className = 'p-1';

        // Create input fields for "Pupil ID", "Class ID", "Promoted", "Transferred", "Repeated", and "Dropped"
        let pupilIdInput = document.createElement('input');
        pupilIdInput.type = 'text';
        pupilIdInput.name = 'master_list[pupil_id][]';
        pupilIdInput.className = 'form-control border border-primary mt-1 rounded-0 d-none';
        pupilIdInput.value = masterListDetails.pupil_id || '';
        pupilIdInput.required = true;

        let pupilNameInput = document.createElement('input');
        pupilNameInput.type = 'text';
        pupilNameInput.name = 'master_list[fullName_Id][]';
        pupilNameInput.className = 'form-control border border-primary mt-1 rounded-0';
        pupilNameInput.value = masterListDetails.fullName_Id || ''; // Corrected this line
        pupilNameInput.required = true;

        let classIdInput = document.createElement('input');
        classIdInput.type = 'text';
        classIdInput.name = 'master_list[class_id][]';
        classIdInput.className = 'form-control border border-primary mt-1 rounded-0 d-none';
        classIdInput.value = masterListDetails.class_id || '';
        classIdInput.required = true;

        let promotedInput = document.createElement('select');
        promotedInput.name = 'master_list[promoted][]';
        promotedInput.className = 'form-control border border-primary mt-1 rounded-0';
        promotedInput.required = true;

        // Add options for "Promoted" enum
        let promotedOptions = ['Yes', 'No'];
        for (let option of promotedOptions) {
            let optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.innerText = option;
            promotedInput.appendChild(optionElement);
        }
        promotedInput.value = masterListDetails.promoted || 'No'; // Set default value

        let transferredInput = document.createElement('select');
        transferredInput.name = 'master_list[transferred][]';
        transferredInput.className = 'form-control border border-primary mt-1 rounded-0';
        transferredInput.required = true;

        // Add options for "Transferred" enum
        let transferredOptions = ['Yes', 'No'];
        for (let option of transferredOptions) {
            let optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.innerText = option;
            transferredInput.appendChild(optionElement);
        }
        transferredInput.value = masterListDetails.transferred || 'No'; // Set default value

        let repeatedInput = document.createElement('select');
        repeatedInput.name = 'master_list[repeated][]';
        repeatedInput.className = 'form-control border border-primary mt-1 rounded-0';
        repeatedInput.required = true;

        // Add options for "Repeated" enum
        let repeatedOptions = ['Yes', 'No'];
        for (let option of repeatedOptions) {
            let optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.innerText = option;
            repeatedInput.appendChild(optionElement);
        }
        repeatedInput.value = masterListDetails.repeated || 'No'; // Set default value

        let droppedInput = document.createElement('select');
        droppedInput.name = 'master_list[dropped][]';
        droppedInput.className = 'form-control border border-primary mt-1 rounded-0';
        droppedInput.required = true;

        // Add options for "Dropped" enum
        let droppedOptions = ['Yes', 'No'];
        for (let option of droppedOptions) {
            let optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.innerText = option;
            droppedInput.appendChild(optionElement);
        }
        droppedInput.value = masterListDetails.dropped || 'No'; // Set default value

        // Append the input fields to the cells
        pupilIdCell.appendChild(pupilIdInput);
        pupilNameCell.appendChild(pupilNameInput);
        classIdCell.appendChild(classIdInput);
        promotedCell.appendChild(promotedInput);
        transferredCell.appendChild(transferredInput);
        repeatedCell.appendChild(repeatedInput);
        droppedCell.appendChild(droppedInput);

        // Append cells to the row
        masterListRow.appendChild(pupilIdCell);
        masterListRow.appendChild(pupilNameCell);
        masterListRow.appendChild(classIdCell);
        masterListRow.appendChild(promotedCell);
        masterListRow.appendChild(transferredCell);
        masterListRow.appendChild(repeatedCell);
        masterListRow.appendChild(droppedCell);

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
            deleteMasterListRow(this);
        };

        // Append the delete button to the actions cell
        actionsCell.appendChild(deleteButton);

        // Append the actions cell to the row
        masterListRow.appendChild(actionsCell);

        // Add the master list row to the table
        table.appendChild(masterListRow);
    }

    function deleteMasterListRow(button) {
        // Traverse the DOM to find the corresponding table row
        let row = button.closest('tr');

        // Extract Pupil ID from the row to identify the master list entry to be deleted
        let pupilId = row.querySelector('input[name="master_list[pupil_id][]"]').value;

        // Remove the row from the table
        row.remove();

        // Update local storage after deleting the specific row
        updateMasterListLocalStorage(pupilId);
    }

    // Add this function to check if there are rows in the table
    function hasMasterListRows() {
        let table = document.getElementById('masterListDetailsTable');
        return table && table.rows.length > 1; // Assuming the first row is the header
    }

    // Modify the updateLocalStorage function to check for master list rows before updating
    function updateMasterListLocalStorage(pupilIdToDelete) {
        // Get existing data from local storage
        let existingData = JSON.parse(localStorage.getItem('masterListData')) || [];

        // Filter out the entry with the specified Pupil ID
        let updatedData = existingData.filter(entry => entry.pupil_id !== pupilIdToDelete);

        // Save the updated data back to local storage
        localStorage.setItem('masterListData', JSON.stringify(updatedData));
    }

    // Load existing data from local storage on page load
    window.onload = function () {
        let existingData = JSON.parse(localStorage.getItem('masterListData')) || [];
        existingData.forEach(function (masterListDetails) {
            appendMasterListRow(masterListDetails);
        });
    }

    // Modify the submitAllMasterListEntries function to check for master list rows before submitting
    function submitAllMasterListEntries() {
        if (hasMasterListRows()) {
            document.getElementById('massInsertMasterListForm').submit();
        } else {
            alert('No records to insert.');
        }
    }

    function clearAllMasterListData() {
        // Clear all master list data from local storage
        localStorage.removeItem('masterListData');

        // Clear the table in the HTML
        clearMasterListTable();
    }

    // Add this function to clear the table in the HTML
    function clearMasterListTable() {
        let table = document.getElementById('masterListDetailsTable');
        if (table) {
            table.remove();
        }
    }
</script>
