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
    append(element) { (this.children ??= []).push(element); }
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

function previewFixture(count = 1) {
    const elements = Object.fromEntries(['screenshot-image', 'screenshot-viewport', 'screenshot-status', 'screenshot-title', 'screenshot-original', 'website-frame', 'screenshot-project', 'screenshot-address', 'screenshot-counter', 'screenshot-live', 'screenshot-prev', 'screenshot-next', 'preview-website', 'preview-screenshot', 'preview-caption'].map(id => [id, new Element()]));
    const link = new Element();
    link.href = '/assets/img/work/dnbx.de__DARK.png?v=123';
    link.dataset.previewTitle = 'Domain Box';
    const links = [link, ...Array.from({ length: count - 1 }, (_, index) => {
        const other = new Element();
        other.href = `/screenshot-${index}.png`;
        other.dataset.previewTitle = `Project ${index + 2}`;
        return other;
    })];
    const opened = [];
    const controller = initScreenshotPreview({ document: { createElement: () => new Element(), getElementById: id => elements[id], querySelectorAll: () => links }, openModal: id => opened.push(id) });
    return { elements, link, opened, controller };
}

test('Enlarge loads the original, names the preview, and resets scroll', () => {
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
    elements['screenshot-image'].fire('load');
    assert.equal(elements['screenshot-image'].hidden, false);
    assert.equal(elements['screenshot-status'].textContent, '');
});

test('Live HTML uses the project proxy and can switch to an adaptive screenshot', () => {
    const { elements, link } = previewFixture();
    link.dataset.previewLive = 'https://dnbx.de';
    link.dataset.previewId = 'dnbx';
    link.fire('click', { preventDefault() {} });
    assert.equal(elements['website-frame'].src, '/preview?project=dnbx');
    assert.equal(elements['website-frame'].hidden, false);
    assert.equal(elements['screenshot-viewport'].hidden, true);
    assert.equal(elements['screenshot-live'].href, 'https://dnbx.de');
    elements['preview-screenshot'].fire('click');
    assert.equal(elements['website-frame'].src, 'about:blank');
    assert.equal(elements['screenshot-viewport'].hidden, false);
    assert.equal(elements['screenshot-image'].src, link.href);
    assert.equal(elements['preview-screenshot'].getAttribute('aria-pressed'), 'true');
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


test('Viewer project navigation respects boundaries and the selector', () => {
    const { elements, link } = previewFixture(3);
    link.fire('click', { preventDefault() {} });
    assert.equal(elements['screenshot-project'].children.length, 3);
    assert.equal(elements['screenshot-prev'].disabled, true);
    elements['screenshot-next'].fire('click');
    assert.equal(elements['screenshot-title'].textContent, 'Project 2');
    assert.equal(elements['screenshot-project'].value, '1');
    elements['screenshot-project'].value = '2';
    elements['screenshot-project'].fire('change');
    assert.equal(elements['screenshot-title'].textContent, 'Project 3');
    assert.equal(elements['screenshot-next'].disabled, true);
    assert.equal(elements['preview-website'].disabled, true);
    elements['screenshot-prev'].fire('click');
    assert.equal(elements['screenshot-counter'].textContent, '2 / 3');
});

test('Closing the viewer unloads the embedded website', () => {
    const { elements, link, controller } = previewFixture();
    link.dataset.previewLive = 'https://dnbx.de';
    link.dataset.previewId = 'dnbx';
    link.fire('click', { preventDefault() {} });
    controller.stop();
    assert.equal(elements['website-frame'].src, 'about:blank');
    assert.equal(elements['screenshot-status'].textContent, '');
});
