<style>
    .payment-logo {
        cursor: pointer;
        height: 200px;
        object-fit: cover; /* This will ensure the aspect ratio of the images is maintained */
    }
</style>
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
                <img src="<?=BASE_IMAGE_PATH?>Khalti-Logo.png" title="khalti" class="payment-logo" id="khalti_select" alt="Khalto Logo" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <img src="<?=BASE_IMAGE_PATH?>Esewa_logo.webp" title="esewa" class="payment-logo" id="esewa_select" alt="Esewa Logo" >
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('khalti_select').addEventListener('click', function () {
    //     load khalti js

    });

</script>
<script src="<?=BASE_JS_PATH?>esewa_handling.js"></script>