@extends('layouts.admin')

@section('title', 'Cài đặt hệ thống')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center space-x-4 mb-4">
        <div class="bg-blue-100 p-3 rounded-full">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Cài đặt hệ thống</h1>
            <p class="text-slate-500">Quản lý sao lưu và nhập liệu dữ liệu</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Manual Backup Section -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
            
            <h2 class="text-lg font-bold text-slate-800 mb-2 relative z-10">Sao lưu Thủ công</h2>
            <p class="text-slate-500 text-sm mb-6 relative z-10">Tạo bản sao lưu ngay lập tức. Dùng khi bạn chuẩn bị thay đổi dữ liệu lớn.</p>

            <div class="flex space-x-3 relative z-10">
                <a href="{{ route('admin.settings.backup.create') }}" class="inline-flex items-center space-x-2 px-4 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    <span>Lưu vào Lịch sử</span>
                </a>
                
                <a href="{{ route('admin.settings.backup') }}" class="inline-flex items-center space-x-2 px-4 py-3 bg-white text-blue-600 font-bold rounded-xl border border-blue-200 hover:bg-blue-50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Tải về máy</span>
                </a>
            </div>
        </div>

        <!-- Realtime Backup Section -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
            
            <div class="relative z-10">
                <h2 class="text-lg font-bold text-slate-800 mb-2 flex items-center">
                    Auto-Backup Realtime
                    <span class="ml-2 flex h-3 w-3 relative">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                </h2>
                <p class="text-slate-500 text-sm mb-2">Hệ thống tự động sao lưu mỗi khi có thay đổi dữ liệu (create, update, delete).</p>
                
                @if(isset($lastBackup))
                    <div class="mb-4 text-xs font-semibold text-slate-400 bg-slate-50 inline-block px-2 py-1 rounded border">
                        <i class="far fa-clock mr-1"></i> Cập nhật lần cuối: <span class="text-slate-700">{{ $lastBackup }}</span>
                    </div>
                @else
                    <div class="mb-4 text-xs font-semibold text-slate-400 bg-slate-50 inline-block px-2 py-1 rounded border">
                        Chưa có bản backup nào
                    </div>
                @endif

                <div>
                    <a href="{{ route('admin.settings.backup.realtime') }}" class="inline-flex items-center space-x-2 px-6 py-3 bg-white text-blue-700 font-bold rounded-xl border-2 border-blue-100 hover:bg-blue-50 hover:border-blue-300 transition-all shadow-lg shadow-blue-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Tải file Realtime (.sql)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Section -->
    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>

        <h2 class="text-lg font-bold text-slate-800 mb-2 relative z-10">Nhập dữ liệu từ Excel</h2>
        <p class="text-slate-500 text-sm mb-6 relative z-10 max-w-md">Nhập hàng loạt Yêu cầu mua sắm từ file Excel vào hệ thống. Hệ thống sẽ tự động tạo Khoa/Phòng và Tài khoản nếu chưa tồn tại.</p>

        <form action="{{ route('admin.settings.import') }}" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-4">
            @csrf
            
            <div class="flex items-center justify-center w-full">
                <label for="excel-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="text-sm text-slate-500"><span class="font-semibold">Click để chọn file</span> hoặc kéo thả vào đây</p>
                        <p class="text-xs text-slate-400 mt-1">XLSX, XLS (Theo mẫu quy định)</p>
                    </div>
                    <input id="excel-file" name="file" type="file" class="hidden" accept=".xlsx, .xls" required />
                </label>
            </div>
            
            <div id="file-name" class="text-sm text-green-600 font-medium hidden text-center"></div>

            <button type="submit" class="w-full inline-flex justify-center items-center space-x-2 px-6 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-lg shadow-green-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <span>Upload & Nhập dữ liệu</span>
            </button>
        </form>
    </div>
</div>

<!-- Backup History Section -->
<div class="mt-8 bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
    <h2 class="text-xl font-bold text-slate-800 mb-4">Lịch sử Backup Tự động</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="p-3 border-b text-slate-500 font-semibold text-sm">Tên file</th>
                    <th class="p-3 border-b text-slate-500 font-semibold text-sm">Thời gian tạo</th>
                    <th class="p-3 border-b text-slate-500 font-semibold text-sm">Dung lượng</th>
                    <th class="p-3 border-b text-slate-500 font-semibold text-sm text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($history as $file)
                <tr class="hover:bg-slate-50">
                    <td class="p-3 border-b text-slate-700 font-medium font-mono text-sm">{{ $file['filename'] }}</td>
                    <td class="p-3 border-b text-slate-600 text-sm">{{ $file['time'] }}</td>
                    <td class="p-3 border-b text-slate-600 text-sm">{{ $file['size'] }}</td>
                    <td class="p-3 border-b text-right">
                        <a href="{{ route('admin.settings.backup.download', $file['filename']) }}" class="text-blue-600 hover:text-blue-800 font-bold text-sm">
                            <i class="fas fa-download mr-1"></i> Tải về
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-slate-400 italic">Chưa có bản backup lịch sử nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('excel-file').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        const nameDisplay = document.getElementById('file-name');
        if (fileName) {
            nameDisplay.textContent = 'Đã chọn: ' + fileName;
            nameDisplay.classList.remove('hidden');
        } else {
            nameDisplay.classList.add('hidden');
        }
    });

    @if(session('error'))
        alert("Lỗi: {{ session('error') }}");
    @endif
</script>
@endsection
