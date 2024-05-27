<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Upload</title>
    <link href="<?= BASE_CSS_PATH ?>add_artist_media.css" rel="stylesheet">
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
                <div class="col-12 mt-3" id="progressBar">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" id="uploadProgressBar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                            0%
                        </div>
                    </div>
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

<script src="<?= BASE_JS_PATH ?>add_artist_media.js"></script>

</body>
</html>
