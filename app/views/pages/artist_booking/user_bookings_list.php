
<h2>My Bookings</h2>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Performance Type</th>
                <th>Booking Date</th>
                <th>Booking Status</th>
                <th>25% Amount</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="user-bookings-list">
            <!-- bookings will be displayed here -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
    $.ajax({
        url: '/api/booking/get-user-bookings',
        type: 'GET',
        success: function(response) {
            if (response.success) {
                let bookings = response.data;
                let bookingsList = '';
                bookings.forEach(booking => {
                    bookingsList += `
                        <tr>
                            <td>${booking.booking_id}</td>
                            <td>${booking.performance_type}</td>
                            <td>${booking.event_date}</td>
                            <td>${booking.status}</td>
                            <td>${booking.total_cost}</td>
                            <td>${booking.payment_status}</td>
                            <td>
                                ${booking.payment_status != 'success' ? '<button class="btn btn-primary go-to-payment">Go to Payment</button>' : '<button class="btn btn-primary">View</button>'}
                                <button class="btn btn-danger">Cancel</button>
                            </td>
                        </tr>
                    `;
                });
                $('#user-bookings-list').html(bookingsList);
            } else {
                alert(response.message);
            }
        },
        error: function() {
            toastr.error('Error fetching user bookings');
        }
    });

    $('#user-bookings-list').on('click', '.go-to-payment', function() {
        let bookingId = $(this).closest('tr').find('td:first').text();
        window.location.href = `/dashboard/payment/${bookingId}`;
    });
});
</script>