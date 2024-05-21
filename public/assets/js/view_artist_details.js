document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const artistId = urlParams.get('id');

    if (artistId) {
        // load videos and images too
        fetch(`/api/media/get-media-by-artist-id/${artistId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const media = data.data;

                    // Populate the media
                    const mediaContainer = document.getElementById('media-container');
                    mediaContainer.innerHTML = ''; // Clear any existing content

                    media.forEach(item => {
                        const mediaItem = document.createElement('div');
                        mediaItem.classList.add('col-lg-4', 'col-md-6', 'col-12', 'mb-4', 'mb-lg-0');

                        mediaItem.innerHTML = `
                            <div class="artist-aboutUs-content artist-block shadow">
                                <div class="artist-img">
                                    <img src="${item.url}" alt="image">
                                </div>
                                <div class="text-block">\
                                    <h2>${item.title}</h2>
                                    <p>${item.description}</p>
                                </div>
                            </div>
                        `;
                        mediaContainer.appendChild(mediaItem);
                    });
                } else {
                    console.error('Failed to fetch artist media:', data.message);
                }
            });
        fetch(`/api/artistDetails/${artistId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const artist = data.data;

                    // Populate the artist details
                    document.querySelector('.artist-img-block img').src = artist.profilePicture ? artist.profilePicture : 'default-image.jpg';
                    document.querySelector('.text-block h2').textContent = artist.fullName ? artist.fullName : artist.stageName;
                    document.querySelector('.text-block .Stars').style.setProperty('--rating', 4.6);
                    document.querySelector('.text-block p').textContent = artist.description ? artist.description : 'No description available.';
                    // Populate other fields as needed
                } else {
                    console.error('Failed to fetch artist details:', data.message);
                }
            })
            .catch(error => console.error('Error fetching artist details:', error));
    } else {
        console.error('No artist ID found in the URL.');
    }
});