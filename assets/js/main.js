document.addEventListener('DOMContentLoaded', () => {
    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    
    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'theme-light' : 'theme-dark');
    body.className = savedTheme;

    themeToggle.addEventListener('click', () => {
        if (body.classList.contains('theme-dark')) {
            body.classList.replace('theme-dark', 'theme-light');
            localStorage.setItem('theme', 'theme-light');
        } else {
            body.classList.replace('theme-light', 'theme-dark');
            localStorage.setItem('theme', 'theme-dark');
        }
    });

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

    // Work Section - Color Shift & Progress
    const workSection = document.getElementById('work');
    const workProgress = document.getElementById('work-progress');
    const projectSections = document.querySelectorAll('.project-section');
    
    const updateWork = () => {
        const rect = workSection.getBoundingClientRect();
        const totalHeight = workSection.offsetHeight;
        const scrolled = Math.max(0, -rect.top);
        const progress = Math.min(100, (scrolled / (totalHeight - window.innerHeight)) * 100);
        
        if (workProgress) workProgress.style.height = `${progress}%`;

        // Color shifting
        let activeColor = '';
        projectSections.forEach(section => {
            const sRect = section.getBoundingClientRect();
            if (sRect.top < window.innerHeight / 2 && sRect.bottom > window.innerHeight / 2) {
                activeColor = section.getAttribute('data-color');
            }
        });

        if (activeColor) {
            // Apply a subtle version of the color to the body background
            // We use an RGBA version to keep it readable and premium
            const r = parseInt(activeColor.slice(1, 3), 16);
            const g = parseInt(activeColor.slice(3, 5), 16);
            const b = parseInt(activeColor.slice(5, 7), 16);
            
            const opacity = body.classList.contains('theme-light') ? 0.08 : 0.05;
            body.style.backgroundColor = `rgba(${r}, ${g}, ${b}, ${opacity})`;
            
            // Also update the accent color variable dynamically for a "pulsing" feel
            document.documentElement.style.setProperty('--accent', activeColor);
        } else {
            body.style.backgroundColor = '';
            document.documentElement.style.removeProperty('--accent');
        }
    };

    window.addEventListener('scroll', () => requestAnimationFrame(updateWork), { passive: true });

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
});
