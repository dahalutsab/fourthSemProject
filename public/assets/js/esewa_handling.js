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
                const success_url = 'http://localhost/dashboard/payment/success';
                const failure_url = 'http://localhost/dashboard/payment/failure';
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

document.getElementById('khalti_select').addEventListener('click', function() {
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
                const booking = data.data;
                const amount = parseFloat(booking.advance_amount) * 100;

                const config = {
                    "publicKey": "test_public_key_2bfcf7b3b7b94b5b8b3f3b3b7b7b7b7b",
                    "productIdentity": bookingId,
                    "productName": "Booking Payment",
                    "productUrl": window.location.href,
                    "eventHandler": {
                        onSuccess(payload) {
                            console.log(payload);

                            fetch('/api/booking/khalti-payment', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    transaction_id: payload.idx,
                                    amount: payload.amount,
                                    product_identity: payload.product_identity,
                                    product_name: payload.product_name,
                                    token: payload.token
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('Payment successful!');
                                        window.location.href = '/dashboard/payment/success';
                                    } else {
                                        alert('Payment verification failed. Please try again.');
                                    }
                                })
                                .catch(error => console.error('Error verifying payment:', error));
                        },
                        onError(error) {
                            console.error(error);
                        },
                        onClose() {
                            console.log('Widget is closing');
                        }
                    }
                };

                const checkout = new KhaltiCheckout(config);
                checkout.show({ amount: amount });
            } else {
                console.error('Failed to fetch booking:', data.message);
            }
        })
        .catch(error => console.error('Error fetching booking:', error));
});

function generateUniqueTransactionUuid() {
    return 'openmichub' + Math.random().toString(36).substr(2, 9).toUpperCase();
}