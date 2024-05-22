<!-- create the table with artist performance types -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Artist Performance Types and Cost</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPerformanceModal">
                Add Performance Type
            </button>
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>Performance Type</th>
                    <th>Cost Per Hour</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="performanceTypesTable">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- fetch the data from backend and display -->
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
                            <td>${performanceType.performance_type}</td>
                            <td>${performanceType.cost_per_hour}</td>
                            <td>
                                <button type="button" class="btn btn-primary" > Book</button>
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

        fetchPerformanceTypes();
    });