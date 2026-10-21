
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PurpFolio')</title>
    <style>
        :root {
            --purple: #7657f6;
            --purple-dark: #6242e6;
            --ink: #201c35;
            --muted: #77738b;
            --line: #e9e6f2;
            --surface: #fff;
            --background: #f8f7fc;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--background);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.6;
        }
        a { color: var(--purple); text-decoration: none; }
        button, input, textarea, select { font: inherit; }
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            gap: 20px; padding: 18px max(5%, calc((100% - 1120px)/2));
            background: white; border-bottom: 1px solid var(--line);
        }
        .brand { font-size: 23px; font-weight: 850; letter-spacing: -1px; color: var(--ink); }
        .brand span { color: var(--purple); }
        .nav-links { display: flex; align-items: center; gap: 18px; flex-wrap: wrap; }
        .container { width: min(1120px, 90%); margin: 38px auto; }
        .narrow { max-width: 470px; }
        .hero { padding: 65px 0 50px; }
        .eyebrow {
            color: var(--purple); font-weight: 750; text-transform: uppercase;
            letter-spacing: 1.5px; font-size: 12px;
        }
        h1 { font-size: clamp(34px, 5vw, 56px); line-height: 1.1; letter-spacing: -2px; margin: 12px 0 18px; }
        h2 { letter-spacing: -.7px; }
        .muted { color: var(--muted); }
        .btn {
            display: inline-flex; justify-content: center; align-items: center;
            border: 0; border-radius: 10px; padding: 11px 17px;
            font-weight: 700; cursor: pointer; background: var(--purple); color: white;
        }
        .btn:hover { background: var(--purple-dark); color: white; }
        .btn.secondary { background: white; color: var(--ink); border: 1px solid var(--line); }
        .btn.danger { background: #fff0f0; color: #b42332; }
        .btn.small { padding: 7px 11px; font-size: 13px; }
        .actions { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }
        .grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 20px; }
        .card {
            padding: 23px; background: var(--surface); border: 1px solid var(--line);
            border-radius: 17px; box-shadow: 0 5px 20px #2b175008;
        }
        .card h2, .card h3 { margin-top: 0; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 14px; font-weight: 700; margin-bottom: 7px; }
        input, textarea, select {
            width: 100%; border: 1px solid #ddd8eb; border-radius: 10px;
            padding: 12px 13px; background: white; color: var(--ink);
        }
        textarea { min-height: 110px; resize: vertical; }
        input:focus, textarea:focus, select:focus {
            outline: 2px solid #c7bbff; border-color: var(--purple);
        }
        .error { color: #b42332; font-size: 13px; margin-top: 4px; }
        .notice { padding: 12px 16px; background: #eaf9f0; color: #176b3a; border-radius: 10px; margin-bottom: 20px; }
        .badge { display: inline-block; padding: 4px 9px; border-radius: 99px; background: #f0edff; color: var(--purple); font-size: 12px; font-weight: 750; }
        .avatar {
            width: 84px; height: 84px; border-radius: 50%; object-fit: cover;
            background: #eee8ff; display: inline-flex; align-items: center;
            justify-content: center; color: var(--purple); font-size: 28px; font-weight: 800;
        }
        .section { padding: 28px 0; }
        .section-title { font-size: 28px; margin-bottom: 12px; }
        .skill-list { display: flex; gap: 9px; flex-wrap: wrap; padding: 0; list-style: none; }
        .skill-list li { background: #f0edff; padding: 7px 12px; border-radius: 8px; font-size: 14px; }
        .footer { text-align: center; padding: 32px 15px; color: var(--muted); font-size: 13px; }
        .template-modern { background: linear-gradient(135deg,#f7f3ff,#fff 55%); }
        .template-simple { background: #fff; }
        .portfolio-hero { padding: 55px 7%; border-radius: 22px; }
        .portfolio-content { max-width: 820px; margin: auto; }
        .project { padding: 18px 0; border-bottom: 1px solid var(--line); }
        @media(max-width: 760px) {
            .grid { grid-template-columns: 1fr; }
            .nav { align-items: flex-start; flex-direction: column; }
            .container { margin: 24px auto; }
            .hero { padding: 35px 0; }
            h1 { letter-spacing: -1px; }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <a class="brand" href="{{ route('home') }}">Purp<span>Folio</span></a>
        <div class="nav-links">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a class="btn small" href="{{ route('portfolios.create') }}">+ New portfolio</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn secondary small" type="submit">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a class="btn small" href="{{ route('register') }}">Get started</a>
            @endauth
        </div>
    </nav>

    <main class="container">
        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">Made with PurpFolio · Build a portfolio that represents you.</footer>
</body>
</html>
