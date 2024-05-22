<form method="post" id="add-artist-performance" data-artist-id="<?php echo $_SESSION[SESSION_USER_ID] ?>">
    <div class="form-group">
        <label for="performance_type_name">Performance Type Name</label>
        <input type="text" class="form-control" id="performance_type_name" name="performance_type" required>
    </div>
    <div class="form-group">
        <label for="cost_per_hour">Cost Per Hour (in Rupees)</label>
        <input type="number" class="form-control" id="cost_per_hour" name="cost_per_hour" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script src="<?=BASE_JS_PATH?>add_artist_performance_types.js"></script>
