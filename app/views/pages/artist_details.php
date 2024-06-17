<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .star-rating {
            direction: rtl;
            display: inline-flex;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 2em;
            color: lightgray;
            cursor: pointer;
        }

        .star-rating input[type="radio"]:checked~label {
            color: gold;
        }

        .comment-section {
            margin-top: 30px;
        }

        .comment-box {
            display: flex;
            margin-bottom: 20px;
        }

        .comment-box img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .comment-content {
            flex-grow: 1;
        }

        .comment-content h5 {
            margin-bottom: 0;
        }

        .comment-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reply-box {
            margin-left: 60px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Breadcrumb and back link -->
        <div class="row bg-gradient shadow">
            <div class="col-lg-8 col-md-8">
                <div class="artist-landing">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Homepage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Singers</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 text-end">
                <a href="/#artist"><i class="fa-solid fa-backward"></i> Back to artists</a>
            </div>
        </div>

        <!-- Artist's media and details -->
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="video-block shadow">
                    <div id="carouselMedia" class="carousel img-block slide carousel-fade">
                        <div class="carousel-inner"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-around mt-2">
                    <i class="fa-solid fa-arrow-left" data-bs-target="#carouselMedia" data-bs-slide="prev"></i>
                    <i class="fa-solid fa-arrow-right" data-bs-target="#carouselMedia" data-bs-slide="next"></i>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="artist-aboutUs-content shadow">
                    <div class="artist-img-block">
                        <img src="<?= BASE_IMAGE_PATH ?>default-profile.png" alt="image">
                    </div>
                    <div class="text-block">
                        <h2>Artist Name</h2>
                        <div class="Stars" style="--rating: 4.6;"></div>
                        <p>Artist description goes here.</p>
                    </div>
                    <div class="social-share">
                        <ul class="social-icon">
                            <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                                <a href="#" class="social-icon-link"><i class="fa-brands fa-facebook"></i></a>
                            </li>
                            <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                                <a href="#" class="social-icon-link"><i class="fa-brands fa-twitter"></i></a>
                            </li>
                            <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                                <a href="#" class="social-icon-link"><i class="fa-brands fa-instagram"></i></a>
                            </li>
                            <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                                <a href="#" class="social-icon-link"><i class="fa-brands fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="hero-button">
                        <a href="#" class="cus-btn primary m-lg-2 m-md-1"><i class="fa fa-message"></i> Message</a>
                        <a href="#" class="cus-btn primary book-artist" id="open_book_modal" data-bs-toggle="modal"
                            data-bs-target="#bookArtistModal"><i class="fa fa-calendar-check"></i> Book</a>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="artist-overview text-center my-lg-5 my-md-2">
                    <h3>Overview</h3>
                    <p>Artist overview goes here.</p>
                    <div class="d-flex justify-content-evenly">
                        <div class="description-icons">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>Location</p>
                        </div>
                        <div class="description-icons">
                            <i class="fa-solid fa-coins"></i>
                            <p>Cost</p>
                        </div>
                        <div class="description-icons">
                            <i class="fa-solid fa-phone"></i>
                            <p>Phone</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="text-center mb-4 pb-2">Comments</h4>
                            <?php if (isset($_SESSION[SESSION_USER_ID])): ?>
                                <div class=" comment-section" id="commentSection">
                                    <!-- Comment form -->
                                    <div class="comment-form mb-4">
                                        <div class="star-rating">
                                            <input type="radio" name="rating" id="rating-5" value="5"><label
                                                for="rating-5">&#9733;</label>
                                            <input type="radio" name="rating" id="rating-4" value="4"><label
                                                for="rating-4">&#9733;</label>
                                            <input type="radio" name="rating" id="rating-3" value="3"><label
                                                for="rating-3">&#9733;</label>
                                            <input type="radio" name="rating" id="rating-2" value="2"><label
                                                for="rating-2">&#9733;</label>
                                            <input type="radio" name="rating" id="rating-1" value="1"><label
                                                for="rating-1">&#9733;</label>
                                        </div>
                                        <label for="commentInput"></label><textarea class="form-control mb-2"
                                            id="commentInput" rows="3" placeholder="Add a comment"></textarea>
                                        <button class="btn btn-primary" id="submitComment">Submit</button>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center">Please <a href="/login">login</a> to post a comment.</p>
                                <?php endif; ?>
                                <!-- Comments display area -->
                                <div class="comment-list" id="commentList">
                                    <!-- Comments will be dynamically populated here -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for booking artist -->
        <div class="modal fade" id="bookArtistModal" tabindex="-1" aria-labelledby="bookArtistModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookArtistModalLabel">Book Artist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Performance Type</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody id="performanceTypeList">
                                <!-- Performance types will be dynamically populated here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Book</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch artist ID from URL parameter
            const urlParams = new URLSearchParams(window.location.search);
            const artistId = urlParams.get('id');

            if (artistId) {
                // Existing code for fetching artist details and media...
                // Fetch media data for the artist
                fetch(`/api/media/get-media-by-artist-id/${artistId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const media = data.data;
                            const mediaContainer = document.querySelector('.carousel-inner');
                            mediaContainer.innerHTML = ''; // Clear any existing content

                            media.forEach((item, index) => {
                                const mediaItem = document.createElement('div');
                                mediaItem.classList.add('carousel-item');
                                if (index === 0) {
                                    mediaItem.classList.add('active');
                                }

                                if (item.media_type === 'photo') {
                                    const img = document.createElement('img');
                                    img.classList.add('d-block', 'w-100');
                                    img.src = item.media_url;
                                    img.alt = 'image';
                                    mediaItem.appendChild(img);
                                } else if (item.media_type === 'video') {
                                    const video = document.createElement('video');
                                    video.classList.add('d-block', 'w-100');
                                    video.controls = true;
                                    video.autoplay = true;
                                    video.loop = true;
                                    video.muted = true;
                                    video.innerHTML = `<source src="${item.media_url}" type="video/mp4" />`;
                                    mediaItem.appendChild(video);
                                } else if (item.media_type === 'audio') {
                                    const audio = document.createElement('audio');
                                    audio.classList.add('d-block', 'w-100');
                                    audio.controls = true;
                                    audio.innerHTML = `<source src="${item.media_url}" type="audio/mpeg" />`;
                                    mediaItem.appendChild(audio);
                                }

                                mediaContainer.appendChild(mediaItem);
                            });
                        } else {
                            console.error('Failed to fetch artist media:', data.message);
                        }
                    })
                    .catch(error => console.error('Error fetching artist media:', error));

                // Fetch artist details
                fetch(`/api/artistDetails/${artistId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const artist = data.data;

                            // Populate artist details
                            document.querySelector('.artist-img-block img').src = artist.profilePicture ||
                                'assets/images/default-image.jpg';
                            document.querySelector('.text-block h2').textContent = artist.fullName || artist.stageName;
                            document.querySelector('.text-block p').textContent = artist.description;

                            // Set artist ID for booking button
                            document.querySelector('.book-artist').setAttribute('data-artist-id', artistId);
                        } else {
                            console.error('Failed to fetch artist details:', data.message);
                        }
                    })
                    .catch(error => console.error('Error fetching artist details:', error));

                document.querySelector('#open_book_modal').addEventListener('click', function () {
                    // Fetch performance types and populate the modal
                    fetch(`/api/artistPerformance/get-artist-performance/${artistId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const performanceTypes = data.data;
                                const tableBody = document.querySelector('#performanceTypeList');
                                tableBody.innerHTML = ''; // Clear any existing content

                                performanceTypes.forEach((performanceType) => {
                                    if (!performanceType.is_deleted) { // Only display performance types that are not deleted
                                        const row = document.createElement('tr');

                                        const typeCell = document.createElement('td');
                                        typeCell.textContent = performanceType.performance_type;
                                        row.appendChild(typeCell);

                                        const costCell = document.createElement('td');
                                        costCell.textContent = performanceType.cost_per_hour;
                                        row.appendChild(costCell);

                                        const bookCell = document.createElement('td');
                                        const bookButton = document.createElement('button');
                                        bookButton.textContent = 'Book';
                                        bookButton.classList.add('btn', 'btn-primary');
                                        bookButton.addEventListener('click', function () {
                                            bookPerformance(artistId, performanceType.performance_type_id);
                                        });
                                        bookCell.appendChild(bookButton);
                                        row.appendChild(bookCell);

                                        tableBody.appendChild(row);
                                    }
                                });
                            } else {
                                console.error('Failed to fetch performance types:', data.message);
                            }
                        })
                        .catch(error => console.error('Error fetching performance types:', error));
                });

                function bookPerformance(artistId, performanceTypeId) {
                    window.location.href = `/dashboard/book-artist/${performanceTypeId}`;
                } // Fetch and display comments
                fetchComments(artistId);

                // Handle comment submission
                var submitCommentButton = document.getElementById('submitComment');
                if (submitCommentButton) {
                    document.getElementById('submitComment').addEventListener('click', function () {
                        submitComment(artistId);
                    });
                }

                // Handle reply submission
                document.querySelector('#commentList').addEventListener('click', function (event) {
                    if (event.target.classList.contains('reply-button')) {
                        const commentId = event.target.dataset.commentId;
                        const replyText = document.querySelector(`#replyInput-${commentId}`).value;
                        submitReply(artistId, commentId, replyText);
                    }
                });
            } else {
                console.error('No artist ID found in the URL.');
            }
        });

        function fetchComments(artistId) {
            fetch(`/api/comments/${artistId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const comments = data.data;
                        const commentList = document.getElementById('commentList');
                        commentList.innerHTML = ''; // Clear existing comments

                        comments.forEach(comment => {
                            const commentBox = document.createElement('div');
                            commentBox.classList.add('comment-box');
                            commentBox.innerHTML = `
                    <img src="${comment.userProfileImage}" alt="User profile">
                    <div class="comment-content">
                        <h5>${comment.userName}</h5>
                        <div class="star-rating" style="--rating: ${comment.rating};"></div>
                        <p>${comment.text}</p>
                        <div class="comment-actions">
                            <button class="btn btn-link reply-button" data-comment-id="${comment.comment_id}">Reply</button>
                        </div>
                        <div class="reply-box" id="replyBox-${comment.comment_id}">
                            <textarea class="form-control mb-2" id="replyInput-${comment.comment_id}" rows="1" placeholder="Add a reply"></textarea>
                            <button class="btn btn-primary reply-button" data-comment-id="${comment.comment_id}">Submit Reply</button>
                        </div>
                    </div>
                    `;
                            commentList.appendChild(commentBox);

                            // Display replies
                            if (comment.replies) {
                                const replyList = document.createElement('div');
                                replyList.classList.add('reply-list');

                                comment.replies.forEach(reply => {
                                    const replyBox = document.createElement('div');
                                    replyBox.classList.add('reply-box');
                                    replyBox.innerHTML = `
                            <img src="${reply.userProfileImage}" alt="User profile">
                            <div class="reply-content">
                                <h5>${reply.userName}</h5>
                                <p>${reply.text}</p>
                            </div>
                            `;
                                    replyList.appendChild(replyBox);
                                });

                                commentBox.appendChild(replyList);
                            }
                        });
                    } else {
                        console.error('Failed to fetch comments:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching comments:', error));
        }

        function submitComment(artistId) {
            const rating = document.querySelector('.star-rating input:checked').value;
            const commentText = document.getElementById('commentInput').value;

            fetch('/api/comments/add', {
                method: 'POST',
                body: JSON.stringify({
                    artistId,
                    rating,
                    text: commentText
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        fetchComments(artistId); // Refresh comments list
                        document.getElementById('commentInput').value = ''; // Clear input
                        document.querySelector('.star-rating input:checked').checked = false; // Clear rating
                    } else {
                        console.error('Error submitting comment:', data.message);
                    }
                })
                .catch(error => console.error('Error submitting comment:', error));
        }

        function submitReply(artistId, commentId, replyText) {
            fetch('/api/replies/add', {
                method: 'POST',
                body: JSON.stringify({
                    artistId,
                    commentId,
                    text: replyText
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const urlParams = new URLSearchParams(window.location.search);
                        const artistId = urlParams.get('id');
                        fetchComments(artistId);
                    } else {
                        console.error('Error submitting reply:', data.message);
                    }
                })
                .catch(error => console.error('Error submitting reply:', error));
        }
    </script>

</body>

</html>