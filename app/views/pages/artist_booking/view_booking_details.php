<style>
        .booking-details {
            margin: 20px auto;
            max-width: 800px;
        }
        .booking-card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: var(--button-color);
            color: var(--text-color);
        }
</style>
<div class="container booking-details">
    <div class="card booking-card">
        <div class="card-header">
            Booking Details
        </div>
        <div class="card-body">
            <p class="card-text">Artist Name: <span id="artist-name"></span></p>
            <p class="card-text">Artist Email: <span id="artist-email"></span></p>
            <p class="card-text">User Name: <span id="user-name"></span></p>
            <p class="card-text">User Email: <span id="user-email"></span></p>
            <p class="card-text">Booking Date: <span id="booking-date"></span></p>
            <p class="card-text">Event Start Time: <span id="start-time"></span></p>
            <p class="card-text">Event End Time: <span id="end-time"></span></p>
            <div class="card">
                <div class="card-header">
                    Location
                </div>
                <div class="card-body">
                    <p class="card-text">Province: <span id="province"></span></p>
                    <p class="card-text">District: <span id="district"></span></p>
                    <p class="card-text">Municipality: <span id="municipality"></span></p>
                    <p class="card-text">Local Area: <span id="location"></span></p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Payment Details
                </div>
                <div class="card-body">
                    <p class="card-text">Total Cost: <span id="total-cost"></span></p>
                    <p class="card-text">Advance Amount: <span id="advance-amount"></span></p>
                    <p class="card-text">Remaining Amount: <span id="remaining-amount"></span></p>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary" onclick="window.history.back()">Back</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingId = new URLSearchParams(window.location.search).get('bookingId');
        if (!bookingId) {
            toastr.error('Booking ID not found');
            return;
        }
        fetchBookingDetails(bookingId);
    });

    function populateBookingDetails(bookingDetails) {
        document.getElementById('artist-name').textContent = bookingDetails.artist;
        document.getElementById('artist-email').textContent = bookingDetails.artist_email;
        document.getElementById('user-name').textContent = bookingDetails.user;
        document.getElementById('user-email').textContent = bookingDetails.user_email;
        document.getElementById('booking-date').textContent = bookingDetails.event_date;
        document.getElementById('start-time').textContent = bookingDetails.event_start_time;
        document.getElementById('end-time').textContent = bookingDetails.event_end_time;
        document.getElementById('province').textContent = bookingDetails.province_name;
        document.getElementById('district').textContent = bookingDetails.district_name;
        document.getElementById('municipality').textContent = bookingDetails.municipality_name;
        document.getElementById('location').textContent = bookingDetails.local_area;
        document.getElementById('total-cost').textContent = bookingDetails.total_cost;
        document.getElementById('advance-amount').textContent = bookingDetails.advance_amount;
        document.getElementById('remaining-amount').textContent = bookingDetails.remaining_amount;
    }

    function fetchBookingDetails(bookingId) {
        fetch(`/api/booking-details?id=${bookingId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    populateBookingDetails(data.data);
                } else {
                    toastr.error(data.message);
                }
            })
            .catch(error => {
                toastr.error('An error occurred while fetching booking details');
                console.error(error);
            });
    }
</script>
