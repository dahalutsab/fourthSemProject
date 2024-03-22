document.addEventListener('click', function(event) {
    // Toggle sidebar button
    if (event.target.closest('.toggle-sidebar-btn')) {
        console.log('toggle sidebar');
        document.body.classList.toggle('toggle-sidebar');
    }

    // Search bar toggle button
    if (event.target.closest('.search-bar-toggle')) {
        document.querySelector('.search-bar').classList.toggle('search-bar-show');
    }
});