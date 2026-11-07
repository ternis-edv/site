export function initScreenshotPreview({ document, openModal }) {
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
            render();
            openModal('modal-screenshot');
        });
    });

    function render() {
        const link = links[current];
        if (!link) return;
        if (!hasWebsite(link)) mode = 'screenshot';
        const website = mode === 'website';
        get('screenshot-title').textContent = link.dataset.previewTitle;
        get('screenshot-address').textContent = link.dataset.previewAddress || link.dataset.previewTitle;
        get('screenshot-counter').textContent = `${current + 1} / ${links.length}`;
        get('screenshot-original').href = link.href;
        get('screenshot-live').hidden = !hasWebsite(link);
        get('screenshot-live').href = hasWebsite(link) ? link.dataset.previewLive : '';
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
        frame.src = website ? `/preview?project=${encodeURIComponent(link.dataset.previewId)}` : 'about:blank';
        if (!website) {
            image.alt = `Screenshot von ${link.dataset.previewTitle}`;
            image.src = link.href;
        }
    }
    get('screenshot-prev')?.addEventListener('click', () => { if (current > 0) { current--; render(); } });
    get('screenshot-next')?.addEventListener('click', () => { if (current < links.length - 1) { current++; render(); } });
    select?.addEventListener('change', () => { current = Number(select.value); render(); });
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
        status.textContent = 'Der Screenshot konnte nicht geladen werden. Bitte versuche „Original öffnen“.';
    });
    return { stop() { frame.src = 'about:blank'; status.textContent = ''; } };
}
