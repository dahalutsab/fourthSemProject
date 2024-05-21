// ajaxErrorHandler.js

function handleAjaxError(response) {
    if (!response.ok) {
        if (response.status === 401) {
            // If the status code is 401 (Unauthorized), redirect to the login page
            window.location.href = '/login';
        } else if (response.status === 403) {
            // If the status code is 403 (Forbidden), redirect to the access denied page
            window.location.href = '/access-denied';
        } else {
            // Handle other errors
            throw new Error('Error fetching media');
        }
    }
    return response.json();
}
