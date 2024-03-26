// Fetch roles and populate the select dropdown
fetch('/api/roles/get-roles',
    {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json'
    }
})
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const rolesSelect = document.getElementById('roles-select');
        data.data.forEach(role => {

            const option = document.createElement('option');
            option.value = role.role_id;
            option.textContent = role.roleName;
            rolesSelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error('There was a problem fetching roles:', error);
    });

const signupForm = document.getElementById('signup-form');

signupForm.addEventListener('submit', function(event) {
    event.preventDefault();

    // Clear previous error messages
    const errorMessages = document.getElementById('error-messages');
    const errorList = document.getElementById('error-list');
    errorMessages.style.display = 'none';
    errorList.innerHTML = '';

    // Collect form data
    const formData = new FormData(signupForm);

    // Send form data to the backend using Fetch API
    fetch('/api/user/create-user', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                // Handle successful response
                console.log('User created successfully');
                // Redirect the user to the OTP verification page
                window.location.href = '/verify-otp';
            } else {
                // Handle error response
                return response.json().then(data => {
                    // Display error messages
                    displayErrorMessages(data.error);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // You can display a generic error message to the user
            displayErrorMessages('An error occurred. Please try again.')
        });
});