<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook Style Comment Section with Curved Lines</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        .comment {
            margin-bottom: 20px;
            position: relative;
        }
        .comment .comment-body {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            position: relative;
        }
        .comment .comment-children {
            padding-left: 30px;
        }
        .comment .comment-line-wrapper {
            position: relative;
        }
        .comment .comment-line {
            position: absolute;
            width: 2px;
            background-color: #ccc;
            z-index: -1;
        }
        .comment .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ccc;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <!-- Main comment section -->
    <div id="comments">
        <!-- Example parent comment -->
        <div class="comment">
            <div class="comment-line-wrapper">
                <svg class="comment-line" height="100%" width="100">
                    <path d="M 20,0 Q 20,25 40,25" fill="transparent" stroke="#ccc"/>
                    <path d="M 40,25 Q 60,25 60,50" fill="transparent" stroke="#ccc"/>
                </svg>
            </div>
            <div class="comment-body">
                <div class="comment-avatar"></div>
                <p><strong>User 1:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <!-- Reply form -->
                <form class="reply-form d-none">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Write a reply...">
                    </div>
                    <button type="submit" class="btn btn-primary">Reply</button>
                </form>
            </div>
            <!-- Nested comments -->
            <div class="comment-children">
                <!-- Example child comment -->
                <div class="comment">
                    <div class="comment-line-wrapper">
                        <svg class="comment-line" height="100%" width="100">
                            <path d="M 20,0 Q 20,25 40,25" fill="transparent" stroke="#ccc"/>
                            <path d="M 40,25 Q 60,25 60,50" fill="transparent" stroke="#ccc"/>
                        </svg>
                    </div>
                    <div class="comment-body">
                        <div class="comment-avatar"></div>
                        <p><strong>User 2:</strong> Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <!-- Reply form for child comment -->
                        <form class="reply-form d-none">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Write a reply...">
                            </div>
                            <button type="submit" class="btn btn-primary">Reply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Another parent comment -->
        <div class="comment">
            <div class="comment-line-wrapper">
                <svg class="comment-line" height="100%" width="100">
                    <path d="M 20,0 Q 20,25 40,25" fill="transparent" stroke="#ccc"/>
                    <path d="M 40,25 Q 60,25 60,50" fill="transparent" stroke="#ccc"/>
                </svg>
            </div>
            <div class="comment-body">
                <div class="comment-avatar"></div>
                <p><strong>User 3:</strong> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <!-- Reply form -->
                <form class="reply-form d-none">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Write a reply...">
                    </div>
                    <button type="submit" class="btn btn-primary">Reply</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Form to add new comment -->
    <form id="new-comment-form" class="mt-5">
        <div class="form-group">
            <label for="comment-text">Write a new comment:</label>
            <textarea class="form-control" id="comment-text" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post Comment</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle reply form visibility
        $('.comment').on('click', '.reply-toggle', function(e) {
            e.preventDefault();
            $(this).closest('.comment').find('.reply-form').toggle();
        });

        // Handle form submission for new comment
        $('#new-comment-form').submit(function(e) {
            e.preventDefault();
            var commentText = $('#comment-text').val();
            if (commentText.trim() !== '') {
                var newComment = `
            <div class="comment">
              <div class="comment-line-wrapper">
                <svg class="comment-line" height="100%" width="100">
                  <path d="M 20,0 Q 20,25 40,25" fill="transparent" stroke="#ccc"/>
                  <path d="M 40,25 Q 60,25 60,50" fill="transparent" stroke="#ccc"/>
                </svg>
              </div>
              <div class="comment-body">
                <div class="comment-avatar"></div>
                <p><strong>New User:</strong> ${commentText}</p>
                <form class="reply-form d-none">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Write a reply...">
                  </div>
                  <button type="submit" class="btn btn-primary">Reply</button>
                </form>
              </div>
            </div>
          `;
                $('#comments').append(newComment);
                $('#comment-text').val('');
            }
        });
    });
</script>
</body>
</html>
