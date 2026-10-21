<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PurpFolio')</title>

    <style>
        :root {
            --purple: #7950f2;
            --purple-dark: #6538d4;
            --ink: #211b3d;
            --muted: #77718a;
            --line: #e9e1f4;
            --surface: #fff;
            --background: #faf8fd;
        }

        * { box-sizing: border-box; }

        html { min-height: 100%; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--background);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.6;
        }

        a { color: var(--purple); text-decoration: none; }
        button, input, textarea, select { font: inherit; }

        .nav {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            width: 100%;
            padding: 14px max(5%, calc((100% - 1240px)/2));
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid var(--line);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
            font-size: 21px;
            font-weight: 850;
            letter-spacing: -.8px;
            color: #6e35d8;
        }

        .brand-mark {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 29px;
            height: 29px;
            border-radius: 9px;
            background: linear-gradient(145deg, #a46bff, #6929e8);
            color: white;
            font-size: 22px;
            font-weight: 900;
            box-shadow: 0 5px 14px #8250ed35;
        }

        .brand-mark::after {
            content: "";
            position: absolute;
            inset: 4px -4px 4px 4px;
            z-index: -1;
            border: 1.5px solid #c5a5ff;
            border-radius: 9px;
            transform: rotate(20deg);
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 27px;
            flex-wrap: wrap;
        }

        .nav-links > a:not(.btn) {
            color: #50465e;
            font-size: 14px;
            font-weight: 650;
            transition: color .2s;
        }

        .nav-links > a:not(.btn):hover {
            color: var(--purple);
        }

        .nav-links form { margin: 0; }

        .page-main {
            width: 100%;
            flex: 1;
        }

        .container {
            width: min(1120px, 90%);
            margin: 38px auto;
        }

        .narrow { max-width: 470px; }

        .hero { padding: 65px 0 50px; }

        .eyebrow {
            color: var(--purple);
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 12px;
        }

        h1 {
            font-size: clamp(34px, 5vw, 56px);
            line-height: 1.1;
            letter-spacing: -2px;
            margin: 12px 0 18px;
        }

        h2 { letter-spacing: -.7px; }
        .muted { color: var(--muted); }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border: 0;
            border-radius: 12px;
            padding: 11px 17px;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(110deg, #8040a4, #a052bd);
            color: white;
            transition: transform .2s, box-shadow .2s, background .2s;
        }

        .btn:hover {
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 7px 18px #8040a425;
        }

        .btn.secondary {
            background: white;
            color: #77429a;
            border: 1px solid #ddc8eb;
            box-shadow: none;
        }

        .btn.danger { background: #fff0f0; color: #b42332; }
        .btn.small { padding: 9px 15px; font-size: 13px; }

        .actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 20px;
        }

        .card {
            padding: 23px;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 17px;
            box-shadow: 0 5px 20px #2b175008;
        }

        .card h2, .card h3 { margin-top: 0; }
        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        input, textarea, select {
            width: 100%;
            border: 1px solid #ddd8eb;
            border-radius: 10px;
            padding: 12px 13px;
            background: white;
            color: var(--ink);
        }

        textarea { min-height: 110px; resize: vertical; }

        input:focus, textarea:focus, select:focus {
            outline: 2px solid #c7bbff;
            border-color: var(--purple);
        }

        .error { color: #b42332; font-size: 13px; margin-top: 4px; }

        .notice {
            padding: 12px 16px;
            background: #eaf9f0;
            color: #176b3a;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .badge {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 99px;
            background: #f0edff;
            color: var(--purple);
            font-size: 12px;
            font-weight: 750;
        }

        .avatar {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            object-fit: cover;
            background: #eee8ff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--purple);
            font-size: 28px;
            font-weight: 800;
        }

        .section { padding: 28px 0; }
        .section-title { font-size: 28px; margin-bottom: 12px; }

        .skill-list {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
            padding: 0;
            list-style: none;
        }

        .skill-list li {
            background: #f0edff;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            padding: 25px 15px 17px;
            color: #77718a;
            font-size: 14px;
            border-top: 1px solid var(--line);
            background: #fff;
        }

        .footer p { margin: 0; }
        .footer p + p { margin-top: 1px; }

        .template-modern { background: linear-gradient(135deg,#f7f3ff,#fff 55%); }
        .template-simple { background: #fff; }
        .portfolio-hero { padding: 55px 7%; border-radius: 22px; }
        .portfolio-content { max-width: 820px; margin: auto; }

        .project {
            padding: 18px 0;
            border-bottom: 1px solid var(--line);
        }

        @media(max-width: 760px) {
            .nav {
                align-items: center;
                flex-direction: column;
                gap: 14px;
                padding: 15px 5%;
            }

            .nav-links {
                justify-content: center;
                gap: 14px 20px;
            }

            .grid { grid-template-columns: 1fr; }
            .container { margin: 24px auto; }
            .hero { padding: 35px 0; }
            h1 { letter-spacing: -1px; }
        }

        @media(max-width: 420px) {
            .nav-links { gap: 12px 15px; }
            .nav-links > a:not(.btn) { font-size: 13px; }
            .brand { font-size: 20px; }
        }
        /* Creative portfolio template */
.portfolio-hero.template-creative {
    background: linear-gradient(135deg, #24113f 0%, #542a85 55%, #9163c9 100%);
    color: #ffffff;
    padding: 56px 40px;
    border-radius: 24px;
    box-shadow: 0 18px 45px rgba(68, 35, 105, 0.2);
}

.portfolio-hero.template-creative h1 {
    color: #ffffff;
    font-size: clamp(36px, 6vw, 58px);
    line-height: 1.08;
    letter-spacing: -1.5px;
}

.portfolio-hero.template-creative h2,
.portfolio-hero.template-creative .eyebrow {
    color: #eadbff;
}

.portfolio-hero.template-creative .muted {
    color: #e4d6f5;
}

.portfolio-hero.template-creative .btn {
    background: #ffffff;
    color: #542a85;
    border: 1px solid #ffffff;
}

@media (max-width: 600px) {
    .portfolio-hero.template-creative {
        padding: 32px 22px;
    }
}
    </style>

</head>

<body>
    <nav class="nav">
        <a class="brand" href="/">
            <span class="brand-mark" aria-hidden="true">P</span>
            <span>PurpFolio</span>
        </a>

        <div class="nav-links">
            <a href="/">Home</a>

            @auth
                <a href="/portfolios/create">Create</a>
                <a href="/portfolios/create">Templates</a>
                <a href="/dashboard">Manage</a>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="btn secondary small" type="submit">
                        Log Out
                    </button>
                </form>
            @else
                <a href="/portfolios/create">Create</a>
                <a href="/portfolios/create">Templates</a>
                <a href="/login">Manage</a>
                <a class="btn secondary small" href="/login">Log In</a>
            @endauth
        </div>
    </nav>

    <main class="page-main">
        @if(session('success'))
            <div class="container">
                <div class="notice">{{ session('success') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <p>© {{ date('Y') }} PurpFolio</p>
        <p>Information Management · HCI · Web Systems Technology 2</p>
    </footer>
</body>
</html>