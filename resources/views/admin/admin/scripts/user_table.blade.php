<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all elements with the class 'copy-unique-id'
        var copyElements = document.querySelectorAll('.copy-unique-id');

        // Add click event listener to each element
        copyElements.forEach(function (element) {
            element.addEventListener('click', function () {
                // Create a temporary textarea to store the Unique ID value
                var textarea = document.createElement('textarea');
                textarea.value = element.textContent;

                // Append the textarea to the document
                document.body.appendChild(textarea);

                // Select the content of the textarea
                textarea.select();

                // Copy the selected text to the clipboard
                document.execCommand('copy');

                // Remove the temporary textarea
                document.body.removeChild(textarea);

                // Optionally, provide some visual feedback to the user
                alert('Unique ID copied to clipboard: ' + element.textContent);
            });
        });
    });
</script>