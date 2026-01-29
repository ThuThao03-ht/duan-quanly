<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BackupService;

class AutoBackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically backup database to storage/app/backups without external tools';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database backup...');
        
        try {
            $service = new BackupService();
            $path = $service->saveBackupToStorage();
            
            $this->info('Backup successful! File saved at: ' . $path);
            
            // Optional: Delete old backups > 7 days
            // $this->cleanOldBackups();
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Backup failed: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
