

<h2>Artist Bookings</h2>
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
        <tbody id="artist-bookings-list">
            <!-- bookings will be displayed here -->
        </tbody>
    </table>
</div>

<script>
    function getArtistBookings() {
        $.ajax({
            url: '/api/booking/get-artist-bookings',
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
                                <button class="btn btn-primary view-bookings">View</button>
                                ${booking.status === 'pending' ? '<button class="btn btn-danger reject-booking">Reject</button>' : ''}
                                ${booking.status === 'pending' ? '<button class="btn btn-primary accept-booking">Accept</button>' : ''}

                            </td>
                        </tr>
                    `;
                    });
                    $('#artist-bookings-list').html(bookingsList);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Error fetching artist bookings');
            }
        });
    }

    $(document).ready(function() {
    getArtistBookings();

    $('#artist-bookings-list').on('click', '.view-bookings', function() {
        let bookingId = $(this).closest('tr').find('td:first').text();
        window.location.href = `/dashboard/booking/view?bookingId=${bookingId}`;
    });

    $('#artist-bookings-list').on('click', '.reject-booking', function() {
        let bookingId = $(this).closest('tr').find('td:first').text();
        rejectBooking(bookingId);
    });

    $('#artist-bookings-list').on('click', '.accept-booking', function() {
        let bookingId = $(this).closest('tr').find('td:first').text();
        acceptBooking(bookingId);
    });

    function rejectBooking(bookingId) {
        $.ajax({
            url: '/api/booking/reject-booking',
            type: 'POST',
            data: {
                booking_id: bookingId
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    getArtistBookings();
                } else {
                    toastr.error(response.error);
                }
            },
            error: function() {
                toastr.error('Error rejecting booking');
            }
        });
    }

    function acceptBooking(bookingId) {
        $.ajax({
            url: '/api/booking/accept-booking',
            type: 'POST',
            data: {
                booking_id: bookingId
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    getArtistBookings();
                } else {
                    alert(response.error);
                }
            },
            error: function() {
                toastr.error("Something went wrong. Please try again later.")
            }
        });
    }

});
</script>
