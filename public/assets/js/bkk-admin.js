/**
 * BKK Admin Theme — small UI helpers.
 * Bootstrap 5 (from Vite) handles dropdowns, modals and tooltips.
 */
(function () {
    'use strict';

    const body = document.body;
    const isMobile = () => window.innerWidth < 1024;

    function openSidebar() {
        body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        body.classList.remove('sidebar-open');
    }

    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const backdrop = document.getElementById('sidebarBackdrop');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            if (isMobile()) {
                body.classList.toggle('sidebar-open');
            } else {
                body.classList.toggle('sidebar-collapsed');
            }
        });
    }

    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeSidebar);
    }

    document.querySelectorAll('.app-sidebar .nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (isMobile()) {
                closeSidebar();
            }
        });
    });

    window.addEventListener('resize', function () {
        if (!isMobile()) {
            closeSidebar();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && body.classList.contains('sidebar-open')) {
            closeSidebar();
        }
    });

    // Fullscreen toggle
    const fullscreenButton = document.getElementById('fullscreenBtn');
    if (fullscreenButton) {
        fullscreenButton.addEventListener('click', function () {
            const icon = fullscreenButton.querySelector('i');

            if (!document.fullscreenElement) {
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen().catch(function () {});
                }
            } else if (document.exitFullscreen) {
                document.exitFullscreen().catch(function () {});
            }

            if (icon) {
                icon.classList.toggle('fa-expand');
                icon.classList.toggle('fa-compress');
            }
        });
    }

    // Job description modal: copy the selected row's description into the modal.
    const descModal = document.getElementById('modalDeskripsi');
    if (descModal) {
        descModal.addEventListener('show.bs.modal', function (event) {
            const trigger = event.relatedTarget;
            if (!trigger) {
                return;
            }

            const title = descModal.querySelector('.modal-title span') || descModal.querySelector('.modal-title');
            const target = descModal.querySelector('.job-desc');

            if (title) {
                title.textContent = trigger.getAttribute('data-title') || 'Deskripsi Loker';
            }

            if (target) {
                const description = trigger.getAttribute('data-desc') || '';
                target.innerHTML = description.trim() !== ''
                    ? description
                    : '<em class="text-muted">Belum ada deskripsi untuk loker ini.</em>';
            }
        });
    }

    // Tooltips (Bootstrap 5 global may be exposed by the Vite bundle).
    if (window.bootstrap && window.bootstrap.Tooltip) {
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (element) {
            new window.bootstrap.Tooltip(element);
        });
    }
})();
