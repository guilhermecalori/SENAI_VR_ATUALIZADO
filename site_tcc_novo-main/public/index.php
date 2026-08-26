<!DOCTYPE html>
<html class="dark" lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login | Ethereal Lab</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              colors: {
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
              borderRadius: {
                  "DEFAULT": "0.25rem",
                  lg: "0.5rem",
                  xl: "0.75rem",
                  full: "9999px"
              },
              fontFamily: {
                  headline: ["Space Grotesk"],
                  body: ["Manrope"],
                  label: ["Manrope"]
              }
            },
          },
        }
    </script>
    <style>
        .glass-panel {
            background: rgba(32, 38, 47, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .bg-spatial-grid {
            background-image: 
                linear-gradient(rgba(129, 236, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(129, 236, 255, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body min-h-screen flex items-center justify-center overflow-hidden">
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-spatial-grid"></div>
        <img class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-screen" alt="Abstract ethereal 3D landscape" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJvj7YCtocK7XlJRy174IFew6tE_zO0e5p2tDBgeAg1X0wIOyBbi2nftel_0iQeomIrepBTsSrYMM-MiaQ7Jq0QWgV0e6gxRmFL781In3vZfbaDGjVg7pDC9VvzDygDRDe4D4tzsRBHzT9Cuv7CcZVKyHsgiFntmokO3id7Hu9dMAVc0Iy94i5LlBeUQqnYhj196F56T-kywhyDt5Zpm71OQwRKpcBVGOu34jgIaNauYvUvSgnfR-MLkh-qgL1EjxiwS8gjJYGWFTR"/>
        <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-background/50"></div>
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-primary/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-tertiary/10 rounded-full blur-[120px]"></div>
    </div>

    <main class="relative z-10 w-full max-w-[1200px] px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div class="hidden lg:block space-y-8">
            <div>
                <span class="inline-block px-4 py-1 rounded-full bg-secondary-container/30 border border-outline-variant/20 text-primary font-label text-sm tracking-widest mb-6">SISTEMA EDUCACIONAL ESPACIAL</span>
                <h1 class="font-headline text-7xl font-bold tracking-tighter text-on-surface leading-[1.1]">
                    Entre na nossa<br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-container">EDUCAÇÃO IMERSIVA!</span>
                </h1>
                <p class="mt-6 text-xl text-on-surface-variant font-light max-w-md leading-relaxed">
                    Acesse seu ambiente de aprendizado imersivo e continue sua jornada através da web espacial.
                </p>
            </div>
            </div>

        <div class="flex justify-center lg:justify-end">
            <div class="glass-panel w-full max-w-[440px] p-10 rounded-[2.5rem] shadow-2xl shadow-primary/5 border border-white/5 relative overflow-hidden group">
                <div class="mb-10 text-center lg:text-left">
                    <div class="flex items-center gap-3 mb-2 lg:justify-start justify-center">
                        <span class="material-symbols-outlined text-primary text-3xl">token</span>
                        <span class="font-headline font-bold text-2xl tracking-tighter text-on-surface">SENAI VR</span>
                    </div>
                    <p class="text-on-surface-variant text-sm">Sincronizando interface neural...</p>
                </div>

                <form action="login.php" method="POST">
                    <div class="space-y-2 mb-6">
                        <label class="block text-xs font-label font-bold text-primary uppercase tracking-[0.2em] ml-1">Nome de usuário ou E-mail</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-outline">
                                <span class="material-symbols-outlined text-[20px]">alternate_email</span>
                            </div>
                            <input name="email" required class="w-full bg-surface-container-highest/30 border border-outline-variant/20 rounded-xl py-4 pl-12 pr-4 text-on-surface placeholder:text-outline/60 focus:outline-none focus:border-primary/50 focus:ring-1 focus:ring-primary/50 transition-all duration-300" placeholder="Digite seu usuário ou e-mail" type="text"/>
                        </div>
                    </div>

                    <div class="space-y-2 mb-6">
                        <div class="flex justify-between items-end px-1">
                            <label class="block text-xs font-label font-bold text-primary uppercase tracking-[0.2em]">Chave de acesso</label>
                            </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-outline">
                                <span class="material-symbols-outlined text-[20px]">lock</span>
                            </div>
                            <input name="senha" id="access_key" required class="w-full bg-surface-container-highest/30 border border-outline-variant/20 rounded-xl py-4 pl-12 pr-12 text-on-surface placeholder:text-outline/60 focus:outline-none focus:border-primary/50 focus:ring-1 focus:ring-primary/50 transition-all duration-300" placeholder="••••••••" type="password"/>
                            <button onclick="togglePassword()" class="absolute inset-y-0 right-4 flex items-center text-outline hover:text-primary transition-colors" type="button">
                                <span id="toggleIcon" class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                    </div>

                    <button class="w-full mt-4 bg-gradient-to-br from-primary to-primary-container text-on-primary font-headline font-bold py-4 rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2" type="submit">
                        Entrar
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </form>
                
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-primary/50 to-transparent"></div>
            </div>
        </div>
    </main>

    <footer class="fixed bottom-8 left-0 right-0 z-20 flex justify-center px-6 pointer-events-none">
        <div class="flex items-center gap-8 bg-surface-container-low/80 backdrop-blur-md px-8 py-3 rounded-full border border-white/5 pointer-events-auto shadow-2xl">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                <span class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-widest">Mainframe Link: Seguro</span>
            </div>
            <div class="w-px h-4 bg-outline-variant/30"></div>
            <div class="flex items-center gap-4 text-on-surface-variant">
                <span class="material-symbols-outlined text-sm">language</span>
                <span class="text-[10px] font-label font-bold uppercase tracking-widest">PT-BR</span>
            </div>
            <div class="w-px h-4 bg-outline-variant/30"></div>
            <div class="flex items-center gap-4 text-on-surface-variant">
                <span class="material-symbols-outlined text-sm">terminal</span>
                <span class="text-[10px] font-label font-bold uppercase tracking-widest">v2.4.0-ESTÁVEL</span>
            </div>
        </div>
    </footer>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('access_key');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.innerText = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                toggleIcon.innerText = 'visibility';
            }
        }
    </script>
</body>
</html>