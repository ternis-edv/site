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

    // Nav Scroll Effect
    const nav = document.getElementById('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    }, { passive: true });

    // Reveal Animations
    const revealElements = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // revealObserver.unobserve(entry.target); // Optional: keep animating or once?
            }
        });
    }, { threshold: 0.1 });

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
