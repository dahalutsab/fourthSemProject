
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

    <div class="container">
        <!-- Breadcrumb and back link -->
        <div class="row bg-gradient shadow">
            <div class="col-lg-8 col-md-8">
                <div class="artist-landing">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Homepage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Artist</li>
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
                        <a href="#" class="cus-btn primary m-lg-2 m-md-1" id="messageButton"><i class="fa fa-message"></i> Message</a>
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
                            <p>Address</p>
                            <p id="address"></p>
                        </div>
                        <div class="description-icons">
                            <i class="fa-solid fa-coins"></i>
                            <p>Cost</p>
                            <p>Please click on "Book" button to see the cost</p>
                        </div>
                        <div class="description-icons">
                            <i class="fa-solid fa-phone"></i>
                            <p>Phone</p>
                            <p id="phone"></p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const artistId = urlParams.get('id');

            if (artistId) {
                initializePage(artistId);
                document.getElementById('messageButton').addEventListener('click', function() {
                    messageArtist(userId);
                });
            } else {
                console.error('No artist ID found in the URL.');
            }
        });


        function initializePage(artistId) {
            fetchArtistDetails(artistId);
            fetchAndDisplayRating(artistId);
            fetchMedia(artistId);
            fetchComments(artistId);
            setupCommentSubmission(artistId);
            setupPerformanceModal(artistId);
        }

        let userId = null;
        function fetchArtistDetails(artistId) {
            fetch(`/api/artistDetails/${artistId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const artist = data.data;
                        userId = artist.userId;

                        document.querySelector('.artist-img-block img').src = artist.profile_picture || 'default-image.jpg';
                        document.querySelector('.text-block h2').textContent = artist.full_name || artist.stage_name;
                        document.querySelector('.text-block p').textContent = artist.description;
                        document.querySelector('.Stars').style.setProperty('--rating', artist.rating);
                        document.querySelector('.description-icons #address').textContent = artist.address;
                        document.querySelector('.description-icons #phone').textContent = artist.phone;

                        // Update social media links
                        const socialIconList = document.querySelector('.social-icon');
                        socialIconList.innerHTML = ''; // Clear existing links
                        artist.social_media_links.forEach(link => {
                            const socialIconItem = document.createElement('li');
                            socialIconItem.classList.add('social-icon-item', 'mx-lg-3', 'm-md-2', 'mx-sm-1');

                            socialIconItem.innerHTML = `
                        <a href="${link.url}" class="social-icon-link">
                            <i class="${link.platform_icon}"></i>
                        </a>
                    `;
                            socialIconList.appendChild(socialIconItem);
                        });
                    } else {
                        console.error('Failed to fetch artist details:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching artist details:', error));
        }

        function fetchMedia(artistId) {
            fetch(`/api/media/get-media-by-artist-id/${artistId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayMedia(data.data);
                    } else {
                        console.error('Failed to fetch artist media:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching artist media:', error));
        }

        function displayMedia(media) {
            const mediaContainer = document.querySelector('.carousel-inner');
            mediaContainer.innerHTML = '';

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
        }

        function fetchComments(artistId) {
            fetch(`/api/comments/${artistId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayComments(data.data, artistId);
                    } else {
                        console.error('Failed to fetch comments:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching comments:', error));
        }

        function displayComments(comments, artistId) {
            const commentList = document.getElementById('commentList');
            commentList.innerHTML = '';

            comments.forEach(comment => {
                const commentBox = createCommentBox(comment);
                commentList.appendChild(commentBox);

                if (comment.replies) {
                    const replyList = createReplyList(comment.replies);
                    commentBox.appendChild(replyList);
                }
            });

            document.querySelector('#commentList').addEventListener('click', function (event) {
                handleCommentActions(event, artistId);
            });
        }

        function fetchAndDisplayRating(artistId) {
            fetch(`/api/artistRating?artistId=${artistId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const rating = data.data.rating;
                        document.querySelector('.Stars').style.setProperty('--rating', rating);
                    } else {
                        console.error('Failed to fetch artist rating:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching artist rating:', error));
        }

        function createCommentBox(comment) {
            const commentBox = document.createElement('div');
            commentBox.classList.add('comment-box');
            commentBox.innerHTML = `
                <img src="${comment.userProfileImage}" alt="User profile">
                <div class="comment-content">
                    <h5>${comment.userName}</h5>
                    <div class="star-rating" style="--rating: ${comment.rating};"></div>
                    <p>${comment.text}</p>
                    <div class="comment-actions">
                        <span class="upvotes">${comment.upvotes} <i class="fa fa-thumbs-up"></i></span>
                        <button class="btn btn-link reply-button" data-comment-id="${comment.comment_id}">Reply</button>
                    </div>
                    <div class="reply-box" id="replyBox-${comment.comment_id}" style="display: none;">
                        <textarea class="form-control mb-2" id="replyInput-${comment.comment_id}" rows="1" placeholder="Add a reply"></textarea>
                        <button class="btn btn-primary submit-reply-button" data-comment-id="${comment.comment_id}">Submit Reply</button>
                    </div>
                </div>
            `;
            return commentBox;
        }

        function createReplyList(replies) {
            const replyList = document.createElement('div');
            replyList.classList.add('reply-list');

            replies.forEach(reply => {
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

            return replyList;
        }

        function handleCommentActions(event, artistId) {
            if (event.target.classList.contains('reply-button')) {
                const commentId = event.target.dataset.commentId;
                toggleReplyBox(commentId);
            } else if (event.target.classList.contains('submit-reply-button')) {
                const commentId = event.target.dataset.commentId;
                const replyText = document.querySelector(`#replyInput-${commentId}`).value;
                submitReply(commentId, replyText, artistId);
            }
        }

        function toggleReplyBox(commentId) {
            const replyBox = document.getElementById(`replyBox-${commentId}`);
            replyBox.style.display = replyBox.style.display === 'none' ? 'block' : 'none';
        }

        function setupCommentSubmission(artistId) {
            const submitCommentButton = document.getElementById('submitComment');
            if (submitCommentButton) {
                submitCommentButton.addEventListener('click', function () {
                    submitComment(artistId);
                });
            }
        }

        function submitComment(artistId) {
            const commentTextElement = document.getElementById('commentInput');
            if (commentTextElement) {
                const commentText = commentTextElement.value;
                if (!commentText) {
                    toastr.error('Please enter a comment');
                    return;
                }
                const ratingElement = document.querySelector('.star-rating input[type="radio"]:checked');
                const rating = ratingElement ? ratingElement.value : 'No rating selected';

                console.log(commentText, rating);
                fetch('/api/comments/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ artistId, text: commentText, rating })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success(data.message);
                            fetchComments(artistId);
                        } else {
                            console.error('Failed to submit comment:', data.error);
                            toastr.error(data.error);
                        }
                    })
                    .catch(error => console.error('Error submitting comment:', error));
            } else {
                console.error('Comment element not found');
            }
        }

        function submitReply(commentId, replyText, artistId) {
            if (!replyText) {
                toastr.error('Please enter a reply');
                return;
            }
            if (!commentId) {
                console.error('Comment ID is required to submit a reply');
                return;
            }
            fetch(`/api/replies/add`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({commentId, text: replyText, artistId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message)
                        fetchComments(artistId);
                    } else {
                        console.error('Failed to submit reply:', data.error);
                        toastr.error(data.error);
                    }
                })
                .catch(error => console.error('Error submitting reply:', error));
        }

        function setupPerformanceModal(artistId) {
            document.querySelector('#open_book_modal').addEventListener('click', function () {
                fetchPerformanceTypes(artistId);
            });
        }

        function fetchPerformanceTypes(artistId) {
            fetch(`/api/artistPerformance/get-artist-performance-by-artist-details/${artistId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayPerformanceTypes(data.data);
                    } else {
                        console.error('Failed to fetch performance types:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching performance types:', error));
        }

        function displayPerformanceTypes(performanceTypes) {
            const tableBody = document.querySelector('#performanceTypeList');
            tableBody.innerHTML = '';

            if (performanceTypes.length === 0) {
                const row = document.createElement('tr');
                const cell = document.createElement('td');
                cell.colSpan = 3;
                cell.textContent = 'Artist has not specified any performance types yet. Please contact the artist for more information.';
                row.appendChild(cell);
                tableBody.appendChild(row);
            }

            performanceTypes.forEach(performanceType => {
                if (!performanceType.is_deleted) {
                    const row = document.createElement('tr');

                    const typeCell = document.createElement('td');
                    typeCell.textContent = performanceType.performance_type;
                    row.appendChild(typeCell);

                    const costCell = document.createElement('td');
                    costCell.textContent = `Rs. ${performanceType.cost_per_hour} per hour`;
                    row.appendChild(costCell);

                    const actionCell = document.createElement('td');
                    const bookButton = document.createElement('button');
                    bookButton.classList.add('btn', 'btn-primary', 'book-button');
                    bookButton.textContent = 'Book';
                    bookButton.dataset.performanceTypeId = performanceType.performance_type_id;
                    bookButton.addEventListener('click', function () {
                        bookPerformance(performanceType.performance_type_id);
                    });
                    actionCell.appendChild(bookButton);
                    row.appendChild(actionCell);

                    tableBody.appendChild(row);
                }
            });
        }

        function bookPerformance(performanceTypeId) {
            window.location.href = `/dashboard/book-artist/${performanceTypeId}`;
        }

        function messageArtist(userId) {
            if (userId !== null) {
                window.location.href = `/dashboard/messages?user_id=${userId}`;
            }
        }

    </script>
