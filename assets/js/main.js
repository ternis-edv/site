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
    const headerOffset = 100; // Offset for the floating header

    let currentProjectIndex = 0;

    if (globalNav && prevBtn && nextBtn && projectSections.length > 0) {
        
        const getAbsoluteTop = (el) => {
            return el.getBoundingClientRect().top + window.scrollY;
        };

        const updateActiveProject = () => {
            const scrollY = window.scrollY;
            const vh = window.innerHeight;
            const center = scrollY + (vh / 2);
            
            let foundIndex = -1;

            projectSections.forEach((section, index) => {
                const top = getAbsoluteTop(section);
                const height = section.offsetHeight;
                if (center >= top && center <= top + height) {
                    foundIndex = index;
                    section.classList.add('visible');
                }
            });

            if (foundIndex !== -1) {
                currentProjectIndex = foundIndex;
            } else if (scrollY < getAbsoluteTop(projectSections[0])) {
                currentProjectIndex = 0;
            } else if (scrollY > getAbsoluteTop(projectSections[projectSections.length - 1])) {
                currentProjectIndex = projectSections.length - 1;
            }

            updateNavButtons();
        };

        const updateNavButtons = () => {
            const scrollY = window.scrollY;
            const firstTop = getAbsoluteTop(projectSections[0]) - headerOffset;
            const lastSection = projectSections[projectSections.length - 1];
            const lastBottom = getAbsoluteTop(lastSection) + lastSection.offsetHeight;

            // Before first project
            if (scrollY < firstTop + 20) {
                prevBtn.disabled = true;
                nextBtn.disabled = false;
            } 
            // After last project
            else if (scrollY > lastBottom - window.innerHeight + 50) {
                prevBtn.disabled = false;
                nextBtn.disabled = true;
            }
            // Within projects
            else {
                const currentTop = getAbsoluteTop(projectSections[currentProjectIndex]);
                
                // If at the very top of the first project, disable prev
                if (currentProjectIndex === 0 && scrollY <= currentTop - headerOffset + 20) {
                    prevBtn.disabled = true;
                } else {
                    prevBtn.disabled = false;
                }
                
                // If at the very end of the last project, disable next
                if (currentProjectIndex === projectSections.length - 1 && scrollY >= lastBottom - window.innerHeight - 20) {
                    nextBtn.disabled = true;
                } else {
                    nextBtn.disabled = false;
                }
            }
        };

        const navigate = (direction) => {
            const scrollY = window.scrollY;
            
            if (direction === 'next') {
                const firstTop = getAbsoluteTop(projectSections[0]) - headerOffset;
                if (scrollY < firstTop - 20) {
                    window.scrollTo({ top: firstTop, behavior: 'smooth' });
                } else {
                    let targetIndex = currentProjectIndex + 1;
                    // If we are currently in a project but not at its bottom, and it's very tall?
                    // No, usually we want to go to the next project's top.
                    if (targetIndex < projectSections.length) {
                        window.scrollTo({
                            top: getAbsoluteTop(projectSections[targetIndex]) - headerOffset,
                            behavior: 'smooth'
                        });
                    }
                }
            } else {
                const firstTop = getAbsoluteTop(projectSections[0]) - headerOffset;
                if (scrollY <= firstTop + 20) return; // Already at top

                const currentTop = getAbsoluteTop(projectSections[currentProjectIndex]);
                // If deep in current project, go to top of it
                if (scrollY > currentTop - headerOffset + 100) {
                    window.scrollTo({
                        top: currentTop - headerOffset,
                        behavior: 'smooth'
                    });
                } else {
                    // Go to previous project
                    let targetIndex = currentProjectIndex - 1;
                    if (targetIndex >= 0) {
                        window.scrollTo({
                            top: getAbsoluteTop(projectSections[targetIndex]) - headerOffset,
                            behavior: 'smooth'
                        });
                    }
                }
            }
        };

        window.addEventListener('scroll', updateActiveProject, { passive: true });
        // Also update on resize to recalculate absolute positions
        window.addEventListener('resize', updateActiveProject, { passive: true });
        
        updateActiveProject(); 
        
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
