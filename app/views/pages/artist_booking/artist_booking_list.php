

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
        fetch('/api/booking/get-artist-bookings')
            .then(response => response.json())
            .then(response => {
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
                    document.getElementById('artist-bookings-list').innerHTML = bookingsList;
                } else {
                    alert(response.message);
                }
            })
            .catch(() => {
                alert('Error fetching artist bookings');
            });
    }

    function rejectBooking(bookingId) {
        fetch('/api/booking/reject-booking', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                booking_id: bookingId
            })
        })
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    toastr.success(response.message);
                    getArtistBookings();
                } else {
                    toastr.error(response.error);
                }
            })
            .catch(() => {
                toastr.error('Error rejecting booking');
            });
    }

    function acceptBooking(bookingId) {
        fetch('/api/booking/accept-booking', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                booking_id: bookingId
            })
        })
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    toastr.success(response.message);
                    getArtistBookings();
                } else {
                    alert(response.error);
                }
            })
            .catch(() => {
                toastr.error("Something went wrong. Please try again later.")
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        getArtistBookings();

        document.getElementById('artist-bookings-list').addEventListener('click', function(event) {
            let target = event.target;
            let bookingId = target.closest('tr').querySelector('td:first-child').textContent;

            if (target.classList.contains('view-bookings')) {
                window.location.href = `/dashboard/booking/view?bookingId=${bookingId}`;
            } else if (target.classList.contains('reject-booking')) {
                rejectBooking(bookingId);
            } else if (target.classList.contains('accept-booking')) {
                acceptBooking(bookingId);
            }
        });
    });
</script>
