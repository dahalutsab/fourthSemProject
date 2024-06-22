
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
                            <td>${booking.advance_amount}</td>
                            <td>${booking.payment_status}</td>
                            <td>
                                ${booking.payment_status !== 'success' && booking.status !== 'cancelled' ? '<button class="btn btn-primary go-to-payment">Go to Payment</button>' : '<button class="btn btn-primary view-bookings">View</button>'}
                                ${booking.status === 'cancelled' ? '' : '<button class="btn btn-danger" id="cancel-booking">Cancel</button>'  }
                            </td>
                        </tr>
                    `;
                });
                $('#user-bookings-list').html(bookingsList);
            } else {
                toastr.error(response.message);
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

    $('#user-bookings-list').on('click', '#cancel-booking', function() {
        let bookingId = $(this).closest('tr').find('td:first').text();
        $.ajax({
            url: '/api/booking/cancel-booking?booking_id=' + bookingId,
            type: 'POST',
            data: {
                booking_id: bookingId
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function() {
                toastr.error('Error cancelling booking');
            }
        });
    });

    $('#user-bookings-list').on('click', '.view-bookings', function() {
        let bookingId = $(this).closest('tr').find('td:first').text();
        window.location.href = `/dashboard/booking/view?bookingId=${bookingId}`;
    });
});
</script>