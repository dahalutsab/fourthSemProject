<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Upload</title>
    <style>
        .files input {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 120px 0 85px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;
        }
        .files input:focus {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            border: 1px solid #92b0b3;
        }
        .files {
            position: relative;
        }
        .files:after {
            pointer-events: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 50px;
            right: 0;
            height: 56px;
            content: "";
            display: block;
            margin: 0 auto;
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .color input {
            background-color: #f1f1f1;
        }
        .files:before {
            position: absolute;
            bottom: 10px;
            left: 0;
            pointer-events: none;
            width: 100%;
            right: 0;
            height: 57px;
            content: "or drag it here.";
            display: block;
            margin: 0 auto;
            color: #2ea591;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
        .file-display {
            margin-top: 20px;
        }
        .file-display img,
        .file-display video,
        .file-display audio {
            max-width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <form method="post" id="form1">
                <div class="form-group">
                    <label> Title
                        <input type="text" class="form-control" name="title" required>
                    </label>
                </div>
                <div class="form-group">
                    <label> Description
                        <textarea class="form-control" name="description" required></textarea>
                    </label>
                </div>
                <div class="form-group files">
                    <label>Upload Your File</label>
                    <input type="file" class="form-control" name="media" multiple id="fileInput">
                </div>
                <button type="submit" class="btn btn-primary" id="submitButton" style="display: none;">Submit</button>
            </form>
        </div>
        <div class="col-12">
            <form id="form2">
                <div class="form-group color">
                    <label class="selected-file mt-2"></label>
                    <div class="file-display" id="fileDisplay"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
</script>

</body>
</html>
