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
            --cream: #f5f0e8;
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
            background-image: url('/admin_assets/assets/img/login_bg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-scene::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

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
            width: min(600px, calc(100vw - 2rem));
            max-height: calc(100vh - 2rem);
            overflow-y: auto;
            overflow-x: hidden;
            padding: 0;
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, 0.12) 0%,
                    rgba(255, 255, 255, 0.04) 100%);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 2px;
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            -webkit-backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            box-shadow:
                0 0 0 1px rgba(201, 168, 76, 0.12),
                0 40px 80px rgba(0, 0, 0, 0.4),
                0 0 120px rgba(201, 168, 76, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.25),
                inset 0 -1px 0 rgba(255, 255, 255, 0.05);
            opacity: 0;
            transform: translateY(28px);
            animation: cardReveal 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.2s forwards;
            scrollbar-width: none;
        }

        .login-card::-webkit-scrollbar {
            display: none;
        }

        @keyframes cardReveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Card header ── */
        .card-header {
            padding: 2rem 2.5rem 1.75rem;
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

        .header-inner {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-text {
            flex: 3;
        }

        .header-logo {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logo img {
            width: 100%;
            max-width: 80px;
            height: auto;
            object-fit: contain;
            opacity: 0.9;
            filter: drop-shadow(0 2px 8px rgba(201, 168, 76, 0.3));
        }

        .card-eyebrow {
            font-size: 0.68rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            font-weight: 400;
            margin-bottom: 0.5rem;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.7s forwards;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
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
            padding: 1.75rem 2.5rem 2rem;
        }

        /* Two-column grid for name+email, password+confirm */
        .fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 1.2rem;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        .field-wrap {
            margin-bottom: 1.2rem;
            opacity: 0;
            animation: fadeUp 0.5s ease forwards;
        }

        .field-wrap:nth-child(1) {
            animation-delay: 0.9s;
        }

        .field-wrap:nth-child(2) {
            animation-delay: 1.0s;
        }

        .field-wrap:nth-child(3) {
            animation-delay: 1.1s;
        }

        .field-wrap:nth-child(4) {
            animation-delay: 1.2s;
        }

        .field-label {
            display: block;
            font-size: 0.68rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.971);
            margin-bottom: 0.45rem;
            font-weight: 400;
        }

        .field-input {
            width: 100%;
            padding: 0.7rem 1rem;
            background: rgba(245, 240, 232, 0.04);
            border: 1px solid rgba(201, 168, 76, 0.18);
            border-radius: 2px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.87rem;
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

        /* ── Footer row ── */
        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.6rem;
            opacity: 0;
            animation: fadeUp 0.5s ease 1.3s forwards;
        }

        .login-link {
            font-size: 0.78rem;
            color: rgba(201, 168, 76, 0.6);
            text-decoration: none;
            letter-spacing: 0.06em;
            transition: color 0.2s;
            position: relative;
        }

        .login-link::after {
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

        .login-link:hover {
            color: var(--gold);
        }

        .login-link:hover::after {
            transform: scaleX(1);
        }

        .register-btn {
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

        .register-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--gold);
            transform: translateX(-101%);
            transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 0;
        }

        .register-btn span {
            position: relative;
            z-index: 1;
        }

        .register-btn:hover {
            color: var(--ink);
        }

        .register-btn:hover::before {
            transform: translateX(0);
        }

        .register-btn:active {
            transform: scale(0.98);
        }

        /* ── Corner accents ── */
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

        .card-welcome {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0 0.25rem 1.4rem;
            opacity: 0;
            animation: fadeUp 0.6s ease 0.5s forwards;
        }

        .welcome-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 168, 76, 0.5));
        }

        .welcome-line:last-child {
            background: linear-gradient(90deg, rgba(201, 168, 76, 0.5), transparent);
        }

        .welcome-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 400;
            font-style: italic;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #ffe291;;
            white-space: nowrap;
            text-shadow: 0 0 20px rgba(201, 168, 76, 0.4);
        }
    </style>

    <div class="login-scene">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="grain"></div>
        <div class="grid-lines"></div>

        <div class="login-card">
            <div class="corner-tl"></div>
            <div class="corner-br"></div>

            <!-- Header -->
            <div class="card-header">
                <div class="card-welcome">
                    <span class="welcome-line"></span>
                    <h2 class="welcome-text">Welcome to NS Photography</h2>
                    <span class="welcome-line"></span>
                </div>

                <div class="header-inner">
                    <div class="header-text">
                        <p class="card-eyebrow">Create Account</p>
                        <h1 class="card-title">Get <em>started</em></h1>
                    </div>
                    <div class="header-logo">
                        <img src="/admin_assets/assets/img/logo_white.png" alt="Logo" />
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="fields-grid">

                        <!-- Name -->
                        <div class="field-wrap">
                            <label class="field-label" for="name">Full Name</label>
                            <input id="name" class="field-input" type="text" name="name"
                                value="{{ old('name') }}" required autofocus autocomplete="name"
                                placeholder="John Doe" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="field-wrap">
                            <label class="field-label" for="email">Email Address</label>
                            <input id="email" class="field-input" type="email" name="email"
                                value="{{ old('email') }}" required autocomplete="username"
                                placeholder="you@example.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="field-wrap">
                            <label class="field-label" for="password">Password</label>
                            <input id="password" class="field-input" type="password" name="password" required
                                autocomplete="new-password" placeholder="••••••••" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="field-wrap">
                            <label class="field-label" for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" class="field-input" type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer">
                        <a class="login-link" href="{{ route('login') }}">
                            Already registered?
                        </a>
                        <button type="submit" class="register-btn">
                            <span>Register →</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
