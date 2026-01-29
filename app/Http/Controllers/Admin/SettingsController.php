<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PurchaseRequestsImport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SettingsController extends Controller
{
    public function index()
    {
        $lastBackup = null;
        if (\Illuminate\Support\Facades\Storage::exists('realtime_backup.sql')) {
            $timestamp = \Illuminate\Support\Facades\Storage::lastModified('realtime_backup.sql');
            $lastBackup = \Carbon\Carbon::createFromTimestamp($timestamp)->timezone('Asia/Ho_Chi_Minh')->format('H:i d/m/Y');
        }

        $backupService = new \App\Services\BackupService();
        $history = $backupService->getHistory();

        return view('admin.settings', compact('lastBackup', 'history'));
    }

    public function downloadRealtimeBackup()
    {
        if (!\Illuminate\Support\Facades\Storage::exists('realtime_backup.sql')) {
            return redirect()->back()->with('error', 'Chưa có bản backup nào.');
        }
        return \Illuminate\Support\Facades\Storage::download('realtime_backup.sql', 'realtime_data_latest.sql');
    }

    public function downloadBackup($filename)
    {
        if (!\Illuminate\Support\Facades\Storage::exists('backups/' . $filename)) {
            return redirect()->back()->with('error', 'File không tồn tại.');
        }
        return \Illuminate\Support\Facades\Storage::download('backups/' . $filename);
    }

    public function backup()
    {
        $backupService = new \App\Services\BackupService();
        $content = $backupService->generateBackupContent();

        $fileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $fileName, [
            'Content-Type' => 'application/octet-stream',
        ]);
    }

    public function createSnapshot()
    {
        try {
            $backupService = new \App\Services\BackupService();
            $path = $backupService->saveBackupToStorage(); // Saves to storage/app/backups/
            return redirect()->back()->with('success', 'Đã tạo điểm khôi phục thành công: ' . basename($path));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi tạo backup: ' . $e->getMessage());
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new PurchaseRequestsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Nhập dữ liệu thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi nhập liệu: ' . $e->getMessage());
        }
    }
}
