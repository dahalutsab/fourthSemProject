<h2>Payment History</h2>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>S.N</th>
            <th>Artist</th>
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
    $(document).ready(function() {
        $.ajax({
            url: '/api/booking/get-user-payments',
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    let payments = response.data;
                    let paymentsList = '';
                    payments.forEach((payment, index) => {
                        paymentsList += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${payment.artist}</td>
                                <td>${payment.payment_date}</td>
                                <td>${payment.amount}</td>
                                <td>${payment.status}</td>
                                <td>${payment.payment_method}</td>
                            </tr>
                        `;
                    });
                    $('#artist-payment-list').html(paymentsList);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Error fetching artist payments');
            }
        });
    });
</script>