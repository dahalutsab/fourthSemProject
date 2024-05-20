let toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
if (toggleSidebarBtn) {
    toggleSidebarBtn.addEventListener('click', function(e) {
        console.log('clicked');
        document.body.classList.toggle('toggle-sidebar');
    });
}