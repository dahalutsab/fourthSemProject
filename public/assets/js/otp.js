// OTP input fields
const inputs = document.querySelectorAll('.otp-input');
for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('input', function (event) {
        const currentInput = event.target;
        const currentValue = currentInput.value;

        // Clear the value if it's not a digit
        if (!/^\d$/.test(currentValue)) {
            currentInput.value = '';
            return;
        }

        // Move focus to the next input field if it exists
        if (i < inputs.length - 1 && currentValue !== '') {
            inputs[i + 1].focus();
        }
    });

    // Move focus to the previous input field when backspace is pressed
    inputs[i].addEventListener('keydown', function (event) {
        if (event.key === 'Backspace' && i > 0 && !inputs[i].value) {
            inputs[i - 1].focus();
        }
    });
}

document.getElementById('otp-form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Clear previous error messages
    const errorMessages = document.getElementById('error-messages');
    const errorList = document.getElementById('error-list');
    errorMessages.style.display = 'none';
    errorList.innerHTML = '';

    // Collect OTP
    const otp = Array.from(document.querySelectorAll('.otp-input')).map(input => input.value).join('');

    // Create a FormData object from the form
    const formData = new FormData();

    // Append the OTP to the FormData object
    formData.append('otp', otp);

    // Send OTP to the server
    fetch('/api/user/verify-otp', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                // OTP verification successful, redirect to login page
                window.location.href = '/login';
            } else {
                // OTP verification failed, display error message
                return response.json().then(data => {
                    // Clear any previous error messages
                    errorList.innerHTML = '';

                    // Create a list item for the error message
                    const errorItem = document.createElement('li');
                    errorItem.textContent = data.error;

                    // Add the error item to the error list
                    errorList.appendChild(errorItem);

                    // Make the error message container visible
                    errorMessages.style.display = 'block';
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // You can display a generic error message to the user
            displayErrorMessages('An error occurred. Please try again.')
        });
});

