<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Outfit:wght@200;300;400;500&display=swap');

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --ink: #0d0d12;
            --gold: #c9a84c;
            --gold-soft: rgba(201, 168, 76, 0.15);
            --cream: #f5f0e8;
            --muted: rgba(245, 240, 232, 0.45);
            --card-bg: rgba(255, 255, 255, 0.08);
            --border: rgba(201, 168, 76, 0.2);
        }

        .login-scene {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            overflow: hidden;
            z-index: 0;

            /* ── Your background image ── */
            background-image: url('/admin_assets/assets/img/login_bg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Dark overlay so the card stays readable */
        .login-scene::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        /* ── Animated orbs ── */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0;
            animation: orbFloat 18s ease-in-out infinite;
            z-index: 1;
        }

        .orb-1 {
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(201, 168, 76, 0.22), transparent 70%);
            top: -120px;
            left: -80px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(120, 80, 180, 0.18), transparent 70%);
            bottom: -60px;
            right: -60px;
            animation-delay: -6s;
        }

        .orb-3 {
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(60, 180, 160, 0.14), transparent 70%);
            top: 50%;
            right: 15%;
            animation-delay: -12s;
        }

        @keyframes orbFloat {
            0% {
                opacity: 0;
                transform: scale(0.85) translate(0px, 20px);
            }

            15% {
                opacity: 1;
            }

            50% {
                transform: scale(1.08) translate(30px, -25px);
            }

            85% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: scale(0.85) translate(0px, 20px);
            }
        }

        /* ── Grain overlay ── */
        .grain {
            position: fixed;
            inset: -50%;
            width: 200%;
            height: 200%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            opacity: 0.35;
            pointer-events: none;
            animation: grainShift 0.8s steps(1) infinite;
            z-index: 2;
        }

        @keyframes grainShift {
            0% {
                transform: translate(0, 0);
            }

            25% {
                transform: translate(-3px, 2px);
            }

            50% {
                transform: translate(2px, -3px);
            }

            75% {
                transform: translate(-2px, -2px);
            }
        }

        /* ── Grid lines ── */
        .grid-lines {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(201, 168, 76, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(201, 168, 76, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            z-index: 2;
            pointer-events: none;
        }

        /* ── Card ── */
        .login-card {
            position: relative;
            z-index: 10;
            width: min(480px, calc(100vw - 2rem));
            padding: 0;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 2px;
            backdrop-filter: blur(32px) saturate(140%);
            -webkit-backdrop-filter: blur(32px) saturate(140%);
            box-shadow:
                0 0 0 1px rgba(201, 168, 76, 0.08),
                0 40px 80px rgba(0, 0, 0, 0.6),
                0 0 120px rgba(201, 168, 76, 0.06);
            opacity: 0;
            transform: translateY(28px);
            animation: cardReveal 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.2s forwards;
        }

        @keyframes cardReveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Card header ── */
        .card-header {
            padding: 2.5rem 2.5rem 2rem;
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .card-eyebrow {
            font-size: 0.68rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 400;
            margin-bottom: 0.75rem;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.7s forwards;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.1rem;
            color: var(--cream);
            line-height: 1.1;
            letter-spacing: -0.02em;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.85s forwards;
        }

        .card-title em {
            font-style: italic;
            color: var(--gold);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Card body ── */
        .card-body {
            padding: 2rem 2.5rem 2.5rem;
        }

        .field-wrap {
            margin-bottom: 1.4rem;
            opacity: 0;
            animation: fadeUp 0.5s ease forwards;
        }

        .field-wrap:nth-child(1) {
            animation-delay: 1.0s;
        }

        .field-wrap:nth-child(2) {
            animation-delay: 1.1s;
        }

        .field-wrap:nth-child(3) {
            animation-delay: 1.2s;
        }

        .field-label {
            display: block;
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgb(255, 255, 255);
            margin-bottom: 0.5rem;
            font-weight: 400;
        }

        .field-input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(245, 240, 232, 0.04);
            border: 1px solid rgba(201, 168, 76, 0.18);
            border-radius: 2px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.88rem;
            font-weight: 300;
            color: var(--cream);
            outline: none;
            transition: all 0.25s ease;
            caret-color: var(--gold);
        }

        .field-input::placeholder {
            color: rgba(245, 240, 232, 0.2);
        }

        .field-input:focus {
            background: rgba(201, 168, 76, 0.06);
            border-color: rgba(201, 168, 76, 0.55);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.07), 0 0 20px rgba(201, 168, 76, 0.05);
        }

        /* ── Remember row ── */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeUp 0.5s ease 1.25s forwards;
        }

        .remember-row input[type="checkbox"] {
            appearance: none;
            width: 14px;
            height: 14px;
            border: 1px solid rgba(201, 168, 76, 0.35);
            border-radius: 1px;
            background: transparent;
            cursor: pointer;
            position: relative;
            flex-shrink: 0;
            transition: all 0.2s;
        }

        .remember-row input[type="checkbox"]:checked {
            background: var(--gold);
            border-color: var(--gold);
        }

        .remember-row input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            top: 1px;
            left: 4px;
            width: 4px;
            height: 7px;
            border: 1.5px solid var(--ink);
            border-top: none;
            border-left: none;
            transform: rotate(42deg);
        }

        .remember-row span {
            font-size: 0.8rem;
            color: rgba(245, 240, 232, 0.827);
            font-weight: 300;
            letter-spacing: 0.02em;
        }

        /* ── Footer row ── */

        .forgot-link {
            font-size: 0.78rem;
            color: rgba(201, 168, 76, 0.6);
            text-decoration: none;
            letter-spacing: 0.06em;
            transition: color 0.2s;
            position: relative;
        }

        .forgot-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gold);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--gold);
        }

        .forgot-link:hover::after {
            transform: scaleX(1);
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .footer-left {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .register-prompt {
            font-size: 0.75rem;
            color: rgba(245, 240, 232, 0.35);
            font-weight: 300;
            letter-spacing: 0.02em;
        }

        .register-prompt-link {
            color: var(--gold);
            text-decoration: none;
            font-weight: 400;
            position: relative;
            transition: color 0.2s;
        }

        .register-prompt-link::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gold);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .register-prompt-link:hover {
            color: rgba(201, 168, 76, 0.85);
        }

        .register-prompt-link:hover::after {
            transform: scaleX(1);
        }

        .login-btn {
            position: relative;
            padding: 0.72rem 2rem;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            font-family: 'Outfit', sans-serif;
            font-size: 0.78rem;
            font-weight: 400;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            cursor: pointer;
            border-radius: 1px;
            overflow: hidden;
            transition: color 0.3s ease;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gold);
            transform: translateX(-101%);
            transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 0;
        }

        .login-btn span {
            position: relative;
            z-index: 1;
        }

        .login-btn:hover {
            color: var(--ink);
        }

        .login-btn:hover::before {
            transform: translateX(0);
        }

        .login-btn:active {
            transform: scale(0.98);
        }

        /* ── Corner accent ── */
        .corner-tl,
        .corner-br {
            position: absolute;
            width: 12px;
            height: 12px;
            pointer-events: none;
        }

        .corner-tl {
            top: -1px;
            left: -1px;
            border-top: 2px solid var(--gold);
            border-left: 2px solid var(--gold);
        }

        .corner-br {
            bottom: -1px;
            right: -1px;
            border-bottom: 2px solid var(--gold);
            border-right: 2px solid var(--gold);
        }

        .header-inner {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-text {
            flex: 3;
            /* takes 3/4 */
        }

        .header-logo {
            flex: 1;
            /* takes 1/4 */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logo img {
            width: 100%;
            max-width: 95px;
            height: auto;
            object-fit: contain;
            opacity: 0.9;
            filter: drop-shadow(0 2px 8px rgba(201, 168, 76, 0.3));
        }
    </style>

    <div class="login-scene">
        <!-- Atmosphere -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="grain"></div>
        <div class="grid-lines"></div>

        <!-- Card -->
        <div class="login-card">
            <div class="corner-tl"></div>
            <div class="corner-br"></div>
            <div class="card-header">
                <div class="header-inner">
                    <!-- 3/4 text side -->
                    <div class="header-text">
                        <p class="card-eyebrow">Admin Access</p>
                        <h1 class="card-title">Welcome <em>back</em></h1>
                    </div>

                    <!-- 1/4 logo side -->
                    <div class="header-logo">
                        <img src="/admin_assets/assets/img/logo_white.png" alt="Logo" />
                    </div>

                </div>
            </div>

            <div class="card-body">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field-wrap">
                        <label class="field-label" for="email">Email Address</label>
                        <input id="email" class="field-input" type="email" name="email"
                            value="{{ old('email') }}" required autofocus autocomplete="username"
                            placeholder="you@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="field-wrap">
                        <label class="field-label" for="password">Password</label>
                        <input id="password" class="field-input" type="password" name="password" required
                            autocomplete="current-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="field-wrap remember-row">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Keep me signed in</span>
                    </div>

                    <div class="card-footer">
                        <div class="footer-left">
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif

                            <p class="register-prompt">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="register-prompt-link">Get registered</a>
                            </p>
                        </div>

                        <button type="submit" class="login-btn">
                            <span>Enter →</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
