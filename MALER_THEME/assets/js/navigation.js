document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const closeMenu = document.querySelector('.close-menu');
    const mobileOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');

    // Toggle mobile menu
    menuToggle.addEventListener('click', function() {
        mobileOverlay.style.display = 'block';
        setTimeout(() => {
            mobileOverlay.classList.add('active');
            menuToggle.classList.add('active');
        }, 10);
        document.body.style.overflow = 'hidden';
    });

    // Close mobile menu
    function closeMobileMenu() {
        mobileOverlay.classList.remove('active');
        menuToggle.classList.remove('active');
        setTimeout(() => {
            mobileOverlay.style.display = 'none';
        }, 300);
        document.body.style.overflow = '';
    }

    closeMenu.addEventListener('click', closeMobileMenu);

    // Close menu when clicking on a link
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Close menu when clicking outside
    mobileOverlay.addEventListener('click', function(e) {
        if (e.target === mobileOverlay) {
            closeMobileMenu();
        }
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileOverlay.classList.contains('active')) {
            closeMobileMenu();
        }
    });
}); 