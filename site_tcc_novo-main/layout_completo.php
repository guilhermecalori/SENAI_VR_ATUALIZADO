<!DOCTYPE html>

<html class="dark" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&amp;family=Manrope:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-error": "#490006",
                    "on-secondary-fixed-variant": "#325377",
                    "primary-container": "#00e3fd",
                    "outline-variant": "#44484f",
                    "primary-fixed-dim": "#00d4ec",
                    "on-primary-fixed": "#003840",
                    "tertiary": "#a68cff",
                    "on-tertiary-fixed": "#1c0055",
                    "surface-variant": "#20262f",
                    "on-primary": "#005762",
                    "on-tertiary-container": "#ffffff",
                    "surface-container": "#151a21",
                    "on-error-container": "#ffa8a3",
                    "inverse-on-surface": "#51555d",
                    "primary-dim": "#00d4ec",
                    "secondary-dim": "#a6c6f0",
                    "on-surface-variant": "#a8abb3",
                    "on-secondary-container": "#b2d3fd",
                    "error-dim": "#d7383b",
                    "tertiary-container": "#7c4dff",
                    "tertiary-fixed-dim": "#ab93ff",
                    "surface-container-low": "#0f141a",
                    "background": "#0a0e14",
                    "on-primary-fixed-variant": "#005762",
                    "on-tertiary-fixed-variant": "#4000ad",
                    "error": "#ff716c",
                    "surface-tint": "#81ecff",
                    "surface-container-high": "#1b2028",
                    "on-secondary": "#28496d",
                    "on-primary-container": "#004d57",
                    "tertiary-dim": "#7e51ff",
                    "inverse-primary": "#006976",
                    "tertiary-fixed": "#b8a3ff",
                    "surface-bright": "#262c36",
                    "on-background": "#f1f3fc",
                    "secondary-fixed-dim": "#a6c6f0",
                    "surface-container-highest": "#20262f",
                    "secondary-fixed": "#b3d4ff",
                    "outline": "#72757d",
                    "inverse-surface": "#f8f9ff",
                    "secondary-container": "#27496c",
                    "error-container": "#9f0519",
                    "on-secondary-fixed": "#103658",
                    "primary": "#81ecff",
                    "surface": "#0a0e14",
                    "on-tertiary": "#25006b",
                    "on-surface": "#f1f3fc",
                    "secondary": "#b3d4ff",
                    "primary-fixed": "#00e3fd",
                    "surface-container-lowest": "#000000",
                    "surface-dim": "#0a0e14"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "fontFamily": {
                    "headline": ["Space Grotesk"],
                    "body": ["Manrope"],
                    "label": ["Manrope"]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-panel {
            background: rgba(32, 38, 47, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body min-h-screen overflow-hidden">
<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-slate-950/40 backdrop-blur-xl flex justify-between items-center px-8 h-20 w-full shadow-[0_8px_32px_0_rgba(129,236,255,0.1)]">
<div class="flex items-center gap-8">
<span class="text-2xl font-bold tracking-tighter text-cyan-400 font-['Space_Grotesk']">Ethereal Lab</span>
<nav class="hidden md:flex items-center gap-6 font-['Space_Grotesk'] tracking-tight">
<a class="text-slate-400 hover:text-slate-200 transition-colors cursor-pointer active:scale-95" href="#">Dashboard</a>
<a class="text-slate-400 hover:text-slate-200 transition-colors cursor-pointer active:scale-95" href="#">Modules</a>
<a class="text-slate-400 hover:text-slate-200 transition-colors cursor-pointer active:scale-95" href="#">Community</a>
</nav>
</div>
<div class="flex items-center gap-6">
<div class="flex items-center gap-4">
<button class="material-symbols-outlined text-slate-400 hover:bg-white/10 transition-colors p-2 rounded-full cursor-pointer active:scale-95">notifications</button>
<button class="material-symbols-outlined text-slate-400 hover:bg-white/10 transition-colors p-2 rounded-full cursor-pointer active:scale-95">settings</button>
</div>
<img alt="User profile avatar" class="w-10 h-10 rounded-full border border-primary/20" data-alt="Professional portrait of a user in a sleek minimalist setting with soft cyan ambient light accenting their features" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2Vm0mGWOs5RjccbcVd_bBgnlQqkcc_5Oa5laescUJo8owlYME6P51UA8LPe4Blk5Mc4Qn293ljwAskRAHG8uqROq_WsemYVwWE2QmpF9rCh0enyGCcMaH8q-doOnfCCxKutCpkf9BvNppuTPzfqLF0vEouha9KD4FD5w3_SD2pRbijN9CSF5gfA1VLplWGnJ4BDtAewhh4MS3I_VSo78kzyK7KVuo-Jl-w4at5Q8I_uf4iOsy4s6ameFFqTtpB9CopKpWyITWdDGj"/>
</div>
</header>
<!-- SideNavBar (Suppressed for focused chat journey, but following shell logic if considered top-level) -->
<aside class="fixed left-0 top-20 h-[calc(100vh-5rem)] w-72 rounded-r-2xl bg-slate-900/60 backdrop-blur-2xl border-r border-white/10 shadow-2xl shadow-cyan-900/20 flex flex-col py-6 z-40">
<div class="px-6 mb-8">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-xl bg-primary/20 flex items-center justify-center">
<span class="material-symbols-outlined text-primary">auto_awesome</span>
</div>
<div>
<h2 class="text-cyan-400 font-bold font-['Manrope']">Spatial Core</h2>
<p class="text-xs text-slate-500">Educational OS</p>
</div>
</div>
</div>
<nav class="flex-1 font-['Manrope'] font-medium">
<a class="text-slate-400 hover:bg-white/5 px-6 py-4 flex items-center gap-4 transition-all duration-300 hover:text-cyan-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined">book_5</span>
<span>User Guide</span>
</a>
<a class="bg-cyan-500/20 text-cyan-400 border-r-4 border-cyan-400 px-6 py-4 flex items-center gap-4 transition-all duration-300 hover:translate-x-1" href="#">
<span class="material-symbols-outlined">smart_toy</span>
<span>AI Support</span>
</a>
<a class="text-slate-400 hover:bg-white/5 px-6 py-4 flex items-center gap-4 transition-all duration-300 hover:text-cyan-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined">lock_open</span>
<span>Professor Kiosk</span>
</a>
<a class="text-slate-400 hover:bg-white/5 px-6 py-4 flex items-center gap-4 transition-all duration-300 hover:text-cyan-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined">auto_stories</span>
<span>Library</span>
</a>
</nav>
<div class="mt-auto px-6 space-y-4">
<button class="w-full py-3 bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 active:scale-95 transition-transform">
                Launch VR
            </button>
<div class="pt-4 border-t border-white/5">
<a class="text-slate-400 hover:bg-white/5 px-2 py-2 flex items-center gap-4 rounded-lg transition-colors" href="#">
<span class="material-symbols-outlined">help</span>
<span class="text-sm">Help</span>
</a>
<a class="text-slate-400 hover:bg-white/5 px-2 py-2 flex items-center gap-4 rounded-lg transition-colors" href="#">
<span class="material-symbols-outlined">logout</span>
<span class="text-sm">Logout</span>
</a>
</div>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="ml-72 pt-20 h-screen flex flex-col relative">
<!-- Background Decoration -->
<div class="absolute inset-0 -z-10 overflow-hidden">
<div class="absolute top-1/4 right-1/4 w-96 h-96 bg-primary/10 rounded-full blur-[120px]"></div>
<div class="absolute bottom-1/4 left-1/4 w-64 h-64 bg-tertiary/10 rounded-full blur-[100px]"></div>
</div>
<!-- Chat Header -->
<div class="px-12 py-8 flex justify-between items-end border-b border-white/5">
<div>
<span class="text-primary font-label text-sm tracking-widest uppercase font-bold mb-2 block">Interactive Session</span>
<h1 class="text-4xl font-headline font-bold tracking-tight">AI Spatial Assistant</h1>
</div>
<div class="flex gap-3">
<span class="px-4 py-2 rounded-full bg-secondary-container text-on-secondary-container text-xs font-bold flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-green-400"></span>
                    NEURAL LINK ACTIVE
                </span>
<span class="px-4 py-2 rounded-full bg-surface-container-highest/50 text-on-surface-variant text-xs font-bold">
                    Meta Quest 3 Expert
                </span>
</div>
</div>
<!-- Message History -->
<div class="flex-1 overflow-y-auto px-12 py-8 space-y-8 scrollbar-hide">
<!-- AI Message -->
<div class="flex items-start gap-4 max-w-3xl">
<div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center shrink-0 border border-primary/30">
<span class="material-symbols-outlined text-primary text-xl">smart_toy</span>
</div>
<div class="glass-panel p-6 rounded-2xl rounded-tl-none border border-white/5 shadow-xl">
<p class="text-on-surface leading-relaxed">
                        Greetings, Researcher. I am your Ethereal Assistant. I can help you calibrate your Meta Quest, explore spatial modules, or troubleshoot your neural interface. What shall we investigate today?
                    </p>
<div class="mt-4 flex flex-wrap gap-2">
<button class="px-4 py-2 rounded-lg bg-surface-bright/50 border border-outline-variant/20 text-xs text-primary hover:bg-primary/10 transition-colors">How do I setup Pass-through?</button>
<button class="px-4 py-2 rounded-lg bg-surface-bright/50 border border-outline-variant/20 text-xs text-primary hover:bg-primary/10 transition-colors">Spatial anchor guides</button>
</div>
</div>
</div>
<!-- User Message -->
<div class="flex items-start gap-4 max-w-3xl ml-auto flex-row-reverse">
<img alt="User profile avatar" class="w-10 h-10 rounded-full border border-primary/20 shrink-0" data-alt="User avatar small thumbnail" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWuUYKQIGBc-xxwbaxiui5C6TtMUdsLQHMq6H-D2YFFQH3L26_ANi4f5KN7cYHoXYY3XiT3PoYX6VFmlkC92EY5Q1gDq8Sihdj3TDbXNy16kprnTSgPPLtMs9Tktp2je19z8WXstxTxytJEyTZLsrEBQ_lnDaXYt-iaZngyJYCAB2DCgrfNsX4hEgKWFUOyo50DwovOowufZ3ExvOs5qA2HCc6TTmIlAwu4zuPujac8MxSeIE-3SXSgh2MijysUuUK_ZsJgxXNzciz"/>
<div class="bg-primary/10 p-6 rounded-2xl rounded-tr-none border border-primary/20 shadow-lg">
<p class="text-on-surface leading-relaxed">
                        I'm having some flickering issues with the hand tracking when using the VR Professor module. Any recommendations?
                    </p>
</div>
</div>
<!-- AI Message with Image Attachment -->
<div class="flex items-start gap-4 max-w-3xl">
<div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center shrink-0 border border-primary/30">
<span class="material-symbols-outlined text-primary text-xl">smart_toy</span>
</div>
<div class="glass-panel p-6 rounded-2xl rounded-tl-none border border-white/5 shadow-xl">
<p class="text-on-surface leading-relaxed mb-4">
                        Hand tracking interference often occurs due to low-light conditions or infrared reflections. Ensure your environment matches these optimal parameters:
                    </p>
<div class="relative w-full h-48 rounded-xl overflow-hidden mb-4 border border-white/10 group">
<img alt="Meta Quest optimal tracking environment" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Futuristic clean room with soft diffused lighting and a person wearing a VR headset with glowing blue sensors" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDO13T9vc_b_p2NJ2JOEAHHT4BEzn1757pbzMlto1FXkFuBMEsy6ko4QTxzQGHQpjth-909lLDtehjsbtl_ohigbnZfylZ24qtkJkW0Z92-_k6_te1XxHK4Cj3ktn_Uhz6JHw18vXUUiUXlebWSEUW8LDM2fPz8wlOVrJGMeV4k8l65mfRpiXvF6oiRo8bMnYOw488u_1MDZ-y1hqJifOvukDfc95KnEPBnItrinl1DFnVebDd4zD55-_BjaozdHw7J_cPCCNiBIn7O"/>
<div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
<div class="absolute bottom-3 left-3 flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-sm">lightbulb</span>
<span class="text-xs font-bold text-white uppercase tracking-tighter">Recommended Setup</span>
</div>
</div>
<ul class="space-y-2 text-on-surface-variant text-sm">
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            Consistent diffused lighting (avoid direct sunlight)
                        </li>
<li class="flex items-center gap-2">
<span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            Clear 1.5m radius from reflective surfaces
                        </li>
</ul>
</div>
</div>
<!-- User Message -->
<div class="flex items-start gap-4 max-w-3xl ml-auto flex-row-reverse">
<img alt="User avatar" class="w-10 h-10 rounded-full border border-primary/20 shrink-0" data-alt="User avatar small thumbnail" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDK6tfTMij9fydnRQPTh_9v1GOk8K3ahQBvSZV9K9-ASDGkkwW4LVzdiIOXpSFljHIOL78PaPdsBJGm1OJCvqugK4B8WcYdEOld-zMoZ-7YZJYu9_tUknnu2CX1q1ND8qhy1EiOSQDEcpo-VQEs5QdTvEWpPRbvkDc5MQK2K7X5S6fQmKhR7YYLAvN6B23UEYk-sTj3_vKls3_sSWvf_v5rZNyH3hllnWMogptc3wYSQSWuuuNFiSb7ptZi8DsFub1LZEdRHTJFlyyC"/>
<div class="bg-primary/10 p-6 rounded-2xl rounded-tr-none border border-primary/20 shadow-lg">
<p class="text-on-surface leading-relaxed">
                        That makes sense. I'll adjust my studio lighting. Can you also tell me how to force a firmware update?
                    </p>
</div>
</div>
</div>
<!-- Input Area -->
<div class="px-12 pb-10 pt-4 bg-gradient-to-t from-background via-background to-transparent">
<div class="max-w-4xl mx-auto relative group">
<div class="absolute inset-0 bg-primary/5 rounded-2xl blur-xl transition-opacity opacity-0 group-focus-within:opacity-100"></div>
<div class="relative flex items-center gap-4 bg-surface-container-highest/50 backdrop-blur-md border border-white/10 rounded-2xl p-2 pl-6 focus-within:border-primary/50 transition-all">
<span class="material-symbols-outlined text-slate-500">attachment</span>
<input class="flex-1 bg-transparent border-none focus:ring-0 text-on-surface placeholder:text-slate-500 py-4 font-body" placeholder="Inquire about spatial modules, updates, or hardware..." type="text"/>
<div class="flex items-center gap-2 pr-2">
<button class="w-12 h-12 flex items-center justify-center rounded-xl bg-surface-bright hover:bg-primary/10 text-slate-400 hover:text-primary transition-all">
<span class="material-symbols-outlined">mic</span>
</button>
<button class="w-12 h-12 flex items-center justify-center rounded-xl bg-gradient-to-br from-primary to-primary-container text-on-primary shadow-lg shadow-primary/20 active:scale-95 transition-transform">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">send</span>
</button>
</div>
</div>
<div class="flex justify-between mt-3 px-2">
<p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">End-to-End Encrypted Neural Link</p>
<p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Spatial Engine v4.2.0</p>
</div>
</div>
</div>
</main>
<!-- Contextual Info Panel (Asymmetric floating module) -->
<div class="fixed right-8 top-32 w-64 space-y-6 hidden lg:block z-30">
<div class="glass-panel p-5 rounded-2xl border border-white/5 shadow-2xl">
<h3 class="text-primary font-bold text-xs uppercase tracking-widest mb-4">Device Status</h3>
<div class="space-y-4">
<div class="flex justify-between items-center">
<span class="text-sm text-slate-400">Battery</span>
<span class="text-sm font-bold text-on-surface">84%</span>
</div>
<div class="w-full bg-white/5 h-1 rounded-full overflow-hidden">
<div class="bg-primary h-full w-[84%]"></div>
</div>
<div class="flex justify-between items-center">
<span class="text-sm text-slate-400">Memory</span>
<span class="text-sm font-bold text-on-surface">12.4 GB / 128 GB</span>
</div>
<div class="w-full bg-white/5 h-1 rounded-full overflow-hidden">
<div class="bg-tertiary h-full w-[15%]"></div>
</div>
</div>
</div>
<div class="glass-panel p-5 rounded-2xl border border-white/5 shadow-2xl relative overflow-hidden group cursor-pointer">
<div class="absolute -right-8 -top-8 w-24 h-24 bg-primary/10 rounded-full blur-2xl group-hover:bg-primary/20 transition-colors"></div>
<h3 class="text-primary font-bold text-xs uppercase tracking-widest mb-2">Active Module</h3>
<p class="text-lg font-headline font-bold mb-1">Spatial History 101</p>
<p class="text-xs text-slate-500 mb-4">Professor A. Kiosk</p>
<button class="text-xs text-primary font-bold flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                View Progress <span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</div>
</div>
</body></html>