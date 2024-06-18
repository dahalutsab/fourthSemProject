<h1>
    Users List
</h1>

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
    $(document).ready(function() {
        $.ajax({
            url: '/api/getAllUsers',
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    var users = response.data;
                    var tbody = $('table tbody');
                    tbody.empty();
                    users.forEach(function(user, index) {
                        var tr = $('<tr></tr>');
                        tr.append('<td>' + (index + 1) + '</td>');
                        tr.append('<td>' + user.username + '</td>');
                        tr.append('<td>' + user.email + '</td>');
                        tr.append('<td>' + (user.isVerified ? 'Yes' : 'No') + '</td>');
                        tr.append('<td>' + (user.isBlocked ? 'Yes' : 'No') + '</td>');
                        tr.append('<td>' +
                            '<button class="btn-success view-user"> View </button> ' +
                            '<button class="btn-danger delete-user"> Block </button>' +
                            '</td>');
                        tbody.append(tr);
                    });
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Failed to fetch users.');
            }

        });
    });
</script>