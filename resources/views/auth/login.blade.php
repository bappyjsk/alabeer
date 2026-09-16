<!DOCTYPE html>
<html lang="en" dir="ltr" id="htmlRoot" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to alabeer | Login</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Segoe+UI:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS (Local Bundle with CDN fallback) -->
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <script>if (typeof tailwind === 'undefined') { document.write('<script src="https://cdn.tailwindcss.com"><\/script>'); }</script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        alabeer: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fcba63',
                            500: '#e68a1f',
                            600: '#d47b15',
                            700: '#b45b0a',
                            800: '#92400e',
                        }
                    },
                    fontFamily: {
                        sans: ['"Segoe UI"', 'Cairo', 'Arial', 'sans-serif'],
                        arabic: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
            overflow-x: hidden;
        }
        html.dark body {
            background-color: #0b0e14;
            color: #e2e8f0;
        }
        html:not(.dark) body {
            background-color: #fafaf9;
            color: #1e293b;
        }
        [dir="rtl"] body {
            font-family: 'Cairo', "Segoe UI", sans-serif;
        }
        .form-input-field {
            border-radius: 8px;
            font-size: 13.5px;
            transition: all 0.2s;
        }
        html.dark .form-input-field {
            border: 1px solid #283243;
            background-color: #181e27;
            color: #f1f5f9;
        }
        html:not(.dark) .form-input-field {
            border: 1px solid #d1d5db;
            background-color: #ffffff;
            color: #374151;
        }
        .form-input-field:focus {
            outline: none;
            border-color: #e68a1f !important;
            box-shadow: 0 0 0 3px rgba(230, 138, 31, 0.35);
        }
    </style>
    <script>
        // Apply saved theme immediately to prevent FOUC
        (function() {
            const savedTheme = localStorage.getItem('alabeer_theme') || 'dark';
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="min-h-screen flex flex-col justify-between relative transition-colors duration-300">

    <!-- Top Navigation Bar (Theme Toggle & Language) -->
    <header class="w-full max-w-7xl mx-auto px-4 sm:px-8 py-4 sm:py-6 flex justify-end items-center gap-2.5 z-20">
        <!-- Dark Mode Toggle Button -->
        <button type="button" id="btnThemeToggle" onclick="toggleTheme()" class="flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-xl border transition-all cursor-pointer shadow-2xs" title="Toggle Dark / Light Mode">
            <span id="themeToggleIcon">🌙</span>
            <span id="themeToggleText">Dark Mode</span>
        </button>

        <!-- Language Button -->
        <button type="button" id="btnLangToggle" onclick="toggleLanguage()" class="flex items-center gap-1.5 text-xs font-semibold transition-all cursor-pointer border px-3 py-1.5 rounded-xl shadow-2xs">
            <span id="txtLangSwitch">Arabic</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke-width="1.5"></circle>
                <path stroke-width="1.5" d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            </svg>
        </button>
    </header>

    <!-- Main Login Workspace (2-Column with Illustration on Left) -->
    <main class="flex-1 flex items-center justify-center px-4 sm:px-6 py-4 z-10">
        <div id="loginCard" class="w-full max-w-4xl rounded-3xl border overflow-hidden grid grid-cols-1 lg:grid-cols-12 transition-all duration-300 shadow-2xl">
            
            <!-- Left Side: Hotel & Travel Illustration Banner -->
            <div id="loginLeftBanner" class="lg:col-span-6 p-6 sm:p-10 flex flex-col justify-between border-b lg:border-b-0 lg:border-e relative overflow-hidden transition-colors duration-300">
                <!-- Top Brand Tagline -->
                <div class="relative z-10">
                    <h1 id="txtHeroTitle" class="text-2xl sm:text-3xl font-extrabold mt-1 tracking-tight leading-snug">
                        Smart Hotel &amp; Apartment Management
                    </h1>
                </div>

                <!-- Hotel Illustration Image -->
                <div class="my-6 flex items-center justify-center relative z-10">
                    <img src="{{ asset('images/login_illustration.png') }}" alt="alabeer Hotel PMS" class="max-h-72 w-auto object-contain drop-shadow-md hover:scale-[1.02] transition-transform duration-300">
                </div>

                <!-- Bottom Trust Badges -->
                <div id="trustBadges" class="relative z-10 pt-4 border-t flex flex-wrap items-center justify-between gap-3 text-[11px] font-medium">
                    <div class="flex items-center gap-1.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span>SHOMOUS Certified</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span>ZATCA Phase 2</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span>Smart Lock Ready</span>
                    </div>
                </div>

                <!-- Soft Background Ambient Blobs -->
                <div class="absolute -top-16 -start-16 w-56 h-56 rounded-full bg-amber-500/10 blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-16 -end-16 w-56 h-56 rounded-full bg-orange-500/10 blur-2xl pointer-events-none"></div>
            </div>

            <!-- Right Side: Login Form -->
            <div id="loginRightForm" class="lg:col-span-6 p-7 sm:p-10 flex flex-col justify-center transition-colors duration-300">
                
                <!-- Logo inside card header -->
                <div class="text-center mb-6">
                    <img src="{{ asset('images/logo_clean.png') }}" alt="alabeer" class="h-10 w-auto mx-auto mb-3 object-contain">
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight" id="txtWelcome">
                        Welcome to <span class="text-alabeer-500 font-semibold">alabeer</span>
                    </h2>
                </div>

                <!-- Laravel Session / Error Alerts -->
                @if ($errors->any())
                    <div class="mb-4 p-2.5 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" id="alabeerLoginForm" class="space-y-4">
                    @csrf

                    <!-- User Name -->
                    <div>
                        <label class="block text-xs font-semibold mb-1" id="lblUsername">User Name</label>
                        <input type="text" name="login" id="login_username" required value="{{ old('login') }}" placeholder="User Name" class="form-input-field w-full px-3.5 py-2.5 text-sm placeholder-slate-500">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-semibold mb-1" id="lblPassword">Password</label>
                        <input type="password" name="password" id="login_password" required placeholder="Password" class="form-input-field w-full px-3.5 py-2.5 text-sm placeholder-slate-500">
                    </div>

                    <!-- Access Code + Forgot Password Link -->
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-xs font-semibold" id="lblAccessCode">Access Code</label>
                            <a href="javascript:void(0)" onclick="alert('Please contact your system administrator to recover your password.')" class="text-xs text-[#fcba63] hover:text-[#e4881c] hover:underline" id="linkForgotPassword">Forget Password ?</a>
                        </div>
                        <input type="text" name="access_code" id="login_access_code" value="{{ old('access_code') }}" placeholder="Access Code" class="form-input-field w-full px-3.5 py-2.5 text-sm placeholder-slate-500">
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none text-xs">
                            <input type="checkbox" name="remember" class="rounded text-alabeer-500 focus:ring-alabeer-400 border-gray-600 w-4 h-4 accent-[#e4881c]">
                            <span id="txtRememberMe">Remember me</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" id="btnLogin" class="w-full py-2.5 px-4 rounded-xl text-white bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#f59e0b] hover:to-[#d97706] font-bold text-sm shadow-lg shadow-orange-500/20 transition-all cursor-pointer mt-2">
                        <span id="txtLoginBtn">Login</span>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Bottom Ambient Skyline Panorama Background -->
    <div class="fixed inset-x-0 bottom-0 h-36 pointer-events-none z-0 opacity-20 dark:opacity-30 overflow-hidden"
         style="background-image: url('{{ asset('images/skyline.png') }}'); background-repeat: repeat-x; background-position: bottom center; background-size: auto 120px;">
    </div>

    <!-- Help Modal -->
    <div id="helpModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center p-4 z-50 backdrop-blur-xs">
        <div id="helpModalCard" class="bg-[#141820] border border-[#232b38] rounded-2xl max-w-sm w-full p-5 shadow-2xl text-slate-200 text-xs space-y-3">
            <h4 class="font-bold text-sm text-white" id="mHelpTitle">Need Help?</h4>
            <p id="mHelpDesc" class="text-slate-300">If you forgot your access code or having login problems, please reach out to our 24/7 alabeer PMS support desk or your property administrator.</p>
            <div class="p-2.5 bg-[#181e27] rounded-xl border border-[#283243] space-y-1.5 text-slate-300">
                <div><strong>Support Hotline:</strong> <a href="tel:+8801621404355" class="text-amber-400 font-mono font-semibold hover:underline">+8801621404355</a></div>
                <div><strong>Email:</strong> <a href="mailto:support@alabeer.sa" class="text-sky-400 font-semibold hover:underline">support@alabeer.sa</a></div>
            </div>
            <button type="button" onclick="closeHelpModal()" class="w-full py-2 bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#f59e0b] hover:to-[#d97706] text-white rounded-xl font-bold transition-all">Close</button>
        </div>
    </div>

    <script>
        let currentLang = 'en';

        const i18n = {
            en: {
                dir: 'ltr',
                switchLabel: 'Arabic',
                welcome: 'Welcome to <span class="text-alabeer-500 font-semibold">alabeer</span>',
                username: 'User Name',
                password: 'Password',
                forgot: 'Forget Password ?',
                accessCode: 'Access Code',
                remember: 'Remember me',
                login: 'Login',
                problem: 'Problem with username or access code?',
                clickHere: 'Click here',
                mTitle: 'Need Help?',
                mDesc: 'If you forgot your access code or having login problems, please reach out to our 24/7 alabeer PMS support desk or your property administrator.',
                dark: 'Dark Mode',
                light: 'Light Mode'
            },
            ar: {
                dir: 'rtl',
                switchLabel: 'English',
                welcome: 'مرحباً بك في <span class="text-alabeer-500 font-semibold">العبيـر</span>',
                username: 'اسم المستخدم',
                password: 'كلمة المرور',
                forgot: 'نسيت كلمة المرور ؟',
                accessCode: 'كود الدخول',
                remember: 'تذكرني',
                login: 'تسجيل الدخول',
                problem: 'مشكلة في اسم المستخدم أو كود الدخول؟',
                clickHere: 'اضغط هنا',
                mTitle: 'هل تحتاج إلى مساعدة؟',
                mDesc: 'إذا نسيت كود الدخول أو واجهت مشكلة في تسجيل الدخول، يرجى التواصل مع الدعم الفني للعبيـر أو مدير المنشأة.',
                dark: 'الوضع الداكن',
                light: 'الوضع الفاتح'
            }
        };

        function toggleLanguage() {
            currentLang = currentLang === 'en' ? 'ar' : 'en';
            applyLanguage(currentLang);
        }

        function applyLanguage(lang) {
            const data = i18n[lang];
            const root = document.getElementById('htmlRoot');
            root.setAttribute('dir', data.dir);
            root.setAttribute('lang', lang);

            document.getElementById('txtLangSwitch').innerText = data.switchLabel;
            document.getElementById('txtWelcome').innerHTML = data.welcome;
            document.getElementById('lblUsername').innerText = data.username;
            document.getElementById('login_username').placeholder = data.username;
            document.getElementById('lblPassword').innerText = data.password;
            document.getElementById('login_password').placeholder = data.password;
            document.getElementById('linkForgotPassword').innerText = data.forgot;
            document.getElementById('lblAccessCode').innerText = data.accessCode;
            document.getElementById('login_access_code').placeholder = data.accessCode;
            document.getElementById('txtRememberMe').innerText = data.remember;
            document.getElementById('txtLoginBtn').innerText = data.login;
            document.getElementById('txtProblem').innerText = data.problem;
            document.getElementById('txtClickHere').innerText = data.clickHere;
            document.getElementById('mHelpTitle').innerText = data.mTitle;
            document.getElementById('mHelpDesc').innerText = data.mDesc;

            const currentTheme = localStorage.getItem('alabeer_theme') || 'dark';
            document.getElementById('themeToggleText').innerText = currentTheme === 'dark' ? data.dark : data.light;
        }

        function updateThemeUI(theme) {
            const isDark = theme === 'dark';
            const root = document.documentElement;
            const btnTheme = document.getElementById('btnThemeToggle');
            const btnLang = document.getElementById('btnLangToggle');
            const icon = document.getElementById('themeToggleIcon');
            const text = document.getElementById('themeToggleText');
            const card = document.getElementById('loginCard');
            const leftBanner = document.getElementById('loginLeftBanner');
            const rightForm = document.getElementById('loginRightForm');
            const heroTitle = document.getElementById('txtHeroTitle');
            const trustBadges = document.getElementById('trustBadges');
            const welcome = document.getElementById('txtWelcome');
            const lblUser = document.getElementById('lblUsername');
            const lblPass = document.getElementById('lblPassword');
            const lblCode = document.getElementById('lblAccessCode');
            const txtRem = document.getElementById('txtRememberMe');
            const txtProb = document.getElementById('txtProblem');
            const helpCard = document.getElementById('helpModalCard');

            const langData = i18n[currentLang];

            if (isDark) {
                root.classList.add('dark');
                icon.innerText = '🌙';
                text.innerText = langData.dark;
                btnTheme.className = 'flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-xl border border-[#262f3e] bg-[#161c24] text-slate-200 hover:bg-[#1f2633] transition-all cursor-pointer shadow-2xs';
                btnLang.className = 'flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-xl border border-[#262f3e] bg-[#161c24] text-slate-200 hover:bg-[#1f2633] transition-all cursor-pointer shadow-2xs';
                
                card.className = 'w-full max-w-4xl bg-[#12161c] rounded-3xl border border-[#232b38] shadow-2xl shadow-black/80 overflow-hidden grid grid-cols-1 lg:grid-cols-12 transition-all duration-300';
                leftBanner.className = 'lg:col-span-6 bg-gradient-to-br from-[#181f2b] via-[#121720] to-[#0c1017] p-6 sm:p-10 flex flex-col justify-between border-b lg:border-b-0 lg:border-e border-[#232b38] relative overflow-hidden transition-colors duration-300';
                rightForm.className = 'lg:col-span-6 p-7 sm:p-10 flex flex-col justify-center bg-[#12161c] transition-colors duration-300';
                
                heroTitle.className = 'text-2xl sm:text-3xl font-extrabold text-white mt-1 tracking-tight leading-snug';
                trustBadges.className = 'relative z-10 pt-4 border-t border-[#232b38] flex flex-wrap items-center justify-between gap-3 text-[11px] text-slate-300 font-medium';
                welcome.className = 'text-xl sm:text-2xl text-white font-bold tracking-tight';
                lblUser.className = 'block text-xs font-semibold text-slate-300 mb-1';
                lblPass.className = 'block text-xs font-semibold text-slate-300 mb-1';
                lblCode.className = 'block text-xs font-semibold text-slate-300';
                txtRem.className = 'text-slate-300 text-xs';
                txtProb.className = 'text-slate-400';
                if (helpCard) helpCard.className = 'bg-[#141820] border border-[#232b38] rounded-2xl max-w-sm w-full p-5 shadow-2xl text-slate-200 text-xs space-y-3';
            } else {
                root.classList.remove('dark');
                icon.innerText = '☀️';
                text.innerText = langData.light;
                btnTheme.className = 'flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-xl border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 transition-all cursor-pointer shadow-2xs';
                btnLang.className = 'flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-xl border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 transition-all cursor-pointer shadow-2xs';
                
                card.className = 'w-full max-w-4xl bg-white rounded-3xl border border-amber-100 shadow-2xl shadow-amber-950/10 overflow-hidden grid grid-cols-1 lg:grid-cols-12 transition-all duration-300';
                leftBanner.className = 'lg:col-span-6 bg-gradient-to-br from-amber-50 via-orange-50/50 to-white p-6 sm:p-10 flex flex-col justify-between border-b lg:border-b-0 lg:border-e border-amber-100/80 relative overflow-hidden transition-colors duration-300';
                rightForm.className = 'lg:col-span-6 p-7 sm:p-10 flex flex-col justify-center bg-white transition-colors duration-300';
                
                heroTitle.className = 'text-2xl sm:text-3xl font-extrabold text-gray-900 mt-1 tracking-tight leading-snug';
                trustBadges.className = 'relative z-10 pt-4 border-t border-amber-200/50 flex flex-wrap items-center justify-between gap-3 text-[11px] text-gray-600 font-medium';
                welcome.className = 'text-xl sm:text-2xl text-gray-800 font-bold tracking-tight';
                lblUser.className = 'block text-xs font-semibold text-gray-700 mb-1';
                lblPass.className = 'block text-xs font-semibold text-gray-700 mb-1';
                lblCode.className = 'block text-xs font-semibold text-gray-800';
                txtRem.className = 'text-gray-700 text-xs';
                txtProb.className = 'text-gray-600';
                if (helpCard) helpCard.className = 'bg-white rounded-2xl max-w-sm w-full p-5 shadow-2xl text-gray-800 text-xs space-y-3';
            }
        }

        function toggleTheme() {
            const current = localStorage.getItem('alabeer_theme') || 'dark';
            const next = current === 'dark' ? 'light' : 'dark';
            localStorage.setItem('alabeer_theme', next);
            updateThemeUI(next);
        }

        function openHelpModal() {
            const m = document.getElementById('helpModal');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }

        function closeHelpModal() {
            const m = document.getElementById('helpModal');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const theme = localStorage.getItem('alabeer_theme') || 'dark';
            updateThemeUI(theme);
        });
    </script>
</body>
</html>