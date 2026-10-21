 @extends('layouts.app')

@section('title', 'PurpFolio — Build a portfolio you are proud to share')

@section('content')
<style>
    .pf-home {
        --pf-purple: #7650f7;
        --pf-deep: #21183c;
        width: 100vw;
        position: relative;
        left: 50%;
        margin-left: -50vw;
        margin-top: -38px;
        overflow: hidden;
        background:
            radial-gradient(ellipse at 16% 88%, rgba(177, 143, 255, .14), transparent 36%),
            radial-gradient(ellipse at 78% 30%, rgba(208, 190, 255, .25), transparent 32%),
            #fff;
    }

    .pf-hero {
        width: min(1240px, 88%);
        min-height: 615px;
        margin: auto;
        display: grid;
        grid-template-columns: 1.08fr .92fr;
        align-items: center;
        gap: 35px;
        padding: 60px 0 65px;
    }

    .pf-eyebrow {
        display: inline-block;
        padding: 8px 14px;
        border: 1px solid #d9cbff;
        border-radius: 99px;
        color: #6940f5;
        background: rgba(255,255,255,.8);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.3px;
        text-transform: uppercase;
    }

    .pf-hero h1 {
        max-width: 670px;
        margin: 23px 0 19px;
        color: #211b3d;
        font-size: clamp(44px, 5.3vw, 76px);
        font-weight: 850;
        line-height: .99;
        letter-spacing: -4px;
    }

    .pf-hero h1 span {
        color: var(--pf-purple);
    }

    .pf-description {
        max-width: 560px;
        color: #716b85;
        font-size: 16px;
        line-height: 1.8;
    }

    .pf-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 26px;
    }

    .pf-home .btn {
        min-height: 49px;
        padding: 13px 22px;
        border-radius: 14px;
        background: linear-gradient(110deg, #8442a8, #a052bd);
        box-shadow: 0 9px 22px rgba(111, 59, 157, .18);
        color: white;
        font-size: 14px;
    }

    .pf-home .btn:hover {
        background: linear-gradient(110deg, #70328f, #8d3cac);
        transform: translateY(-1px);
    }

    .pf-home .btn.secondary {
        background: rgba(255,255,255,.9);
        color: #75409a;
        border: 1px solid #ddc8eb;
        box-shadow: none;
    }

    .pf-note {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 19px;
        color: #89839a;
        font-size: 12px;
    }

    .pf-note-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #8052ff;
        box-shadow: 0 0 0 5px #eee7ff;
    }

    .pf-art {
        position: relative;
        min-height: 420px;
        perspective: 1000px;
    }

    .pf-orb {
        position: absolute;
        top: -70px;
        right: -95px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(222, 212, 255, .28);
    }

    .pf-card {
        position: absolute;
        border-radius: 19px;
        box-shadow: 0 26px 55px rgba(47, 31, 79, .13);
    }

    .pf-card-back {
        top: 65px;
        left: 7%;
        width: 63%;
        height: 325px;
        padding: 28px;
        background: #f0eaff;
        transform: rotate(-9deg);
    }

    .pf-card-back .pf-shape {
        height: 75px;
        border-radius: 13px;
        background: linear-gradient(120deg, #6845ef, #9168ff);
    }

    .pf-card-back .pf-circle {
        width: 52px;
        height: 52px;
        margin-top: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #c8b7ff, #8655f1);
    }

    .pf-card-back .pf-line {
        height: 10px;
        margin-top: 12px;
        border-radius: 10px;
        background: #d9cef3;
    }

    .pf-card-middle {
        top: 35px;
        left: 28%;
        width: 56%;
        height: 345px;
        padding: 22px;
        background: #fff;
        transform: rotate(2deg);
    }

    .pf-card-middle .pf-placeholder {
        height: 78px;
        border-radius: 13px;
        background: linear-gradient(110deg, #f0eaff, #faf8ff);
        border: 1px solid #e9dfff;
    }

    .pf-card-middle .pf-circle {
        width: 46px;
        height: 46px;
        margin-top: 22px;
        border-radius: 50%;
        background: linear-gradient(135deg, #c8b6ff, #8050f4);
    }

    .pf-card-middle .pf-line {
        height: 9px;
        margin-top: 10px;
        border-radius: 9px;
        background: #e1d9ed;
    }

    .pf-card-front {
        z-index: 2;
        top: 75px;
        left: 45%;
        width: 51%;
        min-height: 350px;
        padding: 28px 26px;
        color: white;
        background: linear-gradient(145deg, #1d1234 10%, #39205f 75%, #6030a1);
        transform: rotate(8deg);
    }

    .pf-card-top {
        display: flex;
        justify-content: space-between;
        color: #d8c6ff;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.2px;
    }

    .pf-card-number {
        font-size: 16px;
    }

    .pf-card-front h2 {
        margin: 42px 0 22px;
        color: white;
        font-size: 31px;
        line-height: 1.03;
        letter-spacing: -1px;
    }

    .pf-card-front h2 span {
        color: #b28bff;
    }

    .pf-card-label {
        margin-top: 24px;
        color: #cbb5f7;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 1.5px;
    }

    .pf-tags {
        display: flex;
        gap: 6px;
        margin-top: 12px;
    }

    .pf-tags span {
        padding: 5px 8px;
        border-radius: 99px;
        background: rgba(255,255,255,.15);
        color: #f0e6ff;
        font-size: 9px;
    }

    .pf-project {
        height: 47px;
        margin-top: 12px;
        border: 1px solid rgba(255,255,255,.16);
        border-radius: 9px;
        background: rgba(255,255,255,.07);
    }

    .pf-card-bottom {
        margin-top: 10px;
        color: #d7bfff;
        text-align: right;
        font-size: 10px;
        font-weight: 800;
    }

    @media (max-width: 850px) {
        .pf-hero {
            grid-template-columns: 1fr;
            gap: 5px;
            padding-top: 48px;
        }

        .pf-hero h1 {
            max-width: 650px;
            font-size: clamp(44px, 8vw, 66px);
            letter-spacing: -2.5px;
        }

        .pf-art {
            width: min(530px, 100%);
            min-height: 380px;
            margin: 0 auto;
        }

        .pf-card-back {
            height: 285px;
        }

        .pf-card-middle {
            height: 300px;
        }

        .pf-card-front {
            min-height: 310px;
        }
    }

    @media (max-width: 480px) {
        .pf-home {
            margin-top: -24px;
        }

        .pf-hero {
            width: 88%;
            padding: 38px 0 30px;
        }

        .pf-hero h1 {
            font-size: 43px;
            line-height: 1.04;
        }

        .pf-description {
            font-size: 14px;
        }

        .pf-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .pf-actions .btn {
            width: 100%;
        }

        .pf-art {
            min-height: 315px;
            transform: scale(.88);
            transform-origin: top center;
            margin-bottom: -30px;
        }

        .pf-card-back {
            top: 35px;
            height: 250px;
            padding: 19px;
        }

        .pf-card-middle {
            top: 20px;
            height: 260px;
            padding: 16px;
        }

        .pf-card-front {
            top: 55px;
            min-height: 275px;
            padding: 21px 18px;
        }

        .pf-card-front h2 {
            margin-top: 30px;
            font-size: 25px;
        }
    }
</style>

<div class="pf-home">
    <section class="pf-hero">
        <div class="pf-copy">
            <span class="pf-eyebrow">Online portfolio template generator</span>

            <h1>
                Build a portfolio<br>
                you are <span>proud to share.</span>
            </h1>

            <p class="pf-description">
                Enter your details once, choose a Simple, Modern or Creative
                design, and get a clean portfolio page saved online.
                Edit or delete it any time.
            </p>

            <div class="pf-actions">
                @guest
                    <a class="btn" href="/register">
                        Create Portfolio&nbsp; →
                    </a>
                    <a class="btn secondary" href="/login">
                        Manage Portfolios
                    </a>
                @else
                    <a class="btn" href="/portfolios/create">
                        Create Portfolio&nbsp; →
                    </a>
                    <a class="btn secondary" href="/dashboard">
                        Manage Portfolios
                    </a>
                @endguest
            </div>

            <div class="pf-note">
                <span class="pf-note-dot"></span>
                3 portfolio templates · Save online · Easy to edit
            </div>
        </div>

        <div class="pf-art" aria-label="Illustration of overlapping portfolio template cards" role="img">
            <div class="pf-orb"></div>

            <div class="pf-card pf-card-back" aria-hidden="true">
                <div class="pf-shape"></div>
                <div class="pf-circle"></div>
                <div class="pf-line" style="width:80%"></div>
                <div class="pf-line" style="width:60%"></div>
                <div class="pf-line" style="width:35%;height:20px"></div>
            </div>

            <div class="pf-card pf-card-middle" aria-hidden="true">
                <div class="pf-placeholder"></div>
                <div class="pf-circle"></div>
                <div class="pf-line" style="width:78%"></div>
                <div class="pf-line" style="width:55%"></div>
                <div class="pf-placeholder" style="height:70px;margin-top:24px"></div>
            </div>

            <div class="pf-card pf-card-front" aria-hidden="true">
                <div class="pf-card-top">
                    <span>PORTFOLIO</span>
                    <span class="pf-card-number">03</span>
                </div>

                <h2>Your<br><span>Story.</span></h2>

                <div class="pf-card-label">SKILLS</div>
                <div class="pf-tags">
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>UI/UX</span>
                </div>

                <div class="pf-card-label">PROJECTS</div>
                <div class="pf-project"></div>
                <div class="pf-card-bottom">CREATIVE</div>
            </div>
        </div>
    </section>
</div>
@endsection