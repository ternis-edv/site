# Portfolio website viewer

Shareable routes use `/viewer/<project>/<path>?<query>#<anchor>`. Direct loads and browser Back/Forward restore the selected website and subpage. Allowed links, including links to other visible portfolio projects, update the parent route through a validated iframe message bridge. Unlisted hosts stay blocked.

The fullscreen button uses native fullscreen when supported and falls back to an edge-to-edge layout. Its compact toolbar keeps only the project name, website link, fullscreen exit, and close control.

The project viewer displays current HTML through `/preview?project=<id>`, with its controls outside a sandboxed iframe. The existing screenshot remains available through the Screenshot button and always fits the viewer width. Projects without a public HTTPS link open as screenshots.

The PHP server needs cURL and DOM extensions, DNS resolution, and outbound HTTPS access. HTML is fetched without visitor cookies or credentials. Relative assets resolve against the upstream website; images, styles, scripts, and their network requests load directly from that website. This is an HTML preview, not a complete reverse proxy for APIs, authenticated sessions, or asset pipelines. Forms, popups, workers, and access to the landing page are blocked by the iframe sandbox and response policy. Sites requiring browser storage, CORS-enabled modules, or authentication may need the Screenshot or Website besuchen fallback.

Only visible projects with HTTPS links in `src/Views/partials/projects_data.php` are eligible. Links to eligible projects are rewritten through the proxy; external navigation is disabled in the preview. Each upstream request and redirect is checked against the selected project's hostname (plus its www variant). Public IPv4 addresses are validated and pinned for the request. Requests have time and size limits. Preview routes are excluded from the sitemap and marked noindex.

Run checks with:

```sh
node --test tests/ui-settings.test.mjs
php tests/website-preview.test.php
php tests/website-preview-cache.test.php
```

The viewer displays a dismissible notice about limited links, interactions, cookies, logins, and browser storage. The info control reopens it; fullscreen collapses it to keep the toolbar compact. Loading displays the selected domain and an indeterminate progress indicator, with a button to switch to the screenshot while waiting. Busy states are exposed to assistive technology, and the embedded page cannot receive focus until loading finishes.

Successful upstream HTML is cached server-side for two hours in `storage/cache/website-previews/` (ignored by Git). Keys include the project, path, and query; fragments share the same document. The final redirect URL is retained, and cached HTML is rewritten on each request so host restrictions, navigation links, and the bridge remain current. Failed or empty responses are not cached. Expired entries refresh on the next request; no stale fallback is served after expiry. Atomic writes avoid partial reads, and oldest entries are pruned above 128 documents or 64 MiB. If storage is unavailable, the preview still fetches normally. `X-Preview-Cache: HIT` or `MISS` exposes cache use for diagnostics; browser responses keep `Cache-Control: no-store`. To clear the cache manually, delete its `.json` files.
