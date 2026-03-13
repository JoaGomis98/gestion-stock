<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | StockMaster Sococim</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        // Configuration de la palette Sococim pour Tailwind
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                sococim: {
                  green: '#2E7D32',
                  'green-hover': '#1b5e20',
                  yellow: '#FFEB3B', // Jaune vif pour les accents
                  'pale-green': '#e8f5e9',
                }
              },
              fontFamily: {
                sans: ['Inter', 'sans-serif'],
              },
            }
          }
        }
    </script>

    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e8f5e9 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(46, 125, 50, 0.15);
        }
        .input-focus-effect:focus {
            border-color: #2E7D32;
            box-shadow: 0 0 0 4px rgba(46, 125, 50, 0.1);
            outline: none;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center p-4">

    <div class="w-full max-w-md">
        <div class="text-center mb-10 mt-6 flex flex-col items-center">
            <img src="<?= base_url() ?>assets/images/logoSococim.jpeg" alt="Logo Sococim Industrie" class="h-24 md:h-28 w-auto mb-6">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">STOCK<span class="text-sococim-green">MASTER</span></h1>
            <p class="text-gray-500 mt-2 font-medium">Sococim Industrie</p>
        </div>

        <div class="glass-card rounded-3xl p-8 md:p-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Bienvenue</h2>
            <p class="text-sm text-gray-500 mb-8">Identifiez-vous pour gérer les stocks en temps réel.</p>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <i class="fa fa-exclamation-circle mr-2"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email professionnel</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" name="email" required 
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 transition-all input-focus-effect"
                            placeholder="nom@sococim.sn">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-semibold text-gray-700">Mot de passe</label>
                        <a href="#" class="text-xs font-medium text-sococim-green hover:underline">Oublié ?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password" name="password" required 
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 transition-all input-focus-effect"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" class="h-4 w-4 text-sococim-green border-gray-300 rounded focus:ring-sococim-green">
                        <label for="remember" class="ml-2 block text-sm text-gray-600">Se souvenir de moi</label>
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-sococim-green hover:bg-sococim-green-hover text-white font-bold py-4 rounded-xl shadow-lg shadow-green-900/20 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2 group">
                    <span>Se connecter</span>
                    <i class="fa fa-arrow-right text-sm opacity-70 transition-transform group-hover:translate-x-1"></i>
                </button>
            </form>
        </div>

        <footer class="mt-10 mb-6 text-center">
            <p class="text-gray-400 text-xs tracking-widest uppercase">
                &copy; 2026 Sococim Industrie • Service Informatique
            </p>
        </footer>
    </div>

</body>
</html>