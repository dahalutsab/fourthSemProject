const navLinks = document.querySelectorAll('.nav-link');

navLinks.forEach(link => {
    link.addEventListener('click', function () {
        navLinks.forEach(sibling => sibling.classList.remove('active'));
        this.classList.add('active');
    });
});
