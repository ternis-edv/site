import test from 'node:test';
import assert from 'node:assert/strict';
import { createPreferenceStorage, initAccessibility } from '../assets/js/accessibility.mjs';
import { initScreenshotPreview } from '../assets/js/screenshot-preview.mjs';

class Element {
    constructor() {
        this.listeners = new Map();
        this.attributes = new Map();
        const classes = new Set();
        this.classList = {
            contains: name => classes.has(name),
            remove: name => classes.delete(name),
            toggle(name, force = !classes.has(name)) {
                if (force) classes.add(name); else classes.delete(name);
                return force;
            },
        };
        this.checked = false;
        this.dataset = {};
    }
    addEventListener(name, callback) { this.listeners.set(name, callback); }
    fire(name, event = {}) { this.listeners.get(name)?.(event); }
    setAttribute(name, value) { this.attributes.set(name, value); }
    getAttribute(name) { return this.attributes.get(name); }
}
const ids = ['a11y-contrast', 'a11y-font', 'a11y-reduce-motion', 'a11y-highlight-links', 'a11y-dyslexia-font'];
function settingsFixture(storage = createPreferenceStorage(() => { throw new Error('Storage blocked'); })) {
    const elements = Object.fromEntries([...ids, 'a11y-save', 'a11y-reset'].map(id => [id, new Element()]));
    const document = { body: new Element(), documentElement: new Element(), getElementById: id => elements[id] };
    let applied = 0;
    const controller = initAccessibility({ document, storage, onApply: () => applied++ });
    return { elements, document, storage, controller, applied: () => applied };
}

test('Apply persists every option and restores it in a new page', () => {
    const first = settingsFixture();
    ids.forEach(id => { first.elements[id].checked = true; });
    first.elements['a11y-save'].fire('click');
    assert.equal(first.applied(), 1);
    const restored = settingsFixture(first.storage);
    ids.forEach(id => assert.equal(restored.elements[id].checked, true));
    for (const name of ['high-contrast', 'a11y-large-text', 'a11y-reduce-motion', 'a11y-highlight-links', 'a11y-dyslexia-font']) {
        assert.equal(restored.document.body.classList.contains(name), true);
    }
    assert.equal(restored.document.documentElement.classList.contains('a11y-large-text'), true);
    assert.equal(restored.document.documentElement.classList.contains('a11y-reduce-motion'), true);
});

test('Reset clears saved options and applied page styles', () => {
    const fixture = settingsFixture();
    ids.forEach(id => { fixture.elements[id].checked = true; });
    fixture.elements['a11y-save'].fire('click');
    fixture.elements['a11y-reset'].fire('click');
    const restored = settingsFixture(fixture.storage);
    ids.forEach(id => assert.equal(restored.elements[id].checked, false));
    assert.equal(restored.document.body.classList.contains('high-contrast'), false);
    assert.equal(restored.document.documentElement.classList.contains('a11y-large-text'), false);
    assert.equal(restored.document.documentElement.classList.contains('a11y-reduce-motion'), false);
});

test('Reopening settings discards unapplied checkbox changes', () => {
    const fixture = settingsFixture();
    fixture.elements['a11y-font'].checked = true;
    fixture.controller.sync();
    assert.equal(fixture.elements['a11y-font'].checked, false);
    assert.equal(fixture.applied(), 0);
});

test('Malformed and non-boolean stored preferences use safe defaults', () => {
    for (const value of ['{invalid', 'null', '{"a11y-font":"true","a11y-contrast":1}']) {
        const storage = createPreferenceStorage(() => { throw new Error('Storage blocked'); });
        storage.setItem('accessibility-preferences', value);
        const fixture = settingsFixture(storage);
        ids.forEach(id => assert.equal(fixture.elements[id].checked, false));
    }
});

test('Blocked browser storage preserves session preferences without throwing', () => {
    const storage = createPreferenceStorage(() => { throw new Error('SecurityError'); });
    storage.setItem('theme', 'theme-paper');
    assert.equal(storage.getItem('theme'), 'theme-paper');
    assert.equal(storage.getItem('missing'), null);
});

function previewFixture() {
    const elements = Object.fromEntries(['screenshot-image', 'screenshot-viewport', 'screenshot-zoom', 'screenshot-status', 'screenshot-title', 'screenshot-original'].map(id => [id, new Element()]));
    const link = new Element();
    link.href = '/assets/img/work/dnbx.de__DARK.png?v=123';
    link.dataset.previewTitle = 'Domain Box';
    const opened = [];
    initScreenshotPreview({ document: { getElementById: id => elements[id], querySelectorAll: () => [link] }, openModal: id => opened.push(id) });
    return { elements, link, opened };
}

test('Enlarge loads the original, names the preview, and resets scroll and zoom', () => {
    const { elements, link, opened } = previewFixture();
    let prevented = false;
    link.fire('click', { preventDefault() { prevented = true; } });
    assert.equal(prevented, true);
    assert.deepEqual(opened, ['modal-screenshot']);
    assert.equal(elements['screenshot-image'].src, link.href);
    assert.equal(elements['screenshot-image'].alt, 'Screenshot von Domain Box');
    assert.equal(elements['screenshot-original'].href, link.href);
    assert.equal(elements['screenshot-title'].textContent, 'Domain Box');
    assert.equal(elements['screenshot-viewport'].scrollTop, 0);
    assert.equal(elements['screenshot-zoom'].getAttribute('aria-pressed'), 'false');
    elements['screenshot-image'].fire('load');
    assert.equal(elements['screenshot-image'].hidden, false);
    assert.equal(elements['screenshot-status'].textContent, '');
});

test('Original-size control toggles zoom; reopening starts fitted to width', () => {
    const { elements, link } = previewFixture();
    const click = { preventDefault() {} };
    link.fire('click', click);
    elements['screenshot-zoom'].fire('click');
    assert.equal(elements['screenshot-viewport'].classList.contains('original-size'), true);
    assert.equal(elements['screenshot-zoom'].getAttribute('aria-pressed'), 'true');
    elements['screenshot-zoom'].fire('click');
    assert.equal(elements['screenshot-viewport'].classList.contains('original-size'), false);
    elements['screenshot-zoom'].fire('click');
    link.fire('click', click);
    assert.equal(elements['screenshot-viewport'].classList.contains('original-size'), false);
});

test('Preview load errors keep the original-file fallback available', () => {
    const { elements, link } = previewFixture();
    link.fire('click', { preventDefault() {} });
    elements['screenshot-image'].fire('error');
    assert.equal(elements['screenshot-image'].hidden, true);
    assert.match(elements['screenshot-status'].textContent, /Original öffnen/);
    assert.equal(elements['screenshot-original'].href, link.href);
});

test('Modified clicks preserve native browser navigation', () => {
    for (const modifier of ['ctrlKey', 'metaKey', 'shiftKey', 'altKey']) {
        const { link, opened } = previewFixture();
        link.fire('click', { [modifier]: true, preventDefault() { assert.fail('Modified click intercepted'); } });
        assert.equal(opened.length, 0);
    }
});
