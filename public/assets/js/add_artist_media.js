document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const fileDisplay = document.getElementById('fileDisplay');
    const submitButton = document.getElementById('submitButton');
    const form1 = document.getElementById('form1');

    fileInput.addEventListener('change', function() {
        const files = fileInput.files;
        fileDisplay.innerHTML = ''; // Clear the previous file list

        if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileReader = new FileReader();

                fileReader.onload = function(e) {
                    const fileUrl = e.target.result;
                    let fileElement;

                    if (file.type.startsWith('image/')) {
                        fileElement = document.createElement('img');
                        fileElement.src = fileUrl;
                        fileElement.classList.add('img-thumbnail');
                    } else if (file.type.startsWith('video/')) {
                        fileElement = document.createElement('video');
                        fileElement.src = fileUrl;
                        fileElement.controls = true;
                    } else if (file.type.startsWith('audio/')) {
                        fileElement = document.createElement('audio');
                        fileElement.src = fileUrl;
                        fileElement.controls = true;
                    } else {
                        fileElement = document.createElement('p');
                        fileElement.textContent = 'Unsupported file type';
                    }

                    fileDisplay.appendChild(fileElement);
                };

                fileReader.readAsDataURL(file);
            }
            document.querySelector('.selected-file').textContent = 'Selected File';
            submitButton.style.display = 'block';
        } else {
            fileDisplay.textContent = 'No files selected';
            submitButton.style.display = 'none';
        }
    });

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
                toastr.success(data.message.message);
            })
            .catch((error) => {
                console.error('Error:', error);
                toastr.error(error.message);
            });
    });
});