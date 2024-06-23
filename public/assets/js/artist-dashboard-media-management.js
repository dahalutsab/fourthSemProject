document.addEventListener("DOMContentLoaded", () => {
    const mediaContainer = document.querySelector('.media-container');
    const mainVideoContainer = document.querySelector('.main-video-container');
    const videoListContainer = document.querySelector('.video-list-container');

    // Function to create media element based on type
    const createMediaElement = (mediaItem, isMain = false) => {
        let mediaElement;
        const mediaUrl = `/${mediaItem.media_url}`;
        const title = mediaItem.title;

        if (mediaItem.media_type === 'video') {
            mediaElement = document.createElement('video');
            mediaElement.src = mediaUrl;
            mediaElement.controls = true;
            if (isMain) {
                mediaElement.autoplay = true;
                mediaElement.loop = true;
            } else {

                mediaElement.style.pointerEvents = 'none'; // Disable interaction
                mediaElement.autoplay = false;
                mediaElement.loop = false;
                mediaElement.muted = true;
                mediaElement.setAttribute('playsinline', true); // Prevent fullscreen on mobile

            }
        } else if (mediaItem.media_type === 'photo') {
            mediaElement = document.createElement('img');
            mediaElement.src = mediaUrl;
        } else if (mediaItem.media_type === 'audio') {
            mediaElement = document.createElement('audio');
            mediaElement.src = mediaUrl;
            mediaElement.controls = true;
        }

        mediaElement.classList.add(isMain ? 'main-video' : 'list-video');
        return mediaElement;
    };

    // Function to populate the main video container
    const populateMainVideo = (mediaItem) => {
        mainVideoContainer.innerHTML = '';
        const mediaElement = createMediaElement(mediaItem, true);
        const titleElement = document.createElement('h3');
        titleElement.classList.add('main-vid-title');
        titleElement.innerText = mediaItem.title;

        mainVideoContainer.appendChild(mediaElement);
        mainVideoContainer.appendChild(titleElement);
    };

    // Function to populate the video list container
    const populateVideoList = (mediaItems) => {
        videoListContainer.innerHTML = '';

        mediaItems.forEach((mediaItem, index) => {
            const videoListItem = document.createElement('div');
            videoListItem.classList.add('video-list', 'd-flex', 'justify-content-between');
            if (index === 0) {
                videoListItem.classList.add('active');
            }
            videoListItem.dataset.mediaId = mediaItem.media_id;
            const mediaElement = createMediaElement(mediaItem);
            const titleElement = document.createElement('h3');
            titleElement.classList.add('list-title');
            titleElement.innerText = mediaItem.title;

            const dropstartDiv = document.createElement('div');
            dropstartDiv.classList.add('dropstart');

            const dropdownToggle = document.createElement('div');
            dropdownToggle.classList.add('dropdown-toggle');
            dropdownToggle.setAttribute('type', 'button');
            dropdownToggle.setAttribute('data-bs-toggle', 'dropdown');
            dropdownToggle.setAttribute('aria-expanded', 'false');

            ['dot', 'dot', 'dot'].forEach(className => {
                const dot = document.createElement('span');
                dot.classList.add(className);
                dropdownToggle.appendChild(dot);
            });

            const dropdownMenu = document.createElement('ul');
            dropdownMenu.classList.add('dropdown-menu');
            dropdownMenu.innerHTML = `
                <li>
                    <a class="dropdown-item" id="delete-media">
                        <i class="mdi mdi-delete text-danger"></i>
                        Delete
                    </a>
                </li>
                <li>
                    <a class="dropdown-item">
                        <i class="mdi mdi-update text-success"></i>
                        Update Status
                    </a>
                </li>
            `;

            dropstartDiv.appendChild(dropdownToggle);
            dropstartDiv.appendChild(dropdownMenu);

            videoListItem.appendChild(mediaElement);
            videoListItem.appendChild(titleElement);
            videoListItem.appendChild(dropstartDiv);

            videoListContainer.appendChild(videoListItem);

            videoListItem.addEventListener('click', () => {
                document.querySelectorAll('.video-list').forEach(item => item.classList.remove('active'));
                videoListItem.classList.add('active');
                populateMainVideo(mediaItem);
                if (mediaElement.tagName === 'VIDEO' || mediaElement.tagName === 'AUDIO') {
                    mediaElement.play();
                }
            });
        });
    };

    const deleteMedia = async (mediaId) => {
        try {
            const response = await fetch(`/api/media/delete-media`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ mediaId })
            });
            if (!response.ok) {
                toastr.error('Error deleting media');
            }
            const data = await response.json();
            if (data.success) {
                toastr.success('Media deleted successfully');
                await fetchMedia();
            } else {
                console.error('Failed to delete media:', data.message);
            }
        } catch (error) {
            console.error('Error deleting media:', error);
        }
    }
    // Event listener for delete media
    document.addEventListener('click', (event) => {
        if (event.target.id === 'delete-media') {
            const videoListItem = event.target.closest('.video-list');
            const mediaId = videoListItem.dataset.mediaId;
            if(mediaId) {
                if (confirm('Are you sure you want to delete this media?')) {
                    deleteMedia(mediaId).then(r =>
                        fetchMedia()
                    );
                }
            }
            else {
                toastr.error('Error deleting media');
            }
        }
    });


    const fetchMedia = async () => {
        try {
            const response = await fetch('/api/media/get-media-by-user');
            if (!response.ok) {
                if (response.status === 401) {
                    window.location.href = '/login';
                } else if (response.status === 403) {
                    window.location.href = '/access-denied';
                } else {
                    toastr.error('Error fetching media');
                }
            }
            const data = await response.json();
            if (data.success) {
                const mediaItems = data.data;
                if (mediaItems.length > 0) {
                    populateMainVideo(mediaItems[0]);
                    populateVideoList(mediaItems);
                }
            } else {
                console.error('Failed to fetch media:', data.message);
            }
        } catch (error) {
            console.error('Error fetching media:', error);
        }
    };

    fetchMedia().then(r => console.log('Media fetched successfully'));
});
