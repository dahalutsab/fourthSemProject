document.addEventListener('DOMContentLoaded', function () {
    const artistTab = document.getElementById('artistTab');
    const cardContainer = document.getElementById('card-design');

    // Fetch and display all artists initially
    fetchArtists('/api/artistDetails/getAllArtists');

    // Fetch and populate categories
    fetch('/api/categories/getAllCategories')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const categories = data.data;
                categories.forEach(category => {
                    const navItem = document.createElement('li');
                    navItem.classList.add('nav-item');

                    navItem.innerHTML = `
                        <button class="nav-link" id="${category.name.replace(/\s+/g, '')}Tab" type="button" data-category-id="${category.id}">
                            ${category.name}
                        </button>
                    `;
                    artistTab.appendChild(navItem);

                    // Add event listener to fetch artists by category
                    navItem.querySelector('button').addEventListener('click', function () {
                        fetchArtists(`/api/artistDetails/getAllArtistsByCategory/${category.id}`);
                    });
                });

                // Add "All" tab
                const allTab = document.createElement('li');
                allTab.classList.add('nav-item');
                allTab.innerHTML = `
                    <button class="nav-link active" id="allTab" type="button">
                        All
                    </button>
                `;
                artistTab.insertBefore(allTab, artistTab.firstChild);

                // Add event listener to fetch all artists
                allTab.querySelector('button').addEventListener('click', function () {
                    fetchArtists('/api/artistDetails/getAllArtists');
                });
            } else {
                console.error('Failed to fetch categories:', data.message);
            }
        })
        .catch(error => console.error('Error fetching categories:', error));

    function fetchArtists(apiUrl) {
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const artists = data.data;
                    cardContainer.innerHTML = ''; // Clear existing content

                    artists.forEach(artist => {
                        const card = document.createElement('div');
                        card.classList.add('col-lg-4', 'col-md-6', 'col-12', 'mb-4',);

                        card.innerHTML = `
                            <div class="artist-aboutUs-content artist-block shadow mb-2">
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
                                    <a href="/artist-details?id=${artist.id}" class="cus-btn primary m-lg-2 m-md-1">
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
    }
});
