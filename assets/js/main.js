document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const nav = document.getElementById('nav');
    const projectSections = document.querySelectorAll('.project-section');

    // --- Theme Management & Image Swapping ---
    const themeToggle = document.getElementById('theme-toggle');
    
    const updateProjectImages = (theme) => {
        document.querySelectorAll('.work-img.theme-sensitive').forEach(img => {
            const newSrc = theme === 'theme-light' ? img.getAttribute('data-light') : img.getAttribute('data-dark');
            if (newSrc && img.getAttribute('src') !== newSrc) {
                img.setAttribute('src', newSrc);
            }
        });
    };

    const setTheme = (theme) => {
        body.classList.remove('theme-dark', 'theme-light');
        body.classList.add(theme);
        localStorage.setItem('theme', theme);
        // Set cookie for PHP synchronization (optional but helpful)
        document.cookie = `theme=${theme}; path=/; max-age=31536000`;
        updateProjectImages(theme);
    };

    if (themeToggle) {
        const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'theme-light' : 'theme-dark');
        setTheme(savedTheme);

        themeToggle.addEventListener('click', (e) => {
            e.preventDefault();
            const newTheme = body.classList.contains('theme-dark') ? 'theme-light' : 'theme-dark';
            setTheme(newTheme);
        });
    }

    // --- Project Navigation (Variable Height Support) ---
    const globalNav = document.querySelector('.global-project-nav');
    const prevBtn = globalNav?.querySelector('.prev-btn');
    const nextBtn = globalNav?.querySelector('.next-btn');

    if (globalNav && prevBtn && nextBtn && projectSections.length > 0) {
        
        const updateNavButtons = () => {
            const scrollY = window.scrollY;
            const vh = window.innerHeight;
            const center = scrollY + (vh / 2);

            let firstTop = projectSections[0].offsetTop;
            let lastBottom = projectSections[projectSections.length - 1].offsetTop + projectSections[projectSections.length - 1].offsetHeight;

            // Simple disable/enable based on global work section visibility
            prevBtn.disabled = scrollY < firstTop;
            nextBtn.disabled = scrollY + vh > lastBottom;
        };

        const navigate = (direction) => {
            const scrollY = window.scrollY;
            const vh = window.innerHeight;
            const center = scrollY + (vh / 2);
            
            let targetSection = null;

            if (direction === 'next') {
                // Find the first section whose top is clearly below the current "active" center
                for (let i = 0; i < projectSections.length; i++) {
                    if (projectSections[i].offsetTop > center + 10) {
                        targetSection = projectSections[i];
                        break;
                    }
                }
            } else {
                // Find the last section whose top is clearly above the current "active" center
                for (let i = projectSections.length - 1; i >= 0; i--) {
                    if (projectSections[i].offsetTop < center - 10) {
                        targetSection = projectSections[i];
                        break;
                    }
                }
            }

            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop,
                    behavior: 'smooth'
                });
            }
        };

        window.addEventListener('scroll', updateNavButtons, { passive: true });
        updateNavButtons(); // Initial

        nextBtn.addEventListener('click', (e) => { e.preventDefault(); navigate('next'); });
        prevBtn.addEventListener('click', (e) => { e.preventDefault(); navigate('prev'); });
    }

    // --- Rest of UI (Modals, Mascot, etc.) ---

    // Modals
    const overlay = document.getElementById('modal-overlay');
    const modals = document.querySelectorAll('.modal-content');
    const closeButtons = document.querySelectorAll('.modal-close');

    const openModal = (id) => {
        const modal = document.getElementById(id);
        if (modal && overlay) {
            overlay.classList.add('show');
            modal.classList.add('active');
            body.classList.add('modal-open');
        }
    };

    const closeModal = () => {
        overlay?.classList.remove('show');
        modals.forEach(m => m.classList.remove('active'));
        body.classList.remove('modal-open');
    };

    document.getElementById('trigger-impressum')?.addEventListener('click', (e) => { e.preventDefault(); openModal('modal-impressum'); });
    document.getElementById('trigger-datenschutz')?.addEventListener('click', (e) => { e.preventDefault(); openModal('modal-datenschutz'); });
    document.getElementById('a11y-trigger')?.addEventListener('click', () => openModal('modal-a11y'));
    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));
    overlay?.addEventListener('click', (e) => { if (e.target === overlay) closeModal(); });

    // Mascot Footer Movement
    const mascot = document.querySelector('.footer-mascot');
    const eyes = document.querySelectorAll('.mascot-eye');
    if (mascot && eyes.length > 0) {
        document.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            eyes.forEach(eye => {
                const rect = eye.getBoundingClientRect();
                const eyeX = rect.left + rect.width / 2;
                const eyeY = rect.top + rect.height / 2;
                const angle = Math.atan2(clientY - eyeY, clientX - eyeX);
                const distance = Math.min(rect.width / 4, Math.hypot(clientX - eyeX, clientY - eyeY) / 10);
                eye.style.setProperty('--eye-x', `${Math.cos(angle) * distance}px`);
                eye.style.setProperty('--eye-y', `${Math.sin(angle) * distance}px`);
            });
        });
    }

    // Magnetic
    const magneticElements = document.querySelectorAll('.mag-link, .footer-mascot');
    magneticElements.forEach(el => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            const multiplier = el.classList.contains('footer-mascot') ? 0.1 : 0.4;
            el.style.transform = `translate(${x * multiplier}px, ${y * multiplier}px) ${el.classList.contains('footer-mascot') ? 'rotate(-3deg) scale(1.05)' : ''}`;
        });
        el.addEventListener('mouseleave', () => el.style.transform = 'translate(0, 0)');
    });

    // Global Scroll logic (Progress, Nav state)
    const backToTop = document.getElementById('back-to-top');
    const pageProgress = document.getElementById('page-progress');
    const workSection = document.getElementById('work');

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        nav?.classList.toggle('scrolled', scrollY > 50);
        if (backToTop) backToTop.classList.toggle('show', scrollY > 800);

        if (pageProgress) {
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            pageProgress.style.width = `${docHeight > 0 ? (scrollY / docHeight) * 100 : 0}%`;
        }

        // Section Background Color
        if (workSection && projectSections.length > 0) {
            const center = scrollY + (window.innerHeight / 2);
            let activeProj = null;
            projectSections.forEach(s => {
                const top = s.offsetTop;
                if (center >= top && center <= top + s.offsetHeight) activeProj = s;
            });
            if (activeProj) {
                const color = activeProj.getAttribute('data-color');
                const isDark = body.classList.contains('theme-dark');
                if (color) {
                    const r = parseInt(color.slice(1,3), 16), g = parseInt(color.slice(3,5), 16), b = parseInt(color.slice(5,7), 16);
                    workSection.style.backgroundColor = `rgba(${r}, ${g}, ${b}, ${isDark ? '0.08' : '0.05'})`;
                }
                activeProj.classList.add('visible');
            } else {
                workSection.style.backgroundColor = 'var(--bg)';
            }
        }
    }, { passive: true });

    backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // Reveals
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
});
