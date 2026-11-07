export function initScreenshotPreview({ document, openModal }) {
    // Open original screenshots in a keyboard-accessible, scrollable preview.
    const screenshotImage = document.getElementById('screenshot-image');
    const screenshotViewport = document.getElementById('screenshot-viewport');
    const screenshotZoom = document.getElementById('screenshot-zoom');
    const screenshotStatus = document.getElementById('screenshot-status');
    document.querySelectorAll('.screenshot-preview').forEach(link => {
        link.addEventListener('click', (event) => {
            // Preserve the browser's modified-click/open-in-new-tab behavior.
            if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
            event.preventDefault();
            document.getElementById('screenshot-title').textContent = link.dataset.previewTitle;
            document.getElementById('screenshot-original').href = link.href;
            screenshotStatus.textContent = 'Screenshot wird geladen ...';
            screenshotImage.hidden = true;
            screenshotImage.alt = `Screenshot von ${link.dataset.previewTitle}`;
            screenshotViewport.classList.remove('original-size');
            screenshotZoom.setAttribute('aria-pressed', 'false');
            screenshotZoom.textContent = 'Originalgröße';
            openModal('modal-screenshot');
            screenshotViewport.scrollTop = 0;
            screenshotViewport.scrollLeft = 0;
            screenshotImage.src = link.href;
        });
    });
    screenshotImage?.addEventListener('load', () => {
        screenshotImage.hidden = false;
        screenshotStatus.textContent = '';
    });
    screenshotImage?.addEventListener('error', () => {
        screenshotImage.hidden = true;
        screenshotStatus.textContent = 'Der Screenshot konnte nicht geladen werden. Bitte versuche „Original öffnen“.';
    });
    screenshotZoom?.addEventListener('click', () => {
        const originalSize = screenshotViewport.classList.toggle('original-size');
        screenshotZoom.setAttribute('aria-pressed', String(originalSize));
        screenshotZoom.textContent = originalSize ? 'An Breite anpassen' : 'Originalgröße';
    });

}
