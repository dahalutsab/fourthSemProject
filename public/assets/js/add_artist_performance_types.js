document.addEventListener("DOMContentLoaded", () => {
    const addPerformanceTypeForm = document.getElementById('add-artist-performance');
    addPerformanceTypeForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        const formData = new FormData(this);
        formData.append('artist_id', this.dataset.artistId); // Append the artist ID to the form data

        fetch('/api/artistPerformance/save-artist-performance', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to add performance type');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    toastr.success('Performance type added successfully');
                    this.reset(); // Optionally reset the form
                } else {
                    toastr.error(data.message || 'Failed to add performance type');
                    console.error('Unexpected response format:', data);
                }
            })
            .catch(error => {
                console.error('Error adding performance type:', error);
                toastr.error('Error adding performance type');
            });
    });
});
