document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const btn = document.getElementById('hamburgerBtn');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !btn || !overlay) {
        console.warn('Sidebar elements missing');
        return;
    }

    // Open/close sidebar
    btn.addEventListener('click', function () {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    });

    // Close when clicking overlay
    overlay.addEventListener('click', function () {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    });

    // Close when clicking a link (mobile)
    sidebar.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 800) {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            }
        });
    });
});
