document.addEventListener("DOMContentLoaded", function() {
    // Get all nav links
    const navLinks = document.querySelectorAll('.nav-link');
    // Get all tab panes
    const tabPanes = document.querySelectorAll('.tab-pane');

    // Add click event listener to each nav link
    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function(event) {
            const targetId = this.getAttribute('data-bs-target');

            // Remove active class from all nav links
            navLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Hide all tab panes
            tabPanes.forEach(function(tabPane) {
                tabPane.classList.remove('show');
                if (!tabPane.classList.contains('active')) {
                    tabPane.style.display = 'none';
                }
            });

            // Add active class to the clicked nav link
            this.classList.add('active');

            // Show the corresponding tab pane
            const targetPane = document.querySelector(targetId);
            targetPane.style.display = 'block';
            targetPane.classList.add('show');
        });
    });
});