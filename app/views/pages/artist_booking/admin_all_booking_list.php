<h2>Bookings</h2>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Booking ID</th>
            <th>Artist</th>
            <th>User</th>
            <th>Performance Type</th>
            <th>Booking Date</th>
            <th>Booking Status</th>
            <th>Advance Amount</th>
            <th>Payment Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="admin_booking_list">
        <!-- bookings will be displayed here -->
        </tbody>
    </table>
</div>

<script>
    function getAllBookings() {
        fetch('/api/booking/get-all-bookings')
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    let bookings = response.data;
                    let bookingsList = '';
                    bookings.forEach(booking => {
                        bookingsList += `
                    <tr>
                        <td>${booking.booking_id}</td>
                        <td>${booking.artist_name}</td>
                        <td>${booking.user_name}</td>
                        <td>${booking.performance_type}</td>
                        <td>${booking.event_date}</td>
                        <td>${booking.status}</td>
                        <td>${booking.advance_amount}</td>
                        <td>${booking.payment_status}</td>
                        <td>
                            <button class="btn btn-primary view-bookings" onclick="window.location.href = '/dashboard/booking/view?bookingId=${booking.booking_id}';">View</button>
                        </td>
                    </tr>
                `;
                    });
                    document.getElementById('admin_booking_list').innerHTML = bookingsList;
                } else {
                    alert(response.message);
                }
            })
            .catch(() => {
                alert('Error fetching artist bookings');
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        getAllBookings();
    });
</script>
