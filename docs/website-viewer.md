# Portfolio website viewer

The project viewer displays current HTML through `/preview?project=<id>`, with its controls outside a sandboxed iframe. The existing screenshot remains available through the Screenshot button and always fits the viewer width. Projects without a public HTTPS link open as screenshots.

The PHP server needs cURL and DOM extensions, DNS resolution, and outbound HTTPS access. HTML is fetched without visitor cookies or credentials. Relative assets resolve against the upstream website; images, styles, scripts, and their network requests load directly from that website. This is an HTML preview, not a complete reverse proxy for APIs, authenticated sessions, or asset pipelines. Forms, popups, workers, and access to the landing page are blocked by the iframe sandbox and response policy. Sites requiring browser storage, CORS-enabled modules, or authentication may need the Screenshot or Website besuchen fallback.

Only visible projects with HTTPS links in `src/Views/partials/projects_data.php` are eligible. Links within the same project are rewritten through the proxy; external navigation is disabled in the preview. Each upstream request and redirect is checked against the selected project's hostname (plus its www variant). Public IPv4 addresses are validated and pinned for the request. Requests have time and size limits. Preview routes are excluded from the sitemap and marked noindex.

Run checks with:

```sh
node --test tests/ui-settings.test.mjs
php tests/website-preview.test.php
```
