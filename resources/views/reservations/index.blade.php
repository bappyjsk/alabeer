<!DOCTYPE html>
<html lang="en" dir="ltr" id="resRoot">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alabeer PMS | Reservations</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
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
                        },
                        nazeel: {
                            green: '#516943',
                            darkGreen: '#455a39',
                            headerGreen: '#3e5233',
                            accentBlue: '#178AC2',
                            activeBg: '#D8D8D8',
                            purple: '#7B2CBF'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Cairo', 'system-ui', 'sans-serif'],
                        arabic: ['Cairo', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Plus Jakarta Sans", 'Cairo', system-ui, sans-serif;
            background-color: #0b0e14;
            color: #e2e8f0;
        }
        [dir="rtl"] body {
            font-family: 'Cairo', "Plus Jakarta Sans", sans-serif;
        }
        .sidebar-bg {
            background: linear-gradient(180deg, #11151c 0%, #0c0e13 100%);
        }
        .sidebar-item {
            color: #94a3b8;
            font-weight: 500;
            position: relative;
            margin: 2px 8px;
            border-radius: 10px;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-item::before {
            content: '';
            position: absolute;
            inset-inline-start: -8px;
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 3px;
            height: 20px;
            border-radius: 0 4px 4px 0;
            background-color: #e4881c;
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        [dir="rtl"] .sidebar-item::before {
            border-radius: 4px 0 0 4px;
        }
        .sidebar-item:hover {
            background: rgba(228, 136, 28, 0.12);
            color: #ffffff;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2), inset 0 0 0 1px rgba(228, 136, 28, 0.25);
        }
        .sidebar-item:hover::before {
            transform: translateY(-50%) scaleY(1);
        }
        [dir="rtl"] .sidebar-item:hover {
            transform: translateX(-4px);
        }
        .sidebar-item:active {
            transform: scale(0.98);
        }
        .sidebar-active {
            background: linear-gradient(135deg, #e4881c 0%, #c76f0d 100%) !important;
            color: #ffffff !important;
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(228, 136, 28, 0.35);
        }
        .sidebar-active::before {
            display: none;
        }
        .sidebar-active svg {
            color: #ffffff !important;
        }
        .sidebar-submenu {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            margin: 2px 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .sidebar-submenu a {
            transition: all 0.18s ease;
            border-radius: 6px;
            padding: 6px 12px;
            color: #94a3b8;
        }
        .sidebar-submenu a:hover {
            background: rgba(228, 136, 28, 0.15);
            color: #ffffff;
            transform: translateX(3px);
        }
        [dir="rtl"] .sidebar-submenu a:hover {
            transform: translateX(-3px);
        }
        /* Custom Dark Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #0b0e14;
        }
        ::-webkit-scrollbar-thumb {
            background: #232a37;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #374151;
        }

        /* Card Hover Overlay */
        .room-card .card-overlay {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.18s ease-in-out;
        }
        .room-card:hover .card-overlay,
        .room-card.active-overlay .card-overlay {
            opacity: 1;
            pointer-events: auto;
        }

        /* Light Theme Overrides */
        html.theme-light body {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
        }
        html.theme-light .sidebar-bg {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%) !important;
        }
        html.theme-light aside {
            border-color: #e2e8f0 !important;
            background-color: #ffffff !important;
        }
        html.theme-light .sidebar-item {
            color: #475569 !important;
        }
        html.theme-light .sidebar-item:hover {
            background: rgba(228, 136, 28, 0.08) !important;
            color: #0f172a !important;
        }
        html.theme-light header {
            background-color: rgba(255, 255, 255, 0.96) !important;
            border-color: #e2e8f0 !important;
        }
        html.theme-light main {
            background-color: #f8fafc !important;
        }
        html.theme-light .bg-\[\#0b0e14\] {
            background-color: #f8fafc !important;
        }
        html.theme-light .bg-\[\#12161c\],
        html.theme-light .bg-\[\#141820\],
        html.theme-light .bg-\[\#161c24\] {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #1e293b !important;
        }
        html.theme-light .bg-\[\#181e27\],
        html.theme-light .bg-\[\#1a202c\] {
            background-color: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #0f172a !important;
        }
        html.theme-light .text-white {
            color: #0f172a !important;
        }
        html.theme-light .text-slate-100,
        html.theme-light .text-slate-200,
        html.theme-light .text-slate-300 {
            color: #334155 !important;
        }
        html.theme-light .text-slate-400,
        html.theme-light .text-slate-500 {
            color: #64748b !important;
        }
        html.theme-light .border-\[\#1f2633\],
        html.theme-light .border-\[\#232b38\],
        html.theme-light .border-\[\#252f3f\],
        html.theme-light .border-\[\#262f3e\],
        html.theme-light .border-\[\#2d3748\] {
            border-color: #e2e8f0 !important;
        }
        html.theme-light .room-card {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important;
        }
        html.theme-light .room-card:hover {
            box-shadow: 0 6px 16px rgba(0,0,0,0.08) !important;
            border-color: #e4881c !important;
        }
        html.theme-light .room-card .card-overlay {
            background-color: rgba(30, 41, 59, 0.95) !important;
        }
    </style>
    <script>
        // Apply saved theme immediately to prevent FOUC
        (function() {
            const savedTheme = localStorage.getItem('alabeer_theme') || 'dark';
            if (savedTheme === 'light') {
                document.documentElement.classList.add('theme-light');
            } else {
                document.documentElement.classList.remove('theme-light');
            }
        })();
    </script>
</head>
<body class="h-screen overflow-hidden flex text-slate-100 bg-[#0b0e14] antialiased">

    <!-- Left Sidebar (Exact Same as Dashboard) -->
    <aside class="w-[240px] shrink-0 sidebar-bg flex flex-col h-screen sticky top-0 border-e border-[#1f2633] shadow-2xl z-30 select-none">
        
        <!-- Logo / Brand Header -->
        <div class="h-16 px-4 bg-[#12161c] flex items-center border-b border-[#1f2633] shadow-xs shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo_clean.png') }}" alt="alabeer" class="h-8 w-auto object-contain hover:opacity-90 transition-opacity">
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 py-1 space-y-0.5 text-[13.5px] overflow-y-auto">
            
            <!-- 1. Dashboard -->
            <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center justify-between px-4 py-3.5 {{ request()->routeIs('dashboard') ? 'sidebar-active' : '' }}">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 19h4V9H4v10zm6 0h4V5h-4v14zm6 0h4v-7h-4v7zM2 21h20v2H2v-2z"/>
                    </svg>
                    <span id="txtNavDashboard">Dashboard</span>
                </div>
            </a>

            <!-- 2. Reservations (Active) -->
            <a href="{{ route('reservations.index') }}" class="sidebar-item sidebar-active flex items-center justify-between px-4 py-3.5">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    <span id="txtNavReservations">Reservations</span>
                </div>
            </a>

            <!-- 3. Unit Status -->
            <a href="javascript:void(0)" onclick="notifyTab('Unit Status')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span id="txtNavUnitStatus">Unit Status</span>
                </div>
            </a>

            <!-- 4. Housekeeping (Dropdown) -->
            <div class="group">
                <a href="javascript:void(0)" onclick="toggleSubmenu('subHousekeeping')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span id="txtNavHousekeeping">Housekeeping</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                    </svg>
                </a>
                <div id="subHousekeeping" class="hidden sidebar-submenu text-xs py-1.5 px-4 space-y-1">
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Room Cleaning Tasks</a>
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Staff Inspection</a>
                </div>
            </div>

            <!-- 5. Financial (Dropdown) -->
            <div class="group">
                <a href="javascript:void(0)" onclick="toggleSubmenu('subFinancial')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span id="txtNavFinancial">Financial</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                    </svg>
                </a>
                <div id="subFinancial" class="hidden sidebar-submenu text-xs py-1.5 px-4 space-y-1">
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Tax Invoices (ZATCA)</a>
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Receipts & Payments</a>
                </div>
            </div>

            <!-- 6. Outlets (Dropdown) -->
            <div class="group">
                <a href="javascript:void(0)" onclick="toggleSubmenu('subOutlets')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span id="txtNavOutlets">Outlets</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                    </svg>
                </a>
                <div id="subOutlets" class="hidden sidebar-submenu text-xs py-1.5 px-4 space-y-1">
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Coffee Shop / Cafe</a>
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Laundry POS</a>
                </div>
            </div>

            <!-- 7. Customers (Dropdown) -->
            <div class="group">
                <a href="javascript:void(0)" onclick="toggleSubmenu('subCustomers')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span id="txtNavCustomers">Customers</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                    </svg>
                </a>
                <div id="subCustomers" class="hidden sidebar-submenu text-xs py-1.5 px-4 space-y-1">
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Guest Profiles</a>
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Companies & Agents</a>
                </div>
            </div>

            <!-- 8. SMS (Dropdown) -->
            <div class="group">
                <a href="javascript:void(0)" onclick="toggleSubmenu('subSMS')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                    <div class="flex items-center gap-3.5">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span id="txtNavSMS">SMS</span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                    </svg>
                </a>
                <div id="subSMS" class="hidden sidebar-submenu text-xs py-1.5 px-4 space-y-1">
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">Send SMS to Guest</a>
                    <a href="#" class="block py-1.5 text-slate-300 hover:text-white">SMS Campaign Logs</a>
                </div>
            </div>

            <!-- 9. Reports -->
            <a href="javascript:void(0)" onclick="notifyTab('Reports')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span id="txtNavReports">Reports</span>
                </div>
            </a>

            <!-- 10. Logs -->
            <a href="javascript:void(0)" onclick="notifyTab('Logs')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span id="txtNavLogs">Logs</span>
                </div>
            </a>

            <!-- 11. Night Audit -->
            <a href="javascript:void(0)" onclick="notifyTab('Night Audit')" class="sidebar-item flex items-center justify-between px-4 py-3.5">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span id="txtNavNightAudit">Night Audit</span>
                </div>
            </a>

            <!-- 12. Property Location (Pop-up Trigger Card) -->
            <div class="px-2 py-2 mt-1">
                <button type="button" id="btnSidebarPropertyPopup" onclick="openModal('modalPropertyCompliance')" class="w-full flex items-center gap-3 p-2.5 rounded-2xl bg-[#141820]/90 border border-amber-500/70 hover:border-amber-400 hover:bg-[#1a202c] shadow-lg shadow-amber-950/20 text-slate-100 hover:text-white transition-all group cursor-pointer text-start" title="Property Location">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#ea8c1e] to-[#c76f0d] flex items-center justify-center shadow-md shadow-amber-600/30 shrink-0 group-hover:scale-105 transition-transform">
                        <span class="text-lg leading-none filter drop-shadow">📍</span>
                    </div>
                    <div id="txtNavPropertyLocation" class="text-[13.5px] font-bold text-white group-hover:text-amber-400 transition-colors tracking-tight">Property Location</div>
                </button>
            </div>
        </nav>

        <!-- System Attribution & Developer Info -->
        <div class="p-3 m-3 rounded-xl bg-[#161c24] border border-[#232b38] shadow-2xs shrink-0">
            <div class="flex items-center justify-between text-[10px] text-slate-400">
                <div class="flex items-center gap-1.5 text-slate-400">
                    <svg class="w-3 h-3 text-[#e4881c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    <span class="font-medium text-slate-300">Developed by IT Team</span>
                </div>
                <span class="text-[9px] text-slate-500 font-mono font-medium">v2.4</span>
            </div>
        </div>
    </aside>

    <!-- Main Workspace -->
    <div class="flex-1 flex flex-col h-screen min-w-0 bg-[#0b0e14] overflow-hidden">
        
        <!-- Top App Header (Exact Same as Dashboard) -->
        <header class="h-16 shrink-0 bg-[#12161c]/95 backdrop-blur-md border-b border-[#1f2633] px-4 sm:px-6 flex items-center justify-between z-20 shadow-lg">
            
            <!-- Property Selector & Search -->
            <div class="flex items-center gap-4 flex-1 max-w-xl">
                <div class="relative flex items-center">
                    <span class="absolute start-3 text-alabeer-500 text-xs">🏨</span>
                    <select class="bg-[#181e27] border border-[#262f3e] rounded-lg ps-8 pe-8 py-2 text-xs font-semibold text-slate-200 focus:outline-none focus:ring-2 focus:ring-alabeer-500 focus:bg-[#1f2633] transition-all cursor-pointer">
                        <option selected>alabeer Furnished Suites - Branch 1001</option>
                        <option>alabeer Luxury Residences - Branch 1002</option>
                    </select>
                </div>

                <div class="relative w-full hidden md:block">
                    <span class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" id="topSearchInput" placeholder="Search by reservation #, guest name, national ID, room #..." class="w-full bg-[#181e27] border border-[#262f3e] rounded-lg ps-9 pe-3 py-2 text-xs text-slate-200 placeholder-slate-500 focus:bg-[#1f2633] focus:outline-none focus:ring-2 focus:ring-alabeer-500 transition-all">
                </div>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-3">
                <!-- Dual Clocks -->
                <div class="hidden xl:flex items-center gap-2 bg-[#181e27] border border-[#262f3e] px-3 py-1.5 rounded-lg text-xs text-slate-300">
                    <span title="Saudi Arabia Time">🇸🇦 <b id="navKsaTime" class="font-mono text-amber-400">--:--:--</b></span>
                    <span class="text-slate-600">|</span>
                    <span title="Bangladesh Time">🇧🇩 <b id="navBdTime" class="font-mono text-emerald-400">--:--:--</b></span>
                </div>

                <!-- Date Pill -->
                <div class="hidden lg:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#181e27] border border-[#262f3e] text-xs text-slate-300 font-medium shadow-2xs">
                    <span class="text-[#fcba63] font-semibold">{{ date('d M Y') }}</span>
                    <span class="text-slate-600">•</span>
                    <span class="font-arabic text-slate-400">1448-03-04 هـ</span>
                </div>

                <!-- Dark / Light Theme Toggle -->
                <button type="button" id="btnDashboardThemeToggle" onclick="toggleDashboardTheme()" class="flex items-center gap-1.5 text-xs border border-[#262f3e] px-3 py-1.5 rounded-lg bg-[#181e27] hover:bg-[#1f2633] hover:border-alabeer-500 text-slate-200 font-semibold shadow-2xs transition-all cursor-pointer" title="Toggle Dark / Light Mode">
                    <span id="dashThemeIcon">🌙</span>
                    <span id="dashThemeText">Dark</span>
                </button>

                <!-- Language Toggle -->
                <button type="button" onclick="toggleDashboardLang()" class="flex items-center gap-1.5 text-xs border border-[#262f3e] px-3 py-1.5 rounded-lg bg-[#181e27] hover:bg-[#1f2633] hover:border-alabeer-500 text-slate-200 font-semibold shadow-2xs transition-all">
                    <span id="btnLangLabel">Arabic 🌐</span>
                </button>

                <!-- Header Notifications Bell -->
                <div class="relative">
                    <button type="button" id="btnNotificationsToggle" onclick="toggleNotificationsMenu()" class="relative p-2 rounded-lg border border-[#262f3e] bg-[#181e27] hover:bg-[#1f2633] hover:border-amber-500/50 text-slate-300 hover:text-white transition-all cursor-pointer shadow-2xs" title="Notifications">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <!-- Active Notification Badge -->
                        <span class="absolute top-1 end-1 flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div id="notificationsDropdown" class="hidden absolute end-0 mt-2 w-80 rounded-2xl bg-[#141820] border border-[#232b38] shadow-2xl py-3 px-3 text-xs z-50 animate-in fade-in zoom-in-95">
                        <div class="flex items-center justify-between pb-2 border-b border-[#232b38]">
                            <span class="font-bold text-white flex items-center gap-1.5">
                                <span>🔔</span> Notifications
                            </span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">3 New</span>
                        </div>
                        <div class="space-y-2 py-2 max-h-64 overflow-y-auto custom-scrollbar">
                            <div class="p-2 rounded-xl bg-[#181e27] border border-[#262f3e] hover:border-amber-500/40 transition">
                                <div class="flex justify-between font-semibold text-slate-200">
                                    <span>New Reservation #NZ-204</span>
                                    <span class="text-[10px] text-slate-500 font-normal">2m ago</span>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-0.5">VIP Suite assigned to Mohammed Al-Otaibi.</p>
                            </div>
                            <div class="p-2 rounded-xl bg-[#181e27] border border-[#262f3e] hover:border-amber-500/40 transition">
                                <div class="flex justify-between font-semibold text-slate-200">
                                    <span>Room 207 Checked Out</span>
                                    <span class="text-[10px] text-slate-500 font-normal">15m ago</span>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-0.5">Folio settled. Housekeeping cleaning flagged.</p>
                            </div>
                            <div class="p-2 rounded-xl bg-[#181e27] border border-[#262f3e] hover:border-amber-500/40 transition">
                                <div class="flex justify-between font-semibold text-slate-200">
                                    <span>ZATCA Clearance</span>
                                    <span class="text-[10px] text-slate-500 font-normal">1h ago</span>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-0.5">E-Invoice #INV-2026-8492 signed and cleared.</p>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-[#232b38] text-center">
                            <button type="button" onclick="toggleNotificationsMenu()" class="text-[11px] text-amber-400 hover:text-amber-300 font-semibold">Mark all as read</button>
                        </div>
                    </div>
                </div>

                <!-- User & Logout -->
                <div class="flex items-center gap-2 border-s border-[#1f2633] ps-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#e4881c] to-[#f59e0b] text-white flex items-center justify-center font-bold text-xs shadow-md shadow-amber-500/20">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-end hidden sm:block">
                        <div class="text-xs font-bold text-white leading-tight">{{ Auth::user()->name ?? 'Supervisor' }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition-colors" title="Sign Out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Reservations Content Canvas -->
        <main class="flex-1 p-4 sm:p-6 space-y-4 overflow-y-auto bg-[#0b0e14]">
            
            @if(session('success'))
            <div class="p-3.5 rounded-xl bg-emerald-950/40 border border-emerald-500/40 text-emerald-300 text-xs font-semibold flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5">
                    <span class="w-5 h-5 rounded-full bg-emerald-500 text-slate-950 flex items-center justify-center font-bold text-xs">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200 font-bold text-base leading-none">&times;</button>
            </div>
            @endif

            <!-- Title & Top Action Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-[#1f2633]">
                <div>
                    <h1 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
                        <span>Reservations</span>
                    </h1>
                    <p class="text-xs text-slate-400 mt-0.5">You can see and manage the reservations</p>
                </div>

                <div class="flex items-center gap-2.5 flex-wrap">
                    <!-- Hotline Phone & WhatsApp -->
                    <div class="flex items-center gap-2 bg-[#181e27] border border-[#262f3e] px-3 py-1.5 rounded-xl text-xs text-slate-300">
                        <span class="font-mono font-semibold text-slate-200">+8801621404355</span>
                        <a href="tel:+8801621404355" class="w-5 h-5 rounded bg-sky-600 text-white flex items-center justify-center hover:opacity-90 transition" title="Call">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"></path>
                            </svg>
                        </a>
                        <a href="https://wa.me/8801621404355" target="_blank" class="w-5 h-5 rounded bg-[#25d366] text-white flex items-center justify-center hover:opacity-90 transition" title="WhatsApp">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Filter Button -->
                    <button onclick="toggleFilterModal(true)" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#181e27] border border-[#2d3748] hover:border-amber-500/60 text-slate-200 text-xs font-semibold shadow-xs transition-all cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span>Filter</span>
                    </button>

                    <!-- + New Reservation Button -->
                    <button onclick="openNewReservationModal()" class="flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#f59e0b] hover:to-[#d97706] text-white text-xs font-bold shadow-lg shadow-orange-500/20 transition-all cursor-pointer">
                        <span class="text-sm font-bold leading-none">+</span>
                        <span>New Reservation</span>
                    </button>
                </div>
            </div>

            <!-- View Switcher, Pagination & Status Filter Toolbar -->
            <div class="bg-[#12161c] p-3 rounded-2xl border border-[#1f2633] shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-3 text-xs">
                
                <!-- Left: Status Badges -->
                <div class="flex items-center gap-2 flex-wrap">
                    <!-- Vacant -->
                    <button onclick="filterByStatus('vacant_clean')" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#181e27] border border-[#262f3e] hover:border-emerald-500/60 transition shadow-2xs">
                        <div class="w-3.5 h-4.5 bg-emerald-500 rounded-2xs flex flex-col justify-center items-center p-0.5 gap-0.5">
                            <div class="w-full flex justify-between px-0.5"><span class="w-1 h-1 bg-white rounded-full"></span><span class="w-1 h-1 bg-white rounded-full"></span></div>
                            <div class="w-full flex justify-between px-0.5"><span class="w-1 h-1 bg-white rounded-full"></span><span class="w-1 h-1 bg-white rounded-full"></span></div>
                        </div>
                        <span class="text-slate-200 font-medium">Vacant</span>
                        <span class="text-emerald-400 font-bold ml-0.5">{{ $vacantCount ?? 8 }}</span>
                    </button>

                    <!-- Rented -->
                    <button onclick="filterByStatus('due_out')" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#181e27] border border-[#262f3e] hover:border-rose-500/60 transition shadow-2xs">
                        <div class="w-3.5 h-4.5 bg-rose-500 rounded-2xs flex flex-col justify-center items-center p-0.5 gap-0.5">
                            <div class="w-full flex justify-between px-0.5"><span class="w-1 h-1 bg-white rounded-full"></span><span class="w-1 h-1 bg-white rounded-full"></span></div>
                            <div class="w-full flex justify-between px-0.5"><span class="w-1 h-1 bg-white rounded-full"></span><span class="w-1 h-1 bg-white rounded-full"></span></div>
                        </div>
                        <span class="text-slate-200 font-medium">Rented</span>
                        <span class="text-rose-400 font-bold ml-0.5">{{ $rentedCount ?? 3 }}</span>
                    </button>

                    <!-- Waiting Check-In -->
                    <button onclick="filterByStatus('waiting')" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#181e27] border border-[#262f3e] hover:border-purple-500/60 transition shadow-2xs">
                        <div class="w-3.5 h-4.5 bg-purple-500 rounded-2xs flex flex-col justify-center items-center p-0.5 gap-0.5">
                            <div class="w-full flex justify-between px-0.5"><span class="w-1 h-1 bg-white rounded-full"></span><span class="w-1 h-1 bg-white rounded-full"></span></div>
                            <div class="w-full flex justify-between px-0.5"><span class="w-1 h-1 bg-white rounded-full"></span><span class="w-1 h-1 bg-white rounded-full"></span></div>
                        </div>
                        <span class="text-slate-200 font-medium">Waiting Check-In</span>
                        <span class="text-purple-400 font-bold ml-0.5">{{ $waitingCheckInCount ?? 1 }}</span>
                    </button>

                    <!-- Check-Out Today -->
                    <button onclick="filterByStatus('occupied')" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#181e27] border border-[#262f3e] hover:border-sky-500/60 transition shadow-2xs">
                        <div class="w-3.5 h-4.5 bg-sky-500 rounded-2xs flex flex-col justify-center items-center p-0.5 gap-0.5">
                            <div class="w-full flex justify-between px-0.5"><span class="w-1 h-1 bg-white rounded-full"></span><span class="w-1 h-1 bg-white rounded-full"></span></div>
                            <div class="w-full flex justify-between px-0.5"><span class="w-1 h-1 bg-white rounded-full"></span><span class="w-1 h-1 bg-white rounded-full"></span></div>
                        </div>
                        <span class="text-slate-200 font-medium">Check-Out Today</span>
                        <span class="text-sky-400 font-bold ml-0.5">{{ $checkOutTodayCount ?? 12 }}</span>
                    </button>

                    <!-- Occupancy Rate -->
                    <div class="px-3 py-1.5 rounded-xl bg-[#181e27] border border-[#262f3e] text-slate-400 font-medium">
                        Occupancy Rate <span class="text-amber-400 font-bold ml-1">{{ $occupancyRate ?? 66.7 }}%</span>
                    </div>
                </div>

                <!-- Right: Cleanliness Filter & View Controls -->
                <div class="flex items-center gap-3">
                    <!-- Clean / Dirty / All -->
                    <div class="flex items-center border border-[#262f3e] rounded-xl overflow-hidden bg-[#181e27]">
                        <button type="button" onclick="filterByCleanliness('clean')" id="btnClean" class="px-3 py-1 text-slate-400 hover:text-white text-xs font-medium transition">
                            Clean
                        </button>
                        <button type="button" onclick="filterByCleanliness('dirty')" id="btnDirty" class="px-3 py-1 text-slate-400 hover:text-white text-xs font-medium transition border-s border-[#262f3e]">
                            Dirty
                        </button>
                        <button type="button" onclick="filterByCleanliness('all')" id="btnAll" class="px-3.5 py-1 bg-gradient-to-r from-[#e4881c] to-[#c76f0d] text-white text-xs font-bold transition">
                            All
                        </button>
                    </div>

                    <!-- View Switcher (3 Buttons) -->
                    <div class="flex items-center gap-1 border border-[#262f3e] rounded-xl p-0.5 bg-[#181e27]">
                        <button type="button" onclick="setViewMode('list')" id="btnViewList" class="w-7 h-7 flex items-center justify-center rounded-lg text-slate-400 hover:text-white transition" title="List View">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="setViewMode('grid')" id="btnViewGrid" class="w-7 h-7 flex items-center justify-center rounded-lg bg-sky-600 text-white shadow-2xs transition" title="Grid View">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="setViewMode('calendar')" id="btnViewCalendar" class="w-7 h-7 flex items-center justify-center rounded-lg text-slate-400 hover:text-white transition" title="Calendar View">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Rows & Pagination -->
                    <div class="hidden lg:flex items-center gap-2 text-slate-400 text-xs">
                        <span id="paginationLabel">1-{{ count($rooms) }} of {{ count($rooms) }}</span>
                    </div>
                </div>

            </div>

            <!-- UNIT MATRIX SCROLL AREA (6 Columns Grid) -->
            <div class="relative">

                <!-- Room Grid (6 Columns) -->
                <div id="roomGridContainer" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3.5">
                    @forelse($rooms as $room)
                        @php
                            $isOccupied = ($room->status === 'occupied');
                            $isDueOut = ($room->status === 'due_out');
                            $isVacant = ($room->status === 'vacant_clean' || $room->status === 'vacant_dirty');
                            $currentRes = $room->currentReservation;
                            $guestName = $currentRes && $currentRes->guest ? ($currentRes->guest->full_name_ar ?: $currentRes->guest->first_name . ' ' . $currentRes->guest->last_name) : null;
                            $folioBalance = $currentRes && $currentRes->folio ? $currentRes->folio->balance : 0;
                            
                            // Status color
                            if ($isOccupied) {
                                $iconBg = 'bg-sky-600';
                            } elseif ($isDueOut) {
                                $iconBg = 'bg-rose-600';
                            } else {
                                $iconBg = 'bg-emerald-600';
                            }

                            $isForceHover = ($room->room_number === '204');
                        @endphp

                        <!-- Single Room Card -->
                        <div class="room-card group relative bg-[#141820] border border-[#232b38] rounded-xl p-3 shadow-lg hover:border-amber-500/50 transition-all flex items-start gap-3 h-[92px] overflow-hidden {{ $isForceHover ? 'active-overlay' : '' }}"
                             data-room-id="{{ $room->id }}"
                             data-room-number="{{ $room->room_number }}"
                             data-room-type="{{ $room->roomType->name_en ?? 'Standard' }}"
                             data-room-type-id="{{ $room->room_type_id }}"
                             data-status="{{ $room->status }}"
                             data-floor="{{ $room->floor }}"
                             data-guest-name="{{ $guestName ?? '' }}"
                             data-cleanliness="{{ str_contains($room->status, 'dirty') ? 'dirty' : 'clean' }}">

                            <!-- Left: Dot Matrix Vertical Icon Box -->
                            <div class="w-[30px] h-[40px] rounded-lg shrink-0 {{ $iconBg }} text-white flex flex-col justify-center items-center p-1 gap-1 shadow-xs">
                                <div class="w-full flex justify-between px-0.5">
                                    <span class="w-1 h-1 bg-white rounded-full"></span>
                                    <span class="w-1 h-1 bg-white rounded-full"></span>
                                </div>
                                <div class="w-full flex justify-between px-0.5">
                                    <span class="w-1 h-1 bg-white rounded-full"></span>
                                    <span class="w-1 h-1 bg-white rounded-full"></span>
                                </div>
                                <div class="w-full flex justify-between px-0.5">
                                    <span class="w-1 h-1 bg-white rounded-full"></span>
                                    <span class="w-1 h-1 bg-white rounded-full"></span>
                                </div>
                            </div>

                            <!-- Right: Room Details -->
                            <div class="flex-1 min-w-0 flex flex-col justify-start leading-tight">
                                <!-- Room Number -->
                                <h3 class="text-base font-bold text-white tracking-tight">{{ $room->room_number }}</h3>
                                <!-- Room Type -->
                                <p class="text-[11px] text-slate-400 truncate mt-0.5">
                                    {{ $room->roomType->name_en ?? 'Standard' }}
                                </p>

                                <!-- Guest Name & Balance -->
                                @if($guestName)
                                    <p class="text-[11px] text-slate-200 font-medium truncate mt-1">
                                        {{ $guestName }}
                                    </p>
                                    <p class="text-[10px] font-bold text-amber-400 mt-0.5">
                                        SAR {{ number_format($folioBalance) }}
                                    </p>
                                @endif
                            </div>

                            <!-- HOVER OVERLAY -->
                            <div class="card-overlay absolute inset-0 bg-[#1e293b]/95 backdrop-blur-xs rounded-xl p-2.5 flex flex-col justify-between items-center z-20 text-white shadow-2xl border border-amber-500/40">
                                <!-- Top: Calendar Icon -->
                                <div class="w-full flex justify-start">
                                    <div class="w-5 h-5 bg-white/10 rounded flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Center: '+' Quick Reservation -->
                                <button type="button" 
                                        onclick="openQuickReservation('{{ $room->id }}', '{{ $room->room_number }}', '{{ $room->roomType->name_en ?? '' }}', '{{ $room->room_type_id }}', '{{ $room->roomType->base_price ?? 350 }}')"
                                        class="w-7 h-7 bg-gradient-to-r from-[#e4881c] to-[#c76f0d] rounded-lg flex items-center justify-center text-white font-bold text-base shadow hover:scale-105 transition leading-none -mt-1"
                                        title="Quick Reservation">
                                    +
                                </button>

                                <!-- Bottom: 'Unit Details' Button -->
                                <button type="button" 
                                        onclick="openUnitDetails('{{ $room->id }}', '{{ $room->room_number }}', '{{ $room->roomType->name_en ?? '' }}', '{{ $room->status }}', '{{ $guestName ?? '' }}', '{{ $folioBalance }}', '{{ $room->roomType->base_price ?? 350 }}', '{{ $room->floor }}')"
                                        class="w-full py-0.5 text-[11px] bg-white/10 hover:bg-white/20 text-white rounded-md text-center font-medium transition tracking-tight">
                                    Unit Details
                                </button>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center text-slate-500">
                            No units found in the system.
                        </div>
                    @endforelse
                </div>

                <!-- Empty Search Filter State -->
                <div id="noMatchFilterState" class="hidden py-16 text-center">
                    <svg class="w-10 h-10 text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xs font-semibold text-slate-400">No rooms match the selected filter criteria</p>
                    <button onclick="resetFilters()" class="mt-2 text-xs text-amber-400 hover:underline font-semibold">
                        Reset all filters
                    </button>
                </div>

            </div>

        </main>
    </div>

    <!-- FLOATING SUPPORT CHAT & TICKET (popSupportChatTicket) -->
    <div id="popSupportChatTicket" class="fixed bottom-6 right-6 z-40 flex flex-col items-end">
        <button onclick="toggleSupportChatTicket()" class="w-12 h-12 rounded-full bg-gradient-to-r from-purple-700 to-indigo-600 text-white shadow-2xl hover:scale-105 transition-all flex items-center justify-center relative" title="Help & Support">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zm-4 0h-2v2h2V9z" clip-rule="evenodd"></path>
            </svg>
            <span class="absolute top-0 right-0 w-3 h-3 bg-emerald-400 border-2 border-[#12161c] rounded-full"></span>
        </button>

        <div id="boxSupportChatTicket" class="hidden w-80 sm:w-96 bg-[#141820] rounded-2xl shadow-2xl border border-[#232b38] overflow-hidden mb-3 text-xs">
            <div class="bg-gradient-to-r from-[#181e27] to-[#12161c] p-4 border-b border-[#232b38] text-white flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span>💬</span>
                    <span class="font-bold">alabeer PMS Support Desk</span>
                </div>
                <button onclick="toggleSupportChatTicket(false)" class="text-slate-400 hover:text-white font-bold">✕</button>
            </div>
            <!-- Support Hotline & Email Contact Strip -->
            <div class="px-4 py-2 bg-[#10141b] border-b border-[#232b38] flex items-center justify-between text-[11px] text-slate-300">
                <div class="flex items-center gap-1.5">
                    <span class="text-amber-400">📞</span>
                    <a href="tel:+8801621404355" class="hover:text-amber-400 font-mono font-medium text-slate-200">+8801621404355</a>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="text-sky-400">✉️</span>
                    <a href="mailto:support@alabeer.sa" class="hover:text-sky-400 font-medium text-slate-200">support@alabeer.sa</a>
                </div>
            </div>
            <div class="p-4 space-y-3">
                <p class="text-slate-300">How can we assist with PMS operations today?</p>
                <input type="text" placeholder="Type message..." class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none">
                <button onclick="toggleSupportChatTicket(false)" class="w-full py-2 bg-gradient-to-r from-[#e4881c] to-[#c76f0d] text-white font-bold rounded-xl shadow">Send</button>
            </div>
        </div>
    </div>

    <!-- MODAL: NEW RESERVATION -->
    <div id="modalNewReservation" class="hidden fixed inset-0 z-50 bg-black/75 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#141820] rounded-2xl shadow-2xl border border-[#232b38] max-w-xl w-full overflow-hidden text-slate-100 animate-in fade-in zoom-in-95">
            <div class="bg-gradient-to-r from-[#181e27] to-[#12161c] px-6 py-4 border-b border-[#232b38] flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-[#e4881c] to-[#f59e0b] text-white flex items-center justify-center font-bold text-sm shadow-md">
                        ➕
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Create New Reservation</h3>
                        <p class="text-[11px] text-slate-400">alabeer PMS • Guest Booking Form</p>
                    </div>
                </div>
                <button onclick="closeNewReservationModal()" class="text-slate-400 hover:text-white text-xl font-bold">
                    ✕
                </button>
            </div>

            <form action="{{ route('reservations.store') }}" method="POST" class="p-6 space-y-4 text-xs">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Guest Full Name *</label>
                        <input type="text" name="guest_name" required placeholder="e.g. Mohammed Al-Otaibi"
                               class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 placeholder-slate-500 outline-none focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Phone Number *</label>
                        <input type="text" name="guest_phone" required placeholder="e.g. +966 50 123 4567"
                               class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 placeholder-slate-500 outline-none focus:border-amber-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">National ID / Passport *</label>
                        <input type="text" name="guest_id_number" required placeholder="e.g. 1098765432"
                               class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 placeholder-slate-500 outline-none focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Room Assignment *</label>
                        <select name="room_id" id="newResRoomSelect" required class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none focus:border-amber-500">
                            @foreach($rooms as $r)
                                <option value="{{ $r->id }}">Room {{ $r->room_number }} ({{ $r->roomType->name_en ?? 'Standard' }}) - {{ ucfirst(str_replace('_', ' ', $r->status)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Check-in Date *</label>
                        <input type="date" name="check_in_date" value="{{ date('Y-m-d') }}" required
                               class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Check-out Date *</label>
                        <input type="date" name="check_out_date" value="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                               class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none focus:border-amber-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Daily Rate (SAR) *</label>
                        <input type="number" step="0.01" name="rate_per_night" value="350.00" required
                               class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none focus:border-amber-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Payment Method</label>
                        <select name="payment_method" class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none focus:border-amber-500">
                            <option value="mada">mada Debit Card</option>
                            <option value="visa">Visa / MasterCard</option>
                            <option value="cash">Cash at Desk</option>
                            <option value="corporate">Corporate Direct Billing</option>
                        </select>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#232b38] flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeNewReservationModal()" class="px-4 py-2 rounded-xl border border-[#2d3748] text-slate-300 hover:bg-[#1a202c] transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#f59e0b] hover:to-[#d97706] text-white font-bold transition shadow-lg shadow-orange-500/20">
                        Confirm Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: QUICK RESERVATION -->
    <div id="modalQuickReservation" class="hidden fixed inset-0 z-50 bg-black/75 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#141820] rounded-2xl shadow-2xl border border-[#232b38] max-w-md w-full overflow-hidden text-slate-100 animate-in fade-in zoom-in-95">
            <div class="bg-gradient-to-r from-[#181e27] to-[#12161c] px-6 py-4 border-b border-[#232b38] flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-white">Quick Reservation: Room <span id="quickRoomNumberTitle" class="text-amber-400"></span></h3>
                    <p class="text-[11px] text-slate-400" id="quickRoomTypeTitle">Standard</p>
                </div>
                <button onclick="closeQuickReservation()" class="text-slate-400 hover:text-white text-xl font-bold">✕</button>
            </div>

            <form action="{{ route('reservations.store') }}" method="POST" class="p-6 space-y-3.5 text-xs">
                @csrf
                <input type="hidden" name="room_id" id="quickRoomId">
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">Guest Name *</label>
                    <input type="text" name="guest_name" required placeholder="Guest full name" class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none focus:border-amber-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">National ID / Iqama *</label>
                    <input type="text" name="guest_id_number" required placeholder="ID number" class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none focus:border-amber-500">
                </div>
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">Phone Number *</label>
                    <input type="text" name="guest_phone" required placeholder="+966 5..." class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none focus:border-amber-500">
                </div>
                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Check-in</label>
                        <input type="date" name="check_in_date" value="{{ date('Y-m-d') }}" class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Check-out</label>
                        <input type="date" name="check_out_date" value="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none">
                    </div>
                </div>

                <div class="pt-3 border-t border-[#232b38] flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeQuickReservation()" class="px-4 py-2 rounded-xl border border-[#2d3748] text-slate-300 hover:bg-[#1a202c] transition">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] text-white font-bold transition shadow-md">Assign & Reserve</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: UNIT DETAILS -->
    <div id="modalUnitDetails" class="hidden fixed inset-0 z-50 bg-black/75 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#141820] rounded-2xl shadow-2xl border border-[#232b38] max-w-lg w-full overflow-hidden text-slate-100 animate-in fade-in zoom-in-95">
            <div class="bg-gradient-to-r from-[#181e27] to-[#12161c] px-6 py-4 border-b border-[#232b38] flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-white">Unit Overview: Room <span id="detailRoomNumber" class="text-amber-400"></span></h3>
                    <p class="text-[11px] text-slate-400">Floor <span id="detailFloor"></span> • <span id="detailRoomType"></span></p>
                </div>
                <button onclick="closeUnitDetails()" class="text-slate-400 hover:text-white text-xl font-bold">✕</button>
            </div>

            <div class="p-6 space-y-4 text-xs">
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 rounded-xl bg-[#181e27] border border-[#262f3e]">
                        <span class="text-slate-400 text-[11px] block">Current Status</span>
                        <span id="detailStatus" class="font-bold text-sm text-white capitalize mt-0.5 block"></span>
                    </div>
                    <div class="p-3 rounded-xl bg-[#181e27] border border-[#262f3e]">
                        <span class="text-slate-400 text-[11px] block">Nightly Base Rate</span>
                        <span id="detailPrice" class="font-bold text-sm text-amber-400 mt-0.5 block"></span>
                    </div>
                </div>

                <div class="p-3.5 rounded-xl bg-[#181e27] border border-[#262f3e] space-y-2">
                    <div class="font-semibold text-slate-200">Current Occupant & Billing</div>
                    <div class="flex justify-between text-slate-400">
                        <span>Guest:</span>
                        <b id="detailGuestName" class="text-slate-200">None</b>
                    </div>
                    <div class="flex justify-between text-slate-400">
                        <span>Folio Balance:</span>
                        <b id="detailFolioBalance" class="text-amber-400">0 SAR</b>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#232b38] flex items-center justify-end">
                    <button type="button" onclick="closeUnitDetails()" class="px-5 py-2 rounded-xl bg-[#181e27] hover:bg-[#1f2633] text-slate-200 font-semibold border border-[#2d3748] transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: FILTER -->
    <div id="modalFilter" class="hidden fixed inset-0 z-50 bg-black/75 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#141820] rounded-2xl shadow-2xl border border-[#232b38] max-w-md w-full overflow-hidden text-slate-100 animate-in fade-in zoom-in-95">
            <div class="bg-gradient-to-r from-[#181e27] to-[#12161c] px-6 py-4 border-b border-[#232b38] flex items-center justify-between">
                <h3 class="text-sm font-bold text-white">Filter Unit Matrix</h3>
                <button onclick="toggleFilterModal(false)" class="text-slate-400 hover:text-white text-xl font-bold">✕</button>
            </div>
            <div class="p-6 space-y-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">Filter by Floor</label>
                    <select id="filterFloorSelect" class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none">
                        <option value="all">All Floors</option>
                        <option value="2">Floor 2 (201 - 208)</option>
                        <option value="3">Floor 3 (301 - 308)</option>
                        <option value="4">Floor 4 (401 - 408)</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">Filter by Room Type</label>
                    <select id="filterRoomTypeSelect" class="w-full bg-[#1a202c] border border-[#2d3748] rounded-xl px-3 py-2 text-slate-100 outline-none">
                        <option value="all">All Room Types</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type->name_en }}">{{ $type->name_en }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="pt-3 border-t border-[#232b38] flex items-center justify-end gap-2.5">
                    <button type="button" onclick="resetFilters(); toggleFilterModal(false)" class="px-4 py-2 rounded-xl border border-[#2d3748] text-slate-300 hover:bg-[#1a202c] transition">
                        Reset
                    </button>
                    <button type="button" onclick="applyAdvFilter()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] text-white font-bold transition">
                        Apply Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: PROPERTY LOCATION & COMPLIANCE -->
    <div id="modalPropertyCompliance" class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-[#141820] border border-[#232b38] text-slate-100 rounded-2xl max-w-xl w-full p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-[#232b38] pb-3">
                <div class="flex items-center gap-2">
                    <span class="text-xl">📍</span>
                    <h3 class="font-bold text-base text-white">Property Location & Information</h3>
                </div>
                <button type="button" onclick="closeModal('modalPropertyCompliance')" class="text-slate-400 hover:text-white text-xl font-bold">&times;</button>
            </div>
            <div class="space-y-3 text-xs">
                <div class="p-3 rounded-xl bg-[#181e27] border border-[#262f3e]">
                    <div class="text-slate-400">Property Name</div>
                    <div class="text-white font-bold text-sm mt-0.5">alabeer Furnished Suites - Branch 1001</div>
                    <div class="text-slate-400 mt-1">Tabuk, Kingdom of Saudi Arabia</div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 rounded-xl bg-[#181e27] border border-[#262f3e]">
                        <span class="text-slate-400 text-[11px] block">Commercial Reg (CR)</span>
                        <span class="font-bold text-slate-200">1010892410</span>
                    </div>
                    <div class="p-3 rounded-xl bg-[#181e27] border border-[#262f3e]">
                        <span class="text-slate-400 text-[11px] block">VAT Registration</span>
                        <span class="font-bold text-slate-200">310294819200003</span>
                    </div>
                </div>
            </div>
            <div class="pt-3 border-t border-[#232b38] flex items-center justify-end">
                <button type="button" onclick="closeModal('modalPropertyCompliance')" class="px-4 py-2 rounded-xl bg-[#181e27] text-slate-300 hover:bg-[#1f2633] transition font-semibold">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        // Notification Dropdown
        function toggleNotificationsMenu() {
            const el = document.getElementById('notificationsDropdown');
            if (el) el.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const btn = document.getElementById('btnNotificationsToggle');
            const dropdown = document.getElementById('notificationsDropdown');
            if (dropdown && !dropdown.classList.contains('hidden')) {
                if (btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            }
        });

        // Modal helpers
        function openModal(id) {
            const el = document.getElementById(id);
            if (el) el.classList.remove('hidden');
        }
        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) el.classList.add('hidden');
        }

        function openNewReservationModal() {
            openModal('modalNewReservation');
        }
        function closeNewReservationModal() {
            closeModal('modalNewReservation');
        }

        function openQuickReservation(id, roomNo, type, typeId, price) {
            document.getElementById('quickRoomId').value = id;
            document.getElementById('quickRoomNumberTitle').textContent = roomNo;
            document.getElementById('quickRoomTypeTitle').textContent = type;
            openModal('modalQuickReservation');
        }
        function closeQuickReservation() {
            closeModal('modalQuickReservation');
        }

        function openUnitDetails(id, roomNo, type, status, guest, balance, price, floor) {
            document.getElementById('detailRoomNumber').textContent = roomNo;
            document.getElementById('detailFloor').textContent = floor || '2';
            document.getElementById('detailRoomType').textContent = type;
            document.getElementById('detailStatus').textContent = status.replace('_', ' ');
            document.getElementById('detailPrice').textContent = price + ' SAR';
            document.getElementById('detailGuestName').textContent = guest || 'None';
            document.getElementById('detailFolioBalance').textContent = balance ? balance + ' SAR' : '0 SAR';
            openModal('modalUnitDetails');
        }
        function closeUnitDetails() {
            closeModal('modalUnitDetails');
        }

        function toggleFilterModal(show) {
            if (show) openModal('modalFilter');
            else closeModal('modalFilter');
        }

        function toggleSupportChatTicket(show) {
            const box = document.getElementById('boxSupportChatTicket');
            if (box) {
                if (show === false) box.classList.add('hidden');
                else if (show === true) box.classList.remove('hidden');
                else box.classList.toggle('hidden');
            }
        }

        function notifyTab(tab) {
            // General notification
        }

        function toggleSubmenu(id) {
            const el = document.getElementById(id);
            if (el) el.classList.toggle('hidden');
        }

        // Live Dual Clocks (Saudi Arabia & Bangladesh)
        function updateWorldClocks() {
            const now = new Date();
            const saudiTimeStr = now.toLocaleTimeString('en-US', {
                timeZone: 'Asia/Riyadh',
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const bdTimeStr = now.toLocaleTimeString('en-US', {
                timeZone: 'Asia/Dhaka',
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            const elSaudiTime = document.getElementById('navKsaTime');
            const elBdTime = document.getElementById('navBdTime');
            if (elSaudiTime) elSaudiTime.innerText = saudiTimeStr;
            if (elBdTime) elBdTime.innerText = bdTimeStr;
        }

        // Theme Toggle
        function toggleDashboardTheme() {
            const isLight = document.documentElement.classList.contains('theme-light');
            if (isLight) {
                document.documentElement.classList.remove('theme-light');
                localStorage.setItem('alabeer_theme', 'dark');
                updateDashboardThemeUI('dark');
            } else {
                document.documentElement.classList.add('theme-light');
                localStorage.setItem('alabeer_theme', 'light');
                updateDashboardThemeUI('light');
            }
        }

        function updateDashboardThemeUI(theme) {
            const icon = document.getElementById('dashThemeIcon');
            const text = document.getElementById('dashThemeText');
            if (icon && text) {
                if (theme === 'light') {
                    icon.textContent = '☀️';
                    text.textContent = 'Light';
                } else {
                    icon.textContent = '🌙';
                    text.textContent = 'Dark';
                }
            }
        }

        // Language Toggle
        function toggleDashboardLang() {
            const root = document.getElementById('resRoot');
            const isRtl = root.getAttribute('dir') === 'rtl';
            if (isRtl) {
                root.setAttribute('dir', 'ltr');
                document.getElementById('btnLangLabel').textContent = 'Arabic 🌐';
            } else {
                root.setAttribute('dir', 'rtl');
                document.getElementById('btnLangLabel').textContent = 'English 🌐';
            }
        }

        // Filtering Logic
        let activeStatusFilter = 'all';
        let activeCleanFilter = 'all';
        let activeFloorFilter = 'all';
        let activeTypeFilter = 'all';

        function filterByStatus(status) {
            activeStatusFilter = (activeStatusFilter === status) ? 'all' : status;
            applyAllFilters();
        }

        function filterByCleanliness(clean) {
            activeCleanFilter = clean;
            document.getElementById('btnClean').className = clean === 'clean' ? 'px-3 py-1 bg-gradient-to-r from-[#e4881c] to-[#c76f0d] text-white text-xs font-bold transition' : 'px-3 py-1 text-slate-400 hover:text-white text-xs font-medium transition';
            document.getElementById('btnDirty').className = clean === 'dirty' ? 'px-3 py-1 bg-gradient-to-r from-[#e4881c] to-[#c76f0d] text-white text-xs font-bold transition border-s border-[#262f3e]' : 'px-3 py-1 text-slate-400 hover:text-white text-xs font-medium transition border-s border-[#262f3e]';
            document.getElementById('btnAll').className = clean === 'all' ? 'px-3.5 py-1 bg-gradient-to-r from-[#e4881c] to-[#c76f0d] text-white text-xs font-bold transition' : 'px-3.5 py-1 text-slate-400 hover:text-white text-xs font-medium transition';
            applyAllFilters();
        }

        function applyAdvFilter() {
            activeFloorFilter = document.getElementById('filterFloorSelect').value;
            activeTypeFilter = document.getElementById('filterRoomTypeSelect').value;
            toggleFilterModal(false);
            applyAllFilters();
        }

        function resetFilters() {
            activeStatusFilter = 'all';
            activeCleanFilter = 'all';
            activeFloorFilter = 'all';
            activeTypeFilter = 'all';
            const searchInput = document.getElementById('topSearchInput');
            if (searchInput) searchInput.value = '';
            filterByCleanliness('all');
            applyAllFilters();
        }

        function applyAllFilters() {
            const cards = document.querySelectorAll('.room-card');
            const searchVal = (document.getElementById('topSearchInput')?.value || '').toLowerCase().trim();
            let visibleCount = 0;

            cards.forEach(card => {
                const roomNo = card.dataset.roomNumber.toLowerCase();
                const roomType = card.dataset.roomType;
                const status = card.dataset.status;
                const floor = card.dataset.floor;
                const guest = (card.dataset.guestName || '').toLowerCase();
                const cleanliness = card.dataset.cleanliness;

                let matchStatus = true;
                if (activeStatusFilter === 'vacant_clean') {
                    matchStatus = (status === 'vacant_clean');
                } else if (activeStatusFilter === 'due_out') {
                    matchStatus = (status === 'due_out');
                } else if (activeStatusFilter === 'occupied') {
                    matchStatus = (status === 'occupied');
                } else if (activeStatusFilter === 'waiting') {
                    matchStatus = (status === 'reserved' || status === 'waiting');
                }

                let matchClean = true;
                if (activeCleanFilter !== 'all') {
                    matchClean = (cleanliness === activeCleanFilter);
                }

                let matchFloor = true;
                if (activeFloorFilter !== 'all') {
                    matchFloor = (floor === activeFloorFilter);
                }

                let matchType = true;
                if (activeTypeFilter !== 'all') {
                    matchType = (roomType === activeTypeFilter);
                }

                let matchSearch = true;
                if (searchVal) {
                    matchSearch = (roomNo.includes(searchVal) || roomType.toLowerCase().includes(searchVal) || guest.includes(searchVal));
                }

                if (matchStatus && matchClean && matchFloor && matchType && matchSearch) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const noMatch = document.getElementById('noMatchFilterState');
            const paginationLabel = document.getElementById('paginationLabel');
            if (visibleCount === 0) {
                noMatch.classList.remove('hidden');
            } else {
                noMatch.classList.add('hidden');
            }
            if (paginationLabel) {
                paginationLabel.textContent = `1-${visibleCount} of ${visibleCount}`;
            }
        }

        // Live Search
        document.getElementById('topSearchInput')?.addEventListener('input', function() {
            applyAllFilters();
        });

        // View Mode Switcher
        function setViewMode(mode) {
            const btnList = document.getElementById('btnViewList');
            const btnGrid = document.getElementById('btnViewGrid');
            const btnCalendar = document.getElementById('btnViewCalendar');
            const container = document.getElementById('roomGridContainer');

            [btnList, btnGrid, btnCalendar].forEach(b => {
                b.className = 'w-7 h-7 flex items-center justify-center rounded-lg text-slate-400 hover:text-white transition';
            });

            if (mode === 'grid') {
                btnGrid.className = 'w-7 h-7 flex items-center justify-center rounded-lg bg-sky-600 text-white shadow-2xs transition';
                container.className = 'grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3.5';
            } else if (mode === 'list') {
                btnList.className = 'w-7 h-7 flex items-center justify-center rounded-lg bg-sky-600 text-white shadow-2xs transition';
                container.className = 'grid grid-cols-1 gap-2';
            } else {
                btnCalendar.className = 'w-7 h-7 flex items-center justify-center rounded-lg bg-sky-600 text-white shadow-2xs transition';
                container.className = 'grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3.5';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateWorldClocks();
            setInterval(updateWorldClocks, 1000);

            const savedTheme = localStorage.getItem('alabeer_theme') || 'dark';
            updateDashboardThemeUI(savedTheme);
        });
    </script>
</body>
</html>