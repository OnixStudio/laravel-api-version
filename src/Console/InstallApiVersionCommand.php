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
        if (!class_exists("Laravel\\Sanctum\\SanctumServiceProvider")) {
            $this->warn("Sanctum n'est pas encore installé, on s'en occupe !");
            exec("composer require laravel/sanctum", $output, $returnCode);
            if ($returnCode !== 0) {
                $this->error("❌ Erreur pendant l'installation de Sanctum.");
                return Command::FAILURE;
            }
        }
    
        $this->callSilent('vendor:publish', [
            '--provider' => "Laravel\\Sanctum\\SanctumServiceProvider",
            '--tag' => 'sanctum-config',
        ]);
    
        $this->callSilent('vendor:publish', [
            '--provider' => "Laravel\\Sanctum\\SanctumServiceProvider",
            '--tag' => 'sanctum-migrations',
        ]);
    
        $this->info("✅ Sanctum est installé et configuré.");
    
        if ($this->option('migrate')) {
            $this->call('migrate');
        }
    
        // créer token pour le 1er user
    }
}
