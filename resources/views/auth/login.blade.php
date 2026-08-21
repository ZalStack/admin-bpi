<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Admin Panel BPI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--gold:#E3DBAF;--gold-dim:#CAB988;--gold-deep:#B09861;--burgundy:#520A18;--burgundy-light:#821E38;--burgundy-dark:#3a0611}
        body{font-family:'Poppins','Inter',sans-serif;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;overflow-x:hidden}

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp{from{opacity:0;transform:translateY(30px) scale(.97)}to{opacity:1;transform:translateY(0) scale(1)}}
        @keyframes fadeIn{from{opacity:0}to{opacity:1}}
        @keyframes float{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-20px) rotate(3deg)}}
        @keyframes floatSlow{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(-14px) rotate(-2deg)}}
        @keyframes floatReverse{0%,100%{transform:translateY(0) rotate(0)}50%{transform:translateY(15px) rotate(2deg)}}
        @keyframes pulseGlow{0%,100%{opacity:.15;transform:scale(1)}50%{opacity:.4;transform:scale(1.05)}}
        @keyframes spinSlow{from{transform:rotate(0)}to{transform:rotate(360deg)}}
        @keyframes floatLeft{0%,100%{transform:translate(0,0)}50%{transform:translate(-8px,-12px)}}
        @keyframes floatRight{0%,100%{transform:translate(0,0)}50%{transform:translate(8px,-10px)}}
        @keyframes drift{0%,100%{transform:translate(0,0) rotate(0)}25%{transform:translate(6px,-12px) rotate(2deg)}50%{transform:translate(-4px,-20px) rotate(-1deg)}75%{transform:translate(8px,-8px) rotate(1.5deg)}}
        @keyframes sway{0%,100%{transform:translateX(0) rotate(0)}25%{transform:translateX(12px) rotate(1deg)}75%{transform:translateX(-12px) rotate(-1deg)}}
        @keyframes pulse{0%,100%{opacity:.3;transform:scale(1)}50%{opacity:.6;transform:scale(1.08)}}
        @keyframes orbMove1{0%,100%{transform:translate(0,0)}25%{transform:translate(40px,-30px)}50%{transform:translate(-20px,-60px)}75%{transform:translate(30px,-20px)}}
        @keyframes orbMove2{0%,100%{transform:translate(0,0)}25%{transform:translate(-50px,20px)}50%{transform:translate(30px,50px)}75%{transform:translate(-30px,10px)}}
        @keyframes orbMove3{0%,100%{transform:translate(0,0)}33%{transform:translate(25px,-40px)}66%{transform:translate(-35px,-15px)}}
        @keyframes cornerPulse{0%,100%{opacity:.25;transform:scale(1)}50%{opacity:.5;transform:scale(1.03)}}
        @keyframes lineFlow{0%{stroke-dashoffset:20}100%{stroke-dashoffset:0}}
        @keyframes shake{0%,100%{transform:translateX(0)}10%,30%,50%,70%,90%{transform:translateX(-4px)}20%,40%,60%,80%{transform:translateX(4px)}}
        @keyframes spinBtn{from{transform:rotate(0)}to{transform:rotate(360deg)}}

        .anim-fade-in-up{animation:fadeInUp .7s cubic-bezier(.16,1,.3,1) both}
        .anim-delay-1{animation-delay:.1s}
        .anim-delay-2{animation-delay:.2s}
        .anim-fade-in{animation:fadeIn 1s ease both}

        .float-1{animation:float 6s ease-in-out infinite}
        .float-2{animation:floatSlow 8s ease-in-out infinite}
        .float-3{animation:floatReverse 7s ease-in-out infinite}
        .float-4{animation:floatLeft 7s ease-in-out infinite}
        .float-5{animation:floatRight 8s ease-in-out infinite}
        .float-6{animation:drift 9s ease-in-out infinite}
        .float-7{animation:sway 10s ease-in-out infinite}
        .pulse-slow{animation:pulseGlow 5s ease-in-out infinite}
        .pulse-mid{animation:pulse 6s ease-in-out infinite}
        .spin-slow{animation:spinSlow 30s linear infinite}
        .shake{animation:shake .5s ease-in-out}

        /* ===== BACKGROUND ===== */
        .login-bg{
            background:linear-gradient(135deg,#2a0510 0%,#3a0611 15%,#520A18 35%,#68001C 50%,#821E38 70%,#5c1225 85%,#3a0611 100%);
            position:relative;
        }
        .login-bg::before{
            content:'';position:absolute;inset:0;
            background-image:radial-gradient(rgba(227,219,175,.1) 1px,transparent 1px);
            background-size:24px 24px;
            pointer-events:none;z-index:1;
        }

        /* Ambient Orbs */
        .orb{position:absolute;border-radius:50%;pointer-events:none;will-change:transform}
        .orb-1{width:600px;height:600px;top:10%;left:5%;background:radial-gradient(circle,rgba(130,30,56,.35) 0%,transparent 70%);filter:blur(80px);animation:orbMove1 20s ease-in-out infinite}
        .orb-2{width:500px;height:500px;bottom:5%;right:0;background:radial-gradient(circle,rgba(19,44,92,.3) 0%,transparent 70%);filter:blur(70px);animation:orbMove2 25s ease-in-out infinite}
        .orb-3{width:450px;height:450px;top:40%;left:40%;background:radial-gradient(circle,rgba(151,118,58,.2) 0%,transparent 70%);filter:blur(90px);animation:orbMove3 18s ease-in-out infinite}
        .orb-4{width:350px;height:350px;top:0;right:20%;background:radial-gradient(circle,rgba(227,219,175,.08) 0%,transparent 70%);filter:blur(60px);animation:orbMove1 22s ease-in-out infinite reverse}
        .orb-5{width:300px;height:300px;bottom:20%;left:10%;background:radial-gradient(circle,rgba(196,100,100,.15) 0%,transparent 70%);filter:blur(50px);animation:orbMove2 16s ease-in-out infinite reverse}

        /* Corner Frames */
        .corner-frame{position:absolute;pointer-events:none;z-index:2}
        .corner-frame svg{animation:cornerPulse 6s ease-in-out infinite}

        /* ===== GLASS MORPHISM ===== */
        .glass-card-strong{background:rgba(255,255,255,.1);backdrop-filter:blur(28px);-webkit-backdrop-filter:blur(28px);border:1px solid rgba(255,255,255,.15)}

        /* ===== CARD ===== */
        .card-wrapper{position:relative;border-radius:24px;padding:2px;background:linear-gradient(135deg,rgba(227,219,175,.3),rgba(255,255,255,.05),rgba(227,219,175,.2))}
        .card-wrapper::before{content:'';position:absolute;inset:0;border-radius:24px;padding:1px;background:conic-gradient(from var(--angle,0deg),transparent 40%,var(--gold) 50%,transparent 60%);-webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);-webkit-mask-composite:xor;mask-composite:exclude;opacity:0;transition:opacity .5s ease}
        .card-wrapper:hover::before{opacity:1}
        .card-inner{background:rgba(26,10,20,.75);backdrop-filter:blur(30px);-webkit-backdrop-filter:blur(30px);border-radius:22px;position:relative;overflow:hidden}
        .card-inner::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(227,219,175,.3),transparent)}

        /* ===== INPUT ===== */
        .input-glass{background:rgba(255,255,255,.07);border:1.5px solid rgba(255,255,255,.12);transition:all .35s cubic-bezier(.4,0,.2,1)}
        .input-glass:hover{background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.2)}
        .input-glass:focus{background:rgba(255,255,255,.14);border-color:var(--gold);box-shadow:0 0 0 4px rgba(227,219,175,.1),0 4px 20px -4px rgba(227,219,175,.15)}
        .input-glass::placeholder{color:rgba(255,255,255,.35)}
        .input-icon{transition:color .3s ease,transform .3s ease}
        .input-wrapper:focus-within .input-icon{color:var(--gold);transform:scale(1.1)}

        /* ===== BUTTON ===== */
        .btn-submit{background:linear-gradient(135deg,var(--gold) 0%,var(--gold-dim) 50%,var(--gold-deep) 100%);background-size:200% 200%;transition:all .4s cubic-bezier(.4,0,.2,1);position:relative;overflow:hidden}
        .btn-submit::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.3),transparent);transition:left .6s ease}
        .btn-submit:hover::before{left:100%}
        .btn-submit:hover{transform:translateY(-2px);box-shadow:0 12px 35px -8px rgba(227,219,175,.5),0 0 0 1px rgba(227,219,175,.3);background-position:100% 0}
        .btn-submit:active{transform:translateY(0) scale(.98)}
        .btn-submit:disabled{opacity:.7;cursor:not-allowed;transform:none}
        .btn-submit .btn-spinner{display:none;width:20px;height:20px;border:2.5px solid rgba(82,10,24,.3);border-top-color:var(--burgundy);border-radius:50%;animation:spinBtn .7s linear infinite}
        .btn-submit.loading .btn-text{display:none}
        .btn-submit.loading .btn-spinner{display:inline-block}
        .btn-submit.loading::before{display:none}

        /* ===== CHECKBOX ===== */
        .custom-checkbox{appearance:none;-webkit-appearance:none;width:18px;height:18px;border:1.5px solid rgba(255,255,255,.25);border-radius:5px;background:rgba(255,255,255,.06);cursor:pointer;transition:all .25s ease;position:relative}
        .custom-checkbox:checked{background:var(--gold);border-color:var(--gold)}
        .custom-checkbox:checked::after{content:'';position:absolute;left:5px;top:1px;width:5px;height:10px;border:solid var(--burgundy);border-width:0 2px 2px 0;transform:rotate(45deg)}
        .custom-checkbox:hover{border-color:rgba(227,219,175,.5)}
        .custom-checkbox:focus{box-shadow:0 0 0 3px rgba(227,219,175,.15)}

        /* ===== PASSWORD TOGGLE ===== */
        .toggle-password{position:absolute;right:12px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.35);cursor:pointer;transition:color .3s ease;z-index:10;padding:4px;display:flex;align-items:center;justify-content:center}
        .toggle-password:hover{color:var(--gold)}

        /* ===== DECORATIVE ===== */
        .deco{position:absolute;pointer-events:none;z-index:2}
        .deco svg{filter:drop-shadow(0 0 12px rgba(227,219,175,.06))}

        /* ===== RESPONSIVE ===== */
        @media(max-width:640px){
            .deco svg{transform:scale(.6)}
            .corner-frame svg{transform:scale(.5)}
            .orb-1,.orb-4{width:300px;height:300px}
            .orb-2,.orb-5{width:250px;height:250px}
            .orb-3{width:200px;height:200px}
        }
        @media(min-width:641px) and (max-width:1024px){
            .deco svg{transform:scale(.75)}
            .corner-frame svg{transform:scale(.65)}
        }
        @media(max-width:380px){.card-wrapper{border-radius:18px}.card-inner{border-radius:16px}}

        ::-webkit-scrollbar{width:6px}
        ::-webkit-scrollbar-track{background:transparent}
        ::-webkit-scrollbar-thumb{background:rgba(227,219,175,.2);border-radius:3px}
    </style>
</head>
<body class="h-full login-bg overflow-x-hidden">

<div class="relative min-h-screen flex items-center justify-center p-4 overflow-x-hidden">

    <!-- ===== AMBIENT ORB LAYERS ===== -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none" style="z-index:0">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="orb orb-4"></div>
        <div class="orb orb-5"></div>
    </div>

    <!-- ===== CORNER FRAMES ===== -->
    <!-- Top-Left -->
    <div class="corner-frame top-0 left-0 anim-fade-in" style="animation-delay:.2s">
        <svg width="220" height="220" viewBox="0 0 220 220" fill="none" style="opacity:.3">
            <path d="M0,0 L80,0" stroke="#E3DBAF" stroke-width="1.5"/>
            <path d="M0,0 L0,80" stroke="#E3DBAF" stroke-width="1.5"/>
            <path d="M10,10 L60,10" stroke="#E3DBAF" stroke-width=".8" opacity=".5"/>
            <path d="M10,10 L10,60" stroke="#E3DBAF" stroke-width=".8" opacity=".5"/>
            <circle cx="10" cy="10" r="3" fill="#E3DBAF" opacity=".4"/>
            <!-- Film strip corner -->
            <rect x="20" y="20" width="40" height="30" rx="2" stroke="#E3DBAF" stroke-width="1" opacity=".25"/>
            <rect x="24" y="24" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".2"/>
            <rect x="36" y="24" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".2"/>
            <rect x="24" y="34" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".2"/>
            <rect x="36" y="34" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".2"/>
            <!-- Star -->
            <polygon points="70,30 73,38 82,38 75,43 77,52 70,47 63,52 65,43 58,38 67,38" stroke="#CAB988" stroke-width="1" fill="none" opacity=".25"/>
            <!-- Small reel -->
            <circle cx="50" cy="70" r="18" stroke="#E3DBAF" stroke-width="1" opacity=".2"/>
            <circle cx="50" cy="70" r="6" stroke="#E3DBAF" stroke-width="1" opacity=".25"/>
            <circle cx="50" cy="55" r="3" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <circle cx="50" cy="85" r="3" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <circle cx="35" cy="70" r="3" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <circle cx="65" cy="70" r="3" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <!-- Lines -->
            <line x1="0" y1="100" x2="90" y2="100" stroke="#E3DBAF" stroke-width=".5" opacity=".12" stroke-dasharray="4 6"/>
            <line x1="100" y1="0" x2="100" y2="90" stroke="#E3DBAF" stroke-width=".5" opacity=".12" stroke-dasharray="4 6"/>
            <!-- Dots -->
            <circle cx="100" cy="50" r="2" fill="#CAB988" opacity=".2"/>
            <circle cx="50" cy="100" r="2" fill="#CAB988" opacity=".2"/>
            <circle cx="120" cy="30" r="1.5" fill="#E3DBAF" opacity=".15"/>
            <circle cx="30" cy="120" r="1.5" fill="#E3DBAF" opacity=".15"/>
        </svg>
    </div>
    <!-- Top-Right -->
    <div class="corner-frame top-0 right-0 anim-fade-in" style="animation-delay:.3s">
        <svg width="220" height="220" viewBox="0 0 220 220" fill="none" style="opacity:.3">
            <path d="M220,0 L140,0" stroke="#E3DBAF" stroke-width="1.5"/>
            <path d="M220,0 L220,80" stroke="#E3DBAF" stroke-width="1.5"/>
            <path d="M210,10 L160,10" stroke="#E3DBAF" stroke-width=".8" opacity=".5"/>
            <path d="M210,10 L210,60" stroke="#E3DBAF" stroke-width=".8" opacity=".5"/>
            <circle cx="210" cy="10" r="3" fill="#E3DBAF" opacity=".4"/>
            <!-- Shield -->
            <path d="M180,25 L195,32 L195,55 C195,70 188,78 180,82 C172,78 165,70 165,55 L165,32 Z" stroke="#CAB988" stroke-width="1.2" fill="none" opacity=".25"/>
            <path d="M180,35 L188,39 L188,52 C188,60 184,65 180,67 C176,65 172,60 172,52 L172,39 Z" stroke="#E3DBAF" stroke-width=".8" fill="none" opacity=".18"/>
            <!-- Clapperboard mini -->
            <rect x="140" y="40" width="28" height="20" rx="2" stroke="#E3DBAF" stroke-width="1" opacity=".22"/>
            <path d="M140,40 L146,32 L168,32 L162,40" stroke="#E3DBAF" stroke-width="1" fill="none" opacity=".22"/>
            <line x1="146" y1="40" x2="152" y2="32" stroke="#E3DBAF" stroke-width=".7" opacity=".15"/>
            <line x1="155" y1="40" x2="161" y2="32" stroke="#E3DBAF" stroke-width=".7" opacity=".15"/>
            <!-- Camera -->
            <rect x="150" y="72" width="30" height="18" rx="3" stroke="#E3DBAF" stroke-width="1" opacity=".2"/>
            <path d="M158,72 L161,67 L169,67 L172,72" stroke="#E3DBAF" stroke-width=".8" fill="none" opacity=".18"/>
            <circle cx="165" cy="81" r="5" stroke="#E3DBAF" stroke-width="1" opacity=".2"/>
            <!-- Lines -->
            <line x1="130" y1="100" x2="220" y2="100" stroke="#E3DBAF" stroke-width=".5" opacity=".12" stroke-dasharray="4 6"/>
            <line x1="120" y1="0" x2="120" y2="90" stroke="#E3DBAF" stroke-width=".5" opacity=".12" stroke-dasharray="4 6"/>
            <circle cx="130" cy="50" r="2" fill="#CAB988" opacity=".2"/>
            <circle cx="180" cy="100" r="2" fill="#CAB988" opacity=".2"/>
            <circle cx="100" cy="30" r="1.5" fill="#E3DBAF" opacity=".15"/>
            <circle cx="190" cy="120" r="1.5" fill="#E3DBAF" opacity=".15"/>
        </svg>
    </div>
    <!-- Bottom-Left -->
    <div class="corner-frame bottom-0 left-0 anim-fade-in" style="animation-delay:.5s">
        <svg width="220" height="220" viewBox="0 0 220 220" fill="none" style="opacity:.3">
            <path d="M0,220 L80,220" stroke="#E3DBAF" stroke-width="1.5"/>
            <path d="M0,220 L0,140" stroke="#E3DBAF" stroke-width="1.5"/>
            <path d="M10,210 L60,210" stroke="#E3DBAF" stroke-width=".8" opacity=".5"/>
            <path d="M10,210 L10,160" stroke="#E3DBAF" stroke-width=".8" opacity=".5"/>
            <circle cx="10" cy="210" r="3" fill="#E3DBAF" opacity=".4"/>
            <!-- Play button -->
            <circle cx="50" cy="175" r="20" stroke="#E3DBAF" stroke-width="1.2" fill="none" opacity=".22"/>
            <polygon points="44,167 58,175 44,183" stroke="#E3DBAF" stroke-width="1" fill="none" opacity=".25"/>
            <!-- Sound waves -->
            <path d="M75,168 C80,172 80,178 75,182" stroke="#E3DBAF" stroke-width=".8" fill="none" opacity=".15"/>
            <path d="M80,164 C87,171 87,179 80,186" stroke="#E3DBAF" stroke-width=".6" fill="none" opacity=".1"/>
            <!-- Star -->
            <polygon points="25,150 28,158 37,158 30,163 32,172 25,167 18,172 20,163 13,158 22,158" stroke="#CAB988" stroke-width="1" fill="none" opacity=".22"/>
            <!-- Film reel small -->
            <circle cx="80" cy="150" r="12" stroke="#E3DBAF" stroke-width="1" opacity=".2"/>
            <circle cx="80" cy="150" r="4" stroke="#E3DBAF" stroke-width="1" opacity=".22"/>
            <circle cx="80" cy="140" r="2" stroke="#E3DBAF" stroke-width=".7" opacity=".15"/>
            <circle cx="80" cy="160" r="2" stroke="#E3DBAF" stroke-width=".7" opacity=".15"/>
            <circle cx="70" cy="150" r="2" stroke="#E3DBAF" stroke-width=".7" opacity=".15"/>
            <circle cx="90" cy="150" r="2" stroke="#E3DBAF" stroke-width=".7" opacity=".15"/>
            <!-- Lines -->
            <line x1="0" y1="120" x2="90" y2="120" stroke="#E3DBAF" stroke-width=".5" opacity=".12" stroke-dasharray="4 6"/>
            <line x1="100" y1="130" x2="100" y2="220" stroke="#E3DBAF" stroke-width=".5" opacity=".12" stroke-dasharray="4 6"/>
            <circle cx="100" cy="170" r="2" fill="#CAB988" opacity=".2"/>
            <circle cx="50" cy="130" r="1.5" fill="#E3DBAF" opacity=".15"/>
        </svg>
    </div>
    <!-- Bottom-Right -->
    <div class="corner-frame bottom-0 right-0 anim-fade-in" style="animation-delay:.6s">
        <svg width="220" height="220" viewBox="0 0 220 220" fill="none" style="opacity:.3">
            <path d="M220,220 L140,220" stroke="#E3DBAF" stroke-width="1.5"/>
            <path d="M220,220 L220,140" stroke="#E3DBAF" stroke-width="1.5"/>
            <path d="M210,210 L160,210" stroke="#E3DBAF" stroke-width=".8" opacity=".5"/>
            <path d="M210,210 L210,160" stroke="#E3DBAF" stroke-width=".8" opacity=".5"/>
            <circle cx="210" cy="210" r="3" fill="#E3DBAF" opacity=".4"/>
            <!-- Popcorn -->
            <path d="M170,185 L175,210 Q176,214 180,214 L190,214 Q194,214 195,210 L200,185" stroke="#CAB988" stroke-width="1.2" fill="none" opacity=".22"/>
            <line x1="172" y1="192" x2="198" y2="192" stroke="#CAB988" stroke-width=".8" opacity=".15"/>
            <line x1="173.5" y1="199" x2="196.5" y2="199" stroke="#CAB988" stroke-width=".8" opacity=".15"/>
            <circle cx="178" cy="180" r="4" stroke="#CAB988" stroke-width="1" opacity=".2"/>
            <circle cx="185" cy="177" r="4.5" stroke="#CAB988" stroke-width="1" opacity=".2"/>
            <circle cx="192" cy="180" r="4" stroke="#CAB988" stroke-width="1" opacity=".2"/>
            <circle cx="185" cy="172" r="3.5" stroke="#CAB988" stroke-width=".8" opacity=".15"/>
            <!-- Trophy -->
            <circle cx="155" cy="165" r="8" stroke="#E3DBAF" stroke-width="1" fill="none" opacity=".2"/>
            <path d="M149,173 L149,185 Q149,190 155,191 Q161,190 161,185 L161,173" stroke="#E3DBAF" stroke-width="1" fill="none" opacity=".18"/>
            <path d="M149,176 Q143,178 144,184" stroke="#E3DBAF" stroke-width=".8" fill="none" opacity=".15"/>
            <path d="M161,176 Q167,178 166,184" stroke="#E3DBAF" stroke-width=".8" fill="none" opacity=".15"/>
            <line x1="148" y1="191" x2="162" y2="191" stroke="#E3DBAF" stroke-width="1" opacity=".2"/>
            <rect x="150" y="191" width="10" height="5" rx="1" stroke="#E3DBAF" stroke-width=".8" fill="none" opacity=".15"/>
            <!-- Lines -->
            <line x1="130" y1="120" x2="220" y2="120" stroke="#E3DBAF" stroke-width=".5" opacity=".12" stroke-dasharray="4 6"/>
            <line x1="120" y1="130" x2="120" y2="220" stroke="#E3DBAF" stroke-width=".5" opacity=".12" stroke-dasharray="4 6"/>
            <circle cx="140" cy="170" r="2" fill="#CAB988" opacity=".2"/>
            <circle cx="170" cy="130" r="1.5" fill="#E3DBAF" opacity=".15"/>
        </svg>
    </div>

    <!-- ===== SVG DECORATIVE ICONS (visible on ALL screens) ===== -->

    <!-- LEFT: Large Film Reel -->
    <div class="deco float-1 anim-fade-in" style="top:5%;left:2%;animation-delay:.3s;z-index:2">
        <svg width="130" height="130" viewBox="0 0 130 130" fill="none">
            <circle cx="65" cy="65" r="58" stroke="#E3DBAF" stroke-width="2" opacity=".35"/>
            <circle cx="65" cy="65" r="58" stroke="#E3DBAF" stroke-width="1" opacity=".15" stroke-dasharray="5 7"/>
            <circle cx="65" cy="65" r="20" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <circle cx="65" cy="65" r="7" fill="#E3DBAF" opacity=".45"/>
            <circle cx="65" cy="18" r="10" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <circle cx="65" cy="112" r="10" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <circle cx="18" cy="65" r="10" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <circle cx="112" cy="65" r="10" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <circle cx="32" cy="32" r="9" stroke="#E3DBAF" stroke-width="1.8" opacity=".35"/>
            <circle cx="98" cy="32" r="9" stroke="#E3DBAF" stroke-width="1.8" opacity=".35"/>
            <circle cx="32" cy="98" r="9" stroke="#E3DBAF" stroke-width="1.8" opacity=".35"/>
            <circle cx="98" cy="98" r="9" stroke="#E3DBAF" stroke-width="1.8" opacity=".35"/>
        </svg>
    </div>

    <!-- LEFT: Film Strip (tall) -->
    <div class="deco float-4 anim-fade-in" style="top:28%;left:0;z-index:2;animation-delay:.5s">
        <svg width="50" height="240" viewBox="0 0 50 240" fill="none">
            <rect x="2" y="2" width="46" height="236" rx="4" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <rect x="2" y="2" width="46" height="236" rx="4" stroke="#E3DBAF" stroke-width=".8" opacity=".15" stroke-dasharray="6 8"/>
            <rect x="6" y="12" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="30" y="12" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="6" y="32" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="30" y="32" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="6" y="52" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="30" y="52" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="6" y="72" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="30" y="72" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="6" y="92" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="30" y="92" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".35"/>
            <rect x="6" y="112" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".3"/>
            <rect x="30" y="112" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".3"/>
            <rect x="6" y="132" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".3"/>
            <rect x="30" y="132" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".3"/>
            <rect x="6" y="152" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".25"/>
            <rect x="30" y="152" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".25"/>
            <rect x="6" y="172" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".25"/>
            <rect x="30" y="172" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".25"/>
            <rect x="6" y="192" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".2"/>
            <rect x="30" y="192" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".2"/>
            <rect x="6" y="212" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".18"/>
            <rect x="30" y="212" width="14" height="10" rx="2" stroke="#E3DBAF" stroke-width="1.5" opacity=".18"/>
        </svg>
    </div>

    <!-- LEFT: Camera -->
    <div class="deco float-2 anim-fade-in" style="bottom:15%;left:3%;z-index:2;animation-delay:.7s">
        <svg width="100" height="80" viewBox="0 0 100 80" fill="none">
            <rect x="4" y="20" width="92" height="54" rx="8" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <rect x="4" y="20" width="92" height="54" rx="8" stroke="#E3DBAF" stroke-width=".8" opacity=".15" stroke-dasharray="5 7"/>
            <path d="M30,20 L37,7 L63,7 L70,20" stroke="#E3DBAF" stroke-width="2" fill="none" opacity=".4"/>
            <circle cx="50" cy="47" r="18" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <circle cx="50" cy="47" r="12" stroke="#E3DBAF" stroke-width="1.5" opacity=".3"/>
            <circle cx="50" cy="47" r="5" stroke="#E3DBAF" stroke-width="1.2" opacity=".25"/>
            <rect x="75" y="28" width="7" height="5" rx="1" fill="#E3DBAF" opacity=".25"/>
            <circle cx="82" cy="33" r="4" stroke="#E3DBAF" stroke-width="1.2" opacity=".2"/>
            <line x1="82" y1="28" x2="82" y2="38" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <line x1="77" y1="33" x2="87" y2="33" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
        </svg>
    </div>

    <!-- LEFT: Star -->
    <div class="deco float-6 anim-fade-in" style="top:55%;left:6%;z-index:2;animation-delay:1s">
        <svg width="70" height="70" viewBox="0 0 70 70" fill="none">
            <polygon points="35,5 41,25 62,25 45,38 51,58 35,45 19,58 25,38 8,25 29,25" stroke="#E3DBAF" stroke-width="1.8" opacity=".35"/>
            <polygon points="35,5 41,25 62,25 45,38 51,58 35,45 19,58 25,38 8,25 29,25" stroke="#E3DBAF" stroke-width=".8" opacity=".12" stroke-dasharray="4 5"/>
            <circle cx="35" cy="32" r="8" stroke="#CAB988" stroke-width="1.2" opacity=".28"/>
            <circle cx="35" cy="32" r="3" fill="#E3DBAF" opacity=".2"/>
        </svg>
    </div>

    <!-- LEFT: Megaphone -->
    <div class="deco float-3 anim-fade-in" style="bottom:3%;left:12%;z-index:2;animation-delay:1.3s">
        <svg width="85" height="65" viewBox="0 0 85 65" fill="none">
            <path d="M14,20 L48,8 L48,54 L14,42 Z" stroke="#CAB988" stroke-width="1.8" opacity=".35" fill="none"/>
            <path d="M14,20 L48,8 L48,54 L14,42 Z" stroke="#CAB988" stroke-width=".8" opacity=".12" fill="none" stroke-dasharray="4 6"/>
            <rect x="4" y="24" width="12" height="16" rx="2" stroke="#CAB988" stroke-width="1.5" opacity=".3"/>
            <line x1="48" y1="22" x2="60" y2="18" stroke="#E3DBAF" stroke-width="1.5" opacity=".25"/>
            <line x1="48" y1="40" x2="60" y2="44" stroke="#E3DBAF" stroke-width="1.5" opacity=".25"/>
            <path d="M60,18 C68,24 68,36 60,42" stroke="#E3DBAF" stroke-width="1.2" opacity=".18" fill="none"/>
            <path d="M65,14 C74,22 74,38 65,46" stroke="#E3DBAF" stroke-width=".8" opacity=".1" fill="none"/>
        </svg>
    </div>

    <!-- LEFT: Spotlight -->
    <div class="deco float-7 anim-fade-in" style="top:72%;left:8%;z-index:2;animation-delay:1.6s">
        <svg width="45" height="95" viewBox="0 0 45 95" fill="none">
            <ellipse cx="22.5" cy="12" rx="13" ry="11" stroke="#E3DBAF" stroke-width="1.8" opacity=".32"/>
            <ellipse cx="22.5" cy="12" r="6" stroke="#E3DBAF" stroke-width="1.2" opacity=".22"/>
            <path d="M15,22 L5,88" stroke="#E3DBAF" stroke-width="1" opacity=".12"/>
            <path d="M30,22 L40,88" stroke="#E3DBAF" stroke-width="1" opacity=".12"/>
            <path d="M22.5,22 L22.5,92" stroke="#E3DBAF" stroke-width=".8" opacity=".1"/>
            <path d="M10,22 L0,85" stroke="#E3DBAF" stroke-width=".6" opacity=".08"/>
            <path d="M35,22 L45,85" stroke="#E3DBAF" stroke-width=".6" opacity=".08"/>
        </svg>
    </div>

    <!-- LEFT: Small Reel mid -->
    <div class="deco float-5 anim-fade-in" style="top:18%;left:10%;z-index:2;animation-delay:1.1s">
        <svg width="55" height="55" viewBox="0 0 55 55" fill="none">
            <circle cx="27.5" cy="27.5" r="24" stroke="#CAB988" stroke-width="1.8" opacity=".3"/>
            <circle cx="27.5" cy="27.5" r="9" stroke="#CAB988" stroke-width="1.8" opacity=".35"/>
            <circle cx="27.5" cy="27.5" r="3.5" fill="#CAB988" opacity=".3"/>
            <circle cx="27.5" cy="9" r="5" stroke="#CAB988" stroke-width="1.2" opacity=".25"/>
            <circle cx="27.5" cy="46" r="5" stroke="#CAB988" stroke-width="1.2" opacity=".25"/>
            <circle cx="9" cy="27.5" r="5" stroke="#CAB988" stroke-width="1.2" opacity=".25"/>
            <circle cx="46" cy="27.5" r="5" stroke="#CAB988" stroke-width="1.2" opacity=".25"/>
        </svg>
    </div>

    <!-- LEFT: Cinema ticket -->
    <div class="deco float-1 anim-fade-in" style="top:88%;left:15%;z-index:2;animation-delay:1.9s">
        <svg width="75" height="38" viewBox="0 0 75 38" fill="none">
            <path d="M4,7 Q4,3 8,3 L30,3 L30,0 L36,3 L67,3 Q71,3 71,7 L71,15 Q68,15 68,19 Q68,23 71,23 L71,31 Q71,35 67,35 L36,35 L30,38 L30,35 L8,35 Q4,35 4,31 L4,23 Q7,23 7,19 Q7,15 4,15 Z" stroke="#E3DBAF" stroke-width="1.5" opacity=".3"/>
            <line x1="30" y1="3" x2="30" y2="35" stroke="#E3DBAF" stroke-width=".8" opacity=".2" stroke-dasharray="3 3"/>
            <text x="44" y="16" font-family="Poppins" font-size="7" font-weight="600" fill="#E3DBAF" opacity=".2">BPI</text>
            <text x="40" y="28" font-family="Poppins" font-size="5" fill="#E3DBAF" opacity=".15">CINEMA</text>
        </svg>
    </div>

    <!-- RIGHT: Shield (large, slow spin) -->
    <div class="deco spin-slow anim-fade-in" style="top:2%;right:2%;z-index:2;animation-delay:.4s">
        <svg width="140" height="165" viewBox="0 0 140 165" fill="none">
            <path d="M70,8 L128,38 L128,95 C128,130 98,152 70,160 C42,152 12,130 12,95 L12,38 Z" stroke="#E3DBAF" stroke-width="2" opacity=".3"/>
            <path d="M70,8 L128,38 L128,95 C128,130 98,152 70,160 C42,152 12,130 12,95 L12,38 Z" stroke="#E3DBAF" stroke-width=".8" opacity=".12" stroke-dasharray="6 8"/>
            <path d="M70,24 L108,48 L108,88 C108,112 90,128 70,134 C50,128 32,112 30,88 L30,48 Z" stroke="#CAB988" stroke-width="1.5" opacity=".25"/>
            <rect x="55" y="55" width="30" height="42" rx="2" stroke="#E3DBAF" stroke-width="1.2" opacity=".2"/>
            <rect x="59" y="61" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="73" y="61" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="59" y="73" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="73" y="73" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="59" y="85" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="73" y="85" width="8" height="6" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
        </svg>
    </div>

    <!-- RIGHT: Film Reel Large -->
    <div class="deco float-2 anim-fade-in" style="top:14%;right:8%;z-index:2;animation-delay:.6s">
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none">
            <circle cx="45" cy="45" r="40" stroke="#CAB988" stroke-width="2" opacity=".35"/>
            <circle cx="45" cy="45" r="14" stroke="#CAB988" stroke-width="2" opacity=".4"/>
            <circle cx="45" cy="45" r="5" fill="#CAB988" opacity=".4"/>
            <circle cx="45" cy="13" r="8" stroke="#CAB988" stroke-width="1.5" opacity=".35"/>
            <circle cx="45" cy="77" r="8" stroke="#CAB988" stroke-width="1.5" opacity=".35"/>
            <circle cx="13" cy="45" r="8" stroke="#CAB988" stroke-width="1.5" opacity=".35"/>
            <circle cx="77" cy="45" r="8" stroke="#CAB988" stroke-width="1.5" opacity=".35"/>
            <circle cx="24" cy="24" r="7" stroke="#CAB988" stroke-width="1.2" opacity=".28"/>
            <circle cx="66" cy="24" r="7" stroke="#CAB988" stroke-width="1.2" opacity=".28"/>
            <circle cx="24" cy="66" r="7" stroke="#CAB988" stroke-width="1.2" opacity=".28"/>
            <circle cx="66" cy="66" r="7" stroke="#CAB988" stroke-width="1.2" opacity=".28"/>
        </svg>
    </div>

    <!-- RIGHT: Clapperboard (large) -->
    <div class="deco float-5 anim-fade-in" style="top:38%;right:0;z-index:2;animation-delay:.8s">
        <svg width="110" height="95" viewBox="0 0 110 95" fill="none">
            <rect x="4" y="26" width="102" height="64" rx="5" stroke="#E3DBAF" stroke-width="2" opacity=".4"/>
            <rect x="4" y="26" width="102" height="64" rx="5" stroke="#E3DBAF" stroke-width=".8" opacity=".15" stroke-dasharray="5 7"/>
            <path d="M4,26 L22,6 L106,6 L88,26" stroke="#E3DBAF" stroke-width="2" fill="none" opacity=".4"/>
            <line x1="4" y1="26" x2="22" y2="6" stroke="#E3DBAF" stroke-width="1.2" opacity=".25"/>
            <line x1="22" y1="26" x2="40" y2="6" stroke="#E3DBAF" stroke-width="1.2" opacity=".25"/>
            <line x1="40" y1="26" x2="58" y2="6" stroke="#E3DBAF" stroke-width="1.2" opacity=".25"/>
            <line x1="58" y1="26" x2="76" y2="6" stroke="#E3DBAF" stroke-width="1.2" opacity=".25"/>
            <line x1="76" y1="26" x2="94" y2="6" stroke="#E3DBAF" stroke-width="1.2" opacity=".25"/>
            <line x1="94" y1="26" x2="106" y2="6" stroke="#E3DBAF" stroke-width="1.2" opacity=".25"/>
            <line x1="8" y1="42" x2="102" y2="42" stroke="#E3DBAF" stroke-width="1.2" opacity=".18"/>
            <line x1="8" y1="56" x2="102" y2="56" stroke="#E3DBAF" stroke-width="1.2" opacity=".18"/>
            <line x1="8" y1="70" x2="102" y2="70" stroke="#E3DBAF" stroke-width="1.2" opacity=".18"/>
            <line x1="8" y1="84" x2="102" y2="84" stroke="#E3DBAF" stroke-width="1.2" opacity=".18"/>
        </svg>
    </div>

    <!-- RIGHT: Play Button -->
    <div class="deco float-3 anim-fade-in" style="bottom:25%;right:4%;z-index:2;animation-delay:1s">
        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
            <circle cx="40" cy="40" r="36" stroke="#E3DBAF" stroke-width="2" opacity=".38"/>
            <circle cx="40" cy="40" r="36" stroke="#E3DBAF" stroke-width=".8" opacity=".15" stroke-dasharray="6 8"/>
            <polygon points="32,22 52,40 32,58" stroke="#E3DBAF" stroke-width="2.5" fill="none" opacity=".4"/>
            <polygon points="32,22 52,40 32,58" stroke="#E3DBAF" stroke-width="1.2" opacity=".18"/>
            <path d="M60,28 C65,33 65,47 60,52" stroke="#E3DBAF" stroke-width="1.8" fill="none" opacity=".22"/>
            <path d="M65,22 C72,30 72,50 65,58" stroke="#E3DBAF" stroke-width="1.2" fill="none" opacity=".12"/>
        </svg>
    </div>

    <!-- RIGHT: Popcorn -->
    <div class="deco float-6 anim-fade-in" style="bottom:5%;right:2%;z-index:2;animation-delay:1.2s">
        <svg width="60" height="80" viewBox="0 0 60 80" fill="none">
            <path d="M14,32 L20,72 Q21,76 25,76 L35,76 Q39,76 40,72 L46,32" stroke="#E3DBAF" stroke-width="1.8" opacity=".38" fill="none"/>
            <path d="M14,32 L20,72 Q21,76 25,76 L35,76 Q39,76 40,72 L46,32" stroke="#E3DBAF" stroke-width=".8" opacity=".12" fill="none" stroke-dasharray="4 5"/>
            <line x1="15" y1="40" x2="45" y2="40" stroke="#E3DBAF" stroke-width="1" opacity=".18"/>
            <line x1="16.5" y1="48" x2="43.5" y2="48" stroke="#E3DBAF" stroke-width="1" opacity=".18"/>
            <line x1="18" y1="56" x2="42" y2="56" stroke="#E3DBAF" stroke-width="1" opacity=".18"/>
            <line x1="19" y1="64" x2="41" y2="64" stroke="#E3DBAF" stroke-width="1" opacity=".18"/>
            <circle cx="23" cy="26" r="5.5" stroke="#CAB988" stroke-width="1.5" opacity=".3"/>
            <circle cx="37" cy="24" r="6" stroke="#CAB988" stroke-width="1.5" opacity=".3"/>
            <circle cx="30" cy="18" r="5.5" stroke="#CAB988" stroke-width="1.5" opacity=".3"/>
            <circle cx="16" cy="22" r="4.5" stroke="#CAB988" stroke-width="1.2" opacity=".22"/>
            <circle cx="44" cy="20" r="4.5" stroke="#CAB988" stroke-width="1.2" opacity=".22"/>
            <circle cx="30" cy="10" r="5" stroke="#CAB988" stroke-width="1.2" opacity=".25"/>
        </svg>
    </div>

    <!-- RIGHT: TV Screen -->
    <div class="deco float-1 anim-fade-in" style="top:58%;right:3%;z-index:2;animation-delay:1.4s">
        <svg width="90" height="70" viewBox="0 0 90 70" fill="none">
            <rect x="4" y="4" width="82" height="48" rx="5" stroke="#E3DBAF" stroke-width="1.8" opacity=".32"/>
            <rect x="4" y="4" width="82" height="48" rx="5" stroke="#E3DBAF" stroke-width=".8" opacity=".12" stroke-dasharray="5 6"/>
            <rect x="10" y="10" width="70" height="36" rx="2" stroke="#CAB988" stroke-width="1.2" opacity=".22"/>
            <polygon points="38,22 38,38 50,30" stroke="#E3DBAF" stroke-width="1.5" opacity=".18" fill="none"/>
            <line x1="32" y1="52" x2="24" y2="62" stroke="#E3DBAF" stroke-width="1.5" opacity=".22"/>
            <line x1="58" y1="52" x2="66" y2="62" stroke="#E3DBAF" stroke-width="1.5" opacity=".22"/>
            <line x1="20" y1="62" x2="70" y2="62" stroke="#E3DBAF" stroke-width="1.5" opacity=".22"/>
        </svg>
    </div>

    <!-- RIGHT: Director Chair -->
    <div class="deco float-7 anim-fade-in" style="top:25%;right:14%;z-index:2;animation-delay:1.1s">
        <svg width="55" height="70" viewBox="0 0 55 70" fill="none">
            <path d="M12,8 L12,28" stroke="#E3DBAF" stroke-width="2" opacity=".35"/>
            <path d="M43,8 L43,28" stroke="#E3DBAF" stroke-width="2" opacity=".35"/>
            <path d="M12,8 L43,8" stroke="#E3DBAF" stroke-width="1.8" opacity=".3"/>
            <text x="20" y="22" font-family="Poppins" font-size="7" font-weight="bold" fill="#E3DBAF" opacity=".18">BPI</text>
            <path d="M12,32 L43,32" stroke="#E3DBAF" stroke-width="1.8" opacity=".28"/>
            <line x1="13" y1="32" x2="5" y2="66" stroke="#E3DBAF" stroke-width="1.8" opacity=".25"/>
            <line x1="42" y1="32" x2="50" y2="66" stroke="#E3DBAF" stroke-width="1.8" opacity=".25"/>
            <line x1="5" y1="48" x2="50" y2="48" stroke="#E3DBAF" stroke-width="1.2" opacity=".12" stroke-dasharray="3 4"/>
        </svg>
    </div>

    <!-- RIGHT: Film Canister -->
    <div class="deco float-4 anim-fade-in" style="bottom:18%;right:10%;z-index:2;animation-delay:1.7s">
        <svg width="55" height="55" viewBox="0 0 55 55" fill="none">
            <circle cx="27.5" cy="27.5" r="24" stroke="#E3DBAF" stroke-width="1.8" opacity=".32"/>
            <circle cx="27.5" cy="27.5" r="24" stroke="#E3DBAF" stroke-width=".8" opacity=".12" stroke-dasharray="4 5"/>
            <circle cx="27.5" cy="27.5" r="10" stroke="#E3DBAF" stroke-width="1.5" opacity=".28"/>
            <circle cx="27.5" cy="27.5" r="4" fill="#E3DBAF" opacity=".15"/>
            <path d="M27.5,3.5 A24,24 0 0,1 51,27.5" stroke="#CAB988" stroke-width="1" opacity=".12"/>
            <path d="M3,27.5 A24,24 0 0,0 27.5,51" stroke="#CAB988" stroke-width="1" opacity=".12"/>
        </svg>
    </div>

    <!-- RIGHT: Mini Reel -->
    <div class="deco float-5 anim-fade-in" style="bottom:35%;right:0;z-index:2;animation-delay:.9s">
        <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
            <circle cx="21" cy="21" r="18" stroke="#E3DBAF" stroke-width="1.5" opacity=".28"/>
            <circle cx="21" cy="21" r="6.5" stroke="#E3DBAF" stroke-width="1.5" opacity=".32"/>
            <circle cx="21" cy="21" r="2.5" fill="#E3DBAF" opacity=".22"/>
            <circle cx="21" cy="7" r="3.5" stroke="#E3DBAF" stroke-width="1" opacity=".22"/>
            <circle cx="21" cy="35" r="3.5" stroke="#E3DBAF" stroke-width="1" opacity=".22"/>
            <circle cx="7" cy="21" r="3.5" stroke="#E3DBAF" stroke-width="1" opacity=".22"/>
            <circle cx="35" cy="21" r="3.5" stroke="#E3DBAF" stroke-width="1" opacity=".22"/>
        </svg>
    </div>

    <!-- RIGHT: Mini Clapperboard -->
    <div class="deco float-2 anim-fade-in" style="top:8%;right:22%;z-index:2;animation-delay:1.5s">
        <svg width="50" height="42" viewBox="0 0 50 42" fill="none">
            <rect x="2" y="14" width="46" height="26" rx="3" stroke="#CAB988" stroke-width="1.5" opacity=".3"/>
            <path d="M2,14 L10,4 L48,4 L40,14" stroke="#CAB988" stroke-width="1.5" fill="none" opacity=".3"/>
            <line x1="2" y1="14" x2="10" y2="4" stroke="#CAB988" stroke-width="1" opacity=".18"/>
            <line x1="12" y1="14" x2="20" y2="4" stroke="#CAB988" stroke-width="1" opacity=".18"/>
            <line x1="22" y1="14" x2="30" y2="4" stroke="#CAB988" stroke-width="1" opacity=".18"/>
            <line x1="32" y1="14" x2="40" y2="4" stroke="#CAB988" stroke-width="1" opacity=".18"/>
            <line x1="42" y1="14" x2="48" y2="4" stroke="#CAB988" stroke-width="1" opacity=".18"/>
        </svg>
    </div>

    <!-- RIGHT: Film strip vertical -->
    <div class="deco float-3 anim-fade-in" style="top:48%;right:-1%;z-index:2;animation-delay:2s">
        <svg width="32" height="160" viewBox="0 0 32 160" fill="none">
            <rect x="2" y="2" width="28" height="156" rx="3" stroke="#E3DBAF" stroke-width="1.2" opacity=".22"/>
            <rect x="5" y="8" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".18"/>
            <rect x="18" y="8" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".18"/>
            <rect x="5" y="22" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".18"/>
            <rect x="18" y="22" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".18"/>
            <rect x="5" y="36" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".18"/>
            <rect x="18" y="36" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".18"/>
            <rect x="5" y="50" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".18"/>
            <rect x="18" y="50" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".18"/>
            <rect x="5" y="64" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="18" y="64" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="5" y="78" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="18" y="78" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".15"/>
            <rect x="5" y="92" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".12"/>
            <rect x="18" y="92" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".12"/>
            <rect x="5" y="106" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".12"/>
            <rect x="18" y="106" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".12"/>
            <rect x="5" y="120" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".1"/>
            <rect x="18" y="120" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".1"/>
            <rect x="5" y="134" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".08"/>
            <rect x="18" y="134" width="9" height="7" rx="1" stroke="#E3DBAF" stroke-width=".8" opacity=".08"/>
        </svg>
    </div>

    <!-- RIGHT: Reel Hub -->
    <div class="deco spin-slow anim-fade-in" style="bottom:42%;right:0;z-index:2;animation-delay:2.2s">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
            <circle cx="20" cy="20" r="17" stroke="#CAB988" stroke-width="1.2" opacity=".18"/>
            <circle cx="20" cy="20" r="6" stroke="#CAB988" stroke-width="1.2" opacity=".25"/>
            <circle cx="20" cy="20" r="2" fill="#CAB988" opacity=".18"/>
            <line x1="20" y1="3" x2="20" y2="14" stroke="#CAB988" stroke-width=".8" opacity=".12"/>
            <line x1="20" y1="26" x2="20" y2="37" stroke="#CAB988" stroke-width=".8" opacity=".12"/>
            <line x1="3" y1="20" x2="14" y2="20" stroke="#CAB988" stroke-width=".8" opacity=".12"/>
            <line x1="26" y1="20" x2="37" y2="20" stroke="#CAB988" stroke-width=".8" opacity=".12"/>
        </svg>
    </div>

    <!-- ===== TOP WAVE ===== -->
    <svg class="absolute top-0 left-0 w-full" viewBox="0 0 1440 320" preserveAspectRatio="none" style="height:15vh;min-height:80px;z-index:1">
        <defs>
            <linearGradient id="wt1" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#E3DBAF;stop-opacity:.1"/>
                <stop offset="50%" style="stop-color:#CAB988;stop-opacity:.15"/>
                <stop offset="100%" style="stop-color:#E3DBAF;stop-opacity:.08"/>
            </linearGradient>
            <linearGradient id="wt2" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#fff;stop-opacity:.05"/>
                <stop offset="100%" style="stop-color:#fff;stop-opacity:.1"/>
            </linearGradient>
        </defs>
        <path fill="url(#wt2)" d="M0,160L48,170.7C96,181,192,203,288,192C384,181,480,139,576,128C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,0L0,0Z"/>
        <path fill="url(#wt1)" d="M0,96L48,112C96,128,192,160,288,165.3C384,171,480,149,576,138.7C672,128,768,128,864,138.7C960,149,1056,171,1152,165.3C1248,160,1344,128,1392,112L1440,96L1440,0L0,0Z"/>
    </svg>

    <!-- ===== BOTTOM WAVE ===== -->
    <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 320" preserveAspectRatio="none" style="height:18vh;min-height:100px;z-index:1">
        <defs>
            <linearGradient id="wb1" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#E3DBAF;stop-opacity:.08"/>
                <stop offset="50%" style="stop-color:#CAB988;stop-opacity:.12"/>
                <stop offset="100%" style="stop-color:#E3DBAF;stop-opacity:.06"/>
            </linearGradient>
            <linearGradient id="wb2" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#fff;stop-opacity:.04"/>
                <stop offset="100%" style="stop-color:#fff;stop-opacity:.09"/>
            </linearGradient>
        </defs>
        <path fill="url(#wb2)" d="M0,256L60,240C120,224,240,192,360,186.7C480,181,600,203,720,218.7C840,235,960,245,1080,229.3C1200,213,1320,171,1380,149.3L1440,128L1440,320L0,320Z"/>
        <path fill="url(#wb1)" d="M0,192L60,197.3C120,203,240,213,360,208C480,203,600,181,720,176C840,171,960,181,1080,192C1200,203,1320,213,1380,218.7L1440,224L1440,320L0,320Z"/>
    </svg>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="relative z-10 w-full max-w-[440px] mx-auto">

        <!-- Logo -->
        <div class="text-center mb-6 sm:mb-8 anim-fade-in-up">
            <div class="relative inline-block mb-4 sm:mb-5">
                <div class="absolute -inset-3 rounded-full border border-[#E3DBAF]/10 hidden sm:block"></div>
                <div class="absolute -inset-5 rounded-full border border-dashed border-[#E3DBAF]/5 hidden sm:block"></div>
                <div class="glass-card-strong rounded-2xl p-3 sm:p-4 shadow-2xl relative">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-[#E3DBAF]/10 to-transparent opacity-50"></div>
                    <img src="{{ asset('images/logo-bpi.png') }}" alt="Logo BPI" class="w-12 h-12 sm:w-16 sm:h-16 md:w-20 md:h-20 object-contain relative z-10">
                </div>
            </div>
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-white tracking-tight">Admin Panel <span class="text-[#E3DBAF]">BPI</span></h1>
            <p class="text-[#E3DBAF]/60 mt-1.5 sm:mt-2 font-light text-xs sm:text-sm md:text-base">Badan Perfilman Indonesia</p>
            <div class="flex items-center justify-center gap-2 mt-3">
                <div class="h-px w-10 bg-gradient-to-r from-transparent to-[#E3DBAF]/30"></div>
                <svg width="28" height="10" viewBox="0 0 28 10" fill="none" class="opacity-40">
                    <rect x="0" y="0" width="6" height="10" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                    <rect x="8" y="0" width="6" height="10" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                    <rect x="16" y="0" width="6" height="10" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                    <rect x="24" y="0" width="4" height="10" rx="1" stroke="#E3DBAF" stroke-width="1.2"/>
                </svg>
                <div class="h-px w-10 bg-gradient-to-l from-transparent to-[#E3DBAF]/30"></div>
            </div>
        </div>

        <!-- Login Card -->
        <div class="card-wrapper anim-fade-in-up anim-delay-1">
            <div class="card-inner p-6 sm:p-8 md:p-9 shadow-[0_8px_60px_-12px_rgba(0,0,0,.5)]">
                <div class="flex items-center gap-3 mb-6 sm:mb-7">
                    <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-gradient-to-br from-[#E3DBAF]/20 to-[#CAB988]/10 flex items-center justify-center border border-[#E3DBAF]/15 shadow-lg shadow-[#E3DBAF]/5">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#E3DBAF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="14" rx="2"/><path d="M2 6L7 2h10l5 4"/><line x1="7" y1="2" x2="10" y2="6"/><line x1="12" y1="2" x2="15" y2="6"/></svg>
                    </div>
                    <div>
                        <h2 class="text-white font-semibold text-base sm:text-lg">Masuk</h2>
                        <p class="text-white/45 text-[0.7rem] sm:text-xs">Silakan masuk ke akun Anda</p>
                    </div>
                </div>

                @if (session('status'))
                    <div class="mb-5 bg-[#E3DBAF]/10 backdrop-blur-sm border border-[#E3DBAF]/20 text-[#E3DBAF] px-4 py-3 rounded-xl flex items-center gap-2.5 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5 sm:space-y-6" id="loginForm">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-white/85 mb-2.5">Alamat Email</label>
                        <div class="input-wrapper relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-white/30 input-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 4L12 13L2 4"/></svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="w-full pl-11 pr-4 py-3.5 input-glass rounded-xl text-white text-sm focus:outline-none" placeholder="contoh@email.com">
                        </div>
                        @error('email')
                            <p class="text-[#EBA9B0] text-xs mt-2 flex items-center gap-1.5 shake"><svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-white/85 mb-2.5">Password</label>
                        <div class="input-wrapper relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-white/30 input-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                            </div>
                            <input type="password" name="password" id="password" required class="w-full pl-11 pr-11 py-3.5 input-glass rounded-xl text-white text-sm focus:outline-none" placeholder="Masukan password">
                            <button type="button" class="toggle-password" onclick="togglePassword()" tabindex="-1" aria-label="Toggle password visibility">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-[#EBA9B0] text-xs mt-2 flex items-center gap-1.5 shake"><svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember" id="remember" class="custom-checkbox">
                            <span class="ml-2.5 text-sm text-white/55 group-hover:text-white/75 transition-colors">Ingat Saya</span>
                        </label>
                    </div>

                    @if ($errors->has('email') || $errors->has('password'))
                        <div class="bg-red-500/10 backdrop-blur-sm border border-red-400/25 text-white px-4 py-3.5 rounded-xl flex items-center gap-3 shake">
                            <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-red-500/15 flex items-center justify-center"><svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div>
                            <p class="text-sm text-white/85">Email atau password salah. Silakan coba lagi.</p>
                        </div>
                    @endif

                    <button type="submit" id="submitBtn" class="w-full btn-submit py-3.5 rounded-xl font-semibold text-[#520A18] text-sm sm:text-base shadow-lg focus:outline-none focus:ring-4 focus:ring-[#E3DBAF]/30">
                        <span class="btn-text flex items-center justify-center gap-2.5"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>Masuk ke Dashboard</span>
                        <span class="btn-spinner"></span>
                    </button>

                    <div class="relative flex items-center justify-center pt-1">
                        <div class="absolute inset-x-0 top-1/2 h-px bg-gradient-to-r from-transparent via-white/12 to-transparent"></div>
                        <div class="relative bg-[#1a0a14]/80 backdrop-blur-sm px-3 py-1 rounded-full border border-white/10">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#E3DBAF" stroke-width="2" stroke-linecap="round" opacity=".4"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                    </div>

                    <div class="text-center pt-1">
                        <div class="flex items-center justify-center gap-1.5 mb-2">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#E3DBAF" stroke-width="1.8" opacity=".35"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            <p class="text-[0.68rem] text-white/30 font-light">&copy; {{ date('Y') }} Badan Perfilman Indonesia</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex items-center justify-center mt-5 sm:mt-6 gap-1.5 opacity-25 anim-fade-in-up anim-delay-2">
            <div class="h-px w-12 bg-gradient-to-r from-transparent to-[#E3DBAF]/40"></div>
            <svg width="18" height="12" viewBox="0 0 18 12" fill="none"><rect x="0" y="0" width="5" height="12" rx="1" stroke="#E3DBAF" stroke-width="1.2"/><rect x="6.5" y="0" width="5" height="12" rx="1" stroke="#E3DBAF" stroke-width="1.2"/><rect x="13" y="0" width="5" height="12" rx="1" stroke="#E3DBAF" stroke-width="1.2"/></svg>
            <div class="h-px w-12 bg-gradient-to-l from-transparent to-[#E3DBAF]/40"></div>
        </div>
    </div>
</div>

<script>
function togglePassword(){
    const p=document.getElementById('password'),e=document.getElementById('eyeIcon'),o=document.getElementById('eyeOffIcon');
    if(p.type==='password'){p.type='text';e.classList.add('hidden');o.classList.remove('hidden')}
    else{p.type='password';e.classList.remove('hidden');o.classList.add('hidden')}
}
document.getElementById('loginForm').addEventListener('submit',function(){
    const b=document.getElementById('submitBtn');
    if(!b.classList.contains('loading')){b.classList.add('loading');b.disabled=true}
});
</script>
</body>
</html>
