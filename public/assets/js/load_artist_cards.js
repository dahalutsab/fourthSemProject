document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/artistDetails/getAllArtists')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const artists = data.data;
                const cardContainer = document.getElementById('card-design');
                cardContainer.innerHTML = ''; // Clear any existing content

                artists.forEach(artist => {
                    const card = document.createElement('div');
                    card.classList.add('col-lg-4', 'col-md-6', 'col-12', 'mb-4', 'mb-lg-0');

                    const artistData = encodeURIComponent(JSON.stringify(artist));

                    card.innerHTML = `
                        <div class="artist-aboutUs-content artist-block shadow">
                            <div class="artist-img-block">
                                <img src="${artist.profilePicture ? artist.profilePicture : 'default-image.jpg'}" alt="image">
                            </div>
                            <div class="text-block">
                                <h2>${artist.fullName ? artist.fullName : artist.stageName}</h2>
                                <div class="Stars" style="--rating: 4.6;"></div>
                                <p>${artist.description ? artist.description : 'No description available.'}</p>
                            </div>
                            <div class="social-share">
                                <ul class="social-icon">
                                    <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                                        <a href="#" class="social-icon-link">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                                        <a href="#" class="social-icon-link">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                                        <a href="#" class="social-icon-link">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="social-icon-item mx-lg-3 m-md-2 mx-sm-1">
                                        <a href="#" class="social-icon-link">
                                            <i class="fa-brands fa-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hero-button">
                                <a href="/artist-details?data=${artistData}" class="cus-btn primary m-lg-2 m-md-1">
                                    <i class="fa-solid fa-circle-info"></i> View Details
                                </a>
                            </div>
                        </div>
                    `;

                    cardContainer.appendChild(card);
                });
            } else {
                console.error('Failed to fetch artist details:', data.message);
            }
        })
        .catch(error => console.error('Error fetching artist details:', error));
});
