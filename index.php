<!DOCTYPE html>
<html>
<head>
    <title>LogoVerse</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f7ff;
            color: #222;
        }

        header {
            background-color: white;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        nav a {
            text-decoration: none;
            margin-left: 25px;
            color: #333;
            font-weight: bold;
        }

        .hero {
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            color: #666;
            margin-bottom: 35px;
        }

        .button {
            display: inline-block;
            padding: 14px 30px;
            margin: 10px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .start-button {
            background-color: #6c63ff;
            color: white;
        }

        .login-button {
            background-color: white;
            color: #6c63ff;
            border: 2px solid #6c63ff;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 25px;
            padding: 40px 30px 80px;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            width: 200px;
            padding: 25px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: white;
            color: #777;
        }
    </style>
    <link rel="stylesheet" href="assets/visual.css">
</head>

<body>

<header>
    <div class="logo">LogoVerse</div>

   <nav>
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
</nav>
</header>

<section class="hero">
    <div class="page-kicker">✦ AI-ready brand studio</div>
    <h1>Create Your Brand Identity</h1>

    <p>
        Create logos, brand names, color palettes, font pairings
        and taglines in one place.
    </p>

    <a href="register.php" class="button start-button">Get Started</a>
    <a href="login.php" class="button login-button">Login</a>

    <div class="hero-visual">
        <div class="visual-frame">
            <div class="visual-art">
                <svg width="250" height="220" viewBox="0 0 260 220" role="img" aria-label="LogoVerse brand preview">
                    <defs>
                        <linearGradient id="lvg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#8b7cff"/><stop offset="1" stop-color="#20c997"/></linearGradient>
                    </defs>
                    <circle cx="130" cy="108" r="76" fill="url(#lvg)" opacity=".22"/>
                    <path d="M86 132c16-40 42-64 78-72 2 31-7 57-29 73-17 12-34 15-49 13Z" fill="none" stroke="#fff" stroke-width="9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M90 145c20-29 43-49 71-62" fill="none" stroke="#fff" stroke-width="7" stroke-linecap="round"/>
                    <circle cx="130" cy="108" r="92" fill="none" stroke="rgba(255,255,255,.12)" stroke-width="1"/>
                </svg>
            </div>
            <div class="visual-copy">
                <span class="page-kicker">Logo • Color • Type</span>
                <h3>One workspace for your whole brand.</h3>
                <p>Generate a visual identity, explore brand names, build a color palette and save projects in one place.</p>
                <div class="palette"><span style="background:#6c63ff"></span><span style="background:#20c997"></span><span style="background:#111827"></span><span style="background:#f4c95d"></span></div>
            </div>
        </div>
    </div>
</section>

<section class="features">

    <a href="generator.php" style="text-decoration: none; color: inherit;">
    <div class="card">
        <div class="feature-icon">🎨</div><h3>Logo Generator</h3>
        <p>Create logo concepts for your business.</p>
    </div>
</a>
   <a href="generator.php" style="text-decoration: none; color: inherit;">
    <div class="card">
        <div class="feature-icon">💡</div><h3>Brand Names</h3>
        <p>Get creative brand name suggestions.</p>
    </div>
</a>

   <a href="generator.php" style="text-decoration: none; color: inherit;">
    <div class="card">
        <div class="feature-icon">🌈</div><h3>Color Palettes</h3>
        <p>Choose suitable colors for your brand.</p>
    </div>
</a>
    <a href="generator.php" style="text-decoration: none; color: inherit;">
    <div class="card">
        <div class="feature-icon">🔤</div><h3>Font Pairing</h3>
        <p>Find fonts that work well together.</p>
    </div>
</a>
</section>

<footer>
    <p>© 2026 LogoVerse. All rights reserved.</p>
</footer>

</body>
</html>