
<h2>Payment Received</h2>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>S.N</th>
                <th>User</th>
                <th>Payment Date </th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Transaction Via</th>
            </tr>
        </thead>
        <tbody id="artist-payment-list">
            <!-- payments will be displayed here -->
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/booking/get-artist-payments')
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    let payments = response.data;
                    let paymentsList = '';
                    payments.forEach((payment, index) => {
                        paymentsList += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${payment.user}</td>
                            <td>${payment.payment_date}</td>
                            <td>${payment.amount}</td>
                            <td>${payment.status}</td>
                            <td>${payment.payment_method}</td>
                        </tr>
                    `;
                    });
                    document.getElementById('artist-payment-list').innerHTML = paymentsList;
                } else {
                    toastr.error(response.error);
                }
            })
            .catch(() => {
                alert('Error fetching artist payments');
            });
    });</script>