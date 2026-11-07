const options = {
    'a11y-contrast': 'high-contrast',
    'a11y-font': 'a11y-large-text',
    'a11y-reduce-motion': 'a11y-reduce-motion',
    'a11y-highlight-links': 'a11y-highlight-links',
    'a11y-dyslexia-font': 'a11y-dyslexia-font',
};

// Keep controls usable when browser privacy settings disable local storage.
export function createPreferenceStorage(getStorage = () => window.localStorage) {
    const memory = new Map();
    return {
        getItem(key) {
            try { return getStorage().getItem(key) ?? memory.get(key) ?? null; }
            catch { return memory.get(key) ?? null; }
        },
        setItem(key, value) {
            memory.set(key, String(value));
            try { getStorage().setItem(key, String(value)); } catch { /* Session-only preferences. */ }
        },
    };
}

export function initAccessibility({ document, storage, onApply }) {
    const key = 'accessibility-preferences';
    let saved = {};
    try { saved = JSON.parse(storage.getItem(key)) || {}; } catch { /* Use defaults. */ }
    const controls = Object.keys(options).map(id => [id, document.getElementById(id)]);
    const sync = () => controls.forEach(([id, input]) => {
        if (input) input.checked = saved[id] === true;
    });
    const apply = () => {
        for (const [id, className] of Object.entries(options)) {
            document.body.classList.toggle(className, saved[id] === true);
        }
        document.documentElement.classList.toggle('a11y-large-text', saved['a11y-font'] === true);
        document.documentElement.classList.toggle('a11y-reduce-motion', saved['a11y-reduce-motion'] === true);
    };
    const save = () => {
        saved = Object.fromEntries(controls.map(([id, input]) => [id, input?.checked === true]));
        storage.setItem(key, JSON.stringify(saved));
        apply();
        onApply();
    };
    sync();
    apply();
    document.getElementById('a11y-save')?.addEventListener('click', save);
    document.getElementById('a11y-reset')?.addEventListener('click', () => {
        controls.forEach(([, input]) => { if (input) input.checked = false; });
        save();
    });
    return { sync };
}
