<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body { background-color: #f9f9f9; }
        .comment-box, .reply-box { display: flex; align-items: flex-start; margin-bottom: 20px; }
        .comment-box img, .reply-box img { width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; }
        .comment-box .comment-content, .reply-box .comment-content { background-color: white; padding: 10px; border-radius: 8px; width: 100%; }
        .reply-box { margin-left: 50px; }
        .reply-input { margin-left: 50px; }
        .upvote { cursor: pointer; color: #007bff; font-size: 0.9em; }
        .upvote:hover { text-decoration: underline; }
        .rating { color: gold; margin-right: 5px; }
        .view-replies-button { background: none; border: none; color: #007bff; cursor: pointer; padding: 0; }
        .view-replies-button:hover { text-decoration: underline; }
        @media (max-width: 576px) { .reply-box { margin-left: 30px; } .reply-input { margin-left: 30px; } }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Artist Profile</h3>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Artist Name</h5>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rate the artist:</label>
                        <div id="rating" class="form-control w-auto">
                            <span class="star" data-value="1">★</span>
                            <span class="star" data-value="2">★</span>
                            <span class="star" data-value="3">★</span>
                            <span class="star" data-value="4">★</span>
                            <span class="star" data-value="5">★</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Write a comment:</label>
                        <textarea id="comment" class="form-control" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary" id="postComment">Post Comment</button>
                </div>
            </div>
            <div id="commentsSection">
                <!-- Comments will be dynamically added here -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let selectedRating = 0;
        $('#rating .star').on('click', function() {
            selectedRating = $(this).data('value');
            $('#rating .star').each(function() {
                $(this).text($(this).data('value') <= selectedRating ? '★' : '☆');
            });
        });

        const comments = []; // This will be fetched from the server

        function renderComments(comments, container) {
            container.empty();
            comments.forEach((comment, index) => {
                const commentHtml = `
                    <div class="comment-box">
                        <img src="${comment.userImage}" alt="User Image">
                        <div class="comment-content">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>${comment.username}</strong>
                                    ${comment.rating ? `<span class="rating">${'★'.repeat(comment.rating)}${'☆'.repeat(5 - comment.rating)}</span>` : ''}
                                </div>
                                <div>
                                    <span class="upvote" data-index="${index}">Upvote (${comment.upvotes})</span>
                                </div>
                            </div>
                            <p>${comment.text}</p>
                            <button class="btn btn-sm btn-link reply-button" data-index="${index}">Reply</button>
                            ${comment.replies.length > 0 ? `<button class="view-replies-button" data-index="${index}">View Replies (${comment.replies.length})</button>` : ''}
                            <div class="reply-section" style="display: none;"></div>
                            <div class="reply-input mt-2" style="display: none;">
                                <textarea class="form-control reply-text" rows="2"></textarea>
                                <button class="btn btn-sm btn-primary mt-2 post-reply-button" data-index="${index}">Post Reply</button>
                            </div>
                        </div>
                    </div>
                `;
                const commentElement = $(commentHtml);
                container.append(commentElement);
                renderComments(comment.replies, commentElement.find('.reply-section'));
            });
        }

        $('#postComment').on('click', function() {
            const text = $('#comment').val();
            const newComment = {
                userId: comments.length + 1,
                username: `User${comments.length + 1}`,
                userImage: "https://via.placeholder.com/40",
                rating: selectedRating,
                text: text,
                upvotes: 0,
                replies: []
            };
            comments.push(newComment);
            renderComments(comments, $('#commentsSection'));
            $('#comment').val('');
            selectedRating = 0;
            $('#rating .star').each(function() {
                $(this).text('☆');
            });
        });

        $(document).on('click', '.reply-button', function() {
            const index = $(this).data('index');
            $(this).siblings('.reply-input').toggle();
        });

        $(document).on('click', '.post-reply-button', function() {
            const index = $(this).data('index');
            const replyText = $(this).siblings('.reply-text').val();
            const newReply = {
                userId: comments[index].replies.length + 1,
                username: `User${comments[index].replies.length + 1}`,
                userImage: "https://via.placeholder.com/40",
                text: replyText,
                upvotes: 0,
                replies: []
            };
            function addReply(comments, index) {
                if (index.length === 1) {
                    comments[index[0]].replies.push(newReply);
                } else {
                    addReply(comments[index[0]].replies, index.slice(1));
                }
            }
            addReply(comments, index.toString().split('-').map(Number));
            renderComments(comments, $('#commentsSection'));
        });

        $(document).on('click', '.upvote', function() {
            const index = $(this).data('index').toString().split('-').map(Number);
            function incrementUpvote(comments, index) {
                if (index.length === 1) {
                    comments[index[0]].upvotes += 1;
                } else {
                    incrementUpvote(comments[index[0]].replies, index.slice(1));
                }
            }
            incrementUpvote(comments, index);
            renderComments(comments, $('#commentsSection'));
        });

        $(document).on('click', '.view-replies-button', function() {
            const index = $(this).data('index');
            const replySection = $(this).siblings('.reply-section');
            replySection.toggle();
            if (replySection.is(':visible')) {
                $(this).text('Hide Replies');
            } else {
                $(this).text(`View Replies (${comments[index].replies.length})`);
            }
        });

        renderComments(comments, $('#commentsSection'));
    });
</script>
</body>
</html>
