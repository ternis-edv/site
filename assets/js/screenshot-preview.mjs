export function viewerRoute(project, address) {
    const url = new URL(address);
    return `/viewer/${encodeURIComponent(project)}${url.pathname}${url.search}${url.hash}`;
}

export function initScreenshotPreview({ document, openModal, window = globalThis.window, closeModal = () => {} }) {
    const get = id => document.getElementById(id);
    const image = get('screenshot-image');
    if (!image) return;
    const viewport = get('screenshot-viewport');
    const status = get('screenshot-status');
    const frame = get('website-frame');
    const select = get('screenshot-project');
    const links = [...document.querySelectorAll('.screenshot-preview')];
    let current = 0;
    let mode = 'website';
    let address = '';
    let immersive = false;
    const modal = get('modal-screenshot');
    const landingUrl = window && !window.location.pathname.startsWith('/viewer/') ? window.location.pathname + window.location.search + window.location.hash : '/#work';
    const hasWebsite = link => /^https:\/\//.test(link.dataset.previewLive || '');

    links.forEach((link, index) => {
        const option = document.createElement('option');
        option.value = String(index);
        option.textContent = link.dataset.previewTitle;
        select.append(option);
        link.addEventListener('click', event => {
            if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
            event.preventDefault();
            current = index;
            mode = hasWebsite(link) ? 'website' : 'screenshot';
            address = link.dataset.previewLive || '';
            render();
            syncRoute();
            openModal('modal-screenshot');
        });
    });

    function navigateFrame(src) {
        // Replacing iframe history keeps Back/Forward tied to the public viewer routes.
        try {
            if (frame.contentWindow) { frame.contentWindow.location.replace(src); return; }
        } catch { /* Fall back when a browser blocks cross-origin Location.replace. */ }
        frame.src = src;
    }

    function render() {
        const link = links[current];
        if (!link) return;
        if (!hasWebsite(link)) mode = 'screenshot';
        const website = mode === 'website';
        get('screenshot-title').textContent = link.dataset.previewTitle;
        get('screenshot-address').textContent = address || link.dataset.previewAddress || link.dataset.previewTitle;
        get('screenshot-counter').textContent = `${current + 1} / ${links.length}`;
        get('screenshot-live').hidden = !hasWebsite(link);
        get('screenshot-live').href = hasWebsite(link) ? address : '';
        get('screenshot-prev').disabled = current === 0;
        get('screenshot-next').disabled = current === links.length - 1;
        get('preview-website').disabled = !hasWebsite(link);
        get('preview-website').setAttribute('aria-pressed', String(website));
        get('preview-screenshot').setAttribute('aria-pressed', String(!website));
        get('preview-caption').textContent = website ? 'HTML-Vorschau · Bei Darstellungsproblemen Screenshot wählen' : 'Gespeicherte Vorschau · Immer an die Breite angepasst';
        select.value = String(current);
        frame.hidden = !website;
        viewport.hidden = website;
        viewport.scrollTop = 0;
        viewport.scrollLeft = 0;
        status.textContent = website ? 'Website wird geladen …' : 'Screenshot wird geladen …';
        image.hidden = true;
        navigateFrame(website ? `/preview?project=${encodeURIComponent(link.dataset.previewId)}&url=${encodeURIComponent(address || link.dataset.previewLive)}${new URL(address || link.dataset.previewLive).hash}` : 'about:blank');
        if (!website) {
            image.alt = `Screenshot von ${link.dataset.previewTitle}`;
            image.src = link.href;
        }
    }
    function syncRoute(replace = false) {
        const link = links[current];
        if (!window || !link) return;
        const route = hasWebsite(link) ? viewerRoute(link.dataset.previewId, address || link.dataset.previewLive) : `/viewer/${encodeURIComponent(link.dataset.previewId)}/`;
        const currentRoute = window.location.pathname + window.location.search + window.location.hash;
        if (route !== currentRoute) window.history[replace ? 'replaceState' : 'pushState']({}, '', route);
    }
    function choose(index) {
        if (!links[index]) return;
        current = index;
        address = links[index].dataset.previewLive || '';
        render();
        syncRoute();
    }
    get('screenshot-prev')?.addEventListener('click', () => { if (current > 0) choose(current - 1); });
    get('screenshot-next')?.addEventListener('click', () => { if (current < links.length - 1) choose(current + 1); });
    select?.addEventListener('change', () => choose(Number(select.value)));
    get('preview-website')?.addEventListener('click', () => { mode = 'website'; render(); });
    get('preview-screenshot')?.addEventListener('click', () => { mode = 'screenshot'; render(); });
    frame?.addEventListener('load', () => { if (!frame.hidden) status.textContent = ''; });
    image.addEventListener('load', () => {
        if (mode !== 'screenshot') return;
        image.hidden = false;
        status.textContent = '';
    });
    image.addEventListener('error', () => {
        if (mode !== 'screenshot') return;
        image.hidden = true;
        status.textContent = 'Der Screenshot konnte nicht geladen werden. Bitte versuche es später erneut.';
    });
    function setImmersive(value) {
        immersive = value;
        modal?.classList.toggle('is-immersive', value);
        get('modal-overlay')?.classList.toggle('viewer-immersive', value);
        const button = get('viewer-fullscreen');
        button?.setAttribute('aria-pressed', String(value));
        button?.setAttribute('aria-label', value ? 'Vollbildmodus verlassen' : 'Vollbildmodus öffnen');
        button?.setAttribute('title', value ? 'Vollbildmodus verlassen' : 'Vollbildmodus');
        const enter = button?.querySelector?.('.fullscreen-enter');
        const exit = button?.querySelector?.('.fullscreen-exit');
        if (enter) enter.hidden = value;
        if (exit) exit.hidden = !value;
    }
    function exitFullscreen() {
        if (!immersive) return false;
        setImmersive(false);
        if (document.fullscreenElement) document.exitFullscreen?.().catch(() => {});
        return true;
    }
    get('viewer-fullscreen')?.addEventListener('click', () => {
        if (exitFullscreen()) return;
        setImmersive(true);
        modal?.requestFullscreen?.().catch(() => {});
    });
    document.addEventListener?.('fullscreenchange', () => {
        if (!document.fullscreenElement) setImmersive(false);
    });
    function restoreRoute() {
        if (!window) return;
        const match = window.location.pathname.match(/^\/viewer\/([^/]+)(\/.*)?$/);
        if (!match) { closeModal(); return; }
        const index = links.findIndex(link => link.dataset.previewId === match[1]);
        if (index < 0) return;
        current = index;
        const link = links[current];
        address = hasWebsite(link) ? new URL(new URL(link.dataset.previewLive).origin + (match[2] || '/') + window.location.search + window.location.hash).href : '';
        mode = hasWebsite(link) ? 'website' : 'screenshot';
        render();
        openModal('modal-screenshot');
    }
    window?.addEventListener('message', event => {
        if (event.source !== frame.contentWindow || !['viewer:navigate', 'viewer:loaded'].includes(event.data?.type)) return;
        const index = links.findIndex(link => link.dataset.previewId === event.data.project && hasWebsite(link));
        if (index < 0 || typeof event.data.url !== 'string' || event.data.url.length > 4096) return;
        let url;
        try { url = new URL(event.data.url); } catch { return; }
        const host = new URL(links[index].dataset.previewLive).hostname.replace(/^www\./, '');
        if (url.protocol !== 'https:' || url.username || url.password || url.port || ![host, `www.${host}`].includes(url.hostname)) return;
        if (frame.hidden) return;
        if (event.data.type === 'viewer:loaded' && index !== current) return;
        current = index;
        address = url.href;
        if (event.data.type === 'viewer:navigate') render();
        else {
            get('screenshot-address').textContent = address;
            get('screenshot-live').href = address;
        }
        syncRoute(event.data.type === 'viewer:loaded');
    });
    window?.addEventListener('popstate', restoreRoute);
    if (window?.location.pathname.startsWith('/viewer/')) restoreRoute();
    return {
        exitFullscreen,
        stop() {
            exitFullscreen();
            navigateFrame('about:blank');
            status.textContent = '';
            document.body?.classList.remove('viewer-route');
            if (window?.location.pathname.startsWith('/viewer/')) window.history.replaceState({}, '', landingUrl);
        },
    };
}
