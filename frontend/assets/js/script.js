document.addEventListener("DOMContentLoaded", function() {
    // Get all nav links
    const navLinks = document.querySelectorAll('.nav-link');


    // Add click event listener to each nav link
    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function(event) {
            const targetId = this.getAttribute('data-bs-target');

            // Remove active class from all nav links
            navLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Add active class to the clicked nav link
            this.classList.add('active');
        });
    });
});

const artist_card = document.getElementById('expandable-artist-description-card');
const artist_container = document.getElementById('artist-container');

artist_card.addEventListener('click', function() {
    artist_container.classList.toggle('expand');
    artist_container.classList.toggle('expanded');
}