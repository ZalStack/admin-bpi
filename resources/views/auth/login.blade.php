<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Admin Panel BPI</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(3deg); }
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-14px) rotate(-2deg); }
        }
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(15px) rotate(2deg); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.15; }
            50% { opacity: 0.35; }
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes floatLeft {
            0%, 100% { transform: translateX(0px) translateY(0px); }
            50% { transform: translateX(-8px) translateY(-12px); }
        }
        @keyframes floatRight {
            0%, 100% { transform: translateX(0px) translateY(0px); }
            50% { transform: translateX(8px) translateY(-10px); }
        }
        @keyframes glowPulse {
            0%, 100% { opacity: 0.08; }
            50% { opacity: 0.18; }
        }
        .float-anim { animation: float 6s ease-in-out infinite; }
        .float-anim-slow { animation: floatSlow 8s ease-in-out infinite; }
        .float-anim-reverse { animation: floatReverse 7s ease-in-out infinite; }
        .float-left { animation: floatLeft 7s ease-in-out infinite; }
        .float-right { animation: floatRight 8s ease-in-out infinite; }
        .pulse-glow { animation: pulse-glow 4s ease-in-out infinite; }
        .glow-pulse { animation: glowPulse 5s ease-in-out infinite; }
        .spin-slow { animation: spin-slow 25s linear infinite; }

        .login-bg {
            background: linear-gradient(135deg, #3a0611 0%, #520A18 25%, #68001C 50%, #821E38 75%, #5c1225 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .glass-card-strong {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-glass {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.18);
            border-color: #E3DBAF;
            box-shadow: 0 0 0 3px rgba(227, 219, 175, 0.2), 0 0 20px rgba(227, 219, 175, 0.1);
        }
        .input-glass::placeholder {
            color: rgba(255, 255, 255, 0.45);
        }

        .btn-submit {
            background: linear-gradient(135deg, #E3DBAF 0%, #CAB988 50%, #B09861 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }
        .btn-submit:hover::before {
            left: 100%;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -8px rgba(227, 219, 175, 0.5);
        }
        .btn-submit:active {
            transform: translateY(0);
        }

        /* SVG icon styling */
        .deco-icon {
            filter: drop-shadow(0 0 20px rgba(227, 219, 175, 0.05));
        }
        .deco-icon svg {
            filter: drop-shadow(0 0 15px rgba(227, 219, 175, 0.08));
        }
    </style>
</head>
<body class="font-poppins antialiased h-full login-bg overflow-x-hidden">

    <!-- ========== MAIN CONTAINER ========== -->
    <div class="relative min-h-screen flex items-center justify-center p-4 overflow-x-hidden">

        <!-- ===== DECORATIVE BACKGROUND LAYERS ===== -->

        <!-- Radial glow center -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full bg-[#821E38]/20 blur-[120px] pulse-glow"></div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-[#132C5C]/15 blur-[100px]"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full bg-[#97763A]/10 blur-[80px]"></div>
        </div>

        <!-- ===== TOP WAVY SHAPE ===== -->
        <svg class="absolute top-0 left-0 w-full" viewBox="0 0 1440 320" preserveAspectRatio="none" style="height: 15vh; min-height: 80px;">
            <defs>
                <linearGradient id="waveTopGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#E3DBAF;stop-opacity:0.08" />
                    <stop offset="50%" style="stop-color:#CAB988;stop-opacity:0.12" />
                    <stop offset="100%" style="stop-color:#E3DBAF;stop-opacity:0.06" />
                </linearGradient>
                <linearGradient id="waveTopGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.04" />
                    <stop offset="100%" style="stop-color:#ffffff;stop-opacity:0.08" />
                </linearGradient>
            </defs>
            <path fill="url(#waveTopGrad2)" d="M0,160L48,170.7C96,181,192,203,288,192C384,181,480,139,576,128C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
            <path fill="url(#waveTopGrad1)" d="M0,96L48,112C96,128,192,160,288,165.3C384,171,480,149,576,138.7C672,128,768,128,864,138.7C960,149,1056,171,1152,165.3C1248,160,1344,128,1392,112L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>

        <!-- ===== BOTTOM WAVY SHAPE ===== -->
        <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 320" preserveAspectRatio="none" style="height: 18vh; min-height: 100px;">
            <defs>
                <linearGradient id="waveBotGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#E3DBAF;stop-opacity:0.06" />
                    <stop offset="50%" style="stop-color:#CAB988;stop-opacity:0.1" />
                    <stop offset="100%" style="stop-color:#E3DBAF;stop-opacity:0.05" />
                </linearGradient>
                <linearGradient id="waveBotGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.03" />
                    <stop offset="100%" style="stop-color:#ffffff;stop-opacity:0.07" />
                </linearGradient>
            </defs>
            <path fill="url(#waveBotGrad2)" d="M0,256L60,240C120,224,240,192,360,186.7C480,181,600,203,720,218.7C840,235,960,245,1080,229.3C1200,213,1320,171,1380,149.3L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
            <path fill="url(#waveBotGrad1)" d="M0,192L60,197.3C120,203,240,213,360,208C480,203,600,181,720,176C840,171,960,181,1080,192C1200,203,1320,213,1380,218.7L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
        </svg>

        <!-- ===== DECORATIVE SVG ICONS - LEFT SIDE ===== -->

        <!-- Film Reel (top-left) - Dipertebal -->
        <div class="absolute top-[10%] left-[3%] float-anim deco-icon glow-pulse hidden lg:block pointer-events-none">
            <svg width="110" height="110" viewBox="0 0 110 110" fill="none">
                <circle cx="55" cy="55" r="48" stroke="#E3DBAF" stroke-width="3" opacity="0.4"/>
                <circle cx="55" cy="55" r="48" stroke="#E3DBAF" stroke-width="1.5" opacity="0.2" stroke-dasharray="4 6"/>
                <circle cx="55" cy="55" r="16" stroke="#E3DBAF" stroke-width="3" opacity="0.5"/>
                <circle cx="55" cy="55" r="6" fill="#E3DBAF" opacity="0.6"/>
                <!-- Sprocket holes -->
                <circle cx="55" cy="18" r="9" stroke="#E3DBAF" stroke-width="2.5" opacity="0.5"/>
                <circle cx="55" cy="92" r="9" stroke="#E3DBAF" stroke-width="2.5" opacity="0.5"/>
                <circle cx="18" cy="55" r="9" stroke="#E3DBAF" stroke-width="2.5" opacity="0.5"/>
                <circle cx="92" cy="55" r="9" stroke="#E3DBAF" stroke-width="2.5" opacity="0.5"/>
                <circle cx="29" cy="29" r="8" stroke="#E3DBAF" stroke-width="2.5" opacity="0.4"/>
                <circle cx="81" cy="29" r="8" stroke="#E3DBAF" stroke-width="2.5" opacity="0.4"/>
                <circle cx="29" cy="81" r="8" stroke="#E3DBAF" stroke-width="2.5" opacity="0.4"/>
                <circle cx="81" cy="81" r="8" stroke="#E3DBAF" stroke-width="2.5" opacity="0.4"/>
            </svg>
        </div>

        <!-- Film Strip (left-middle) - Dipertebal -->
        <div class="absolute top-[42%] left-[1.5%] float-left deco-icon hidden lg:block pointer-events-none">
            <svg width="45" height="200" viewBox="0 0 45 200" fill="none">
                <rect x="2" y="2" width="41" height="196" rx="4" stroke="#E3DBAF" stroke-width="2.5" opacity="0.5"/>
                <rect x="2" y="2" width="41" height="196" rx="4" stroke="#E3DBAF" stroke-width="1" opacity="0.2" stroke-dasharray="6 8"/>
                <!-- Sprocket holes -->
                <rect x="6" y="12" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="27" y="12" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="6" y="34" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="27" y="34" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="6" y="56" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="27" y="56" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="6" y="78" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="27" y="78" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="6" y="100" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="27" y="100" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="6" y="122" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="27" y="122" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="6" y="144" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="27" y="144" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="6" y="166" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="27" y="166" width="12" height="10" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <rect x="6" y="188" width="12" height="6" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.3"/>
                <rect x="27" y="188" width="12" height="6" rx="2" stroke="#E3DBAF" stroke-width="2" opacity="0.3"/>
            </svg>
        </div>

        <!-- Camera Icon (left-bottom) - Dipertebal -->
        <div class="absolute bottom-[28%] left-[4%] float-anim-slow deco-icon hidden xl:block pointer-events-none">
            <svg width="90" height="70" viewBox="0 0 90 70" fill="none">
                <!-- Camera body -->
                <rect x="4" y="18" width="82" height="48" rx="8" stroke="#E3DBAF" stroke-width="2.5" opacity="0.5"/>
                <rect x="4" y="18" width="82" height="48" rx="8" stroke="#E3DBAF" stroke-width="1" opacity="0.2" stroke-dasharray="5 7"/>
                <!-- Viewfinder bump -->
                <path d="M28,18 L34,6 L56,6 L62,18" stroke="#E3DBAF" stroke-width="2.5" fill="none" opacity="0.5"/>
                <!-- Lens -->
                <circle cx="45" cy="42" r="16" stroke="#E3DBAF" stroke-width="2.5" opacity="0.5"/>
                <circle cx="45" cy="42" r="10" stroke="#E3DBAF" stroke-width="2" opacity="0.4"/>
                <circle cx="45" cy="42" r="4" stroke="#E3DBAF" stroke-width="1.5" opacity="0.3"/>
                <!-- Flash -->
                <rect x="68" y="26" width="6" height="4" rx="1" fill="#E3DBAF" opacity="0.3"/>
                <!-- Focus ring details -->
                <circle cx="74" cy="30" r="4" stroke="#E3DBAF" stroke-width="1.5" opacity="0.3"/>
                <line x1="74" y1="26" x2="74" y2="34" stroke="#E3DBAF" stroke-width="1" opacity="0.2"/>
                <line x1="70" y1="30" x2="78" y2="30" stroke="#E3DBAF" stroke-width="1" opacity="0.2"/>
            </svg>
        </div>

        <!-- ===== DECORATIVE SVG ICONS - RIGHT SIDE ===== -->

        <!-- BPI Shield (top-right) - Dipertebal -->
        <div class="absolute top-[6%] right-[3%] spin-slow deco-icon hidden md:block pointer-events-none">
            <svg width="130" height="150" viewBox="0 0 130 150" fill="none">
                <!-- Shield outline -->
                <path d="M65,8 L118,35 L118,85 C118,118 92,138 65,146 C38,138 12,118 12,85 L12,35 Z" stroke="#E3DBAF" stroke-width="2.5" opacity="0.35"/>
                <path d="M65,8 L118,35 L118,85 C118,118 92,138 65,146 C38,138 12,118 12,85 L12,35 Z" stroke="#E3DBAF" stroke-width="1" opacity="0.15" stroke-dasharray="6 8"/>
                <!-- Inner shield -->
                <path d="M65,22 L100,44 L100,80 C100,104 83,120 65,126 C47,120 30,104 30,80 L30,44 Z" stroke="#CAB988" stroke-width="2" opacity="0.3"/>
                <!-- Film inside shield -->
                <rect x="50" y="50" width="30" height="40" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity="0.25"/>
                <rect x="54" y="56" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width="1" opacity="0.2"/>
                <rect x="68" y="56" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width="1" opacity="0.2"/>
                <rect x="54" y="68" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width="1" opacity="0.2"/>
                <rect x="68" y="68" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width="1" opacity="0.2"/>
                <rect x="54" y="80" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width="1" opacity="0.2"/>
                <rect x="68" y="80" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width="1" opacity="0.2"/>
            </svg>
        </div>

        <!-- Film Reel Small (top-right) - Dipertebal -->
        <div class="absolute top-[18%] right-[10%] float-anim-slow deco-icon hidden lg:block pointer-events-none">
            <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                <circle cx="40" cy="40" r="36" stroke="#CAB988" stroke-width="2.5" opacity="0.4"/>
                <circle cx="40" cy="40" r="12" stroke="#CAB988" stroke-width="2.5" opacity="0.5"/>
                <circle cx="40" cy="40" r="5" fill="#CAB988" opacity="0.5"/>
                <circle cx="40" cy="12" r="7" stroke="#CAB988" stroke-width="2" opacity="0.4"/>
                <circle cx="40" cy="68" r="7" stroke="#CAB988" stroke-width="2" opacity="0.4"/>
                <circle cx="12" cy="40" r="7" stroke="#CAB988" stroke-width="2" opacity="0.4"/>
                <circle cx="68" cy="40" r="7" stroke="#CAB988" stroke-width="2" opacity="0.4"/>
                <circle cx="22" cy="22" r="6" stroke="#CAB988" stroke-width="2" opacity="0.3"/>
                <circle cx="58" cy="22" r="6" stroke="#CAB988" stroke-width="2" opacity="0.3"/>
                <circle cx="22" cy="58" r="6" stroke="#CAB988" stroke-width="2" opacity="0.3"/>
                <circle cx="58" cy="58" r="6" stroke="#CAB988" stroke-width="2" opacity="0.3"/>
            </svg>
        </div>

        <!-- Clapperboard (right-middle) - Dipertebal -->
        <div class="absolute top-[42%] right-[2%] float-right deco-icon hidden lg:block pointer-events-none">
            <svg width="100" height="85" viewBox="0 0 100 85" fill="none">
                <!-- Board -->
                <rect x="4" y="24" width="92" height="58" rx="5" stroke="#E3DBAF" stroke-width="2.5" opacity="0.5"/>
                <rect x="4" y="24" width="92" height="58" rx="5" stroke="#E3DBAF" stroke-width="1" opacity="0.2" stroke-dasharray="5 7"/>
                <!-- Clapstick top -->
                <path d="M4,24 L20,6 L96,6 L80,24" stroke="#E3DBAF" stroke-width="2.5" fill="none" opacity="0.5"/>
                <!-- Clapstick lines -->
                <line x1="4" y1="24" x2="20" y2="6" stroke="#E3DBAF" stroke-width="1.5" opacity="0.3"/>
                <line x1="20" y1="24" x2="36" y2="6" stroke="#E3DBAF" stroke-width="1.5" opacity="0.3"/>
                <line x1="36" y1="24" x2="52" y2="6" stroke="#E3DBAF" stroke-width="1.5" opacity="0.3"/>
                <line x1="52" y1="24" x2="68" y2="6" stroke="#E3DBAF" stroke-width="1.5" opacity="0.3"/>
                <line x1="68" y1="24" x2="84" y2="6" stroke="#E3DBAF" stroke-width="1.5" opacity="0.3"/>
                <line x1="84" y1="24" x2="96" y2="6" stroke="#E3DBAF" stroke-width="1.5" opacity="0.3"/>
                <!-- Board stripes -->
                <line x1="8" y1="38" x2="92" y2="38" stroke="#E3DBAF" stroke-width="1.5" opacity="0.2"/>
                <line x1="8" y1="50" x2="92" y2="50" stroke="#E3DBAF" stroke-width="1.5" opacity="0.2"/>
                <line x1="8" y1="62" x2="92" y2="62" stroke="#E3DBAF" stroke-width="1.5" opacity="0.2"/>
                <line x1="8" y1="74" x2="92" y2="74" stroke="#E3DBAF" stroke-width="1.5" opacity="0.2"/>
            </svg>
        </div>

        <!-- Play Button (right-bottom) - Dipertebal -->
        <div class="absolute bottom-[32%] right-[6%] float-anim-reverse deco-icon hidden xl:block pointer-events-none">
            <svg width="70" height="70" viewBox="0 0 70 70" fill="none">
                <!-- Circle -->
                <circle cx="35" cy="35" r="32" stroke="#E3DBAF" stroke-width="2.5" opacity="0.4"/>
                <circle cx="35" cy="35" r="32" stroke="#E3DBAF" stroke-width="1" opacity="0.2" stroke-dasharray="6 8"/>
                <!-- Play triangle -->
                <polygon points="28,22 48,35 28,48" stroke="#E3DBAF" stroke-width="2.5" fill="none" opacity="0.5"/>
                <!-- Inner glow -->
                <polygon points="28,22 48,35 28,48" stroke="#E3DBAF" stroke-width="1.5" opacity="0.2"/>
                <!-- Sound waves -->
                <path d="M58,26 C62,30 62,40 58,44" stroke="#E3DBAF" stroke-width="2" fill="none" opacity="0.25"/>
                <path d="M62,21 C68,29 68,41 62,49" stroke="#E3DBAF" stroke-width="1.5" fill="none" opacity="0.15"/>
            </svg>
        </div>

        <!-- ===== MAIN CONTENT ===== -->
        <div class="relative z-10 w-full max-w-[440px] mx-auto">

            <!-- Logo / Brand Section -->
            <div class="text-center mb-6 sm:mb-8">
                <!-- Logo container with decorative ring -->
                <div class="relative inline-block mb-4 sm:mb-5">
                    <!-- Outer decorative ring -->
                    <div class="absolute -inset-3 rounded-full border border-[#E3DBAF]/10 hidden sm:block"></div>
                    <div class="absolute -inset-5 rounded-full border border-dashed border-[#E3DBAF]/5 hidden sm:block"></div>

                    <div class="glass-card-strong rounded-2xl p-3 sm:p-4 shadow-2xl">
                        <img
                            src="{{ asset('images/logo-bpi.png') }}"
                            alt="Logo BPI"
                            class="w-12 h-12 sm:w-16 sm:h-16 md:w-20 md:h-20 object-contain"
                        >
                    </div>
                </div>

                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-white tracking-tight">
                    Admin Panel <span class="text-[#E3DBAF]">BPI</span>
                </h1>
                <p class="text-[#E3DBAF]/70 mt-1.5 sm:mt-2 font-light text-xs sm:text-sm md:text-base">
                    Badan Perfilman Indonesia
                </p>
                <div class="flex items-center justify-center gap-2 mt-3">
                    <div class="h-px w-8 bg-gradient-to-r from-transparent to-[#E3DBAF]/30"></div>
                    <!-- Film strip accent -->
                    <svg width="28" height="10" viewBox="0 0 28 10" fill="none" class="opacity-40">
                        <rect x="0" y="0" width="6" height="10" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                        <rect x="8" y="0" width="6" height="10" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                        <rect x="16" y="0" width="6" height="10" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                        <rect x="24" y="0" width="4" height="10" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                    </svg>
                    <div class="h-px w-8 bg-gradient-to-l from-transparent to-[#E3DBAF]/30"></div>
                </div>
            </div>

            <!-- Login Card -->
            <div class="glass-card rounded-2xl sm:rounded-3xl shadow-[0_8px_60px_-12px_rgba(0,0,0,0.4)] p-6 sm:p-8 md:p-9">

                <!-- Card header -->
                <div class="flex items-center gap-3 mb-6 sm:mb-7">
                    <!-- Clapperboard mini icon -->
                    <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-[#E3DBAF]/20 to-[#CAB988]/10 flex items-center justify-center border border-[#E3DBAF]/15">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E3DBAF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="6" width="20" height="14" rx="2"/>
                            <path d="M2 6L7 2h10l5 4"/>
                            <line x1="7" y1="2" x2="10" y2="6"/>
                            <line x1="12" y1="2" x2="15" y2="6"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white font-semibold text-base sm:text-lg">Masuk</h2>
                        <p class="text-white/50 text-[0.7rem] sm:text-xs">Silakan masuk ke akun Anda</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5 sm:space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white/90 mb-2">
                            Alamat Email
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none transition-colors group-focus-within:[&>svg]:text-[#E3DBAF]">
                                <svg class="h-5 w-5 text-white/30 transition-colors" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="M22 4L12 13L2 4"/>
                                </svg>
                            </div>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="w-full pl-11 pr-4 py-3 input-glass rounded-xl text-white text-sm focus:outline-none"
                                placeholder="contoh@email.com"
                            >
                        </div>
                        @error('email')
                            <p class="text-[#EBA9B0] text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white/90 mb-2">
                            Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none transition-colors group-focus-within:[&>svg]:text-[#E3DBAF]">
                                <svg class="h-5 w-5 text-white/30 transition-colors" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                                </svg>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                class="w-full pl-11 pr-4 py-3 input-glass rounded-xl text-white text-sm focus:outline-none"
                                placeholder="Masukan password"
                            >
                        </div>
                        @error('password')
                            <p class="text-[#EBA9B0] text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer group">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="h-4 w-4 rounded border-white/30 bg-white/10 text-[#E3DBAF] focus:ring-[#E3DBAF]/30 focus:ring-offset-0 transition"
                            >
                            <span class="ml-2 text-sm text-white/60 group-hover:text-white/80 transition-colors">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Error Message -->
                    @if ($errors->has('email') || $errors->has('password'))
                        <div class="bg-red-500/15 backdrop-blur-sm border border-red-400/30 text-white px-4 py-3 rounded-xl flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                            <p class="text-sm text-white/90">Email atau password salah. Silakan coba lagi.</p>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full btn-submit py-3 rounded-xl font-semibold text-[#520A18] text-sm sm:text-base shadow-lg focus:outline-none focus:ring-4 focus:ring-[#E3DBAF]/30"
                    >
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
                                <polyline points="10 17 15 12 10 7"/>
                                <line x1="15" y1="12" x2="3" y2="12"/>
                            </svg>
                            Masuk ke Dashboard
                        </span>
                    </button>

                    <!-- Divider with film icon -->
                    <div class="relative flex items-center justify-center pt-1">
                        <div class="absolute inset-x-0 top-1/2 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
                        <div class="relative bg-[#1a0a14]/80 backdrop-blur-sm px-3 py-1 rounded-full border border-white/10">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E3DBAF" stroke-width="2" stroke-linecap="round" opacity="0.5">
                                <polygon points="5 3 19 12 5 21 5 3"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-center pt-2">
                        <div class="flex items-center justify-center gap-1.5 mb-2">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#E3DBAF" stroke-width="1.8" opacity="0.4">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                            <p class="text-[0.68rem] text-white/35 font-light">
                                &copy; {{ date('Y') }} Badan Perfilman Indonesia
                            </p>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Bottom decorative element -->
            <div class="flex items-center justify-center mt-5 sm:mt-6 gap-1.5 opacity-30">
                <div class="h-px w-12 bg-gradient-to-r from-transparent to-[#E3DBAF]/40"></div>
                <svg width="18" height="12" viewBox="0 0 18 12" fill="none">
                    <rect x="0" y="0" width="5" height="12" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                    <rect x="6.5" y="0" width="5" height="12" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                    <rect x="13" y="0" width="5" height="12" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                </svg>
                <div class="h-px w-12 bg-gradient-to-l from-transparent to-[#E3DBAF]/40"></div>
            </div>
        </div>
    </div>

</body>
</html>
