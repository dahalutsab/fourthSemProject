<table class="table" data-artist-id="<?php echo $_SESSION[SESSION_USER_ID] ?>">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Performance Type</th>
        <th scope="col">Cost Per Hour</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const artistId = document.querySelector('.table').dataset.artistId;

        function fetchPerformanceTypes() {
            fetch(`/api/artistPerformance/get-artist-performance/${artistId}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.success) {
                        let table = document.querySelector('.table tbody');
                        table.innerHTML = ''; // Clear existing rows
                        data.data.forEach((performanceType, index) => {
                            let row = document.createElement('tr');
                            row.innerHTML = `
                            <th scope="row">${index + 1}</th>
                            <td>${performanceType.performance_type}</td>
                            <td>${performanceType.cost_per_hour}</td>
                            <td>${performanceType.is_deleted ? 'Deleted' : 'Active'}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-edit" data-id="${performanceType.performance_type_id}" data-performance-type="${performanceType.performance_type}" data-cost-per-hour="${performanceType.cost_per_hour}">Edit</button>
                                <button type="button" class="btn btn-danger btn-delete" data-id="${performanceType.performance_type_id}">Delete</button>
                            </td>
                        `;
                            table.appendChild(row);
                        });

                        document.querySelectorAll('.btn-edit').forEach(button => {
                            button.addEventListener('click', openEditModal);
                        });

                        document.querySelectorAll('.btn-delete').forEach(button => {
                            button.addEventListener('click', deletePerformanceType);
                        });
                    } else {
                        console.error('Unexpected response format:', data);
                    }
                })
                .catch(error => {
                    console.error('Error fetching performance types:', error);
                });
        }

        function openEditModal(event) {
            const button = event.currentTarget;
            const performanceTypeId = button.dataset.id;
            const performanceType = button.dataset.performanceType;
            const costPerHour = button.dataset.costPerHour;

            const modal = new bootstrap.Modal(document.getElementById('editPerformanceModal'), {
                keyboard: false
            });

            document.getElementById('edit_performance_type_id').value = performanceTypeId;
            document.getElementById('edit_performance_type').value = performanceType;
            document.getElementById('edit_cost_per_hour').value = costPerHour;

            modal.show();
        }

        function deletePerformanceType(event) {
            const button = event.currentTarget;
            const performanceTypeId = button.dataset.id;

            fetch(`/api/artistPerformance/delete-artist-performance/${performanceTypeId}`, {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data && data.success) {
                        toastr.success('Performance type deleted successfully');
                        fetchPerformanceTypes();
                    } else {
                        toastr.error(data.message || 'Failed to delete performance type');
                        console.error('Unexpected response format:', data);
                    }
                })
                .catch(error => {
                    console.error('Error deleting performance type:', error);
                    toastr.error('Error deleting performance type');
                });
        }

        document.getElementById('editPerformanceForm').addEventListener('submit', function (event) {
            event.preventDefault();

            const performanceTypeId = document.getElementById('edit_performance_type_id').value;
            const performanceType = document.getElementById('edit_performance_type').value;
            const costPerHour = document.getElementById('edit_cost_per_hour').value;
            const artistId = document.querySelector('.table').dataset.artistId;

            fetch(`/api/artistPerformance/update-artist-performance/${performanceTypeId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    performance_type: performanceType,
                    cost_per_hour: costPerHour,
                    artist_id: artistId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data && data.success) {
                        toastr.success('Performance type updated successfully');
                        fetchPerformanceTypes();
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editPerformanceModal'));
                        modal.hide();
                    } else {
                        toastr.error(data.message || 'Failed to update performance type');
                        console.error('Unexpected response format:', data);
                    }
                })
                .catch(error => {
                    console.error('Error updating performance type:', error);
                    toastr.error('Error updating performance type');
                });
        });

        fetchPerformanceTypes();
    });
</script>

<!-- Edit Performance Modal -->
<div class="modal fade" id="editPerformanceModal" tabindex="-1" aria-labelledby="editPerformanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPerformanceForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPerformanceModalLabel">Edit Performance Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_performance_type_id">
                    <div class="form-group">
                        <label for="edit_performance_type">Performance Type</label>
                        <input type="text" class="form-control" id="edit_performance_type" name="performance_type" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_cost_per_hour">Cost Per Hour (in Rupees)</label>
                        <input type="number" class="form-control" id="edit_cost_per_hour" name="cost_per_hour" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
