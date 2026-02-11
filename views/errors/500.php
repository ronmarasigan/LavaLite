<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>500 | Not Found</title>

<style>
:root {
  --bg: #f6f8fb;
  --card: #ffffff;
  --text: #0f172a;
  --muted: #475569;
  --primary: #dd4814;
  --border: #e5e7eb;
  --shadow: 0 8px 18px rgba(2,6,23,.06);
}

* { box-sizing: border-box; }
html, body { height: 100%; margin: 0; }

body {
  font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial;
  background: var(--bg);
  color: var(--text);
  display: grid;
  place-items: center;
  padding: 1rem;
}

.card {
  width: 100%;
  max-width: 420px;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 1rem;
  box-shadow: var(--shadow);
  padding: 1.25rem;
}

.code {
  font-size: .7rem;
  font-weight: 700;
  color: var(--primary);
  background: rgba(221,72,20,.08);
  border: 1px solid rgba(221,72,20,.15);
  border-radius: 999px;
  padding: .25rem .6rem;
  margin-bottom: .6rem;
  display: inline-block;
}

h1 {
  margin: 0 0 .25rem;
  font-size: 1.25rem;
  line-height: 1.2;
}

p {
  margin: 0;
  font-size: .9rem;
  color: var(--muted);
}

.actions {
  margin-top: 1rem;
  display: flex;
  gap: .5rem;
}

.btn {
  padding: .5rem .75rem;
  font-size: .85rem;
  border-radius: .6rem;
  border: 1px solid var(--border);
  background: #fff;
  color: var(--text);
  text-decoration: none;
  font-weight: 600;
}

.btn.primary {
  background: var(--primary);
  color: #fff;
  border-color: transparent;
}

.hint {
  margin-top: .75rem;
  font-size: .75rem;
  color: var(--muted);
  border-top: 1px dashed var(--border);
  padding-top: .6rem;
}

.kbd {
  font-family: monospace;
  background: rgba(148,163,184,.15);
  border: 1px solid rgba(148,163,184,.35);
  border-radius: .35rem;
  padding: .1rem .3rem;
}
</style>
</head>

<body>
<main class="card" role="main">
  <div class="code">500 • Internal Server Error</div>
  <h1>Internal Server Error</h1>
  <p><?= $error ?></p>

  <div class="actions">
    <a class="btn primary" href="/">Home</a>
    <a class="btn" href="javascript:history.back()">Back</a>
  </div>

  <div class="hint">
    Tip: Press <span class="kbd">Ctrl</span> + <span class="kbd">L</span> to retype the URL.
  </div>
</main>
</body>
</html>
