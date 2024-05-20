let form1 = document.getElementById('form1');
form1.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    const formData = new FormData(form1);

    fetch('/api/media/save-media', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            toastr.success(data.message);
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Error saving media');
        });
});