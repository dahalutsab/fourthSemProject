document.addEventListener('DOMContentLoaded', function() {
    // Fetch artist ID from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const artistId = urlParams.get('id');

    if (artistId) {
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
                        }
                        else if (item.media_type === 'audio') {
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
                    document.querySelector('.artist-img-block img').src = artist.profilePicture || 'assets/images/default-image.jpg';
                    document.querySelector('.text-block h2').textContent = artist.fullName || artist.stageName;
                    document.querySelector('.text-block p').textContent = artist.description;
                    // Populate other artist details as needed
                } else {
                    console.error('Failed to fetch artist details:', data.message);
                }
            })
            .catch(error => console.error('Error fetching artist details:', error));
    } else {
        console.error('No artist ID found in the URL.');
    }
});
