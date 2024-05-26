<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        .payment-logo {
            cursor: pointer;
            height: 200px;
            object-fit: cover; /* This will ensure the aspect ratio of the images is maintained */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Payment Page</h1>
            <p>This is the payment page.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="<?=BASE_IMAGE_PATH?>Khalti-Logo.png" title="khalti" class="payment-logo" id="khalti_select" alt="Khalti Logo">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <img src="<?=BASE_IMAGE_PATH?>Esewa_logo.webp" title="esewa" class="payment-logo" id="esewa_select" alt="Esewa Logo">
            </div>
        </div>
    </div>
</div>


<!-- Payment Handling Script -->
<script>
    document.getElementById('esewa_select').addEventListener('click', function() {
        // Get booking ID from URL
        const url = window.location.href;
        const bookingId = url.substring(url.lastIndexOf('/') + 1);

        fetch(`/api/booking/get-booking/${bookingId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Booking:', data.data);
                    const booking = data.data;
                    const amount = booking.advance_amount;
                    const tax_amount = 0;
                    let total_amount = parseFloat(amount) + tax_amount;
                    total_amount = total_amount.toFixed(0);
                    const transaction_uuid = generateUniqueTransactionUuid();
                    const product_code = 'EPAYTEST';
                    const product_service_charge = 0;
                    const product_delivery_charge = 0;
                    const success_url = 'http://openmichub.com/dashboard/payment/success';
                    const failure_url = 'http://openmichub.com/dashboard/payment/failure';
                    const signed_field_names = "total_amount,transaction_uuid,product_code";

                    fetch('/api/generate-signature', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            message: `total_amount=${total_amount},transaction_uuid=${transaction_uuid},product_code=${product_code}`
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const signature = data.data;
                                console.log('Signature:', signature);

                                // Create a form dynamically
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.action = 'https://rc-epay.esewa.com.np/api/epay/main/v2/form';

                                const fields = {
                                    tax_amount: tax_amount,
                                    total_amount: total_amount,
                                    amount: total_amount,
                                    transaction_uuid: transaction_uuid,
                                    product_code: product_code,
                                    product_service_charge: product_service_charge,
                                    product_delivery_charge: product_delivery_charge,
                                    success_url: success_url,
                                    failure_url: failure_url,
                                    signed_field_names: signed_field_names,
                                    signature: signature
                                };

                                // Loop through fields object and create hidden input fields
                                for (const [key, value] of Object.entries(fields)) {
                                    const input = document.createElement('input');
                                    input.type = 'hidden';
                                    input.name = key;
                                    input.value = value;
                                    form.appendChild(input);
                                }

                                // Append the form to the body and submit it
                                document.body.appendChild(form);
                                form.submit();
                            } else {
                                console.error('Failed to generate signature:', data.message);
                            }
                        })
                        .catch(error => console.error('Error generating signature:', error));
                } else {
                    console.error('Failed to fetch booking:', data.message);
                }
            })
            .catch(error => console.error('Error fetching booking:', error));
    });
    function generateUniqueTransactionUuid() {
        return 'openmichub' + Math.random().toString(36).substr(2, 9).toUpperCase();
    }

    document.getElementById('khalti_select').addEventListener('click', function() {
        const url = window.location.href;
        const bookingId = url.substring(url.lastIndexOf('/') + 1);
        const amount = 1000;

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/payment/khalti';

        const fields = {
            amount: amount,
            purchase_order_id: bookingId,
            purchase_order_name: 'Booking Payment',
        };

        for (const [key, value] of Object.entries(fields)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            form.appendChild(input);
        }

        document.body.appendChild(form);
        form.submit();
    });
</script>
</body>
</html>
