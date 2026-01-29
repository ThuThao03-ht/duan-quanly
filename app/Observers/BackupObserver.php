<?php

namespace App\Observers;

use App\Services\BackupService;
use Illuminate\Support\Facades\Log;

class BackupObserver
{
    protected $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    /**
     * Handle events after all transactions are committed.
     * We trigger backup on Created, Updated, Deleted, Restored.
     */
    private function triggerBackup($model, $event)
    {
        try {
            // Check if it's running in console (seeders, etc) to avoid spamming backups during init
            // But user wants "new data" to be backed up.
            // We'll proceed.
            
            $this->backupService->saveRealtimeBackup();
            // Optional: Log::info("Realtime backup triggered by {$event} on " . get_class($model));
        } catch (\Exception $e) {
            Log::error("Realtime backup failed: " . $e->getMessage());
        }
    }

    public function created($model)
    {
        $this->triggerBackup($model, 'created');
    }

    public function updated($model)
    {
        $this->triggerBackup($model, 'updated');
    }

    public function deleted($model)
    {
        $this->triggerBackup($model, 'deleted');
    }
}
