<div class="container d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="card shadow">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <div class="alert alert-danger" id="error-messages" role="alert" style="display:none;">
                <ul id="error-list"></ul>
            </div>
            <form id="signup-form">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                        <i class="fas fa-user"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" placeholder="Email address" name="email" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <select class="form-select" id="roles-select" aria-label="Account type" name="role" required>
                            <option selected value="">Select account type</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Create password" name="password" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Repeat password" name="confirm_password" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="submit-btn" name="submit-signup">Create Account</button>
                </div>
                <p class="text-center mb-0">
                    Have an account? Please <a href="/login">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    // Fetch roles and populate the select dropdown
    fetch('/api/roles/get-roles', {
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
                        displayErrorMessages(data.errors);
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // You can display a generic error message to the user
                displayErrorMessages(['An error occurred. Please try again.'])
            });
    });

    function displayErrorMessages(errors) {
        const errorMessages = document.getElementById('error-messages');
        const errorList = document.getElementById('error-list');

        // Clear previous error messages
        errorList.innerHTML = '';

        // Check if errors is an array or string
        if (Array.isArray(errors)) {
            // If errors is an array, loop through each error and display it
            errors.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li);
            });
        } else if (typeof errors === 'string' || typeof errors === 'object') {
            // If errors is a string or object, display the error
            const li = document.createElement('li');
            li.textContent = errors.error || errors;
            errorList.appendChild(li);
        }

        // Show the error messages
        errorMessages.style.display = 'block';
    }
</script>