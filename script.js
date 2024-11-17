// Select the form element
const form = document.getElementById("signup-form");

form.addEventListener("submit", function (event) {
    event.preventDefault();  // Prevent the default form submission

    const formData = new FormData(form);

    fetch('http://localhost/Cosmo%20Airlines/php/controllers/UserController.php', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json', // Ensure the server returns JSON
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);  // Check the returned data
        if (data.success) {
            alert("User created successfully!");  // Show success message
        } else if (data.error) {
            alert("Error: " + data.error);  // Show error message
        }
    })
    .catch(error => {
        console.error('Error submitting the form:', error);  // Handle any errors
    });
});
