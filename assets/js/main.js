document.addEventListener('DOMContentLoaded', () => {
    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    
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

    // Cookie Consent Rework
    const consent = document.getElementById('cookie-consent');
    const ccAccept = document.getElementById('cc-accept');
    const ccAcceptAll = document.getElementById('cc-accept-all');

    if (!localStorage.getItem('cc-choice')) {
        setTimeout(() => consent.classList.add('show'), 1500);
    }

    ccAccept.addEventListener('click', () => {
        const analytics = document.getElementById('cc-analytics').checked;
        localStorage.setItem('cc-choice', analytics ? 'custom' : 'essential');
        consent.classList.remove('show');
    });

    ccAcceptAll.addEventListener('click', () => {
        localStorage.setItem('cc-choice', 'all');
        consent.classList.remove('show');
    });

    // Legal Modals
    const overlay = document.getElementById('modal-overlay');
    const modalImpressum = document.getElementById('modal-impressum');
    const modalDatenschutz = document.getElementById('modal-datenschutz');
    const openImpressum = document.getElementById('open-impressum');
    const openDatenschutz = document.getElementById('open-datenschutz');
    const closeButtons = document.querySelectorAll('.modal-close');

    const openModal = (modal) => {
        overlay.classList.add('show');
        modal.classList.add('active');
        body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        overlay.classList.remove('show');
        modalImpressum.classList.remove('active');
        modalDatenschutz.classList.remove('active');
        body.style.overflow = '';
    };

    openImpressum.addEventListener('click', (e) => { e.preventDefault(); openModal(modalImpressum); });
    openDatenschutz.addEventListener('click', (e) => { e.preventDefault(); openModal(modalDatenschutz); });
    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));
    overlay.addEventListener('click', (e) => { if (e.target === overlay) closeModal(); });

    // Nav Scroll Effect
    const nav = document.getElementById('nav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 50);
    }, { passive: true });

    // Back to Top
    const backToTop = document.getElementById('back-to-top');
    window.addEventListener('scroll', () => {
        backToTop.classList.toggle('show', window.scrollY > 800);
    }, { passive: true });

    backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

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

        let activeColor = '';
        projectSections.forEach(section => {
            const sRect = section.getBoundingClientRect();
            if (sRect.top < window.innerHeight / 2 && sRect.bottom > window.innerHeight / 2) {
                activeColor = section.getAttribute('data-color');
            }
        });

        if (activeColor) {
            const r = parseInt(activeColor.slice(1, 3), 16);
            const g = parseInt(activeColor.slice(3, 5), 16);
            const b = parseInt(activeColor.slice(5, 7), 16);
            const opacity = body.classList.contains('theme-light') ? 0.05 : 0.03;
            body.style.backgroundColor = `rgba(${r}, ${g}, ${b}, ${opacity})`;
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
    }, { threshold: 0.1 });

    revealElements.forEach(el => revealObserver.observe(el));
});
