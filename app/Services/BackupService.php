<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BackupService
{
    public function generateBackupContent()
    {
        $tables = ['users', 'departments', 'purchase_requests', 'pr_timelines', 'notes']; 
        
        $content = "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            // Drop if exists
            $content .= "DROP TABLE IF EXISTS `$table`;\n";

            // Create Check
            $createTable = DB::select("SHOW CREATE TABLE `$table`")[0]->{'Create Table'};
            $content .= $createTable . ";\n\n";

            // Insert Data
            $rows = DB::table($table)->get();
            foreach ($rows as $row) {
                $values = array_map(function ($value) {
                    return $value === null ? "NULL" : "'" . addslashes($value) . "'";
                }, (array)$row);
                $content .= "INSERT INTO `$table` VALUES (" . implode(", ", $values) . ");\n";
            }
            $content .= "\n";
        }

        $content .= "\nSET FOREIGN_KEY_CHECKS=1;\n";
        
        return $content;
    }

    public function saveBackupToStorage()
    {
        $content = $this->generateBackupContent();
        $fileName = 'backups/auto_backup_' . date('Y-m-d_H-i-s') . '.sql';
        
        // Ensure directory exists
        if (!Storage::exists('backups')) {
            Storage::makeDirectory('backups');
        }
        
        Storage::put($fileName, $content);
        
        return $fileName;
    }

    public function saveRealtimeBackup()
    {
        // This overwrites the single 'latest' file for real-time protection
        $content = $this->generateBackupContent();
        $fileName = 'realtime_backup.sql'; // Fixed filename
        
        Storage::put($fileName, $content);
        
        return $fileName;
    }

    public function getHistory()
    {
        $files = Storage::files('backups');
        $backups = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $backups[] = [
                    'filename' => basename($file),
                    'path' => $file,
                    'size' => round(Storage::size($file) / 1024, 2) . ' KB',
                    'time' => \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->timezone('Asia/Ho_Chi_Minh')->format('H:i d/m/Y'),
                    'timestamp' => Storage::lastModified($file)
                ];
            }
        }

        // Sort by newest first
        usort($backups, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        return $backups;
    }
}
