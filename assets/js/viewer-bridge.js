// Runs in the opaque-origin preview, never with access to the parent document.
(() => {
    const config = JSON.parse(document.currentScript.dataset.viewer);
    const allowed = url => config.projects.find(project => {
        const host = new URL(project.link).hostname.replace(/^www\./, '');
        return url.protocol === 'https:' && !url.username && !url.password && !url.port
            && [host, `www.${host}`].includes(url.hostname);
    });
    const send = (type, project, url) => parent.postMessage({ type, project, url }, config.origin);
    send('viewer:loaded', config.project, config.url);
    document.addEventListener('click', event => {
        const anchor = event.target.closest?.('a');
        if (!anchor || event.button !== 0) return;
        if (!anchor.dataset.viewerUrl && !anchor.getAttribute('href')) return;
        let url;
        try { url = new URL(anchor.dataset.viewerUrl || anchor.getAttribute('href'), config.url); }
        catch { return; }
        const project = allowed(url);
        event.preventDefault();
        event.stopImmediatePropagation();
        if (!project) return;
        send('viewer:navigate', project.id, url.href);
    }, true);
})();
