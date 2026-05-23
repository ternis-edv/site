document.addEventListener('DOMContentLoaded', () => {
    // Determine scrollbar width to prevent layout shift during modal open
    const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
    document.documentElement.style.setProperty('--scrollbar-width', `${scrollbarWidth}px`);

    const body = document.body;

    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'theme-light' : 'theme-dark');
    body.classList.remove('theme-dark', 'theme-light');
    body.classList.add(savedTheme);

    themeToggle.addEventListener('click', () => {
        const isDark = body.classList.contains('theme-dark');
        body.classList.replace(isDark ? 'theme-dark' : 'theme-light', isDark ? 'theme-light' : 'theme-dark');
        localStorage.setItem('theme', isDark ? 'theme-light' : 'theme-dark');
    });

    // Mobile Menu Logic
    const mobileToggle = document.getElementById('mobile-toggle');
    const navLinks = document.getElementById('nav-links');

    mobileToggle.addEventListener('click', () => {
        const isExpanded = mobileToggle.getAttribute('aria-expanded') === 'true';
        mobileToggle.setAttribute('aria-expanded', !isExpanded);
        navLinks.classList.toggle('active');
        body.classList.toggle('menu-open');
    });

    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            mobileToggle.setAttribute('aria-expanded', 'false');
            navLinks.classList.remove('active');
            body.classList.remove('menu-open');
        });
    });

    // Modals
    const overlay = document.getElementById('modal-overlay');
    const modals = document.querySelectorAll('.modal-content');
    const closeButtons = document.querySelectorAll('.modal-close');

    const openModal = (id) => {
        const modal = document.getElementById(id);
        overlay.classList.add('show');
        modal.classList.add('active');
        body.classList.add('modal-open');
    };

    const closeModal = () => {
        overlay.classList.remove('show');
        modals.forEach(m => m.classList.remove('active'));
        body.classList.remove('modal-open');
    };

    document.getElementById('trigger-impressum').addEventListener('click', (e) => { e.preventDefault(); openModal('modal-impressum'); });
    document.getElementById('trigger-datenschutz').addEventListener('click', (e) => { e.preventDefault(); openModal('modal-datenschutz'); });
    document.getElementById('a11y-trigger').addEventListener('click', () => openModal('modal-a11y'));

    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));
    overlay.addEventListener('click', (e) => { if (e.target === overlay) closeModal(); });

    // Accessibility: ESC to close modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.classList.contains('show')) closeModal();
    });

    // Cookie Consent
    const consent = document.getElementById('cookie-consent');
    const ccAcceptAll = document.getElementById('cc-accept-all');
    const ccSettingsTrigger = document.getElementById('cc-settings-trigger');

    if (!localStorage.getItem('cc-choice')) {
        setTimeout(() => consent.classList.add('show'), 1500);
    }

    ccAcceptAll.addEventListener('click', () => {
        localStorage.setItem('cc-choice', 'all');
        consent.classList.remove('show');
    });

    ccSettingsTrigger.addEventListener('click', () => {
        consent.classList.remove('show');
        openModal('modal-cookie-settings');
    });

    document.getElementById('cc-save-settings').addEventListener('click', () => {
        const analytics = document.getElementById('cc-analytics').checked;
        localStorage.setItem('cc-choice', analytics ? 'custom' : 'essential');
        closeModal();
    });

    // Accessibility
    const a11yContrast = document.getElementById('a11y-contrast');
    const a11yFont = document.getElementById('a11y-font');
    const a11yReduceMotion = document.getElementById('a11y-reduce-motion');
    const a11yHighlightLinks = document.getElementById('a11y-highlight-links');
    const a11yDyslexiaFont = document.getElementById('a11y-dyslexia-font');

    if (localStorage.getItem('a11y-contrast') === 'true') {
        a11yContrast.checked = true;
        body.classList.add('high-contrast');
    }
    if (localStorage.getItem('a11y-font') === 'true') {
        a11yFont.checked = true;
        document.documentElement.style.setProperty('--font-scale', '1.15');
    }
    if (localStorage.getItem('a11y-reduce-motion') === 'true') {
        a11yReduceMotion.checked = true;
        body.classList.add('a11y-reduce-motion');
    }
    if (localStorage.getItem('a11y-highlight-links') === 'true') {
        a11yHighlightLinks.checked = true;
        body.classList.add('a11y-highlight-links');
    }
    if (localStorage.getItem('a11y-dyslexia-font') === 'true') {
        a11yDyslexiaFont.checked = true;
        body.classList.add('a11y-dyslexia-font');
    }

    document.getElementById('a11y-save').addEventListener('click', () => {
        const contrast = a11yContrast.checked;
        const font = a11yFont.checked;
        const reduceMotion = a11yReduceMotion.checked;
        const highlightLinks = a11yHighlightLinks.checked;
        const dyslexiaFont = a11yDyslexiaFont.checked;

        localStorage.setItem('a11y-contrast', contrast);
        localStorage.setItem('a11y-font', font);
        localStorage.setItem('a11y-reduce-motion', reduceMotion);
        localStorage.setItem('a11y-highlight-links', highlightLinks);
        localStorage.setItem('a11y-dyslexia-font', dyslexiaFont);

        body.classList.toggle('high-contrast', contrast);
        document.documentElement.style.setProperty('--font-scale', font ? '1.15' : '1');
        body.classList.toggle('a11y-reduce-motion', reduceMotion);
        body.classList.toggle('a11y-highlight-links', highlightLinks);
        body.classList.toggle('a11y-dyslexia-font', dyslexiaFont);

        closeModal();
    });

    // Footer Time
    const timeEl = document.getElementById('current-time');
    if (timeEl) {
        const updateTime = () => {
            const now = new Date();
            timeEl.textContent = now.toLocaleTimeString('de-DE', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' — Germany';
        };
        setInterval(updateTime, 1000);
        updateTime();
    }

    // Mascot Eye Movement
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
                const moveX = Math.cos(angle) * distance;
                const moveY = Math.sin(angle) * distance;
                eye.style.setProperty('--eye-x', `${moveX}px`);
                eye.style.setProperty('--eye-y', `${moveY}px`);
            });
        });
    }

    // Magnetic Elements
    const magneticElements = document.querySelectorAll('.footer-mail-v2, .footer-list a, .error-actions a');
    magneticElements.forEach(el => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            const multiplier = el.classList.contains('f-large-text') ? 0.1 : 0.4;
            el.style.transform = `translate(${x * multiplier}px, ${y * multiplier}px)`;
        });
        
        el.addEventListener('mouseleave', () => {
            el.style.transform = 'translate(0, 0)';
        });
    });

    // Horizontal Scroll Hijacking Setup
    const workScrollTrack = document.getElementById('work-scroll-track');
    const workScrollContainer = document.getElementById('work-scroll-container');

    const initHorizontalScroll = () => {
        if (!workScrollTrack || !workScrollContainer) return;

        if (window.innerWidth > 1024) {
            const containerWidth = workScrollContainer.scrollWidth;
            // The height of the track equals the horizontal scroll distance plus viewport height
            const trackHeight = containerWidth - window.innerWidth + window.innerHeight;
            workScrollTrack.style.height = `${trackHeight}px`;
        } else {
            workScrollTrack.style.height = 'auto';
        }
    };

    // Initialize and handle resizes
    if (workScrollTrack && workScrollContainer) {
        initHorizontalScroll();
        window.addEventListener('resize', initHorizontalScroll);
    }

    // Scroll Logic (Performance Optimized)
    const nav = document.getElementById('nav');
    const backToTop = document.getElementById('back-to-top');
    const workSection = document.getElementById('work');
    const projectSections = document.querySelectorAll('.project-section');
    const pageProgress = document.getElementById('page-progress');
    
    let ticking = false;

    const onScroll = () => {
        const scrollY = window.scrollY;

        // Nav & BackToTop
        nav.classList.toggle('scrolled', scrollY > 50);
        if (backToTop) backToTop.classList.toggle('show', scrollY > 800);

        // Global Page Progress
        if (pageProgress) {
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = docHeight > 0 ? (scrollY / docHeight) * 100 : 0;
            pageProgress.style.width = `${scrollPercent}%`;
        }

        // Horizontal Scroll Translation
        if (workScrollTrack && workScrollContainer && window.innerWidth > 1024) {
            const trackRect = workScrollTrack.getBoundingClientRect();
            // Start scrolling horizontally when the track reaches the top of the viewport
            if (trackRect.top <= 0 && trackRect.bottom >= window.innerHeight) {
                const scrollProgress = -trackRect.top;
                workScrollContainer.style.transform = `translateX(-${scrollProgress}px)`;
            } else if (trackRect.top > 0) {
                workScrollContainer.style.transform = `translateX(0px)`;
            } else if (trackRect.bottom < window.innerHeight) {
                const maxScroll = workScrollContainer.scrollWidth - window.innerWidth;
                workScrollContainer.style.transform = `translateX(-${maxScroll}px)`;
            }
        } else if (workScrollContainer) {
            workScrollContainer.style.transform = `none`;
        }

        // Project Background Transition
        if (workSection) {
            let activeProject = null;

            if (window.innerWidth > 1024 && workScrollTrack) {
                const threshold = window.innerWidth * 0.4;
                projectSections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    // On desktop, elements translate horizontally
                    if (rect.left <= threshold && rect.right >= threshold) {
                        activeProject = section;
                    }
                });
            } else {
                const threshold = window.innerHeight * 0.4;
                projectSections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    if (rect.top <= threshold && rect.bottom >= threshold) {
                        activeProject = section;
                    }
                });
            }

            if (activeProject) {
                const color = activeProject.getAttribute('data-color');
                const isDark = body.classList.contains('theme-dark');
                if (color) {
                    workSection.style.backgroundColor = isDark ? `rgba(${hexToRgb(color)}, 0.05)` : `rgba(${hexToRgb(color)}, 0.03)`;
                }
            } else {
                workSection.style.backgroundColor = 'var(--bg)';
            }
        }

        ticking = false;
    };

    function hexToRgb(hex) {
        const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? `${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)}` : '0,0,0';
    }

    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(onScroll);
            ticking = true;
        }
    }, { passive: true });

    backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all other items (optional, depending on preference)
            faqItems.forEach(otherItem => otherItem.classList.remove('active'));

            if (!isActive) {
                item.classList.add('active');
            }
        });
    });

    // Reveals
    const revealElements = document.querySelectorAll('.reveal, .project-section');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { 
        threshold: 0.05,
        rootMargin: '0px 0px -20px 0px' 
    });

    const checkReveals = () => {
        revealElements.forEach(el => {
            if (!el.classList.contains('visible')) {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 20) {
                    el.classList.add('visible');
                    revealObserver.unobserve(el);
                }
            }
        });
    };

    revealElements.forEach(el => revealObserver.observe(el));
    
    // Initial check for elements already in view (especially when landing on anchor)
    setTimeout(checkReveals, 100);
    window.addEventListener('load', checkReveals);
});
