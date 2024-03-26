function displayErrorMessages(errorMessage) {
    const errorMessages = document.getElementById('error-messages');
    const errorList = document.getElementById('error-list');

    // Clear any previous error messages
    errorList.innerHTML = '';

    // Create a list item for the error message
    const errorItem = document.createElement('li');
    errorItem.textContent = errorMessage;

    // Add the error item to the error list
    errorList.appendChild(errorItem);

    // Make the error message container visible
    errorMessages.style.display = 'block';
}