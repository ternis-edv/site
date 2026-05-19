document.addEventListener('DOMContentLoaded', () => {
    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    
    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'theme-light' : 'theme-dark');
    body.className = savedTheme;

    // Cookie Banner
    const banner = document.getElementById('cookie-banner');
    const cbAcceptAll = document.getElementById('cb-accept-all');
    const cbRejectAll = document.getElementById('cb-reject-all');
    const cbSettings = document.getElementById('cb-settings');
    const cbModal = document.getElementById('cb-modal');
    const cbSaveSettings = document.getElementById('cb-save-settings');

    if (!localStorage.getItem('cookies-accepted')) {
        setTimeout(() => banner.classList.add('show'), 1000);
    }

    cbAcceptAll.addEventListener('click', () => {
        localStorage.setItem('cookies-accepted', 'all');
        banner.classList.remove('show');
    });

    cbRejectAll.addEventListener('click', () => {
        localStorage.setItem('cookies-accepted', 'necessary');
        banner.classList.remove('show');
    });

    cbSettings.addEventListener('click', () => {
        cbModal.classList.add('show');
    });

    cbSaveSettings.addEventListener('click', () => {
        const analytics = document.getElementById('cookie-analytics').checked;
        localStorage.setItem('cookies-accepted', analytics ? 'custom-analytics' : 'necessary');
        cbModal.classList.remove('show');
        banner.classList.remove('show');
    });

    window.addEventListener('click', (e) => {
        if (e.target === cbModal) cbModal.classList.remove('show');
    });

    // Nav Scroll Effect
    const nav = document.getElementById('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    }, { passive: true });

    // Back to Top
    const backToTop = document.getElementById('back-to-top');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    }, { passive: true });

    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Reveal Animations
    const revealElements = document.querySelectorAll('.reveal, .project-section');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.15 });

    revealElements.forEach(el => revealObserver.observe(el));

    // Work Progress
    const workSection = document.getElementById('work');
    const workProgress = document.getElementById('work-progress');
    
    window.addEventListener('scroll', () => {
        const rect = workSection.getBoundingClientRect();
        const totalHeight = workSection.offsetHeight;
        const scrolled = Math.max(0, -rect.top);
        const progress = Math.min(100, (scrolled / totalHeight) * 100);
        workProgress.style.height = `${progress}%`;
    }, { passive: true });

    // The CSS sticky handles the core request of sticky info with scrolling tall images.
});
