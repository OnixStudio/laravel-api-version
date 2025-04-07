<?php

namespace Onixstudio\ApiVersion\Console;

use Illuminate\Console\Command;
use App\Models\User;

class InstallApiVersionCommand extends Command
{
    protected $signature = 'api-version:install {--migrate}';
    protected $description = 'Installe Sanctum, configure Laravel API Version, et génère un token utilisateur';

    public function handle()
    {
        if (!class_exists('Laravel\\Sanctum\\SanctumServiceProvider')) {
            $this->error('❌ Sanctum n'est pas installé. Veuillez d'abord exécuter : composer require laravel/sanctum');
            return Command::FAILURE;
        }

        $this->callSilent('vendor:publish', [
            '--provider' => 'Laravel\\Sanctum\\SanctumServiceProvider',
            '--tag' => 'sanctum-config'
        ]);

        $this->info('✅ Fichier de config Sanctum publié.');

        if ($this->option('migrate')) {
            $this->call('migrate');
        } else {
            $this->warn('⚠️ N'oubliez pas de lancer: php artisan migrate');
        }

        $user = User::first();
        if (!$user) {
            $this->warn('⚠️ Aucun utilisateur trouvé. Créez-en un via php artisan tinker ou seed.');
            return Command::SUCCESS;
        }

        $token = $user->createToken('api-version-token')->plainTextToken;
        $this->info('🔐 Token généré pour l'utilisateur #' . $user->id . ': ' . $token);

        return Command::SUCCESS;
    }
}
