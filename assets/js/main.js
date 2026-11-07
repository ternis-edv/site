import { initScreenshotPreview } from './screenshot-preview.mjs?v=4';
import { createPreferenceStorage, initAccessibility } from './accessibility.mjs';

document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const storage = createPreferenceStorage();
    const reduceMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches || body.classList.contains('a11y-reduce-motion');
    const nav = document.getElementById('nav');
    const projectSections = document.querySelectorAll('.project-section');
    const scrollBehavior = () => reduceMotion() ? 'instant' : 'smooth';

    const mobileToggle = document.getElementById('mobile-toggle');
    const navLinks = document.getElementById('nav-links');
    const mobileViewport = window.matchMedia('(max-width: 768px)');
    const setMenuOpen = (open) => {
        navLinks?.classList.toggle('active', open);
        nav?.classList.toggle('menu-open', open);
        mobileToggle?.setAttribute('aria-expanded', String(open));
        mobileToggle?.setAttribute('aria-label', open ? 'Menü schließen' : 'Menü öffnen');
        if (navLinks) navLinks.inert = mobileViewport.matches && !open;
    };
    mobileToggle?.addEventListener('click', () => {
        setMenuOpen(mobileToggle.getAttribute('aria-expanded') !== 'true');
    });
    navLinks?.addEventListener('click', (event) => {
        if (event.target.closest('a')) setMenuOpen(false);
    });
    document.addEventListener('click', (event) => {
        if (nav && !nav.contains(event.target)) setMenuOpen(false);
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && mobileToggle?.getAttribute('aria-expanded') === 'true') {
            setMenuOpen(false);
            mobileToggle.focus();
        }
    });
    mobileViewport.addEventListener('change', () => setMenuOpen(false));
    setMenuOpen(false);

    const sectionLinks = [...document.querySelectorAll('.nav-links a')];
    const updateSectionLinks = () => {
        let current = '';
        sectionLinks.forEach(link => {
            const section = document.getElementById(new URL(link.href).hash.slice(1));
            if (section && section.getBoundingClientRect().top <= 160) current = link.hash;
        });
        sectionLinks.forEach(link => {
            if (link.hash === current) link.setAttribute('aria-current', 'location');
            else link.removeAttribute('aria-current');
        });
    };
    window.addEventListener('scroll', updateSectionLinks, { passive: true });
    updateSectionLinks();

    // --- Project Visualization Scrollbar Check ---
    const updateImageWrapperOverflow = () => {
        document.querySelectorAll('.image-wrapper').forEach(wrapper => {
            const overflows = wrapper.scrollHeight > wrapper.clientHeight + 1;
            const hint = wrapper.closest('.browser-frame')?.querySelector('.screenshot-scroll-hint');
            if (hint) hint.hidden = !overflows;
            if (overflows) {
                wrapper.classList.remove('no-overflow');
            } else {
                wrapper.classList.add('no-overflow');
            }
        });
    };
    
    // Check after fonts and initial layout
    setTimeout(updateImageWrapperOverflow, 100);
    window.addEventListener('resize', updateImageWrapperOverflow, { passive: true });
    window.addEventListener('load', updateImageWrapperOverflow, { passive: true });
    document.querySelectorAll('.work-img').forEach(img => img.addEventListener('load', updateImageWrapperOverflow));
    if ('ResizeObserver' in window) {
        const imageResizeObserver = new ResizeObserver(updateImageWrapperOverflow);
        document.querySelectorAll('.image-wrapper, .native-img').forEach(element => imageResizeObserver.observe(element));
    }

    const themeToggle = document.getElementById('theme-toggle');
    const themes = ['theme-dark', 'theme-light', 'theme-nord', 'theme-midnight', 'theme-paper'];
    
    const updateProjectImages = (theme) => {
        const isLight = theme === 'theme-light' || theme === 'theme-paper';
        document.querySelectorAll('.work-img.theme-sensitive').forEach(img => {
            const newSrc = isLight ? img.getAttribute('data-light') : img.getAttribute('data-dark');
            const previewLink = img.closest('.browser-frame')?.querySelector('.screenshot-preview');
            if (previewLink) previewLink.href = img.getAttribute(isLight ? 'data-full-light' : 'data-full-dark');
            if (newSrc && img.getAttribute('src') !== newSrc) {
                img.setAttribute('src', newSrc);
            }
        });
    };

    const setTheme = (theme) => {
        body.classList.remove(...themes);
        body.classList.add(theme);
        storage.setItem('theme', theme);
        document.cookie = `theme=${theme}; path=/; max-age=31536000`;
        updateProjectImages(theme);

        // Dynamically sync the theme select dropdown in settings popover
        const settingThemeEl = document.getElementById('setting-theme');
        if (settingThemeEl && settingThemeEl.value !== theme) {
            settingThemeEl.value = theme;
        }
    };

    if (themeToggle) {
        let currentTheme = storage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'theme-light' : 'theme-dark');
        if (!themes.includes(currentTheme)) currentTheme = 'theme-dark';
        setTheme(currentTheme);

        themeToggle.addEventListener('click', (e) => {
            e.preventDefault();
            let index = themes.indexOf(storage.getItem('theme') || 'theme-dark');
            index = (index + 1) % themes.length;
            const newTheme = themes[index];
            setTheme(newTheme);
            
            // Respect both system and saved motion preferences.
            if (reduceMotion()) return;
            themeToggle.style.transform = 'scale(0.9) rotate(15deg)';
            setTimeout(() => themeToggle.style.transform = 'scale(1) rotate(0deg)', 200);
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
                    window.scrollTo({ top: firstTop, behavior: scrollBehavior() });
                } else {
                    let targetIndex = currentProjectIndex + 1;
                    // If we are currently in a project but not at its bottom, and it's very tall?
                    // No, usually we want to go to the next project's top.
                    if (targetIndex < projectSections.length) {
                        window.scrollTo({
                            top: getAbsoluteTop(projectSections[targetIndex]) - headerOffset,
                            behavior: scrollBehavior()
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
                        behavior: scrollBehavior()
                    });
                } else {
                    // Go to previous project
                    let targetIndex = currentProjectIndex - 1;
                    if (targetIndex >= 0) {
                        window.scrollTo({
                            top: getAbsoluteTop(projectSections[targetIndex]) - headerOffset,
                            behavior: scrollBehavior()
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
    let modalReturnFocus = null;
    let activeModal = null;
    const focusableElements = (container) => [...container.querySelectorAll('a[href], button, input, select, textarea, [tabindex="0"]')]
        .filter(element => !element.disabled && !element.inert && element.getClientRects().length);

    modals.forEach(modal => {
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('aria-modal', 'true');
        const heading = modal.querySelector('h2');
        if (heading) {
            if (!heading.id) heading.id = `${modal.id}-title`;
            modal.setAttribute('aria-labelledby', heading.id);
        }
    });

    const openModal = (id) => {
        const modal = document.getElementById(id);
        if (modal && overlay) {
            if (!activeModal) modalReturnFocus = document.activeElement;
            modals.forEach(item => item.classList.remove('active'));
            activeModal = modal;
            overlay.classList.add('show');
            modal.classList.add('active');
            body.classList.add('modal-open');
            [...body.children].forEach(element => {
                if (element !== overlay && element.tagName !== 'SCRIPT') element.inert = true;
            });
            focusableElements(modal)[0]?.focus();
        }
    };

    const closeModal = () => {
        screenshotPreview?.stop();
        overlay?.classList.remove('show');
        modals.forEach(m => m.classList.remove('active'));
        body.classList.remove('modal-open');
        [...body.children].forEach(element => { element.inert = false; });
        setMenuOpen(false);
        activeModal = null;
        modalReturnFocus?.focus();
    };

    document.addEventListener('keydown', (event) => {
        if (!activeModal) return;
        if (event.key === 'Escape') {
            event.preventDefault();
            if (!screenshotPreview?.exitFullscreen()) closeModal();
        } else if (event.key === 'Tab') {
            const elements = focusableElements(activeModal);
            const first = elements[0];
            const last = elements[elements.length - 1];
            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last?.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first?.focus();
            }
        }
    });

    document.getElementById('trigger-impressum')?.addEventListener('click', (e) => { 
        e.preventDefault(); 
        openModal('modal-impressum'); 
        setTimeout(() => window.dispatchEvent(new Event('render-protected-contacts')), 50);
    });
    document.getElementById('trigger-datenschutz')?.addEventListener('click', (e) => { e.preventDefault(); openModal('modal-datenschutz'); });
    document.getElementById('trigger-datenschutz-from-page')?.addEventListener('click', (e) => { e.preventDefault(); openModal('modal-datenschutz'); });
    document.getElementById('trigger-cookie-settings-from-page')?.addEventListener('click', (e) => { e.preventDefault(); openModal('modal-cookie-settings'); });
    const accessibility = initAccessibility({ document, storage, onApply: () => {
        closeModal();
        document.getElementById('ui-status').textContent = 'Einstellungen zur Barrierefreiheit übernommen.';
        window.dispatchEvent(new Event('resize'));
    } });
    document.getElementById('a11y-trigger')?.addEventListener('click', () => {
        accessibility.sync();
        openModal('modal-a11y');
    });
    document.getElementById('settings-trigger')?.addEventListener('click', () => openModal('modal-settings'));
    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));
    overlay?.addEventListener('click', (e) => { if (e.target === overlay) closeModal(); });

    const screenshotPreview = initScreenshotPreview({ document, openModal, closeModal });

    // --- Anti-Scraping Dynamic Contact Canvas System ---
    const initProtectedContacts = () => {
        const key = 0x5a;
        const data = {
            'phone': [113, 110, 99, 122, 107, 109, 111, 122, 108, 98, 111, 99, 105, 98, 107], // +49 175 6859381
            'email-info': [51, 52, 60, 53, 26, 46, 63, 40, 52, 51, 41, 119, 63, 62, 44, 116, 62, 63], // info@ternis-edv.de
            'email-edv': [63, 62, 44, 26, 46, 63, 40, 52, 51, 41, 55, 59, 51, 54, 116, 62, 63] // edv@ternismail.de
        };

        const decode = (id) => {
            const bytes = data[id];
            if (!bytes) return '';
            return bytes.map(b => String.fromCharCode(b ^ key)).join('');
        };

        const renderCanvas = (el) => {
            const id = el.getAttribute('data-protected-contact');
            const text = decode(id);
            if (!text) return;

            const fontSize = parseInt(el.getAttribute('data-font-size') || '16', 10);
            const fontFamily = el.getAttribute('data-font-family') || "'JetBrains Mono', monospace";

            let canvas = el.querySelector('canvas');
            if (!canvas) {
                canvas = document.createElement('canvas');
                canvas.setAttribute('aria-label', 'Geschützte Kontaktinformation');
                canvas.setAttribute('role', 'img');
                el.innerHTML = '';
                el.appendChild(canvas);
            }

            const ctx = canvas.getContext('2d');
            if (!ctx) return;
            const dpr = window.devicePixelRatio || 1;

            // Get live computed theme text color
            const style = getComputedStyle(document.body);
            const textColor = style.getPropertyValue('--text').trim() || '#ffffff';

            ctx.font = `500 ${fontSize}px ${fontFamily}`;
            const metrics = ctx.measureText(text);
            const width = Math.ceil(metrics.width) + 8;
            const height = Math.ceil(fontSize * 1.6);

            canvas.width = Math.round(width * dpr);
            canvas.height = Math.round(height * dpr);
            canvas.style.width = `${width}px`;
            canvas.style.height = `${height}px`;

            ctx.scale(dpr, dpr);
            ctx.clearRect(0, 0, width, height);
            ctx.font = `500 ${fontSize}px ${fontFamily}`;
            ctx.fillStyle = textColor;
            ctx.textBaseline = 'middle';
            ctx.fillText(text, 4, height / 2);
        };

        const renderAll = () => {
            document.querySelectorAll('[data-protected-contact]').forEach(renderCanvas);
        };

        renderAll();
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(renderAll);
        }
        setTimeout(renderAll, 100);
        setTimeout(renderAll, 500);

        window.addEventListener('resize', renderAll, { passive: true });
        window.addEventListener('render-protected-contacts', renderAll);

        const themeObserver = new MutationObserver(renderAll);
        themeObserver.observe(document.body, { attributes: true, attributeFilter: ['class', 'style'] });

        // Copy button handling
        document.querySelectorAll('.btn-protected-copy').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                const target = btn.getAttribute('data-target');
                const text = decode(target);
                if (!text) return;

                try {
                    await navigator.clipboard.writeText(text);
                    const originalHtml = btn.innerHTML;
                    btn.classList.add('copied');
                    btn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><polyline points="20 6 9 17 4 12"/></svg> <span>Kopiert!</span>';
                    setTimeout(() => {
                        btn.classList.remove('copied');
                        btn.innerHTML = originalHtml;
                    }, 2000);
                } catch (err) {
                    prompt('Kopieren:', text);
                }
            });
        });

        // Direct action button handling (tel / mailto)
        document.querySelectorAll('.btn-protected-action').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const target = btn.getAttribute('data-target');
                const action = btn.getAttribute('data-action');
                const text = decode(target);
                if (!text) return;

                if (action === 'call') {
                    const cleanPhone = text.replace(/[^0-9+]/g, '');
                    window.location.href = `tel:${cleanPhone}`;
                } else if (action === 'mail') {
                    window.location.href = `mailto:${text}`;
                }
            });
        });
    };

    initProtectedContacts();

    // --- Settings Management ---
    const settingTheme = document.getElementById('setting-theme');
    const settingRadius = document.getElementById('setting-radius');
    const settingsSave = document.getElementById('settings-save');

    if (settingTheme && settingRadius && settingsSave) {
        // Init values
        const currentTheme = storage.getItem('theme') || 'theme-dark';
        const currentRadius = storage.getItem('radius-factor') || '1';
        
        settingTheme.value = currentTheme;
        settingRadius.value = currentRadius;
        document.documentElement.style.setProperty('--radius-factor', currentRadius);

        // Realtime theme change on select dropdown change
        settingTheme.addEventListener('change', () => {
            setTheme(settingTheme.value);
        });

        settingsSave.addEventListener('click', () => {
            setTheme(settingTheme.value);
            const radius = settingRadius.value;
            storage.setItem('radius-factor', radius);
            document.documentElement.style.setProperty('--radius-factor', radius);
            closeModal();
        });

        // Realtime radius preview
        settingRadius.addEventListener('input', () => {
            document.documentElement.style.setProperty('--radius-factor', settingRadius.value);
        });
    }

    // Mascot Footer Movement
    const mascot = document.querySelector('.footer-mascot');
    const eyes = document.querySelectorAll('.mascot-eye');
    if (mascot && eyes.length > 0) {
        document.addEventListener('mousemove', (e) => {
            if (reduceMotion()) return;
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
            if (reduceMotion()) return;
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

    backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: scrollBehavior() }));

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
