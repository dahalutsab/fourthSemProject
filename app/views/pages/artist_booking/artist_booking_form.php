
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details Form</title>
    <style>
        body {
            background-color: var(--background-color);
        }
        h2{
            color: var(--text-color);
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: var(--card-color);
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .btn-color {
            background-color: var(--button-color);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-color:hover {
            background-color: var(--button-color-hover);
            color: #fff;
        }


        .form-row {
            display: flex;
            gap: 10px;
        }
        .form-row .col {
            flex: 1;
        }

        .form-control {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus {
            outline: 0;

            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-select {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            background-image: none;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        .form-select:focus {
            outline: 0;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .form-select::ms-expand {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Event Details</h2>
    <form id="eventForm">
        <div class="form-row mb-3">
            <div class="col">
                <label for="province" class="form-label"><p>Province</p></label>
                <select class="form-select" id="province" name="province" required>
                    <option value="" disabled selected>Select your province</option>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
            <div class="col">
                <label for="district" class="form-label"><p>District</p></label>
                <select class="form-select" id="district" name="district" required>
                    <option value="" disabled selected>Select your district</option>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
            <div class="col">
                <label for="municipality" class="form-label"><p>Municipality</p></label>
                <select class="form-select" id="municipality" name="municipality" required>
                    <option value="" disabled selected>Select your municipality</option>
                    <!-- Options will be populated dynamically -->
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="localArea" class="form-label"><p>Tole/Local Area</p></label>
            <input type="text" class="form-control" id="localArea" name="localArea" required>
        </div>

        <div class="form-row">
            <div class="col mb-3">
                <label for="eventDate" class="form-label"><p>Event Date</p></label>
                <input type="date" class="form-control" id="eventDate" name="eventDate" required>
            </div>
            <div class="col mb-3">
                <label for="eventStartTime" class="form-label"><p>Event Start Time</p></label>
                <input type="time" class="form-control" id="eventStartTime" name="eventStartTime" required>
            </div>
            <div class="col mb-3">
                <label for="eventEndTime" class="form-label"><p>Event End Time</p></label>
                <input type="time" class="form-control" id="eventEndTime" name="eventEndTime" required>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-color">Calculate Cost</button>
        </div>
    </form>
</div>
<script src="<?= BASE_JS_PATH?>artist_booking_form.js"></script>

</body>
</html>