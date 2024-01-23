<script>
    function submitUserForm() {
        // Get form data
        let userName = document.getElementById('userName').value;
        let userEmail = document.getElementById('userEmail').value;
        let userType = document.getElementById('userTypeSelect').value;
        let userPassword = document.getElementById('userPassword').value;

        // Validate form data
        if (!userName || !userEmail || !userType || !userPassword) {
            alert('Please fill in all fields.');
            return;
        }

        // Create an object with user details
        let newUserDetails = {
            name: userName,
            email: userEmail,
            user_type: userType, // Update to match the name used in the appendRow function
            password: userPassword,
            // Add other details as needed
        };

        // Save the details to local storage
        saveToLocalStorage(newUserDetails);

        // Append a new row to the userDetailsDiv with the received details
        appendRow(newUserDetails);

        // Clear the form fields
        document.getElementById('userName').value = '';
        document.getElementById('userEmail').value = '';
        document.getElementById('userTypeSelect').value = '4'; // Set to default option
        document.getElementById('userPassword').value = '';
    }

    function saveToLocalStorage(userDetails) {
        // Retrieve existing data from local storage
        let existingData = JSON.parse(localStorage.getItem('userData')) || [];

        // Add the new user details to the existing data
        existingData.push(userDetails);

        // Save the updated data back to local storage
        localStorage.setItem('userData', JSON.stringify(existingData));
    }

    function appendRow(userDetails) {
        // Check if userDetailsDiv already contains a table
        let existingTable = document.getElementById('userDetailsTable');
        let table;

        if (existingTable) {
            // If a table exists, use it to avoid repetition
            table = existingTable;
        } else {
            // If no table exists, create a new one
            table = document.createElement('table');
            table.id = 'userDetailsTable';
            table.className = 'table';

            // Add a header row with manual columns "Name", "Email", "User Type", and "Password"
            let headerRow = document.createElement('tr');

            // Add header cell for "Name"
            let nameHeaderCell = document.createElement('th');
            nameHeaderCell.innerText = 'Name';
            nameHeaderCell.className = 'p-1';
            headerRow.appendChild(nameHeaderCell);

            // Add header cell for "Email"
            let emailHeaderCell = document.createElement('th');
            emailHeaderCell.innerText = 'Email';
            emailHeaderCell.className = 'p-1';
            headerRow.appendChild(emailHeaderCell);

            // Add header cell for "User Type"
            let userTypeHeaderCell = document.createElement('th');
            userTypeHeaderCell.className = 'd-none';
            userTypeHeaderCell.innerText = 'User Type';
            headerRow.appendChild(userTypeHeaderCell);

            let userTypeVisibleHeaderCell = document.createElement('th');
            userTypeVisibleHeaderCell.innerText = 'User Type';
            userTypeVisibleHeaderCell.className = 'p-1';
            headerRow.appendChild(userTypeVisibleHeaderCell);

            // Add header cell for "Password"
            let passwordHeaderCell = document.createElement('th');
            passwordHeaderCell.innerText = 'Password';
            passwordHeaderCell.className = 'p-1';
            headerRow.appendChild(passwordHeaderCell);

            // Add header cell for actions
            let actionsHeaderCell = document.createElement('th');
            actionsHeaderCell.innerText = 'Actions';
            actionsHeaderCell.className = 'p-1';
            headerRow.appendChild(actionsHeaderCell);

            // Add the header row to the table
            table.appendChild(headerRow);

            // Append the table to userDetailsDiv
            document.getElementById('userDetailsDiv').appendChild(table);
        }

        // Add a row for the user details
        let userRow = document.createElement('tr');

        // Add cells for "Name", "Email", "User Type", and "Password"
        let nameCell = document.createElement('td');
        nameCell.className = 'p-1';
        let emailCell = document.createElement('td');
        emailCell.className = 'p-1';
        let userTypeCell = document.createElement('td');
        userTypeCell.className = 'p-1 d-none';
        let userTypeVisibleCell = document.createElement('td');
        userTypeVisibleCell.className = 'p-1';
        let passwordCell = document.createElement('td');
        passwordCell.className = 'p-1';

        // Create input fields for "Name", "Email", "User Type", and "Password"
        let nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.name = 'users[name][]';
        nameInput.className = 'form-control border border-primary name-input mt-1 rounded-0';
        nameInput.value = userDetails.name || '';
        nameInput.required = true;

        let emailInput = document.createElement('input');
        emailInput.type = 'text';
        emailInput.name = 'users[email][]';
        emailInput.className = 'form-control border border-primary email-input mt-1 rounded-0';
        emailInput.value = userDetails.email || '';
        emailInput.required = true;

        let userTypeInput = document.createElement('input');
        userTypeInput.type = 'text';
        userTypeInput.name = 'users[user_type][]';
        userTypeInput.className = 'form-control border border-primary user-type-input mt-1 rounded-0';
        userTypeInput.value = userDetails.user_type || '';
        userTypeInput.required = true;

        let userTypeVisibleInput = document.createElement('input');
        userTypeVisibleInput.type = 'text';
        userTypeVisibleInput.name = '';
        userTypeVisibleInput.className =
            'form-control border border-0 border-primary user-type-input mt-1 rounded-0 cursor-default';

        // Assuming userDetails.user_type is an integer
        if (userDetails.user_type == 2) {
            userTypeVisibleInput.value = 'Medical Officer';
        } else if (userDetails.user_type == 3) {
            userTypeVisibleInput.value = 'School Nurse';
        } else if (userDetails.user_type == 4) {
            userTypeVisibleInput.value = 'Class Adviser';
        } else {
            // Handle other cases or leave it empty
        }

        userTypeVisibleInput.required = true;
        userTypeVisibleInput.readOnly = true;

        let passwordInput = document.createElement('input');
        passwordInput.type = 'password'; // Assuming it's a password field
        passwordInput.name = 'users[password][]';
        passwordInput.className = 'form-control border border-primary password-input mt-1 rounded-0';
        passwordInput.value = userDetails.password || '';
        passwordInput.required = true;

        // Append the input fields to the cells
        nameCell.appendChild(nameInput);
        emailCell.appendChild(emailInput);
        userTypeCell.appendChild(userTypeInput);
        userTypeVisibleCell.appendChild(userTypeVisibleInput);
        passwordCell.appendChild(passwordInput);

        // Append cells to the row
        userRow.appendChild(nameCell);
        userRow.appendChild(emailCell);
        userRow.appendChild(userTypeCell);
        userRow.appendChild(userTypeVisibleCell);
        userRow.appendChild(passwordCell);

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
            deleteRow(this);
        };

        // Append the delete button to the actions cell
        actionsCell.appendChild(deleteButton);

        // Append the actions cell to the row
        userRow.appendChild(actionsCell);

        // Add the user row to the table
        table.appendChild(userRow);
    }

    function deleteRow(button) {
        // Traverse the DOM to find the corresponding table row
        let row = button.closest('tr');

        // Extract email from the row to identify the user to be deleted
        let email = row.querySelector('input[name="users[email][]"]').value;

        // Remove the row from the table
        row.remove();

        // Update local storage after deleting the specific row
        updateLocalStorage(email);
    }

    // Add this function to check if there are rows in the table
    function hasRows() {
        let table = document.getElementById('userDetailsTable');
        return table && table.rows.length > 1; // Assuming the first row is the header
    }

    // Modify the updateLocalStorage function to check for rows before updating
    function updateLocalStorage(emailToDelete) {
        // Get existing data from local storage
        let existingData = JSON.parse(localStorage.getItem('userData')) || [];

        // Filter out the entry with the specified email
        let updatedData = existingData.filter(user => user.email !== emailToDelete);

        // Save the updated data back to local storage
        localStorage.setItem('userData', JSON.stringify(updatedData));

        // Toggle visibility of the "Insert All" button based on the presence of rows
        let insertAllButton = document.getElementById('insertAllButton');
        if (insertAllButton) {
            insertAllButton.style.display = hasRows() ? 'block' : 'none';
        }
    }

    // Load existing data from local storage on page load
    window.onload = function () {
        let existingData = JSON.parse(localStorage.getItem('userData')) || [];
        existingData.forEach(function (userDetails) {
            appendRow(userDetails);
        });

        // Toggle visibility of the "Insert All" button based on the presence of rows
        let insertAllButton = document.getElementById('insertAllButton');
        if (insertAllButton) {
            insertAllButton.style.display = hasRows() ? 'block' : 'none';
        }
    }

    // Modify the submitAllUsers function to check for rows before submitting
    function submitAllUsers() {
        if (hasRows()) {
            document.getElementById('massInsertForm').submit();
        } else {
            alert('No records to insert.');
        }
    }

    function clearAllUserData() {
        // Clear all user data from local storage
        localStorage.removeItem('userData');

        // Clear the table in the HTML
        clearTable();

        // Toggle visibility of the "Insert All" button based on the presence of rows
        let insertAllButton = document.getElementById('insertAllButton');
        if (insertAllButton) {
            insertAllButton.style.display = hasRows() ? 'block' : 'none';
        }
    }

    // Add this function to clear the table in the HTML
    function clearTable() {
        let table = document.getElementById('userDetailsTable');
        if (table) {
            table.remove();
        }
    }

</script>
