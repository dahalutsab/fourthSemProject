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
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <form method="post" action="#" id="form1">
                <div class="form-group files">
                    <label>Upload Your File</label>
                    <input type="file" class="form-control" multiple id="fileInput">
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
    $(document).ready(function() {
        $('#fileInput').on('change', function() {
            const files = this.files;
            const fileDisplay = $('#fileDisplay');
            const submitButton = $('#submitButton');
            const selectedFileLabel = $('.selected-file');

            fileDisplay.empty(); // Clear the previous file list

            if (files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const fileReader = new FileReader();

                    fileReader.onload = function(e) {
                        const fileUrl = e.target.result;
                        let fileElement;

                        if (file.type.startsWith('image/')) {
                            fileElement = $('<img>').attr('src', fileUrl).addClass('img-thumbnail');
                        } else if (file.type.startsWith('video/')) {
                            fileElement = $('<video controls>').attr('src', fileUrl);
                        } else if (file.type.startsWith('audio/')) {
                            fileElement = $('<audio controls>').attr('src', fileUrl);
                        } else {
                            fileElement = $('<p>').text('Unsupported file type');
                        }

                        fileDisplay.append(fileElement);
                    };

                    fileReader.readAsDataURL(file);
                }
                selectedFileLabel.text(`Selected File`);
                submitButton.show();

            } else {
                fileDisplay.text('No files selected');
                // Hide the submit button if no files are selected
                submitButton.hide();
            }
        });
    });
</script>

</body>

