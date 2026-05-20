const { chromium } = require('playwright');

(async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage({ viewport: { width: 1280, height: 800 } });
  await page.goto('http://localhost:3000');
  await page.screenshot({ path: 'screenshot.png', fullPage: true });
  await browser.close();
})();
