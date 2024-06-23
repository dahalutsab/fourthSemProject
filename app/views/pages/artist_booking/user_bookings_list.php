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
    document.addEventListener('DOMContentLoaded', function() {
        function getUserBookings() {
            fetch('/api/booking/get-user-bookings')
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
                                    ${booking.payment_status !== 'success' && booking.status !== 'cancelled' ? '<button class="btn btn-primary go-to-payment">Go to Payment</button>' : '<button class="btn btn-primary view-bookings">View</button>'}
                                    ${booking.status === 'cancelled' ? '' : '<button class="btn btn-danger" id="cancel-booking">Cancel</button>'  }
                                </td>
                            </tr>
                        `;
                        });
                        document.getElementById('user-bookings-list').innerHTML = bookingsList;
                    } else {
                        toastr.error(response.message);
                    }
                })
                .catch(() => {
                    alert('Error fetching user bookings');
                });
        }

        getUserBookings();

        document.getElementById('user-bookings-list').addEventListener('click', function(event) {
            let target = event.target;
            let bookingId = target.closest('tr').querySelector('td:first-child').textContent;

            if (target.classList.contains('go-to-payment')) {
                window.location.href = `/dashboard/payment/${bookingId}`;
            } else if (target.id === 'cancel-booking') {
                fetch('/api/booking/cancel-booking', {
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
                            getUserBookings(); // Refresh the bookings list
                        } else {
                            toastr.error(response.error);
                        }
                    })
                    .catch(() => {
                        alert('Error cancelling booking');
                    });
            } else if (target.classList.contains('view-bookings')) {
                window.location.href = `/dashboard/booking/view?bookingId=${bookingId}`;
            }
        });
    });</script>