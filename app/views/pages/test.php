<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <title>Artist Details</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .rating-stars {
            cursor: pointer;
            font-size: 1.5rem;
            color: #d3d3d3;
        }
        .rating-stars .active {
            color: gold;
        }
    </style>
</head>
<body class="p-3 m-0 border-0 bd-example">
<!-- Artist details section -->
<div class="container mt-5">
    <h2>Artist Details</h2>
    <p>Details about the artist go here...</p>
</div>

<!-- Rating and Review Section -->
<div class="container mt-5">
    <div class="card bg-light">
        <header class="card-header border-0 bg-transparent">
            <img src="https://via.placeholder.com/40x40" class="rounded-circle me-2" /><a class="fw-semibold text-decoration-none">JohnDoe</a>
        </header>
        <div class="card-body py-1">
            <form id="reviewForm">
                <div class="rating-stars mb-2">
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div>
                <div>
                    <label for="comment" class="visually-hidden">Comment</label>
                    <textarea class="form-control form-control-sm border border-2 rounded-1" id="comment" style="height: 50px" placeholder="Add a comment..." minlength="3" maxlength="255" required></textarea>
                </div>
            </form>
        </div>
        <footer class="card-footer bg-transparent border-0 text-end">
            <button class="btn btn-link btn-sm me-2 text-decoration-none" type="button" id="cancelButton">Cancel</button>
            <button type="submit" class="btn btn-primary btn-sm" id="submitReviewButton">Submit</button>
        </footer>
    </div>

    <!-- Comments Section -->
    <aside class="d-flex justify-content-between align-items-center my-4">
        <h4 class="h6">Comments</h4>
    </aside>

    <div id="reviewsSection">
        <!-- Reviews will be dynamically populated here -->
    </div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel">Reply to Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="replyComment" rows="3" placeholder="Type your reply..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitReplyButton">Submit Reply</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        let selectedRating = 0;
        let replyToCommentId = null;

        // Handle star rating click
        $('.star').on('click', function() {
            selectedRating = $(this).data('value');
            $('.star').removeClass('active');
            for (let i = 1; i <= selectedRating; i++) {
                $(`.star[data-value="${i}"]`).addClass('active');
            }
        });

        // Submit review
        $('#submitReviewButton').on('click', function() {
            const comment = $('#comment').val();
            if (selectedRating && comment) {
                // Replace with your AJAX call to submit the review
                // $.post('/submitReview.php', { rating: selectedRating, comment: comment }, function(response) {
                //     const res = JSON.parse(response);
                //     if (res.success) {
                //         alert('Review submitted successfully!');
                //         fetchReviews();
                //     } else {
                //         alert('Failed to submit review.');
                //     }
                // });
                alert(`Rating: ${selectedRating}\nComment: ${comment}`);
            } else {
                alert('Please select a rating and write a comment.');
            }
        });

        // Handle reply button click
        $(document).on('click', '.replyButton', function() {
            replyToCommentId = $(this).data('comment-id');
            $('#replyModal').modal('show');
        });

        // Submit reply
        $('#submitReplyButton').on('click', function() {
            const replyComment = $('#replyComment').val();
            if (replyComment) {
                // Replace with your AJAX call to submit the reply
                // $.post('/submitReply.php', { comment_id: replyToCommentId, reply: replyComment }, function(response) {
                //     const res = JSON.parse(response);
                //     if (res.success) {
                //         alert('Reply submitted successfully!');
                //         fetchReviews();
                //         $('#replyModal').modal('hide');
                //     } else {
                //         alert('Failed to submit reply.');
                //     }
                // });
                alert(`Reply to Comment ID: ${replyToCommentId}\nReply: ${replyComment}`);
                $('#replyModal').modal('hide');
            } else {
                alert('Please write a reply.');
            }
        });

        // Example of fetching reviews
        function fetchReviews() {
            // Replace with your AJAX call to fetch reviews
            const reviews = [
                { id: 1, username: 'JaneDoe', rating: 5, comment: 'Great artist!', created_at: '2 months ago' },
                { id: 2, username: 'JohnSmith', rating: 4, comment: 'Really enjoyed the performance.', created_at: '3 weeks ago' },
            ];

            let reviewsHtml = '';
            reviews.forEach(review => {
                reviewsHtml += `
                        <article class="card bg-light mb-3">
                            <header class="card-header border-0 bg-transparent d-flex align-items-center">
                                <div>
                                    <img src="https://via.placeholder.com/40x40" class="rounded-circle me-2" />
                                    <a class="fw-semibold text-decoration-none">${review.username}</a>
                                    <span class="ms-3 small text-muted">${review.created_at}</span>
                                </div>
                                <div class="dropdown ms-auto">
                                    <button class="btn btn-link text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Report</a></li>
                                    </ul>
                                </div>
                            </header>
                            <div class="card-body py-2 px-3">
                                ${review.comment}
                            </div>
                            <footer class="card-footer bg-white border-0 py-1 px-3">
                                <button type="button" class="btn btn-link btn-sm text-decoration-none ps-0 upvoteButton" data-review-id="${review.id}">
                                    <i class="bi bi-hand-thumbs-up me-1"></i>(3)
                                </button>
                                <button type="button" class="btn btn-link btn-sm text-decoration-none replyButton" data-comment-id="${review.id}">
                                    Reply
                                </button>
                                <button type="button" class="btn btn-light btn-sm border rounded-4 ms-2">
                                    <i class="bi bi-check-circle-fill text-secondary"></i> Mark as answer
                                </button>
                            </footer>
                        </article>`;
            });

            $('#reviewsSection').html(reviewsHtml);
        }

        // Initial fetch of reviews
        fetchReviews();
    });
</script>
</body>
</html>
