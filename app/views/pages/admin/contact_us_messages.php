<table class="table" id="contactUsTable">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Submitted At</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/api/contact-us-messages',
            method: 'GET',
            success: function(data) {
                populateTable(data.data);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });

    function populateTable(data) {
        const tableBody = $('#contactUsTable tbody');
        data.forEach(message => {
            const row = `
            <tr>
                <td>${message.id}</td>
                <td>${message.name}</td>
                <td>${message.email}</td>
                <td>${message.subject}</td>
                <td>${message.message}</td>
                <td>${message.submitted_at}</td>
            </tr>
        `;
            tableBody.append(row);
        });
    }
</script>