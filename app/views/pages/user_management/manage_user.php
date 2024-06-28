<h1>Users List</h1>

<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">S.No</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Is Active</th>
            <th scope="col">Is Blocked</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="userTableBody">
        <!-- User data will be appended here by JavaScript -->
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchAndDisplayUsers();

        // Event delegation for buttons in the action column
        document.querySelector('table').addEventListener('click', function(event) {
            const userId = event.target.closest('tr').dataset.userId;

            if (event.target.classList.contains('view-user')) {
                viewUser(userId);
            } else if (event.target.classList.contains('delete-user')) {
                if (confirm('Are you sure you want to block this user?')) {
                    deleteUser(userId);
                }
            } else if (event.target.classList.contains('unblock-user')) {
                if (confirm('Are you sure you want to unblock this user?')) {
                    unblockUser(userId);
                }
            }
        });
    });

    function fetchAndDisplayUsers() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/api/getAllUsers', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const users = response.data;
                        const tbody = document.querySelector('#userTableBody');
                        tbody.innerHTML = '';
                        users.forEach(function(user, index) {
                            const tr = document.createElement('tr');
                            tr.dataset.userId = user.id;
                            tr.innerHTML = `
                                <td>${index + 1}</td>
                                <td>${user.username}</td>
                                <td>${user.email}</td>
                                <td>${user.isVerified ? 'Yes' : 'No'}</td>
                                <td>${user.isBlocked ? 'Yes' : 'No'}</td>
                                <td>
                                    <button type="button" class="btn btn-success view-user">View</button>
                                    ${user.isBlocked
                                ? `<button type="button" class="btn btn-primary unblock-user">Unblock</button>`
                                : `<button type="button" class="btn btn-danger delete-user">Block</button>`}
                                </td>`;
                            tbody.appendChild(tr);
                        });
                    } else {
                        alert(response.message);
                    }
                } catch (e) {
                    alert('Failed to parse response.');
                }
            } else {
                alert('Failed to fetch users.');
            }
        };
        xhr.send();
    }

    function viewUser(userId) {
        window.location.href = '/dashboard/user-info?id=' + userId;
    }

    function deleteUser(userId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/blockUser', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        toastr.success('User blocked successfully.');
                        fetchAndDisplayUsers();
                    } else {
                        toastr.error(response.error);
                    }
                } catch (e) {
                    toastr.error('Failed to parse response.');
                }
            } else {
                toastr.error('Failed to block user.');
            }
        };
        xhr.send(JSON.stringify({ userId: userId }));
    }

    function unblockUser(userId) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/unblockUser', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        toastr.success('User unblocked successfully.');
                        fetchAndDisplayUsers();
                    } else {
                        toastr.error(response.error);
                    }
                } catch (e) {
                    toastr.error('Failed to parse response.');
                }
            } else {
                toastr.error('Failed to unblock user.');
            }
        };
        xhr.send(JSON.stringify({ userId: userId }));
    }
</script>
