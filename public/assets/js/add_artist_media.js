document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const fileDisplay = document.getElementById('fileDisplay');
    const submitButton = document.getElementById('submitButton');
    const form1 = document.getElementById('form1');
    const uploadProgressBar = document.getElementById('uploadProgressBar');

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
        document.getElementById('progressBar').style.display = 'block';
        const formData = new FormData(form1);
        const xhr = new XMLHttpRequest();

        xhr.open('POST', '/api/media/save-media', true);

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = Math.round((e.loaded / e.total) * 100);
                uploadProgressBar.style.width = percentComplete + '%';
                uploadProgressBar.textContent = percentComplete + '%';
                uploadProgressBar.setAttribute('aria-valuenow', percentComplete);
            }
        });

        xhr.addEventListener('load', function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                console.log('Success:', response);
                toastr.success(response.message.message);
                uploadProgressBar.style.width = '0%';
                uploadProgressBar.textContent = '0%';
                uploadProgressBar.setAttribute('aria-valuenow', 0);
            } else {
                console.error('Error:', xhr.statusText);
                toastr.error(xhr.statusText);
            }
        });

        xhr.addEventListener('error', function() {
            console.error('Error:', xhr.statusText);
            toastr.error(xhr.statusText);
        });

        xhr.send(formData);
    });
});
