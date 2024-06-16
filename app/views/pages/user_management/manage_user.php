<h2>Users List</h2>
<table class="table" id="usersTable">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Users will be dynamically inserted here -->
    </tbody>
</table>
<script>
    // Fetch all users
    fetch('/api/getAllUsers')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const usersTable = document.getElementById('usersTable').getElementsByTagName('tbody')[0];

                // Create a table row for each user
                data.data.forEach(user => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.isVerified ? 'Verified' : 'Not Verified'}</td>
                    `;

                    usersTable.appendChild(row);
                });
            } else {
                console.error('Failed to fetch users');
            }
        });
</script>