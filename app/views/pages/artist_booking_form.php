<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evSXbVzTVFTJwvtQveJhxSyphtzWL+TlLwYmiwTRqocQocAdIGNWhzntsHqbsIknN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-3">
    <h2>Booking Form</h2>
    <form>
        <div class="mb-3">
            <label for="province" class="form-label">Province:</label>
            <select class="form-select" id="province" required>
                <option value="">Select Province</option>
                <option value="province1">Province 1</option>
                <option value="province2">Province 2</option>
                <option value="province3">Province 3</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="district" class="form-label">District:</label>
            <select class="form-select" id="district" required>
                <option value="">Select District</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="municipality" class="form-label">Municipality:</label>
            <select class="form-select" id="municipality" required>
                <option value="">Select Municipality</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Specific Location (Required):</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="booking-datetime" class="form-label">Booking Date and Time:</label>
            <input type="datetime-local" class="form-control" id="booking-datetime" name="booking_datetime" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Booking</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-OgwbZS7IlznvJKcufgvUebr/VxLN/sYGz1LFnTKY4z4XCdP+CBXTGlFNIRUO5yNp" crossorigin="anonymous"></script>
</body>
</html>
