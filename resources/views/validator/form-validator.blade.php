<script>
    document.getElementById("userForm").onsubmit = function (event) {
        // Validation for Select Element
        var userType = document.getElementById("userTypeSelect").value;
        var validationMessage = document.getElementById("validationMessage");
        var userTypeSelect = document.getElementById("userTypeSelect");

        if (userType === "") {
            validationMessage.textContent = "Please select a role before submitting the form.";
            userTypeSelect.classList.add("is-invalid");
            userTypeSelect.classList.add("border-danger");
            event.preventDefault();
        } else {
            validationMessage.textContent = "";
            userTypeSelect.classList.remove("is-invalid");
            userTypeSelect.classList.remove("border-danger");
        }
    };

    $(document).ready(function() {
        $('.select2').select2();
    });

    // Adding event listeners to revert back to normal state when user corrects the inputs
    document.getElementById("userTypeSelect").addEventListener("change", function () {
        var userTypeSelect = document.getElementById("userTypeSelect");
        var validationMessage = document.getElementById("validationMessage");

        validationMessage.textContent = ""; // Remove the validation message
        userTypeSelect.classList.remove("is-invalid");
        userTypeSelect.classList.remove("border-danger");
    });

    //Pagination
    document.getElementById('paginationSelect').addEventListener('change', function() {
        document.getElementById('userFilterForm').submit();
    });

    //RadioButtons
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(radioButton => {
        radioButton.addEventListener('change', () => {
            document.getElementById('userFilterForm').submit();
        });
    });


</script>
