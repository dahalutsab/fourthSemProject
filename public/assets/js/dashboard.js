document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
    if (toggleSidebarBtn) {
        toggleSidebarBtn.addEventListener('click', function(e) {
            console.log('clicked here');
            document.body.classList.toggle('toggle-sidebar');
        });
    }
});