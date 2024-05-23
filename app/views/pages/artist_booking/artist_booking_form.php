<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form method="post" id="eventForm">
        <div class="mb-3">
            <label for="province" class="form-label">Province</label>
            <select class="form-select" id="province" name="province" >
                <option value="" disabled selected>Select your province</option>
                <!-- Options will be populated dynamically -->
            </select>
        </div>

        <div class="mb-3">
            <label for="district" class="form-label">District</label>
            <select class="form-select" id="district" name="district" >
                <option value="" disabled selected>Select your district</option>
                <!-- Options will be populated dynamically -->
            </select>
        </div>

        <div class="mb-3">
            <label for="municipality" class="form-label">Municipality</label>
            <select class="form-select" id="municipality" name="municipality" >
                <option value="" disabled selected>Select your municipality</option>
                <!-- Options will be populated dynamically -->
            </select>
        </div>

        <div class="mb-3">
            <label for="localArea" class="form-label">Tole/Local Area</label>
            <input type="text" class="form-control" id="localArea" name="localArea" >
        </div>

        <div class="mb-3">
            <label for="eventDate" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="eventDate" name="eventDate" >
        </div>

        <div class="mb-3">
            <label for="eventStartTime" class="form-label">Event Start Time</label>
            <input type="time" class="form-control" id="eventStartTime" name="eventStartTime" required>
        </div>

        <div class="mb-3">
            <label for="eventEndTime" class="form-label">Event End Time</label>
            <input type="time" class="form-control" id="eventEndTime" name="eventEndTime" required>
        </div>

        <button type="submit" class="btn calculate-cost btn-primary">Calculate Cost</button>
    </form>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="costModal" tabindex="-1" aria-labelledby="costModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="costModalLabel">Cost Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Total Cost: NPR <span id="totalCost"></span></p>
                <p>Advance Amount: NPR <span id="advanceAmount"></span></p>
                <p>Remaining Amount: NPR <span id="remainingAmount"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="proceedToPayment">Proceed to Payment</button>
            </div>
        </div>
    </div>
</div>


<script src="<?= BASE_JS_PATH?>artist_booking_form.js"></script>
</body>
</html>
