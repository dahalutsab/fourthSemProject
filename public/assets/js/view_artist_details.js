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
                    document.querySelector('.artist-img-block img').src = artist.profilePicture || 'assets/images/default-image.jpg';
                    document.querySelector('.text-block h2').textContent = artist.fullName || artist.stageName;
                    document.querySelector('.text-block p').textContent = artist.description;

                    // Set artist ID for booking button
                    document.querySelector('.book-artist').setAttribute('data-artist-id', artistId);
                } else {
                    console.error('Failed to fetch artist details:', data.message);
                }
            })
            .catch(error => console.error('Error fetching artist details:', error));

        // Handle booking button click
        document.querySelector('#open_book_modal').addEventListener('click', function() {
            // Fetch performance types and populate the modal
            fetch(`/api/artistPerformance/get-artist-performance/${artistId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const performanceTypes = data.data;
                        const tableBody = document.querySelector('#artist_booking_performance_list tbody');
                        tableBody.innerHTML = ''; // Clear any existing content

                        performanceTypes.forEach((performanceType, index) => {
                            const row = document.createElement('tr');

                            const numberCell = document.createElement('td');
                            numberCell.textContent = index + 1;
                            row.appendChild(numberCell);

                            const typeCell = document.createElement('td');
                            typeCell.textContent = performanceType.performance_type;
                            row.appendChild(typeCell);

                            const costCell = document.createElement('td');
                            costCell.textContent = performanceType.cost_per_hour;
                            row.appendChild(costCell);

                            const actionCell = document.createElement('td');
                            const selectButton = document.createElement('button');
                            selectButton.textContent = 'Select';
                            selectButton.classList.add('btn', 'btn-primary');
                            selectButton.addEventListener('click', function() {
                                // Handle selection of performance type
                                console.log('Selected performance type:', performanceType);
                            });
                            actionCell.appendChild(selectButton);
                            row.appendChild(actionCell);

                            tableBody.appendChild(row);
                        });
                    } else {
                        console.error('Failed to fetch performance types:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching performance types:', error));
        });
    } else {
        console.error('No artist ID found in the URL.');
    }
});
