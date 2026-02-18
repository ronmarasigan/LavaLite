<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LavaLite - Keep it light. Build it fast</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --orange: #f97316;
      --orange-dark: #ea580c;
      --gray-1: #111827;
      --gray-2: #1f2937;
      --gray-3: #374151;
      --gray-4: #9ca3af;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
      color: #e2e8f0;
      min-height: 100vh;
      line-height: 1.6;
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 24px;
    }

    header {
      padding: 80px 0 100px;
      text-align: center;
    }

    h1 {
      font-size: 3.8rem;
      font-weight: 700;
      margin-bottom: 0.4rem;
      letter-spacing: -0.05em;
    }

    .subtitle {
      font-size: 1.42rem;
      color: var(--gray-4);
      margin-bottom: 2.2rem;
      font-weight: 400;
    }

    .lava {
      color: var(--orange);
      font-weight: 700;
    }

    .tagline {
      font-size: 1.28rem;
      max-width: 640px;
      margin: 0 auto 2.5rem;
      color: #cbd5e1;
    }

    .buttons {
      display: flex;
      justify-content: center;
      gap: 1.2rem;
      flex-wrap: wrap;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 32px;
      font-size: 1.05rem;
      font-weight: 500;
      border-radius: 12px;
      text-decoration: none;
      transition: all 0.22s ease;
      border: 1px solid transparent;
    }

    .btn-primary {
      background: var(--orange);
      color: white;
      border-color: var(--orange);
    }

    .btn-primary:hover {
      background: var(--orange-dark);
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(249, 115, 22, 0.35);
    }

    .btn-outline {
      background: transparent;
      color: var(--orange);
      border-color: var(--orange);
    }

    .btn-outline:hover {
      background: rgba(249, 115, 22, 0.08);
      transform: translateY(-2px);
    }

    .features {
      padding: 60px 0 100px;
      text-align: center;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 2rem;
      margin-top: 3.5rem;
    }

    .feature-card {
      background: rgba(30, 41, 59, 0.6);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(249, 115, 22, 0.12);
      border-radius: 16px;
      padding: 2rem 1.6rem;
      transition: all 0.25s ease;
    }

    .feature-card:hover {
      border-color: var(--orange);
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .feature-icon {
      font-size: 2.6rem;
      margin-bottom: 1.1rem;
      color: var(--orange);
    }

    .feature-title {
      font-size: 1.32rem;
      margin-bottom: 0.9rem;
      color: white;
    }

    footer {
      text-align: center;
      padding: 60px 0 80px;
      color: #64748b;
      font-size: 0.95rem;
    }

    @media (max-width: 640px) {
      h1 { font-size: 2.8rem; }
      .subtitle { font-size: 1.2rem; }
    }
  </style>
</head>
<body>

  <div class="container">

    <header>
      <h1><span class="lava">Lava</span>Lite</h1>
      <div class="subtitle">Routing + SQL Builder. Zero bloat.</div>

      <p class="tagline">
        The lightweight PHP framework that gets out of your way<br>
        and lets you ship fast — with a warm orange soul.
      </p>

      <div class="buttons">
        <a href="https://lavalite.netlify.app" class="btn btn-primary">Get Started →</a>
        <a href="https://github.com/ronmarasigan/lavalite" target="_blank" class="btn btn-outline">View on GitHub</a>
      </div>
    </header>

    <section class="features">
      <h2 style="font-size:2.1rem; margin-bottom:1rem;">Why LavaLite?</h2>

      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">🚀</div>
          <div class="feature-title">Lightning Fast Routing</div>
          <p>Simple, expressive routes with zero magic. Just works.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">🧱</div>
          <div class="feature-title">Clean SQL Builder</div>
          <p>Fluent, safe queries — no more string concatenation nightmares.</p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">🪶</div>
          <div class="feature-title">Ultra Lightweight</div>
          <p>Only what you need. No heavy dependencies. ~58 KB.</p>
        </div>
      </div>
    </section>

    <footer>
      <p>LavaLite • 2025–2026</p>
    </footer>

  </div>

</body>
</html>