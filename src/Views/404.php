<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Not Found</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .error-page { height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; background: var(--bg); color: var(--text); }
        .error-code { font-family: var(--fd); font-size: 10rem; font-weight: 800; color: var(--accent); line-height: 1; }
        .error-msg { font-size: 1.5rem; margin: 2rem 0; color: var(--muted-b); }
    </style>
</head>
<body class="theme-dark">
    <div class="error-page">
        <div class="error-code">404</div>
        <div class="error-msg">Diese Seite wurde nicht gefunden.</div>
        <a href="/" class="btn-p">Zurück zur Startseite</a>
    </div>
</body>
</html>
