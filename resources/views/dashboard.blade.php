<!DOCTYPE html>
<html lang="en" dir="ltr" id="dashRoot">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alabeer PMS | Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
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
        .room-badge {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .room-badge:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 20px -4px rgba(0, 0, 0, 0.4);
        }
        .fab-purple {
            background: linear-gradient(135deg, #8b3cd4 0%, #6a24a5 100%);
            box-shadow: 0 8px 25px -4px rgba(123, 44, 191, 0.5);
        }
        .fab-purple:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 12px 30px -4px rgba(123, 44, 191, 0.65);
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
        html.theme-light .hover\:bg-\[\#1f2633\]:hover,
        html.theme-light .hover\:bg-\[\#1c2433\]:hover {
            background-color: #f1f5f9 !important;
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
    <!-- Left Sidebar (Permanently Frozen Tablet Dark Matte) -->
    <aside class="w-[240px] shrink-0 sidebar-bg flex flex-col h-screen sticky top-0 border-e border-[#1f2633] shadow-2xl z-30 select-none">
        
        <!-- Logo / Brand Header -->
        <div class="h-16 px-4 bg-[#12161c] flex items-center border-b border-[#1f2633] shadow-xs shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo_clean.png') }}" alt="alabeer" class="h-8 w-auto object-contain hover:opacity-90 transition-opacity">
            </a>
        </div>



        <!-- Navigation Menu -->
        <nav class="flex-1 py-1 space-y-0.5 text-[13.5px] overflow-y-auto">
            
            <!-- 1. Dashboard (Active Item) -->
            <a href="{{ route('dashboard') }}" class="sidebar-item sidebar-active flex items-center justify-between px-4 py-3.5">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 19h4V9H4v10zm6 0h4V5h-4v14zm6 0h4v-7h-4v7zM2 21h20v2H2v-2z"/>
                    </svg>
                    <span id="txtNavDashboard">Dashboard</span>
                </div>
            </a>

            <!-- 2. Reservations -->
            <a href="{{ route('reservations.index') }}" class="sidebar-item flex items-center justify-between px-4 py-3.5 {{ request()->routeIs('reservations.index') ? 'sidebar-active' : '' }}">
                <div class="flex items-center gap-3.5">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

            <!-- 12. Property Location (Pop-up Trigger Card - Only Name) -->
            <div class="px-2 py-2 mt-1">
                <button type="button" id="btnSidebarPropertyPopup" onclick="openModal('modalPropertyCompliance')" class="w-full flex items-center gap-3 p-2.5 rounded-2xl bg-[#141820]/90 border border-amber-500/70 hover:border-amber-400 hover:bg-[#1a202c] shadow-lg shadow-amber-950/20 text-slate-100 hover:text-white transition-all group cursor-pointer text-start" title="Property Location">
                    <!-- Orange icon box with pink pin marker -->
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
        
        <!-- Top App Header -->
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
                    <input type="text" placeholder="Search by reservation #, guest name, national ID, room #..." class="w-full bg-[#181e27] border border-[#262f3e] rounded-lg ps-9 pe-3 py-2 text-xs text-slate-200 placeholder-slate-500 focus:bg-[#1f2633] focus:outline-none focus:ring-2 focus:ring-alabeer-500 transition-all">
                </div>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-3">
                <!-- Date Pill -->
                <div class="hidden lg:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#181e27] border border-[#262f3e] text-xs text-slate-300 font-medium shadow-2xs">
                    <span class="text-[#fcba63] font-semibold">16 Sep 2026</span>
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

        <!-- Main Dashboard Body -->
        <main class="flex-1 p-4 sm:p-6 space-y-6 overflow-y-auto bg-[#0b0e14]">
            
            @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-950/40 border border-emerald-500/40 text-emerald-300 text-xs font-semibold flex items-center justify-between shadow-xs animate-fadeIn">
                <div class="flex items-center gap-2.5">
                    <span class="w-5 h-5 rounded-full bg-emerald-500 text-slate-950 flex items-center justify-center font-bold text-xs">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200 font-bold text-base leading-none">&times;</button>
            </div>
            @endif

            @if($errors->any())
            <div class="p-4 rounded-xl bg-rose-950/40 border border-rose-500/40 text-rose-300 text-xs font-semibold shadow-xs">
                <div class="font-bold mb-1 flex items-center gap-1.5">
                    <span>⚠️</span> <span>Please fix the following errors:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 font-normal ps-4">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Quick Actions Toolbar & Live World Clocks (Saudi Arabia & Bangladesh) -->
            <div class="bg-[#12161c] p-3 sm:p-4 rounded-2xl border border-[#1f2633] shadow-lg flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2.5">
                    <button type="button" onclick="openNewResModal()" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#d47b15] hover:to-[#b45b0a] text-white font-bold text-xs flex items-center gap-2 shadow-md shadow-amber-900/30 transition-all hover:shadow-lg hover:-translate-y-0.5">
                        <span class="text-white">➕</span> <span id="btnNewRes">New Reservation</span>
                    </button>
                    <button type="button" onclick="openWalkInModal()" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white font-bold text-xs flex items-center gap-2 shadow-md shadow-amber-900/30 transition-all hover:shadow-lg hover:-translate-y-0.5">
                        <span>🔑</span> <span id="btnWalkin">Walk-in Check-in</span>
                    </button>
                    <button type="button" onclick="alert('ZATCA e-Invoicing Phase 2 FATOORA integration active')" class="px-3.5 py-2.5 rounded-xl bg-[#181e27] hover:bg-[#1f2633] text-slate-200 hover:text-white font-semibold text-xs border border-[#262f3e] hover:border-alabeer-500 transition-colors flex items-center gap-1.5">
                        <span>🧾</span> <span id="btnInvoice">Tax Invoice</span>
                    </button>
                </div>

                <!-- Right Side: Dual Live Clocks (Saudi Arabia & Bangladesh) -->
                <div class="flex items-center gap-2.5 sm:gap-3 flex-wrap">
                    
                    <!-- 1. Saudi Arabia (Riyadh, GMT+3) Clock -->
                    <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl bg-[#181e27] border border-[#262f3e] shadow-sm hover:border-emerald-500/50 transition-colors" title="Kingdom of Saudi Arabia (Riyadh Time - GMT+3)">
                        <!-- Saudi Flag -->
                        <span class="text-lg leading-none filter drop-shadow">🇸🇦</span>
                        <div class="leading-tight">
                            <div class="flex items-center gap-1.5">
                                <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider">KSA (Riyadh)</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            </div>
                            <div class="flex items-baseline gap-1.5">
                                <span id="clockSaudiTime" class="text-xs font-mono font-black text-white tracking-wide">--:--:--</span>
                                <span id="clockSaudiDate" class="text-[10px] text-slate-400 font-medium">16 Sep 2026</span>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-7 w-[1px] bg-[#232b38] hidden sm:block"></div>

                    <!-- 2. Bangladesh (Dhaka, GMT+6) Clock -->
                    <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl bg-[#181e27] border border-[#262f3e] shadow-sm hover:border-rose-500/50 transition-colors" title="Bangladesh (Dhaka Time - GMT+6)">
                        <!-- BD Flag -->
                        <span class="text-lg leading-none filter drop-shadow">🇧🇩</span>
                        <div class="leading-tight">
                            <div class="flex items-center gap-1.5">
                                <span class="text-[10px] font-bold text-rose-400 uppercase tracking-wider">BD (Dhaka)</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                            </div>
                            <div class="flex items-baseline gap-1.5">
                                <span id="clockBdTime" class="text-xs font-mono font-black text-white tracking-wide">--:--:--</span>
                                <span id="clockBdDate" class="text-[10px] text-slate-400 font-medium">16 Sep 2026</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <!-- Nazeel Property Operation Panels (Matching Reference Screen) -->
            <div class="space-y-4">
                
                <!-- Row 1: Reservations Balances & Drawer Balance -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-3.5">
                    
                    <!-- Reservations Balances (8 Cols) -->
                    <div class="lg:col-span-8 bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-bold text-sky-400 uppercase tracking-wider flex items-center gap-1.5">
                                <span>💳</span> <span>Reservations Balances</span>
                            </h4>
                            <span class="text-[10px] text-slate-500 font-mono">Live Ledger</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <!-- Credit -->
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-[#181e27] border border-[#262f3e] shadow-xs">
                                <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 flex items-center justify-center font-bold text-base shrink-0">
                                    ⬅️
                                </div>
                                <div class="leading-tight">
                                    <div class="text-[11px] text-slate-400 font-semibold">Credit</div>
                                    <div class="text-base font-black text-white mt-0.5">0.00 <span class="text-xs font-normal text-slate-400">SAR</span></div>
                                </div>
                            </div>
                            <!-- Debit -->
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-[#181e27] border border-[#262f3e] shadow-xs">
                                <div class="w-9 h-9 rounded-xl bg-rose-500/10 text-rose-400 border border-rose-500/30 flex items-center justify-center font-bold text-base shrink-0">
                                    ➡️
                                </div>
                                <div class="leading-tight">
                                    <div class="text-[11px] text-slate-400 font-semibold">Debit</div>
                                    <div class="text-base font-black text-rose-400 mt-0.5">-2,440.00 <span class="text-xs font-normal text-slate-400">SAR</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Drawer Balance (4 Cols) -->
                    <div class="lg:col-span-4 bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg flex flex-col justify-between space-y-3">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-bold text-sky-400 uppercase tracking-wider flex items-center gap-1.5">
                                <span>🗄️</span> <span>Drawer Balance</span>
                            </h4>
                            <span class="text-[10px] text-emerald-400 bg-emerald-500/10 px-1.5 py-0.5 rounded border border-emerald-500/30 font-medium">Shift Open</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-[#181e27] border border-[#262f3e] shadow-xs">
                            <div class="w-9 h-9 rounded-xl bg-purple-500/20 text-purple-300 border border-purple-500/40 flex items-center justify-center font-bold text-xs shrink-0 font-mono">
                                SAR
                            </div>
                            <div class="leading-tight">
                                <div class="text-[11px] text-slate-400 font-semibold">Current Cash Drawer</div>
                                <div class="text-base font-black text-emerald-400 mt-0.5">6,738.96 <span class="text-xs font-normal text-slate-400">SAR</span></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Row 2: Today's Reservation Status & Today's Financial Summary -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-3.5">
                    
                    <!-- Today's Reservation Status (6 Cols) -->
                    <div class="lg:col-span-6 bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg space-y-3">
                        <h4 class="text-xs font-bold text-sky-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span>📋</span> <span>Today's Reservation Status</span>
                        </h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                            <!-- On Arrival -->
                            <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $arrivals->where('status', 'confirmed')->count() }}
                                </span>
                                <div class="text-[11px] text-slate-300 font-medium leading-tight">On Arrival</div>
                            </div>
                            <!-- Checked-In -->
                            <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $arrivals->where('status', 'checked_in')->count() }}
                                </span>
                                <div class="text-[11px] text-slate-300 font-medium leading-tight">Checked-In</div>
                            </div>
                            <!-- On Departure -->
                            <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $dueOutCount }}
                                </span>
                                <div class="text-[11px] text-slate-300 font-medium leading-tight">On Departure</div>
                            </div>
                            <!-- Checked-Out -->
                            <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-rose-500/20 text-rose-400 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $departuresTodayCount }}
                                </span>
                                <div class="text-[11px] text-slate-300 font-medium leading-tight">Checked-Out</div>
                            </div>
                            <!-- In House -->
                            <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2.5 col-span-2 sm:col-span-1">
                                <span class="w-7 h-7 rounded-lg bg-blue-500/20 text-blue-400 font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $occupiedCount }}
                                </span>
                                <div class="text-[11px] text-slate-300 font-medium leading-tight">In House</div>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Financial Summary & Housekeeping (6 Cols) -->
                    <div class="lg:col-span-6 space-y-3.5">
                        
                        <!-- Financial Summary -->
                        <div class="bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg space-y-3">
                            <h4 class="text-xs font-bold text-sky-400 uppercase tracking-wider flex items-center gap-1.5">
                                <span>📊</span> <span>Today's Financial Summary</span>
                            </h4>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                                <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2">
                                    <span class="text-base">💵</span>
                                    <div class="leading-tight">
                                        <div class="text-[9px] text-slate-400 font-medium">Total Revenue</div>
                                        <div class="text-xs font-bold text-emerald-400 mt-0.5">212.09</div>
                                    </div>
                                </div>
                                <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2">
                                    <span class="text-base">📄</span>
                                    <div class="leading-tight">
                                        <div class="text-[9px] text-slate-400 font-medium">Promissory</div>
                                        <div class="text-xs font-bold text-slate-200 mt-0.5">0</div>
                                    </div>
                                </div>
                                <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2">
                                    <span class="text-base">🧾</span>
                                    <div class="leading-tight">
                                        <div class="text-[9px] text-slate-400 font-medium">Receipts</div>
                                        <div class="text-xs font-bold text-slate-200 mt-0.5">0</div>
                                    </div>
                                </div>
                                <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-2">
                                    <span class="text-base">🎯</span>
                                    <div class="leading-tight">
                                        <div class="text-[9px] text-slate-400 font-medium">Payments</div>
                                        <div class="text-xs font-bold text-slate-200 mt-0.5">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Housekeeping Summary (From screenshot) -->
                        <div class="bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg space-y-3">
                            <h4 class="text-xs font-bold text-sky-400 uppercase tracking-wider flex items-center gap-1.5">
                                <span>🧹</span> <span>Housekeeping</span>
                            </h4>
                            <div class="grid grid-cols-2 gap-2.5">
                                <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center text-sm">🌿</span>
                                    <div class="leading-tight">
                                        <div class="text-[11px] text-slate-400 font-medium">Vacant &amp; Dirty</div>
                                        <div class="text-sm font-black text-white mt-0.5">{{ $dirtyCount }}</div>
                                    </div>
                                </div>
                                <div class="p-2.5 rounded-xl bg-[#181e27] border border-[#262f3e] flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-rose-500/10 text-rose-400 border border-rose-500/20 flex items-center justify-center text-sm">🔑</span>
                                    <div class="leading-tight">
                                        <div class="text-[11px] text-slate-400 font-medium">Rented &amp; Dirty</div>
                                        <div class="text-sm font-black text-white mt-0.5">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- KPI Metric Cards (alabeer PMS Overview) -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5">
                
                <!-- Occupancy -->
                <div class="bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg hover:border-[#e4881c]/50 transition-all">
                    <div class="flex items-center justify-between text-xs text-slate-400 mb-2">
                        <span class="font-semibold text-slate-300" id="lblOccupancy">Occupancy</span>
                        <span class="text-xs font-bold text-emerald-400 bg-emerald-500/20 px-2 py-0.5 rounded-full border border-emerald-500/30">▲ 84%</span>
                    </div>
                    <div class="text-2xl font-black text-white tracking-tight">{{ $occupancyRate }}%</div>
                    <div class="text-[11px] text-slate-400 mt-1 font-medium">{{ $occupiedCount }} / {{ $totalRooms }} Units Occupied</div>
                </div>

                <!-- Vacant Clean -->
                <div class="bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg hover:border-emerald-500/50 transition-all">
                    <div class="flex items-center justify-between text-xs text-slate-400 mb-2">
                        <span class="font-semibold text-slate-300" id="lblVacantClean">Vacant Clean</span>
                        <span class="w-6 h-6 rounded-lg bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center text-xs font-bold">✓</span>
                    </div>
                    <div class="text-2xl font-black text-emerald-400 tracking-tight">{{ $vacantCleanCount }}</div>
                    <div class="text-[11px] text-emerald-400/80 mt-1 font-medium">Ready for check-in</div>
                </div>

                <!-- Arrivals Today -->
                <div class="bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg hover:border-blue-500/50 transition-all">
                    <div class="flex items-center justify-between text-xs text-slate-400 mb-2">
                        <span class="font-semibold text-slate-300" id="lblArrivals">Arrivals Today</span>
                        <span class="w-6 h-6 rounded-lg bg-blue-500/20 text-blue-400 border border-blue-500/30 flex items-center justify-center text-xs">🛬</span>
                    </div>
                    <div class="text-2xl font-black text-blue-400 tracking-tight">{{ $arrivals->count() }}</div>
                    <div class="text-[11px] text-blue-400/80 mt-1 font-medium">{{ $arrivals->where('status', 'checked_in')->count() }} Checked in</div>
                </div>

                <!-- Departures Today -->
                <div class="bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg hover:border-amber-500/50 transition-all">
                    <div class="flex items-center justify-between text-xs text-slate-400 mb-2">
                        <span class="font-semibold text-slate-300" id="lblDepartures">Departures Today</span>
                        <span class="w-6 h-6 rounded-lg bg-amber-500/20 text-amber-400 border border-amber-500/30 flex items-center justify-center text-xs">🛫</span>
                    </div>
                    <div class="text-2xl font-black text-[#fcba63] tracking-tight">{{ $dueOutCount + $departuresTodayCount }}</div>
                    <div class="text-[11px] text-amber-400/80 mt-1 font-medium">{{ $departuresTodayCount }} Completed</div>
                </div>

                <!-- Revenue Today -->
                <div class="bg-[#12161c] p-4 rounded-2xl border border-[#1f2633] shadow-lg hover:border-[#e4881c]/50 transition-all col-span-2 sm:col-span-1">
                    <div class="flex items-center justify-between text-xs text-slate-400 mb-2">
                        <span class="font-semibold text-slate-300" id="lblRevenue">Today's Revenue</span>
                        <span class="text-[10px] font-bold text-[#fcba63] bg-amber-500/20 px-1.5 py-0.5 rounded border border-amber-500/30">SAR</span>
                    </div>
                    <div class="text-2xl font-black text-white tracking-tight">{{ number_format($revenueToday, 0) }}</div>
                    <div class="text-[11px] text-[#fcba63] mt-1 font-semibold">RevPAR: {{ $totalRooms > 0 ? round($revenueToday / $totalRooms, 0) : 0 }} SAR</div>
                </div>

            </div>

            <!-- Modern Tablet Dark Visualizer Section (Matching Tablet Analytics Mockup) -->
            <div class="bg-[#12161c] rounded-3xl p-5 sm:p-7 border border-[#232936] shadow-2xl text-slate-100 space-y-6 relative overflow-hidden">
                <!-- Background Ambient Glows -->
                <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-[#e4881c]/10 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-emerald-500/5 blur-3xl pointer-events-none"></div>

                <!-- Section Top Header Bar -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#232936] relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#e4881c] to-[#f59e0b] flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-[#e4881c]/25">
                            📊
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-base font-extrabold text-white tracking-tight">Performance &amp; Intelligence Telemetry</h3>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#e4881c]/20 text-[#fcba63] border border-[#e4881c]/40 uppercase tracking-wider">Live Feed</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">Real-time revenue forecast, inventory allocation &amp; velocity gauges</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 text-xs">
                        <!-- Mode Selector Pill -->
                        <div class="inline-flex rounded-xl bg-[#1b212b] p-1 border border-[#2c3444]">
                            <button type="button" class="px-3 py-1 rounded-lg bg-[#e4881c] text-white font-bold text-[11px] shadow-xs">Today</button>
                            <button type="button" class="px-3 py-1 rounded-lg text-slate-400 hover:text-slate-200 font-semibold text-[11px] transition-colors">7 Days</button>
                            <button type="button" class="px-3 py-1 rounded-lg text-slate-400 hover:text-slate-200 font-semibold text-[11px] transition-colors">30 Days</button>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#19212c] border border-emerald-500/30 text-emerald-400 font-semibold text-[11px]">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>99.9% Telemetry</span>
                        </span>
                    </div>
                </div>

                <!-- 3-Column Visualizer Grid -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 relative z-10">
                    
                    <!-- Column 1: Inventory Pie Breakdown (Occupancy & Distribution) -->
                    <div class="md:col-span-4 bg-[#181e27] rounded-2xl p-4 sm:p-5 border border-[#262f3e] flex flex-col justify-between space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">🍩</span>
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Room Inventory Share</span>
                            </div>
                            <span class="text-[11px] font-mono text-[#fcba63] font-bold">{{ $occupiedCount }}/{{ $totalRooms }} Active</span>
                        </div>

                        <!-- Donut Chart Container -->
                        <div class="relative flex items-center justify-center my-2" style="height: 180px;">
                            <canvas id="chartInventoryDonut"></canvas>
                            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                <span class="text-2xl font-black text-white tracking-tight">{{ $occupancyRate }}%</span>
                                <span class="text-[10px] text-slate-400 uppercase font-semibold tracking-wider">Occupancy</span>
                            </div>
                        </div>

                        <!-- Legend Chips -->
                        <div class="grid grid-cols-2 gap-2 pt-3 border-t border-[#262f3e] text-[11px]">
                            <div class="flex items-center gap-2 bg-[#12161c] px-2.5 py-1.5 rounded-lg border border-[#232a37]">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#e4881c] shrink-0"></span>
                                <span class="text-slate-300 truncate">Occupied ({{ $occupiedCount }})</span>
                            </div>
                            <div class="flex items-center gap-2 bg-[#12161c] px-2.5 py-1.5 rounded-lg border border-[#232a37]">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#10b981] shrink-0"></span>
                                <span class="text-slate-300 truncate">Vacant ({{ $vacantCleanCount }})</span>
                            </div>
                            <div class="flex items-center gap-2 bg-[#12161c] px-2.5 py-1.5 rounded-lg border border-[#232a37]">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#3b82f6] shrink-0"></span>
                                <span class="text-slate-300 truncate">Reserved ({{ $reservedCount }})</span>
                            </div>
                            <div class="flex items-center gap-2 bg-[#12161c] px-2.5 py-1.5 rounded-lg border border-[#232a37]">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#f43f5e] shrink-0"></span>
                                <span class="text-slate-300 truncate">Cleaning ({{ $dirtyCount }})</span>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Hourly Occupancy Wave & Revenue Yield Analysis -->
                    <div class="md:col-span-5 bg-[#181e27] rounded-2xl p-4 sm:p-5 border border-[#262f3e] flex flex-col justify-between space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">📈</span>
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Intraday Demand &amp; Revenue</span>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">+14.2% vs Avg</span>
                        </div>

                        <!-- Spline Wave Chart -->
                        <div class="relative" style="height: 180px;">
                            <canvas id="chartDemandWave"></canvas>
                        </div>

                        <!-- Intraday Stats Micro Strip -->
                        <div class="grid grid-cols-3 gap-2 pt-3 border-t border-[#262f3e] text-center">
                            <div class="bg-[#12161c] p-2 rounded-xl border border-[#232a37]">
                                <div class="text-[10px] text-slate-400 uppercase font-semibold">Peak Hour</div>
                                <div class="text-xs font-bold text-white mt-0.5">20:00 - 22:00</div>
                            </div>
                            <div class="bg-[#12161c] p-2 rounded-xl border border-[#232a37]">
                                <div class="text-[10px] text-slate-400 uppercase font-semibold">ADR (Average)</div>
                                <div class="text-xs font-bold text-[#fcba63] mt-0.5">580 SAR</div>
                            </div>
                            <div class="bg-[#12161c] p-2 rounded-xl border border-[#232a37]">
                                <div class="text-[10px] text-slate-400 uppercase font-semibold">RevPAR Peak</div>
                                <div class="text-xs font-bold text-emerald-400 mt-0.5">487 SAR</div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 3: Speedometer Gauge & Operations Quick Status -->
                    <div class="md:col-span-3 bg-[#181e27] rounded-2xl p-4 sm:p-5 border border-[#262f3e] flex flex-col justify-between space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">⚡</span>
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Turnaround Velocity</span>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                        <!-- Half Radial Gauge Container -->
                        <div class="relative flex flex-col items-center justify-center my-1" style="height: 140px;">
                            <canvas id="chartVelocityGauge"></canvas>
                            <div class="absolute inset-x-0 bottom-1 flex flex-col items-center justify-center">
                                <span class="text-xl font-black text-white">94<span class="text-xs text-[#e4881c] font-bold">%</span></span>
                                <span class="text-[9px] text-slate-400 uppercase font-bold tracking-wider">Fast Turnaround</span>
                            </div>
                        </div>

                        <!-- Operations Mini KPI Cards -->
                        <div class="space-y-2 pt-2 border-t border-[#262f3e]">
                            <div class="flex items-center justify-between bg-[#12161c] px-3 py-2 rounded-xl border border-[#232a37] text-xs">
                                <span class="text-slate-400 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    <span>Avg Cleaning Time</span>
                                </span>
                                <span class="font-bold text-white font-mono">28 min</span>
                            </div>
                            <div class="flex items-center justify-between bg-[#12161c] px-3 py-2 rounded-xl border border-[#232a37] text-xs">
                                <span class="text-slate-400 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#e4881c]"></span>
                                    <span>Smart Lock Health</span>
                                </span>
                                <span class="font-bold text-emerald-400 font-mono">100% OK</span>
                            </div>
                            <div class="flex items-center justify-between bg-[#12161c] px-3 py-2 rounded-xl border border-[#232a37] text-xs">
                                <span class="text-slate-400 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                    <span>Direct Channel Share</span>
                                </span>
                                <span class="font-bold text-[#fcba63] font-mono">68%</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Unit Status Matrix / Floor Plan Map -->
            <div class="bg-[#12161c] p-5 sm:p-6 rounded-2xl border border-[#1f2633] shadow-lg space-y-5">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-[#1f2633]">
                    <div>
                        <h2 class="font-bold text-sm text-white flex items-center gap-2" id="txtUnitMatrixTitle">
                            <span>Unit Status Matrix</span>
                            <span class="text-xs font-semibold text-[#fcba63] bg-amber-500/20 px-2 py-0.5 rounded-full border border-amber-500/30">{{ $totalRooms }} Units</span>
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5" id="txtUnitMatrixDesc">Live floor status of rooms and furnished hotel apartments (Click unit to manage)</p>
                    </div>

                    <!-- Status Color Keys -->
                    <div class="flex flex-wrap items-center gap-3 text-[11px] font-medium text-slate-300">
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-xs"></span> <span>Vacant Clean</span></span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-xs"></span> <span>Occupied</span></span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-xs"></span> <span>Due Out</span></span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-xs"></span> <span>Reserved</span></span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-500 shadow-xs"></span> <span>Cleaning/Maint.</span></span>
                    </div>
                </div>

                @php
                    $statusStyles = [
                        'vacant_clean' => ['bg' => 'bg-emerald-950/30 hover:bg-emerald-900/40', 'border' => 'border-emerald-500/40', 'text' => 'text-emerald-400', 'sub' => 'text-emerald-300/80 font-medium', 'label' => 'Available'],
                        'occupied'     => ['bg' => 'bg-rose-950/30 hover:bg-rose-900/40', 'border' => 'border-rose-500/40', 'text' => 'text-rose-400', 'sub' => 'text-rose-300/80 font-medium', 'label' => 'Occupied'],
                        'due_out'      => ['bg' => 'bg-amber-950/30 hover:bg-amber-900/40', 'border' => 'border-amber-500/40', 'text' => 'text-[#fcba63]', 'sub' => 'text-amber-300/80 font-medium', 'label' => 'Due Out'],
                        'reserved'     => ['bg' => 'bg-blue-950/30 hover:bg-blue-900/40', 'border' => 'border-blue-500/40', 'text' => 'text-blue-400', 'sub' => 'text-blue-300/80 font-medium', 'label' => 'Reserved'],
                        'vacant_dirty' => ['bg' => 'bg-slate-900/60 hover:bg-slate-800/60', 'border' => 'border-slate-700', 'text' => 'text-slate-300', 'sub' => 'text-slate-400 font-medium', 'label' => 'Cleaning'],
                        'maintenance'  => ['bg' => 'bg-slate-900/60 hover:bg-slate-800/60', 'border' => 'border-slate-700', 'text' => 'text-slate-300', 'sub' => 'text-slate-400 font-medium', 'label' => 'Maint.'],
                    ];
                @endphp

                <!-- Floor 1 -->
                <div>
                    <div class="text-xs font-bold text-slate-200 mb-2.5 flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-lg bg-[#181e27] border border-[#262f3e] text-[#fcba63] font-bold">Floor 1</span>
                        <span class="text-slate-400 font-normal">Executive Suites</span>
                    </div>
                    <div class="grid grid-cols-3 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-2.5">
                        @foreach($floor1Rooms as $room)
                            @php
                                $st = $statusStyles[$room->status] ?? $statusStyles['vacant_clean'];
                                $guestName = $room->currentReservation?->guest ? ($room->currentReservation->guest->first_name . ' ' . substr($room->currentReservation->guest->last_name, 0, 1) . '.') : $st['label'];
                            @endphp
                            <div onclick="openRoomActionModal('{{ $room->id }}', '{{ $room->room_number }}', '{{ $room->status }}', '{{ $room->roomType->name_en }}')" 
                                 class="room-badge p-2.5 rounded-xl {{ $st['bg'] }} border {{ $st['border'] }} cursor-pointer text-center shadow-md" 
                                 title="Room {{ $room->room_number }} ({{ $room->status }})">
                                <div class="text-xs font-black {{ $st['text'] }}">{{ $room->room_number }}</div>
                                <div class="text-[10px] {{ $st['sub'] }} truncate mt-0.5">{{ $guestName }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Floor 2 -->
                <div class="pt-2">
                    <div class="text-xs font-bold text-slate-200 mb-2.5 flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-lg bg-[#181e27] border border-[#262f3e] text-[#fcba63] font-bold">Floor 2</span>
                        <span class="text-slate-400 font-normal">Standard 1-Bedroom Suites & Deluxe Studios</span>
                    </div>
                    <div class="grid grid-cols-3 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-2.5">
                        @foreach($floor2Rooms as $room)
                            @php
                                $st = $statusStyles[$room->status] ?? $statusStyles['vacant_clean'];
                                $guestName = $room->currentReservation?->guest ? ($room->currentReservation->guest->first_name . ' ' . substr($room->currentReservation->guest->last_name, 0, 1) . '.') : $st['label'];
                            @endphp
                            <div onclick="openRoomActionModal('{{ $room->id }}', '{{ $room->room_number }}', '{{ $room->status }}', '{{ $room->roomType->name_en }}')" 
                                 class="room-badge p-2.5 rounded-xl {{ $st['bg'] }} border {{ $st['border'] }} cursor-pointer text-center shadow-md" 
                                 title="Room {{ $room->room_number }} ({{ $room->status }})">
                                <div class="text-xs font-black {{ $st['text'] }}">{{ $room->room_number }}</div>
                                <div class="text-[10px] {{ $st['sub'] }} truncate mt-0.5">{{ $guestName }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Reservations Management Panel (Matching Reference Screen Tabs & Search) -->
            <div class="bg-[#12161c] rounded-2xl border border-[#1f2633] shadow-lg overflow-hidden space-y-4 p-4 sm:p-5">
                
                <!-- Header with Action -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-[#1f2633]">
                    <div>
                        <h3 class="font-bold text-sm text-white flex items-center gap-2" id="txtArrivalsTitle">
                            <span>Reservations</span>
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Guest registry &amp; check-in operations</p>
                    </div>
                    <button type="button" onclick="openNewResModal()" class="px-4 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-xs flex items-center gap-1.5 shadow-md shadow-emerald-900/30 transition-all cursor-pointer">
                        <span>➕</span> <span>New Reservation</span>
                    </button>
                </div>

                <!-- 3 Tabs (Arrival, Departure, In House) -->
                <div class="flex border-b border-[#232b38] text-xs font-bold">
                    <button type="button" onclick="switchResTab('arrival')" id="resTabArrival" class="px-6 py-2.5 bg-sky-600 text-white rounded-t-xl transition-all">
                        Arrival
                    </button>
                    <button type="button" onclick="switchResTab('departure')" id="resTabDeparture" class="px-6 py-2.5 bg-[#181e27] text-slate-400 hover:text-white rounded-t-xl transition-all">
                        Departure
                    </button>
                    <button type="button" onclick="switchResTab('inhouse')" id="resTabInHouse" class="px-6 py-2.5 bg-[#181e27] text-slate-400 hover:text-white rounded-t-xl transition-all">
                        In House
                    </button>
                </div>

                <!-- Search & Filters Toolbar -->
                <div class="flex flex-wrap items-center justify-between gap-3 bg-[#181e27] p-2.5 rounded-xl border border-[#262f3e]">
                    <div class="flex items-center gap-2.5 flex-1 max-w-md">
                        <!-- Dropdown filter -->
                        <select class="bg-[#12161c] border border-[#2d3748] rounded-lg px-2.5 py-1.5 text-xs font-semibold text-slate-200 focus:outline-none cursor-pointer">
                            <option>Today ({{ $arrivals->count() }})</option>
                            <option>Tomorrow</option>
                            <option>This Week</option>
                        </select>

                        <!-- Search phone / guest -->
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 start-0 flex items-center ps-2.5 text-slate-500 pointer-events-none text-xs">
                                🔍
                            </span>
                            <input type="text" id="inputSearchGuest" placeholder="Type guest phone no. or name" class="w-full bg-[#12161c] border border-[#2d3748] rounded-lg ps-8 pe-3 py-1.5 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-sky-500 transition-colors">
                        </div>

                        <!-- Print button -->
                        <button type="button" onclick="window.print()" class="w-8 h-8 rounded-lg bg-sky-600 hover:bg-sky-500 text-white flex items-center justify-center text-xs shadow-xs transition-colors" title="Print Arrivals List">
                            🖨️
                        </button>
                    </div>

                    <!-- Pagination tracker -->
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <span>1 - {{ $arrivals->count() }} of {{ $arrivals->count() }}</span>
                        <div class="flex items-center gap-1">
                            <button type="button" class="w-6 h-6 rounded bg-[#12161c] border border-[#2d3748] text-slate-400 hover:text-white flex items-center justify-center">&lt;</button>
                            <button type="button" class="w-6 h-6 rounded bg-[#12161c] border border-[#2d3748] text-slate-400 hover:text-white flex items-center justify-center">&gt;</button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-start">
                        <thead class="bg-[#161c24] text-slate-400 border-b border-[#1f2633] font-bold uppercase tracking-wider text-[10px]">
                            <tr>
                                <th class="p-3.5 text-start">Res #</th>
                                <th class="p-3.5 text-start">Guest Name</th>
                                <th class="p-3.5 text-start">Room</th>
                                <th class="p-3.5 text-start">Dates</th>
                                <th class="p-3.5 text-start">Total (SAR)</th>
                                <th class="p-3.5 text-start">Shamous Status</th>
                                <th class="p-3.5 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1f2633]">
                            @forelse($arrivals as $res)
                            <tr class="hover:bg-amber-500/5 transition-colors">
                                <td class="p-3.5 font-mono font-bold text-[#fcba63]">#{{ $res->reservation_no }}</td>
                                <td class="p-3.5">
                                    <div class="font-bold text-white">{{ $res->guest->first_name }} {{ $res->guest->last_name }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">{{ $res->guest->mobile_number }} • ID: {{ substr($res->guest->id_number, 0, 4) }}****</div>
                                </td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-1 rounded-lg bg-[#181e27] border border-[#262f3e] font-bold text-slate-200 text-[11px]">
                                        {{ $res->room ? 'Room ' . $res->room->room_number : ($res->roomType ? $res->roomType->code : 'Unassigned') }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-slate-300">
                                    <div class="font-medium text-slate-200">{{ \Carbon\Carbon::parse($res->check_in_date)->format('d M') }} ➜ {{ \Carbon\Carbon::parse($res->check_out_date)->format('d M') }}</div>
                                    <div class="text-[10px] text-[#fcba63] font-semibold mt-0.5">
                                        {{ \Carbon\Carbon::parse($res->check_in_date)->diffInDays(\Carbon\Carbon::parse($res->check_out_date)) }} Nights
                                    </div>
                                </td>
                                <td class="p-3.5 font-black text-white">{{ number_format($res->total_amount, 2) }} SAR</td>
                                <td class="p-3.5">
                                    @php
                                        $hasShamous = $res->shomoosTransactions && $res->shomoosTransactions->count() > 0;
                                    @endphp
                                    @if($hasShamous)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400 font-bold border border-emerald-500/30 text-[10px]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            <span>Synced</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-500/20 text-[#fcba63] font-bold border border-amber-500/30 text-[10px]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                            <span>Pending Sync</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-end">
                                    @if($res->status === 'confirmed')
                                        <form action="{{ route('reservations.check-in', $res->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3.5 py-1.5 rounded-lg bg-[#e4881c] hover:bg-[#c76f0d] text-white font-bold text-[11px] shadow-sm hover:shadow transition-all">
                                                Check In
                                            </button>
                                        </form>
                                    @elseif($res->status === 'checked_in')
                                        <form action="{{ route('reservations.check-out', $res->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3.5 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white font-bold text-[11px] shadow-sm hover:shadow transition-all">
                                                Check Out
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[11px] text-slate-500 font-semibold uppercase">{{ $res->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-500 font-medium">
                                    No arrivals scheduled for today. Click "New Reservation" or "Walk-in Check-in" above.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Chat & Ticket Floating Button & Interactive Pop-up Drawer (Right Side) -->
    <div id="supportWidgetContainer" class="fixed bottom-6 end-6 z-50 flex flex-col items-end">
        
        <!-- Support Pop-up Box (Hidden by default, toggled on click) -->
        <div id="popSupportChatTicket" class="hidden mb-3 w-80 sm:w-96 rounded-2xl bg-[#141820] border border-[#232b38] shadow-2xl overflow-hidden backdrop-blur-xl transition-all select-none animate-in fade-in slide-in-from-bottom-5">
            <!-- Header -->
            <div class="p-4 bg-gradient-to-r from-purple-700 via-indigo-700 to-purple-900 text-white flex items-center justify-between shadow-md">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-lg shadow-inner">
                        💬
                    </div>
                    <div>
                        <h4 class="font-bold text-sm tracking-tight leading-tight">24/7 Support &amp; Tickets</h4>
                        <p class="text-[11px] text-purple-200">Helpdesk, Live Chat &amp; Issue Tickets</p>
                    </div>
                </div>
                <button type="button" onclick="toggleSupportPopup()" class="text-white/80 hover:text-white text-xl font-bold leading-none p-1 cursor-pointer">&times;</button>
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

            <!-- Tab Switcher (Chat vs Ticket) -->
            <div class="flex border-b border-[#232b38] bg-[#12161c] text-xs font-semibold">
                <button type="button" id="tabSupportChatBtn" onclick="switchSupportTab('chat')" class="flex-1 py-2.5 text-center border-b-2 border-purple-500 text-white flex items-center justify-center gap-1.5 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span>Live Chat</span>
                </button>
                <button type="button" id="tabSupportTicketBtn" onclick="switchSupportTab('ticket')" class="flex-1 py-2.5 text-center border-b-2 border-transparent text-slate-400 hover:text-slate-200 flex items-center justify-center gap-1.5 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    <span>New Ticket</span>
                </button>
            </div>

            <!-- Content: Live Chat Pane -->
            <div id="supportChatPane" class="p-4 space-y-3">
                <div class="h-44 overflow-y-auto space-y-2.5 text-xs custom-scrollbar pe-1" id="supportChatMessages">
                    <div class="flex items-start gap-2">
                        <div class="w-6 h-6 rounded-full bg-purple-600 flex items-center justify-center text-[10px] text-white font-bold shrink-0">IT</div>
                        <div class="bg-[#1a202c] border border-[#2d3748] rounded-xl rounded-tl-none p-2.5 text-slate-200 leading-relaxed shadow-xs">
                            Hello! Welcome to alabeer Hospitality Support. How can we assist your front desk or IT operations today?
                            <div class="text-[9px] text-slate-500 text-end mt-1">Just now</div>
                        </div>
                    </div>
                </div>

                <!-- Chat Input Form -->
                <form onsubmit="sendSupportChatMessage(event)" class="flex items-center gap-2 pt-1 border-t border-[#232b38]">
                    <input type="text" id="inputSupportChatMessage" placeholder="Type your message..." required class="flex-1 text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none transition-all">
                    <button type="submit" class="px-3.5 py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs shadow-md shadow-purple-600/30 transition-all cursor-pointer">
                        Send
                    </button>
                </form>
            </div>

            <!-- Content: Ticket Creation Pane -->
            <div id="supportTicketPane" class="hidden p-4 space-y-3">
                <form onsubmit="submitSupportTicket(event)" class="space-y-3 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Issue Category *</label>
                        <select id="ticketCategory" required class="w-full bg-[#1a202c] border border-[#2d3748] text-slate-200 rounded-xl px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                            <option value="pms_billing">PMS &amp; ZATCA Billing Error</option>
                            <option value="shamous_sync">Shamous Ministry Integration</option>
                            <option value="hvac_maintenance">Room Maintenance / HVAC</option>
                            <option value="smart_lock">Smart Door Lock Gateway</option>
                            <option value="other">General IT &amp; Hardware</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Priority Level *</label>
                        <select id="ticketPriority" required class="w-full bg-[#1a202c] border border-[#2d3748] text-slate-200 rounded-xl px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                            <option value="urgent" class="text-rose-400">🔥 Urgent (SLA &lt; 2 Hours)</option>
                            <option value="high" class="text-amber-400">⚡ High Priority</option>
                            <option value="medium" selected class="text-sky-400">Normal Priority</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 mb-1">Ticket Subject &amp; Description *</label>
                        <textarea id="ticketDescription" rows="2" required placeholder="Describe the incident or error encountered..." class="w-full bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl p-2.5 focus:ring-2 focus:ring-purple-500 focus:outline-none resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-bold shadow-lg shadow-purple-600/30 transition-all cursor-pointer">
                        Submit Support Ticket
                    </button>
                </form>
            </div>
        </div>

        <!-- Floating Trigger Button (Right Side) -->
        <button type="button" id="btnSupportFloating" onclick="toggleSupportPopup()" class="w-13 h-13 rounded-full fab-purple text-white flex items-center justify-center shadow-2xl transition-all hover:scale-110 active:scale-95 cursor-pointer relative group" title="Support Chat &amp; Ticket System">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
            </svg>
            <!-- Badge dot -->
            <span class="absolute top-0 end-0 w-3.5 h-3.5 rounded-full bg-emerald-400 border-2 border-[#0b0e14] animate-pulse"></span>
            
            <!-- Tooltip Hover Tag -->
            <span class="absolute end-15 bg-[#141820] text-slate-200 text-[11px] font-semibold px-2.5 py-1 rounded-lg border border-[#232b38] shadow-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                Chat &amp; Tickets
            </span>
        </button>
    </div>

    <!-- ================= MODALS ================= -->

    <!-- 1. New Reservation Modal -->
    <div id="modalNewReservation" class="fixed inset-0 z-50 hidden bg-black/70 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-[#141820] border border-[#232b38] text-slate-100 rounded-2xl max-w-xl w-full p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-[#232b38] pb-3">
                <div class="flex items-center gap-2">
                    <span class="text-xl">➕</span>
                    <h3 class="font-bold text-base text-white">Create New Reservation</h3>
                </div>
                <button type="button" onclick="closeModal('modalNewReservation')" class="text-slate-400 hover:text-white text-xl font-bold">&times;</button>
            </div>

            <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">First Name *</label>
                        <input type="text" name="first_name" required placeholder="e.g. Faisal" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Last Name</label>
                        <input type="text" name="last_name" placeholder="e.g. Al-Dossary" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">National ID / Iqama / Passport *</label>
                        <input type="text" name="id_number" required placeholder="10-digit Saudi ID" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Mobile Number *</label>
                        <input type="text" name="mobile_number" required placeholder="+966500000000" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Room Type *</label>
                        <select name="room_type_id" id="newResRoomType" onchange="filterAvailableRooms(this.value, 'newResRoomId')" required class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                            <option value="" class="bg-[#1a202c] text-slate-300">Select Room Type</option>
                            @foreach($roomTypes as $rt)
                                <option value="{{ $rt->id }}" data-price="{{ $rt->base_price }}" class="bg-[#1a202c] text-slate-200">{{ $rt->name_en }} ({{ $rt->base_price }} SAR/night)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Assign Room (Optional)</label>
                        <select name="room_id" id="newResRoomId" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                            <option value="" class="bg-[#1a202c] text-slate-300">Auto-assign upon Check-in</option>
                            @foreach($vacantRooms as $vr)
                                <option value="{{ $vr->id }}" data-type="{{ $vr->room_type_id }}" class="bg-[#1a202c] text-slate-200">Room {{ $vr->room_number }} (Floor {{ $vr->floor }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Check-in Date *</label>
                        <input type="date" name="check_in_date" required value="{{ date('Y-m-d') }}" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Check-out Date *</label>
                        <input type="date" name="check_out_date" required value="{{ date('Y-m-d', strtotime('+2 days')) }}" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Deposit / Advance Payment (SAR)</label>
                        <input type="number" name="paid_amount" step="0.01" value="0.00" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Payment Method</label>
                        <select name="payment_method" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                            <option value="mada" class="bg-[#1a202c]">mada Debit Card</option>
                            <option value="visa" class="bg-[#1a202c]">Visa / MasterCard</option>
                            <option value="cash" class="bg-[#1a202c]">Cash</option>
                            <option value="bank_transfer" class="bg-[#1a202c]">Bank Transfer</option>
                        </select>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#232b38] flex items-center justify-end gap-2">
                    <button type="button" onclick="closeModal('modalNewReservation')" class="px-4 py-2 rounded-xl border border-[#2d3748] text-slate-300 hover:bg-[#1a202c] text-xs font-semibold transition-colors">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#f59e0b] hover:to-[#d97706] text-white text-xs font-bold shadow-lg shadow-orange-500/20 transition-all">Confirm Reservation</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. Walk-in Check-in Modal -->
    <div id="modalWalkIn" class="fixed inset-0 z-50 hidden bg-black/70 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-[#141820] border border-[#232b38] text-slate-100 rounded-2xl max-w-xl w-full p-6 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between border-b border-[#232b38] pb-3">
                <div class="flex items-center gap-2">
                    <span class="text-xl">🔑</span>
                    <div>
                        <h3 class="font-bold text-base text-white">Instant Walk-in Check-in</h3>
                        <p class="text-[11px] text-slate-400">Guest registration + Room assignment</p>
                    </div>
                </div>
                <button type="button" onclick="closeModal('modalWalkIn')" class="text-slate-400 hover:text-white text-xl font-bold">&times;</button>
            </div>

            <form action="{{ route('reservations.walk-in') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">First Name *</label>
                        <input type="text" name="first_name" required placeholder="Guest first name" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Last Name</label>
                        <input type="text" name="last_name" placeholder="Guest last name" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">National ID / Iqama / Passport *</label>
                        <input type="text" name="id_number" required placeholder="10-digit ID" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Mobile Number *</label>
                        <input type="text" name="mobile_number" required placeholder="+9665xxxxxxxx" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Select Room Type *</label>
                        <select name="room_type_id" id="walkInRoomType" onchange="filterAvailableRooms(this.value, 'walkInRoomId')" required class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                            <option value="" class="bg-[#1a202c] text-slate-300">Select Room Type</option>
                            @foreach($roomTypes as $rt)
                                <option value="{{ $rt->id }}" data-price="{{ $rt->base_price }}" class="bg-[#1a202c] text-slate-200">{{ $rt->name_en }} ({{ $rt->base_price }} SAR)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Select Vacant Clean Room *</label>
                        <select name="room_id" id="walkInRoomId" required class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                            <option value="" class="bg-[#1a202c] text-slate-300">Select Room</option>
                            @foreach($vacantRooms as $vr)
                                <option value="{{ $vr->id }}" data-type="{{ $vr->room_type_id }}" class="bg-[#1a202c] text-slate-200">Room {{ $vr->room_number }} (Floor {{ $vr->floor }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Check-in Date *</label>
                        <input type="date" name="check_in_date" required value="{{ date('Y-m-d') }}" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Check-out Date *</label>
                        <input type="date" name="check_out_date" required value="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Payment Amount (SAR) *</label>
                        <input type="number" name="paid_amount" step="0.01" required value="350.00" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Payment Method *</label>
                        <select name="payment_method" required class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                            <option value="mada" class="bg-[#1a202c]">mada Debit Card</option>
                            <option value="visa" class="bg-[#1a202c]">Visa / MasterCard</option>
                            <option value="cash" class="bg-[#1a202c]">Cash</option>
                        </select>
                    </div>
                </div>

                <div class="pt-3 border-t border-[#232b38] flex items-center justify-end gap-2">
                    <button type="button" onclick="closeModal('modalWalkIn')" class="px-4 py-2 rounded-xl border border-[#2d3748] text-slate-300 hover:bg-[#1a202c] text-xs font-semibold transition-colors">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#f59e0b] hover:to-[#d97706] text-white text-xs font-bold shadow-lg shadow-orange-500/20 transition-all">Check In Now</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Room Action / Status Modal -->
    <div id="modalRoomAction" class="fixed inset-0 z-50 hidden bg-black/70 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-[#141820] border border-[#232b38] text-slate-100 rounded-2xl max-w-sm w-full p-6 shadow-2xl space-y-4">
            <div class="flex items-center justify-between border-b border-[#232b38] pb-3">
                <div>
                    <h3 class="font-bold text-base text-white" id="roomActionTitle">Room 101</h3>
                    <p class="text-xs text-slate-400" id="roomActionSubtitle">Executive Suite</p>
                </div>
                <button type="button" onclick="closeModal('modalRoomAction')" class="text-slate-400 hover:text-white text-xl font-bold">&times;</button>
            </div>

            <form id="roomStatusForm" method="POST" action="" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Update Room Status</label>
                    <select name="status" id="roomActionStatusSelect" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none">
                        <option value="vacant_clean" class="bg-[#1a202c]">Vacant Clean (Ready)</option>
                        <option value="vacant_dirty" class="bg-[#1a202c]">Vacant Dirty (Needs Cleaning)</option>
                        <option value="occupied" class="bg-[#1a202c]">Occupied</option>
                        <option value="due_out" class="bg-[#1a202c]">Due Out</option>
                        <option value="reserved" class="bg-[#1a202c]">Reserved</option>
                        <option value="maintenance" class="bg-[#1a202c]">Under Maintenance</option>
                    </select>
                </div>

                <div class="pt-2 flex items-center justify-end gap-2">
                    <button type="button" onclick="closeModal('modalRoomAction')" class="px-4 py-2 rounded-xl border border-[#2d3748] text-slate-300 hover:bg-[#1a202c] text-xs font-semibold transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#f59e0b] hover:to-[#d97706] text-white text-xs font-bold shadow-lg shadow-orange-500/20 transition-all">Save Status</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 4. Confirm Address, Commercial Information & Location Modal -->
    <div id="modalPropertyCompliance" class="fixed inset-0 z-50 hidden bg-black/75 flex items-center justify-center p-3 sm:p-5 backdrop-blur-sm overflow-y-auto">
        <div class="bg-[#141820] border border-[#232b38] text-slate-100 rounded-3xl max-w-3xl w-full p-6 sm:p-8 shadow-2xl space-y-6 max-h-[92vh] overflow-y-auto">
            
            <!-- Modal Header -->
            <div class="flex items-start justify-between border-b border-[#232b38] pb-4">
                <div>
                    <h3 class="font-bold text-lg sm:text-xl text-white tracking-tight">Confirm Address, Commercial Information &amp; Location</h3>
                    <p class="text-xs text-slate-400 mt-1">Please complete/ confirm the following details for your property ...</p>
                </div>
                <button type="button" onclick="closeModal('modalPropertyCompliance')" class="text-slate-400 hover:text-white text-2xl font-bold p-1 leading-none">&times;</button>
            </div>

            <!-- Modal Body Form -->
            <form id="propertyComplianceForm" onsubmit="savePropertyCompliance(event)" class="space-y-5">
                @csrf
                
                <!-- 1. VAT Registration Number -->
                <div>
                    <div class="flex items-center gap-1.5 mb-1.5">
                        <label class="block text-xs font-semibold text-slate-300">VAT Reg. No.</label>
                        <span class="text-slate-500 hover:text-slate-300 cursor-pointer text-xs" title="15-digit ZATCA Tax Identification Number">
                            <svg class="w-3.5 h-3.5 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        </span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                        <div class="flex-1">
                            <input type="text" id="vatRegNo" name="vat_number" value="312777096700003" placeholder="e.g. 312777096700003" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer gap-2.5 shrink-0 select-none">
                            <input type="checkbox" id="toggleNoVat" onchange="toggleVatInput(this)" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#e4881c]"></div>
                            <span class="text-xs text-slate-300 font-medium">I don't have VAT Reg. No.</span>
                        </label>
                    </div>
                </div>

                <!-- 2. Commercial Registration Number -->
                <div>
                    <div class="flex items-center gap-1.5 mb-1.5">
                        <label class="block text-xs font-semibold text-slate-300">Comm. Reg. No.</label>
                        <span class="text-slate-500 hover:text-slate-300 cursor-pointer text-xs" title="10-digit Commercial Registration number issued by Ministry of Commerce">
                            <svg class="w-3.5 h-3.5 inline" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        </span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                        <div class="flex-1">
                            <input type="text" id="commRegNo" name="comm_number" value="7039653048" placeholder="e.g. 7039653048" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer gap-2.5 shrink-0 select-none">
                            <input type="checkbox" id="toggleNoComm" onchange="toggleCommInput(this)" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#e4881c]"></div>
                            <span class="text-xs text-slate-300 font-medium">I don't have Comm. Reg. No.</span>
                        </label>
                    </div>
                </div>

                <!-- 3. National Address (3 Columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Building No. <span class="text-rose-500">*</span></label>
                        <input type="text" id="inputBuildingNo" name="building_no" required value="5244" placeholder="Building No." class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Secondary No. <span class="text-rose-500">*</span></label>
                        <input type="text" id="inputSecondaryNo" name="secondary_no" required value="6740" placeholder="Secondary No." class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Postal Code <span class="text-rose-500">*</span></label>
                        <input type="text" id="inputPostalCode" name="postal_code" required value="47917" placeholder="Postal Code" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                    </div>
                </div>

                <!-- 4. Property Location (Customizable & Live GPS Detection) -->
                <div class="pt-2 space-y-3">
                    <div class="flex items-center justify-between">
                        <h4 class="font-bold text-sm text-white flex items-center gap-2">
                            <span>Property Location</span>
                            <span class="text-[10px] text-amber-400 bg-amber-500/10 border border-amber-500/30 px-2 py-0.5 rounded-full font-medium">Customizable</span>
                        </h4>
                        <span id="txtLocationStatus" class="text-[11px] text-emerald-400 font-mono flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Live GPS Ready</span>
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                        
                        <!-- Map Preview -->
                        <div class="md:col-span-6 space-y-1">
                            <div class="flex items-center justify-between text-xs text-slate-300">
                                <label class="font-semibold">Interactive Map Preview</label>
                                <span id="lblMapCoords" class="text-[10px] text-slate-400 font-mono">24.7136° N, 46.6753° E</span>
                            </div>
                            <div class="relative w-full h-56 rounded-2xl overflow-hidden border border-[#2d3748] bg-[#16202e] shadow-inner select-none group cursor-crosshair" onclick="handleMapClick(event)" title="Click anywhere on the map to place custom pin location">
                                <!-- Stylized Map Canvas & Roads -->
                                <svg id="svgMapPreview" class="w-full h-full object-cover pointer-events-none" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Base Terrain -->
                                    <rect width="400" height="300" fill="#1b2432"/>
                                    <!-- Rivers / Topo areas -->
                                    <path d="M0,80 Q100,60 200,90 T400,60 L400,300 L0,300 Z" fill="#18202d"/>
                                    <path d="M50,0 Q180,120 280,300 L320,300 Q200,100 80,0 Z" fill="#202a3a"/>
                                    <!-- Road Network -->
                                    <line x1="0" y1="120" x2="400" y2="180" stroke="#334155" stroke-width="4"/>
                                    <line x1="120" y1="0" x2="260" y2="300" stroke="#334155" stroke-width="4"/>
                                    <line x1="50" y1="280" x2="380" y2="80" stroke="#475569" stroke-width="3" stroke-dasharray="2,2"/>
                                    <!-- Highways -->
                                    <path d="M60,20 L160,140 L340,240" stroke="#f59e0b" stroke-width="3.5" stroke-linecap="round" opacity="0.8"/>
                                    <path d="M20,220 L180,140 L380,100" stroke="#e4881c" stroke-width="3" stroke-linecap="round" opacity="0.8"/>
                                    <circle cx="210" cy="145" r="28" fill="#e4881c" fill-opacity="0.1" stroke="#e4881c" stroke-width="1.5" stroke-dasharray="4,4"/>
                                    
                                    <!-- Route Shields -->
                                    <rect x="75" y="40" width="18" height="14" rx="3" fill="#1e293b" stroke="#64748b"/>
                                    <text x="84" y="51" fill="#94a3b8" font-size="8" font-weight="bold" text-anchor="middle">65</text>
                                    
                                    <rect x="300" y="160" width="18" height="14" rx="3" fill="#1e293b" stroke="#64748b"/>
                                    <text x="309" y="171" fill="#94a3b8" font-size="8" font-weight="bold" text-anchor="middle">80</text>
                                    
                                    <rect x="60" y="190" width="18" height="14" rx="3" fill="#1e293b" stroke="#64748b"/>
                                    <text x="69" y="201" fill="#94a3b8" font-size="8" font-weight="bold" text-anchor="middle">50</text>

                                    <!-- City labels -->
                                    <text x="135" y="60" fill="#94a3b8" font-size="9" font-weight="600">Al Majma'ah</text>
                                    <text x="135" y="70" fill="#64748b" font-size="8">المجمعة</text>

                                    <text x="75" y="125" fill="#94a3b8" font-size="9" font-weight="600">Shaqra</text>
                                    <text x="75" y="135" fill="#64748b" font-size="8">شقراء</text>

                                    <text x="135" y="185" fill="#cbd5e1" font-size="9" font-weight="600">Diriyah</text>
                                    <text x="135" y="195" fill="#94a3b8" font-size="8">الدرعية</text>

                                    <!-- Riyadh Center with Glow -->
                                    <circle cx="210" cy="145" r="7" fill="#ef4444" opacity="0.3"/>
                                    <text x="228" y="146" fill="#ffffff" font-size="12" font-weight="bold">Riyadh</text>
                                    <text x="228" y="158" fill="#fcba63" font-size="10" font-weight="semibold">الرياض</text>

                                    <text x="220" y="225" fill="#94a3b8" font-size="9" font-weight="600">Al-Kharj</text>
                                    <text x="220" y="235" fill="#64748b" font-size="8">الخرج</text>

                                    <text x="160" y="240" fill="#94a3b8" font-size="9" font-weight="600">Ad-Dilam</text>

                                    <!-- Dynamic Pinpoint Marker -->
                                    <g id="mapPinGroup" transform="translate(200, 120)">
                                        <path d="M10,0 C4.5,0 0,4.5 0,10 C0,17.5 10,25 10,25 C10,25 20,17.5 20,10 C20,4.5 15.5,0 10,0 Z" fill="#ef4444" filter="drop-shadow(0px 3px 6px rgba(0,0,0,0.6))"/>
                                        <circle cx="10" cy="10" r="3.5" fill="#ffffff"/>
                                    </g>
                                </svg>

                                <!-- Zoom & Control Buttons -->
                                <div class="absolute bottom-3 end-3 flex flex-col gap-1 z-10">
                                    <div class="bg-[#181e27]/90 border border-[#2d3748] rounded-lg shadow-lg flex flex-col overflow-hidden">
                                        <button type="button" onclick="event.stopPropagation(); alert('Map Zoom In')" class="w-7 h-7 flex items-center justify-center text-slate-200 hover:bg-[#252f3f] text-sm font-bold border-b border-[#2d3748] cursor-pointer">+</button>
                                        <button type="button" onclick="event.stopPropagation(); alert('Map Zoom Out')" class="w-7 h-7 flex items-center justify-center text-slate-200 hover:bg-[#252f3f] text-sm font-bold cursor-pointer">-</button>
                                    </div>
                                    <button type="button" onclick="event.stopPropagation(); detectCurrentLocation()" class="w-7 h-7 bg-[#181e27]/90 border border-[#2d3748] rounded-lg shadow-lg flex items-center justify-center text-cyan-400 hover:bg-[#252f3f] cursor-pointer" title="Center On Current GPS Location">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </button>
                                </div>
                            </div>
                            <div class="text-[10px] text-slate-400 flex items-center justify-between pt-0.5">
                                <span>💡 Tip: Click anywhere on map to pin custom location</span>
                                <span class="text-cyan-400 cursor-pointer hover:underline" onclick="detectCurrentLocation()">Recenter GPS</span>
                            </div>
                        </div>

                        <!-- Coordinates & Detection Details -->
                        <div class="md:col-span-6 space-y-3">
                            <div class="grid grid-cols-2 gap-2.5">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1">Longitude <span class="text-amber-400">*</span></label>
                                    <input type="text" id="propLongitude" name="longitude" value="24.7136" onchange="syncLocationFromInputs()" placeholder="e.g. 24.7136" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-300 mb-1">Latitude <span class="text-amber-400">*</span></label>
                                    <input type="text" id="propLatitude" name="latitude" value="46.6753" onchange="syncLocationFromInputs()" placeholder="e.g. 46.6753" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all">
                                </div>
                            </div>

                            <!-- Detect Current Location Button -->
                            <div class="flex items-center gap-2">
                                <button type="button" id="btnDetectLocation" onclick="detectCurrentLocation()" class="flex-1 py-2.5 px-4 rounded-xl border border-cyan-500/60 bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-400 hover:text-cyan-300 font-bold text-xs flex items-center justify-center gap-2 transition-all shadow-xs cursor-pointer">
                                    <svg class="w-4 h-4 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                    <span id="btnDetectLocationText">Detect Current Location</span>
                                </button>
                                <button type="button" onclick="alert('Detect Current Location automatically queries your live GPS browser coordinates, reverse geocodes the National Address, and updates all fields.')" class="w-8 h-8 rounded-xl border border-[#2d3748] bg-[#1a202c] hover:bg-[#252f3f] text-cyan-400 font-bold text-xs flex items-center justify-center transition-colors cursor-pointer" title="How Location Detection Works">
                                    ?
                                </button>
                            </div>

                            <!-- Selected Location Summary (Customizable text) -->
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <label class="block text-xs font-semibold text-slate-300">Selected Location Summary</label>
                                    <span class="text-[10px] text-slate-400">Editable / Auto-updated</span>
                                </div>
                                <textarea id="propLocationSummary" name="location_summary" rows="2" class="w-full text-xs bg-[#1a202c] border border-[#2d3748] text-slate-100 placeholder-slate-500 rounded-xl p-3 focus:ring-2 focus:ring-[#e4881c] focus:border-[#e4881c] focus:outline-none transition-all resize-none">2868, Al Urubah Road, حي الورود, Riyadh Principality, Riyadh</textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal Actions (Bottom) -->
                <div class="pt-4 border-t border-[#232b38] flex items-center justify-end gap-3">
                    <button type="button" onclick="closeModal('modalPropertyCompliance')" class="px-5 py-2.5 rounded-xl border border-[#2d3748] text-slate-300 hover:bg-[#1a202c] text-xs font-semibold transition-colors">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#e4881c] to-[#c76f0d] hover:from-[#f59e0b] hover:to-[#d97706] text-white text-xs font-bold shadow-lg shadow-orange-500/20 transition-all">Confirm &amp; Save Details</button>
                </div>

            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleSubmenu(id) {
            const el = document.getElementById(id);
            if (el) el.classList.toggle('hidden');
        }

        // Reservation Tab Switcher (Arrival, Departure, In House)
        function switchResTab(tab) {
            const btnArr = document.getElementById('resTabArrival');
            const btnDep = document.getElementById('resTabDeparture');
            const btnInH = document.getElementById('resTabInHouse');

            // Reset all
            [btnArr, btnDep, btnInH].forEach(b => {
                if (b) {
                    b.classList.remove('bg-sky-600', 'text-white');
                    b.classList.add('bg-[#181e27]', 'text-slate-400');
                }
            });

            if (tab === 'arrival') {
                btnArr.classList.add('bg-sky-600', 'text-white');
                btnArr.classList.remove('bg-[#181e27]', 'text-slate-400');
            } else if (tab === 'departure') {
                btnDep.classList.add('bg-sky-600', 'text-white');
                btnDep.classList.remove('bg-[#181e27]', 'text-slate-400');
            } else {
                btnInH.classList.add('bg-sky-600', 'text-white');
                btnInH.classList.remove('bg-[#181e27]', 'text-slate-400');
            }
        }

        // Header Notifications Dropdown Handler
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

        // Support Chat & Ticket Handlers
        function toggleSupportPopup() {
            const pop = document.getElementById('popSupportChatTicket');
            if (pop) {
                pop.classList.toggle('hidden');
            }
        }

        function switchSupportTab(tab) {
            const chatPane = document.getElementById('supportChatPane');
            const ticketPane = document.getElementById('supportTicketPane');
            const chatBtn = document.getElementById('tabSupportChatBtn');
            const ticketBtn = document.getElementById('tabSupportTicketBtn');

            if (tab === 'chat') {
                chatPane.classList.remove('hidden');
                ticketPane.classList.add('hidden');
                chatBtn.classList.add('border-purple-500', 'text-white');
                chatBtn.classList.remove('border-transparent', 'text-slate-400');
                ticketBtn.classList.remove('border-purple-500', 'text-white');
                ticketBtn.classList.add('border-transparent', 'text-slate-400');
            } else {
                chatPane.classList.add('hidden');
                ticketPane.classList.remove('hidden');
                ticketBtn.classList.add('border-purple-500', 'text-white');
                ticketBtn.classList.remove('border-transparent', 'text-slate-400');
                chatBtn.classList.remove('border-purple-500', 'text-white');
                chatBtn.classList.add('border-transparent', 'text-slate-400');
            }
        }

        function sendSupportChatMessage(e) {
            e.preventDefault();
            const input = document.getElementById('inputSupportChatMessage');
            const msg = input?.value.trim();
            if (!msg) return;

            const box = document.getElementById('supportChatMessages');
            if (box) {
                // User message
                const userMsgHtml = `
                    <div class="flex items-start justify-end gap-2">
                        <div class="bg-purple-600 rounded-xl rounded-tr-none p-2.5 text-white leading-relaxed shadow-xs">
                            ${msg}
                            <div class="text-[9px] text-purple-200 text-end mt-1">Just now</div>
                        </div>
                    </div>
                `;
                box.insertAdjacentHTML('beforeend', userMsgHtml);
                input.value = '';
                box.scrollTop = box.scrollHeight;

                // Automated helpdesk dispatcher acknowledgment
                setTimeout(() => {
                    const replyHtml = `
                        <div class="flex items-start gap-2">
                            <div class="w-6 h-6 rounded-full bg-purple-600 flex items-center justify-center text-[10px] text-white font-bold shrink-0">IT</div>
                            <div class="bg-[#1a202c] border border-[#2d3748] rounded-xl rounded-tl-none p-2.5 text-slate-200 leading-relaxed shadow-xs">
                                Thank you for your inquiry. A hospitality technician has been assigned to your ticket.
                                <div class="text-[9px] text-slate-500 text-end mt-1">Just now</div>
                            </div>
                        </div>
                    `;
                    box.insertAdjacentHTML('beforeend', replyHtml);
                    box.scrollTop = box.scrollHeight;
                }, 1000);
            }
        }

        function submitSupportTicket(e) {
            e.preventDefault();
            const cat = document.getElementById('ticketCategory')?.value;
            const pri = document.getElementById('ticketPriority')?.value;
            const desc = document.getElementById('ticketDescription')?.value;

            const ticketId = 'TKT-' + Math.floor(100000 + Math.random() * 900000);
            alert(`Support Ticket [${ticketId}] logged successfully!\nCategory: ${cat}\nPriority: ${pri}\nOur enterprise technical operations team will follow up within SLA window.`);
            
            document.getElementById('ticketDescription').value = '';
            toggleSupportPopup();
        }

        function notifyTab(name) {
            alert('Opening ' + name + ' module...');
        }

        function openModal(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.remove('hidden');
                el.classList.add('flex');
            }
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.add('hidden');
                el.classList.remove('flex');
            }
        }

        function openNewResModal() {
            openModal('modalNewReservation');
        }

        function openWalkInModal() {
            openModal('modalWalkIn');
        }

        function openRoomActionModal(id, number, currentStatus, typeName) {
            document.getElementById('roomActionTitle').innerText = 'Room ' + number;
            document.getElementById('roomActionSubtitle').innerText = typeName;
            document.getElementById('roomActionStatusSelect').value = currentStatus;
            document.getElementById('roomStatusForm').action = '/rooms/' + id + '/status';
            openModal('modalRoomAction');
        }

        function filterAvailableRooms(typeId, targetSelectId) {
            const target = document.getElementById(targetSelectId);
            if (!target) return;
            const options = target.querySelectorAll('option');
            options.forEach(opt => {
                if (!opt.value) return; // Keep default placeholder
                const optType = opt.getAttribute('data-type');
                if (!typeId || optType === typeId) {
                    opt.style.display = '';
                } else {
                    opt.style.display = 'none';
                }
            });
        }

        let dashCurrentLang = 'en';
        const dI18n = {
            en: {
                dir: 'ltr',
                btnLang: 'Arabic 🌐',
                dashboard: 'Dashboard',
                reservations: 'Reservations',
                unitStatus: 'Unit Status',
                housekeeping: 'Housekeeping',
                financial: 'Financial',
                outlets: 'Outlets',
                customers: 'Customers',
                sms: 'SMS',
                reports: 'Reports',
                logs: 'Logs',
                nightAudit: 'Night Audit',
                propertyLocation: 'Property Location'
            },
            ar: {
                dir: 'rtl',
                btnLang: 'English 🌐',
                dashboard: 'لوحة التحكم',
                reservations: 'الحجوزات',
                unitStatus: 'حالة الوحدات',
                housekeeping: 'خدمة الغرف',
                financial: 'المالية والفواتير',
                outlets: 'نقاط البيع',
                customers: 'العملاء والنزلاء',
                sms: 'الرسائل النصية',
                reports: 'التقارير',
                logs: 'سجل العمليات',
                nightAudit: 'التدقيق الليلي',
                propertyLocation: 'موقع المنشأة والعنوان'
            }
        };

        function toggleDashboardLang() {
            dashCurrentLang = dashCurrentLang === 'en' ? 'ar' : 'en';
            const data = dI18n[dashCurrentLang];
            const root = document.getElementById('dashRoot');
            root.setAttribute('dir', data.dir);
            root.setAttribute('lang', dashCurrentLang);

            document.getElementById('btnLangLabel').innerText = data.btnLang;
            document.getElementById('txtNavDashboard').innerText = data.dashboard;
            document.getElementById('txtNavReservations').innerText = data.reservations;
            document.getElementById('txtNavUnitStatus').innerText = data.unitStatus;
            document.getElementById('txtNavHousekeeping').innerText = data.housekeeping;
            document.getElementById('txtNavFinancial').innerText = data.financial;
            document.getElementById('txtNavOutlets').innerText = data.outlets;
            document.getElementById('txtNavCustomers').innerText = data.customers;
            document.getElementById('txtNavSMS').innerText = data.sms;
            document.getElementById('txtNavReports').innerText = data.reports;
            document.getElementById('txtNavLogs').innerText = data.logs;
            document.getElementById('txtNavNightAudit').innerText = data.nightAudit;
            const propLoc = document.getElementById('txtNavPropertyLocation');
            if (propLoc) propLoc.innerText = data.propertyLocation;
        }

        // Property Compliance & Location Helpers
        function toggleVatInput(checkbox) {
            const input = document.getElementById('vatRegNo');
            if (!input) return;
            if (checkbox.checked) {
                input.dataset.oldVal = input.value;
                input.value = '';
                input.placeholder = 'No VAT Reg. No.';
                input.disabled = true;
                input.classList.add('opacity-40', 'cursor-not-allowed');
            } else {
                input.value = input.dataset.oldVal || '312777096700003';
                input.disabled = false;
                input.placeholder = 'e.g. 312777096700003';
                input.classList.remove('opacity-40', 'cursor-not-allowed');
            }
        }

        function toggleCommInput(checkbox) {
            const input = document.getElementById('commRegNo');
            if (!input) return;
            if (checkbox.checked) {
                input.dataset.oldVal = input.value;
                input.value = '';
                input.placeholder = 'No Comm. Reg. No.';
                input.disabled = true;
                input.classList.add('opacity-40', 'cursor-not-allowed');
            } else {
                input.value = input.dataset.oldVal || '7039653048';
                input.disabled = false;
                input.placeholder = 'e.g. 7039653048';
                input.classList.remove('opacity-40', 'cursor-not-allowed');
            }
        }

        // Interactive Map & Live Geolocation Handlers
        function updateMapPinPosition(lat, lng) {
            const pinGroup = document.getElementById('mapPinGroup');
            const lblCoords = document.getElementById('lblMapCoords');
            if (lblCoords) {
                lblCoords.innerText = `${lat}° N, ${lng}° E`;
            }
            if (pinGroup) {
                const numLat = parseFloat(lat) || 24.7136;
                const numLng = parseFloat(lng) || 46.6753;
                
                // Riyadh relative offset normalized
                const normX = Math.min(Math.max((numLng - 46.45) / (46.90 - 46.45), 0.08), 0.92);
                const normY = Math.min(Math.max(1 - (numLat - 24.50) / (24.95 - 24.50), 0.08), 0.92);
                
                const svgX = Math.round(normX * 400);
                const svgY = Math.round(normY * 300);
                
                pinGroup.setAttribute('transform', `translate(${svgX - 10}, ${svgY - 25})`);
            }
        }

        function handleMapClick(event) {
            const container = event.currentTarget.getBoundingClientRect();
            const clickX = event.clientX - container.left;
            const clickY = event.clientY - container.top;
            
            const ratioX = clickX / container.width;
            const ratioY = clickY / container.height;
            
            const newLng = (46.45 + ratioX * (46.90 - 46.45)).toFixed(4);
            const newLat = (24.95 - ratioY * (24.95 - 24.50)).toFixed(4);
            
            document.getElementById('propLatitude').value = newLat;
            document.getElementById('propLongitude').value = newLng;
            
            const pinGroup = document.getElementById('mapPinGroup');
            if (pinGroup) {
                const svgX = Math.round(ratioX * 400);
                const svgY = Math.round(ratioY * 300);
                pinGroup.setAttribute('transform', `translate(${svgX - 10}, ${svgY - 25})`);
            }
            
            const lblCoords = document.getElementById('lblMapCoords');
            if (lblCoords) {
                lblCoords.innerText = `${newLat}° N, ${newLng}° E`;
            }
            
            const summary = document.getElementById('propLocationSummary');
            if (summary) {
                summary.value = `Custom Selected Location (Coordinates: ${newLat}° N, ${newLng}° E)`;
            }
            
            const status = document.getElementById('txtLocationStatus');
            if (status) {
                status.innerHTML = `<span class="w-2 h-2 rounded-full bg-amber-400"></span><span class="text-amber-400">Custom Pin Selected</span>`;
            }
        }

        function syncLocationFromInputs() {
            const lat = document.getElementById('propLatitude')?.value;
            const lng = document.getElementById('propLongitude')?.value;
            updateMapPinPosition(lat, lng);
        }

        function detectCurrentLocation() {
            const btn = document.getElementById('btnDetectLocation');
            const btnText = document.getElementById('btnDetectLocationText');
            const status = document.getElementById('txtLocationStatus');
            
            if (btnText) btnText.innerText = 'Detecting My Location...';
            if (status) {
                status.innerHTML = `<span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span><span class="text-cyan-400">Querying Device GPS...</span>`;
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        const curLat = pos.coords.latitude.toFixed(4);
                        const curLng = pos.coords.longitude.toFixed(4);
                        
                        document.getElementById('propLatitude').value = curLat;
                        document.getElementById('propLongitude').value = curLng;
                        
                        updateMapPinPosition(curLat, curLng);
                        
                        const summary = document.getElementById('propLocationSummary');
                        if (summary) {
                            summary.value = `My Live Location (Lat: ${curLat}°, Lng: ${curLng}°) - Verified via Browser GPS`;
                        }

                        // Reverse geocoding lookup using OpenStreetMap Nominatim for real city/address
                        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${curLat}&lon=${curLng}&zoom=18&addressdetails=1`, {
                            headers: { 'Accept-Language': 'en' }
                        })
                        .then(res => res.json())
                        .then(geoData => {
                            if (geoData && geoData.display_name && summary) {
                                summary.value = geoData.display_name;
                            }
                            if (geoData && geoData.address) {
                                const addr = geoData.address;
                                if (addr.house_number && document.getElementById('inputBuildingNo')) {
                                    document.getElementById('inputBuildingNo').value = addr.house_number;
                                }
                                if (addr.postcode && document.getElementById('inputPostalCode')) {
                                    document.getElementById('inputPostalCode').value = addr.postcode;
                                }
                            }
                        })
                        .catch(() => {
                            // Non-blocking if offline or rate-limited
                        });

                        if (btnText) btnText.innerText = '✓ My Location Detected';
                        if (status) {
                            status.innerHTML = `<span class="w-2 h-2 rounded-full bg-emerald-400"></span><span class="text-emerald-400">My Location Active</span>`;
                        }
                        setTimeout(() => { 
                            if (btnText) btnText.innerText = 'Detect Current Location';
                        }, 3000);
                    },
                    (err) => {
                        // High accuracy Riyadh City Center fallback if location permission denied/unavailable
                        const fallbackLat = '24.7136';
                        const fallbackLng = '46.6753';
                        document.getElementById('propLatitude').value = fallbackLat;
                        document.getElementById('propLongitude').value = fallbackLng;
                        
                        updateMapPinPosition(fallbackLat, fallbackLng);
                        
                        const summary = document.getElementById('propLocationSummary');
                        if (summary) {
                            summary.value = '2868, Al Urubah Road, حي الورود, Riyadh Principality, Riyadh';
                        }

                        if (btnText) btnText.innerText = '✓ Riyadh Location (Default)';
                        if (status) {
                            status.innerHTML = `<span class="w-2 h-2 rounded-full bg-emerald-400"></span><span class="text-emerald-400">Riyadh GPS Active</span>`;
                        }
                        setTimeout(() => { 
                            if (btnText) btnText.innerText = 'Detect Current Location';
                        }, 3000);
                    },
                    { timeout: 8000, enableHighAccuracy: true, maximumAge: 0 }
                );
            } else {
                const fallbackLat = '24.7136';
                const fallbackLng = '46.6753';
                document.getElementById('propLatitude').value = fallbackLat;
                document.getElementById('propLongitude').value = fallbackLng;
                updateMapPinPosition(fallbackLat, fallbackLng);
                if (btnText) btnText.innerText = '✓ Riyadh Location Detected';
                if (status) {
                    status.innerHTML = `<span class="w-2 h-2 rounded-full bg-emerald-400"></span><span class="text-emerald-400">Riyadh GPS Active</span>`;
                }
                setTimeout(() => { 
                    if (btnText) btnText.innerText = 'Detect Current Location';
                }, 3000);
            }
        }

        function savePropertyCompliance(e) {
            e.preventDefault();
            const data = {
                vat: document.getElementById('toggleNoVat')?.checked ? 'None' : document.getElementById('vatRegNo')?.value,
                comm: document.getElementById('toggleNoComm')?.checked ? 'None' : document.getElementById('commRegNo')?.value,
                building: document.getElementById('inputBuildingNo')?.value,
                secondary: document.getElementById('inputSecondaryNo')?.value,
                postal: document.getElementById('inputPostalCode')?.value,
                longitude: document.getElementById('propLongitude')?.value,
                latitude: document.getElementById('propLatitude')?.value,
                summary: document.getElementById('propLocationSummary')?.value
            };
            localStorage.setItem('alabeer_property_compliance', JSON.stringify(data));
            sessionStorage.setItem('dismissed_property_modal', 'true');
            alert('Property Address, Commercial Registration & Location confirmed and saved successfully!');
            closeModal('modalPropertyCompliance');
        }

        // Theme Toggle Handler
        function updateDashboardThemeUI(theme) {
            const isDark = theme === 'dark';
            const root = document.documentElement;
            const icon = document.getElementById('dashThemeIcon');
            const text = document.getElementById('dashThemeText');

            if (isDark) {
                root.classList.remove('theme-light');
                if (icon) icon.innerText = '🌙';
                if (text) text.innerText = 'Dark';
            } else {
                root.classList.add('theme-light');
                if (icon) icon.innerText = '☀️';
                if (text) text.innerText = 'Light';
            }
        }

        function toggleDashboardTheme() {
            const current = localStorage.getItem('alabeer_theme') || 'dark';
            const next = current === 'dark' ? 'light' : 'dark';
            localStorage.setItem('alabeer_theme', next);
            updateDashboardThemeUI(next);
        }

        // Real-time Dual Clocks (Saudi Arabia & Bangladesh)
        function updateWorldClocks() {
            const now = new Date();

            // 1. Saudi Arabia (Riyadh, Asia/Riyadh, GMT+3)
            const saudiTimeStr = now.toLocaleTimeString('en-US', {
                timeZone: 'Asia/Riyadh',
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const saudiDateStr = now.toLocaleDateString('en-GB', {
                timeZone: 'Asia/Riyadh',
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });

            const elSaudiTime = document.getElementById('clockSaudiTime');
            const elSaudiDate = document.getElementById('clockSaudiDate');
            if (elSaudiTime) elSaudiTime.innerText = saudiTimeStr;
            if (elSaudiDate) elSaudiDate.innerText = saudiDateStr;

            // 2. Bangladesh (Dhaka, Asia/Dhaka, GMT+6)
            const bdTimeStr = now.toLocaleTimeString('en-US', {
                timeZone: 'Asia/Dhaka',
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const bdDateStr = now.toLocaleDateString('en-GB', {
                timeZone: 'Asia/Dhaka',
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });

            const elBdTime = document.getElementById('clockBdTime');
            const elBdDate = document.getElementById('clockBdDate');
            if (elBdTime) elBdTime.innerText = bdTimeStr;
            if (elBdDate) elBdDate.innerText = bdDateStr;
        }

        // Initialize Dark Visualizer Analytics (Matching Tablet Visualizer Mockup)
        document.addEventListener('DOMContentLoaded', function() {
            // Start live world clocks immediately and update every second
            updateWorldClocks();
            setInterval(updateWorldClocks, 1000);

            const savedTheme = localStorage.getItem('alabeer_theme') || 'dark';
            updateDashboardThemeUI(savedTheme);

            // Restore customized values from localStorage if available
            try {
                const savedCompliance = localStorage.getItem('alabeer_property_compliance');
                if (savedCompliance) {
                    const parsed = JSON.parse(savedCompliance);
                    if (parsed.vat && parsed.vat !== 'None') document.getElementById('vatRegNo').value = parsed.vat;
                    if (parsed.comm && parsed.comm !== 'None') document.getElementById('commRegNo').value = parsed.comm;
                    if (parsed.building) document.getElementById('inputBuildingNo').value = parsed.building;
                    if (parsed.secondary) document.getElementById('inputSecondaryNo').value = parsed.secondary;
                    if (parsed.postal) document.getElementById('inputPostalCode').value = parsed.postal;
                    if (parsed.longitude) document.getElementById('propLongitude').value = parsed.longitude;
                    if (parsed.latitude) document.getElementById('propLatitude').value = parsed.latitude;
                    if (parsed.summary) document.getElementById('propLocationSummary').value = parsed.summary;
                    if (parsed.longitude && parsed.latitude) {
                        updateMapPinPosition(parsed.longitude, parsed.latitude);
                    }
                }
            } catch (e) {}

            // Auto-show Property Address, Commercial Information & Location modal 3 seconds after login
            setTimeout(() => {
                openModal('modalPropertyCompliance');
                // Automatically query current location to show live coords in popup
                detectCurrentLocation();
            }, 3000);
            // 1. Room Inventory Donut
            const ctxDonut = document.getElementById('chartInventoryDonut')?.getContext('2d');
            if (ctxDonut) {
                new Chart(ctxDonut, {
                    type: 'doughnut',
                    data: {
                        labels: ['Occupied', 'Vacant Clean', 'Reserved', 'Cleaning/Maint'],
                        datasets: [{
                            data: [{{ $occupiedCount }}, {{ $vacantCleanCount }}, {{ $reservedCount }}, {{ $dirtyCount }}],
                            backgroundColor: ['#e4881c', '#10b981', '#3b82f6', '#f43f5e'],
                            borderWidth: 0,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '72%',
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#1e2532',
                                titleColor: '#ffffff',
                                bodyColor: '#cbd5e1',
                                borderColor: '#334155',
                                borderWidth: 1,
                                padding: 10
                            }
                        }
                    }
                });
            }

            // 2. Intraday Demand Spline Wave
            const ctxWave = document.getElementById('chartDemandWave')?.getContext('2d');
            if (ctxWave) {
                const gradientFill = ctxWave.createLinearGradient(0, 0, 0, 180);
                gradientFill.addColorStop(0, 'rgba(228, 136, 28, 0.45)');
                gradientFill.addColorStop(1, 'rgba(228, 136, 28, 0.0)');

                const gradientFill2 = ctxWave.createLinearGradient(0, 0, 0, 180);
                gradientFill2.addColorStop(0, 'rgba(16, 185, 129, 0.35)');
                gradientFill2.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

                new Chart(ctxWave, {
                    type: 'line',
                    data: {
                        labels: ['06:00', '09:00', '12:00', '15:00', '18:00', '21:00', '23:00'],
                        datasets: [
                            {
                                label: 'Demand Surge (Today)',
                                data: [32, 48, 62, 75, 91, 88, 70],
                                borderColor: '#e4881c',
                                borderWidth: 2.5,
                                backgroundColor: gradientFill,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#e4881c',
                                pointBorderColor: '#ffffff',
                                pointHoverRadius: 5
                            },
                            {
                                label: 'Target Baseline',
                                data: [25, 40, 50, 60, 72, 70, 60],
                                borderColor: '#10b981',
                                borderWidth: 2,
                                borderDash: [4, 4],
                                backgroundColor: gradientFill2,
                                fill: true,
                                tension: 0.4,
                                pointRadius: 0
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                align: 'end',
                                labels: {
                                    boxWidth: 10,
                                    boxHeight: 10,
                                    color: '#94a3b8',
                                    font: { size: 10 }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#1e2532',
                                borderColor: '#334155',
                                borderWidth: 1
                            }
                        },
                        scales: {
                            x: {
                                grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                ticks: { color: '#64748b', font: { size: 10 } }
                            },
                            y: {
                                grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                ticks: { color: '#64748b', font: { size: 10 } }
                            }
                        }
                    }
                });
            }

            // 3. Turnaround Velocity Radial Half Gauge
            const ctxGauge = document.getElementById('chartVelocityGauge')?.getContext('2d');
            if (ctxGauge) {
                new Chart(ctxGauge, {
                    type: 'doughnut',
                    data: {
                        labels: ['Efficiency', 'Remaining'],
                        datasets: [{
                            data: [94, 6],
                            backgroundColor: ['#e4881c', '#232936'],
                            borderWidth: 0,
                            circumference: 180,
                            rotation: 270
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '78%',
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
