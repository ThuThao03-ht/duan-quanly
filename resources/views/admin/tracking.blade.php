@extends('layouts.admin')

@section('title', 'Theo dõi Mua hàng')

@section('container_class', 'p-6')

@section('styles')
    <style>
        .table-container { 
            overflow: auto; 
            max-height: 85vh; 
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }
        table { 
            border-collapse: separate; 
            border-spacing: 0;
            width: 100%; 
            background: white;
        }
        
        /* Sticky Header (Vertical) */
        thead th { 
            position: sticky; 
            top: 0; 
            background: #eef2ff; 
            z-index: 40; 
            white-space: nowrap;
            border-bottom: 2px solid #3b82f6;
            border-right: 1px solid #e2e8f0;
            padding: 12px 14px;
            color: #1e40af;
            font-weight: 700;
        }
        
        /* Row 2 of header should stick below row 1 */
        thead tr:nth-child(2) th {
            top: 45px; /* Adjust based on height of row 1 */
            z-index: 39;
        }

        /* Sticky Columns */
        .sticky-col-0 { position: sticky; left: 0; z-index: 30; background: white !important; min-width: 40px; border-right: none !important; }
        .sticky-col-1 { position: sticky; left: 40px; z-index: 30; background: white !important; min-width: 60px; box-shadow: inset -1px 0 0 #e2e8f0; }
        .sticky-col-2 { position: sticky; left: 100px; z-index: 30; background: white !important; min-width: 150px; box-shadow: inset -1px 0 0 #e2e8f0; }
        .sticky-col-3 { position: sticky; left: 250px; z-index: 30; background: white !important; min-width: 300px; box-shadow: inset -1px 0 0 #e2e8f0; }
        .sticky-col-4 { position: sticky; left: 550px; z-index: 30; background: white !important; min-width: 110px; box-shadow: inset -1px 0 0 #e2e8f0; }
        .sticky-col-5 { position: sticky; left: 660px; z-index: 30; background: white !important; min-width: 110px; box-shadow: inset -1px 0 0 #e2e8f0; }

        /* Elevation for sticky headers in sticky columns */
        thead th.sticky-col-0, thead th.sticky-col-1, thead th.sticky-col-2, thead th.sticky-col-3,
        thead th.sticky-col-4, thead th.sticky-col-5 { 
            z-index: 50; 
            background: #eef2ff !important;
            box-shadow: inset -1px -1px 0 #e2e8f0;
        }

        td { 
            white-space: nowrap; 
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0;
            padding: 8px 12px;
            background: white;
            background-clip: padding-box;
        }

        .content-wrap {
            white-space: normal !important;
            min-width: 300px;
            max-width: 400px;
            line-height: 1.5;
            word-break: break-word;
        }
        
        .editable { cursor: pointer; min-width: 50px; min-height: 24px; padding: 4px 8px; border-radius: 4px; transition: all 0.2s; }
        .editable:hover { background: #f1f5f9; }
        .editing { background: white !important; box-shadow: 0 0 0 2px #3b82f6; outline: none; }
        
        .row-editing-indicator {
            display: none;
            color: #3b82f6;
            transform: rotate(90deg);
            animation: bounce-horizontal 2s infinite;
        }
        tr.active-editing .row-editing-indicator {
            display: inline-block;
        }
        tr.active-editing .row-stt-text {
            display: inline-block;
            opacity: 0.5;
        }
        @keyframes bounce-horizontal {
            0%, 100% { transform: rotate(90deg) translateX(0); }
            50% { transform: rotate(90deg) translateX(5px); }
        }
        
        /* Zebra Striping (Blue Theme) */
        #pr-table-body tr:nth-child(even) td {
            background-color: #f0f7ff;
        }
        #pr-table-body tr:nth-child(even) .sticky-col-0,
        #pr-table-body tr:nth-child(even) .sticky-col-1,
        #pr-table-body tr:nth-child(even) .sticky-col-2,
        #pr-table-body tr:nth-child(even) .sticky-col-3,
        #pr-table-body tr:nth-child(even) .sticky-col-4,
        #pr-table-body tr:nth-child(even) .sticky-col-5 {
            background-color: #f0f7ff !important;
        }

        /* Hover Effect (Green Theme) */
        #pr-table-body tr:hover td,
        #pr-table-body tr:hover .sticky-col-0,
        #pr-table-body tr:hover .sticky-col-1,
        #pr-table-body tr:hover .sticky-col-2,
        #pr-table-body tr:hover .sticky-col-3,
        #pr-table-body tr:hover .sticky-col-4,
        #pr-table-body tr:hover .sticky-col-5 {
            background-color: #f0fdf4 !important;
        }

        input[type="date"], input[type="text"] {
            border: none;
            background: transparent;
            width: 100%;
            font-family: inherit;
            font-size: inherit;
        }
        input:focus { outline: none; }

        /* Duration Input Style */
        .duration-container {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            transition: all 0.2s;
        }
        .duration-container:focus-within {
            border-color: #3b82f6;
            ring: 2px solid rgba(59, 130, 246, 0.1);
        }
        .duration-input {
            width: 100% !important;
            padding: 4px 8px !important;
            padding-right: 30px !important;
            font-size: 11px !important;
            border: none !important;
            background: transparent !important;
            outline: none !important;
            color: #1e293b;
        }
        .date-picker-wrapper {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-left: 1px solid #f1f5f9;
        }
        .date-icon {
            color: #94a3b8;
            pointer-events: none;
        }
        .date-hidden-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        /* Status colors */
        .status-select {
            font-weight: 600 !important;
            transition: all 0.2s ease;
        }
        .status-processing {
            background-color: #fffbeb !important;
            color: #d97706 !important;
            border: 1px solid #fef3c7 !important;
        }
        .status-completed {
            background-color: #f0fdf4 !important;
            color: #16a34a !important;
            border: 1px solid #dcfce7 !important;
        }
        .status-pill {
            background-color: #f8fafc;
            color: #475569;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            border: 1px solid #e2e8f0;
            white-space: nowrap;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .progress-bar-container {
            width: 100px;
            background-color: #f1f5f9;
            height: 10px; /* Thicker for visibility */
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .percent-bar {
            background-color: #22c55e !important; /* Force Green 500 */
            height: 100%;
        }
        .percentage-text {
            color: #16a34a !important; /* Text green 600 */
        }
        
        /* Row Selection and Deletion */
        tr.row-selected td,
        tr.row-selected .sticky-col-0,
        tr.row-selected .sticky-col-1,
        tr.row-selected .sticky-col-2,
        tr.row-selected .sticky-col-3,
        tr.row-selected .sticky-col-4,
        tr.row-selected .sticky-col-5 {
            background-color: #fee2e2 !important; /* Soft Red */
            box-shadow: inset 0 0 0 1px #ef4444 !important;
        }

        /* Custom Modal Styles */
        .custom-modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
            z-index: 100;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .custom-modal-backdrop.open {
            display: flex;
            opacity: 1;
        }
        .custom-modal {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            padding: 24px;
            max-width: 400px;
            width: 90%;
            margin: auto;
            transform: scale(0.95) translateY(10px);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            opacity: 0;
        }
        .custom-modal-backdrop.open .custom-modal {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
        
        /* Force button text colors */
        #modal-confirm, #modal-ok {
            color: #ffffff !important;
        }
        #modal-cancel {
            color: #334155 !important; /* slate-700 */
        }
    </style>
@endsection

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Danh sách Yêu cầu Mua sắm (PR)</h2>
            <p class="text-slate-500 text-sm">Click vào từng ô để chỉnh sửa nhanh thông tin.</p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">Lọc:</span>
            <div class="flex items-center bg-white border border-slate-200 rounded-lg px-3 shadow-sm">
                <svg class="w-4 h-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002-2z" /></svg>
                <select id="filter_month" class="text-sm text-slate-600 outline-none py-2 bg-transparent pr-2 font-medium cursor-pointer">
                    <option value="all">Tất cả tháng</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ sprintf('%02d', $i) }}">Tháng {{ $i }}</option>
                    @endfor
                </select>
                <div class="w-px h-4 bg-slate-200 mx-2"></div>
                <select id="filter_year" class="text-sm text-slate-600 outline-none py-2 bg-transparent pr-4 font-medium cursor-pointer">
                    <option value="all">Tất cả năm</option>
                    @for($y = 2024; $y <= 2027; $y++)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex items-center bg-white border border-slate-200 rounded-lg px-3 shadow-sm">
                <svg class="w-4 h-4 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                <select id="filter_status" class="text-sm text-slate-600 outline-none py-2 bg-transparent pr-4 font-medium cursor-pointer">
                    <option value="all">Tất cả trạng thái</option>
                    <option value="Đang xử lý">Đang xử lý</option>
                    <option value="Hoàn thành">Hoàn thành</option>
                </select>
            </div>
            <button onclick="clearFilters()" class="bg-white border border-slate-200 text-slate-400 hover:text-red-500 px-3 py-2 rounded-lg transition-all flex items-center shadow-sm text-xs font-bold uppercase tracking-tight">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                Xóa lọc
            </button>
            <button onclick="exportExcel()" class="bg-white border border-slate-200 text-slate-600 hover:text-green-600 px-4 py-2 rounded-lg transition-all flex items-center shadow-sm text-xs font-bold uppercase tracking-tight">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Xuất Excel
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-xl font-bold border border-green-100 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="table-container">
            <table class="text-sm">
                <thead>
                    <tr class="text-slate-600 font-bold uppercase tracking-wider bg-slate-50">
                        <th class="p-4 text-center sticky-col-0"></th>
                        <th class="p-4 text-center sticky-col-1">STT</th>
                        <th class="p-4 text-left sticky-col-2">Khoa/phòng</th>
                        <th class="p-4 text-left sticky-col-3">Nội dung mua sắm</th>
                        <th class="p-4 text-center sticky-col-4">Nhận PR</th>
                        <th class="p-4 text-center sticky-col-5">Duyệt PR</th>
                        <th class="p-4 text-center">Ngày báo giá</th>
                        <th class="p-4 text-center">Ngày làm PO</th>
                        <th class="p-4 text-center">Duyệt PO</th>
                        <th class="p-4 text-center">Kí HĐ</th>
                        <th class="p-4 text-center">Tiến độ</th>
                        <th class="p-4 text-center">Trạng thái</th>
                        <th class="p-4 text-center">Ngày giao hàng</th>
                        <th class="p-4 text-left">Ghi chú (Giao hàng)</th>
                        <th class="p-4 text-left">Lý do</th>
                        <th class="p-4 text-left">Ghi chú Khoa/Phòng</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <!-- Dòng nhập nhanh mới -->
                    <tr id="new-pr-row" class="bg-blue-50/50 border-b-2 border-blue-100">
                        <td class="p-4 text-center sticky-col-0"></td>
                        <td class="p-4 text-blue-600 font-bold italic text-center text-xs sticky-col-1">NEW</td>
                        <td class="p-4 sticky-col-2">
                            <input type="text" id="new_department_name" list="department_list" autocomplete="off"
                                placeholder="Tìm hoặc nhập mới..."
                                class="w-full bg-white border border-slate-200 rounded px-2 py-1.5 outline-none focus:ring-2 focus:ring-blue-500/20 text-sm font-medium">
                            <datalist id="department_list">
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->name }}" data-id="{{ $dept->id }}"></option>
                                @endforeach
                            </datalist>
                        </td>
                        <td class="p-4 sticky-col-3">
                            <input type="text" id="new_content" placeholder="Nội dung..." 
                                class="w-full bg-white border border-slate-200 rounded px-3 py-1.5 outline-none focus:ring-2 focus:ring-blue-500/20 font-medium">
                        </td>
                        <td class="p-4 text-center sticky-col-4">
                            <input type="date" id="new_pr_received_date" class="w-full text-xs bg-white border border-slate-200 rounded px-1 py-1">
                        </td>
                        <td class="p-4 text-center sticky-col-5">
                            <input type="date" id="new_pr_approved_date" class="w-full text-xs bg-white border border-slate-200 rounded px-1 py-1">
                        </td>
                        <td class="p-4 text-center">
                            <input type="date" id="new_quotation_date" class="w-24 text-xs bg-white border border-slate-200 rounded px-1 py-1">
                        </td>
                        <td class="p-4 text-center">
                            <input type="date" id="new_po_created_date" class="w-24 text-xs bg-white border border-slate-200 rounded px-1 py-1">
                        </td>
                        <td class="p-4 text-center">
                            <input type="date" id="new_po_approved_date" class="w-24 text-xs bg-white border border-slate-200 rounded px-1 py-1">
                        </td>
                        <td class="p-4 text-center">
                            <input type="date" id="new_contract_signed_date" class="w-24 text-xs bg-white border border-slate-200 rounded px-1 py-1">
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex flex-col items-start space-y-2 min-w-[120px]">
                                <div class="progress-bar-container">
                                    <div class="percent-bar bg-blue-400 h-full w-0 transition-all duration-500"></div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs font-bold text-blue-600 percentage-text">0%</span>
                                    <span class="status-pill label-text">Chờ xử lý</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <select id="new_status" onchange="updateStatusStyle(this)" 
                                class="status-select status-processing w-full rounded px-2 py-1 outline-none text-xs">
                                <option value="Đang xử lý">Đang xử lý</option>
                                <option value="Hoàn thành">Hoàn thành</option>
                            </select>
                        </td>
                        <td class="p-4 text-center">
                            <div class="duration-container shadow-sm">
                                <input type="text" id="new_goods_received_date" placeholder="1 tuần, 3th..." 
                                    class="duration-input"
                                    title="Nhập '1 tuần', '1 tháng', '15 ngày' để tự động tính từ ngày Kí HĐ">
                                <div class="date-picker-wrapper">
                                    <svg class="date-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002-2z" /></svg>
                                    <input type="date" class="date-hidden-input">
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <input type="text" id="new_delivery_note" placeholder="..." class="w-full bg-white border border-slate-200 rounded px-2 py-1 text-xs">
                        </td>
                        <td colspan="2" class="p-4">
                            <button onclick="saveNewPR()" class="w-full bg-blue-600 text-white rounded-lg py-2 font-bold hover:bg-blue-700 transition-colors text-xs shadow-md">LƯU NHANH</button>
                        </td>
                    </tr>

                    <tbody id="pr-table-body" class="divide-y divide-slate-100">
                    @forelse($requests as $request)
                    <tr class="hover:bg-blue-50/30 transition-colors" data-pr-id="{{ $request->id }}">
                        <td class="p-4 text-center sticky-col-0">
                            <span class="row-editing-indicator">
                                <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </span>
                        </td>
                        <td class="p-4 text-slate-500 font-medium text-center sticky-col-1">
                            <span class="row-stt-text"></span>
                        </td>
                        <td class="p-4 font-semibold text-slate-700 sticky-col-2">{{ $request->department->name ?? 'N/A' }}</td>
                        <td class="p-4 sticky-col-3 content-wrap">
                            <div class="editable" data-id="{{ $request->id }}" data-field="content">{{ $request->content }}</div>
                        </td>
                        <td class="p-4 text-center sticky-col-4">
                            <input type="date" class="editable-date" data-id="{{ $request->id }}" data-field="pr_received_date" value="{{ $request->timeline->pr_received_date ?? '' }}">
                        </td>
                        <td class="p-4 text-center sticky-col-5">
                            <input type="date" class="editable-date" data-id="{{ $request->id }}" data-field="pr_approved_date" value="{{ $request->timeline->pr_approved_date ?? '' }}">
                        </td>
                        <td class="p-4 text-center">
                            <input type="date" class="editable-date" data-id="{{ $request->id }}" data-field="quotation_date" value="{{ $request->timeline->quotation_date ?? '' }}">
                        </td>
                        <td class="p-4 text-center">
                            <input type="date" class="editable-date" data-id="{{ $request->id }}" data-field="po_created_date" value="{{ $request->timeline->po_created_date ?? '' }}">
                        </td>
                        <td class="p-4 text-center">
                            <input type="date" class="editable-date" data-id="{{ $request->id }}" data-field="po_approved_date" value="{{ $request->timeline->po_approved_date ?? '' }}">
                        </td>
                        <td class="p-4 text-center">
                            <input type="date" class="editable-date" data-id="{{ $request->id }}" data-field="contract_signed_date" value="{{ $request->timeline->contract_signed_date ?? '' }}">
                        </td>
                        <td class="p-4 text-center progress-cell">
                            @php
                                $prog = $request->progress_info;
                            @endphp
                            <div class="flex flex-col items-start space-y-2 min-w-[120px]">
                                <div class="progress-bar-container">
                                    <div class="percent-bar {{ $prog['color'] }} h-full transition-all duration-500" style="width: {{ $prog['percent'] }}%"></div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs font-bold percentage-text">{{ $prog['percent'] }}%</span>
                                    <span class="status-pill label-text">{{ $prog['label'] }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <select class="editable-select status-select {{ $request->status == 'Hoàn thành' ? 'status-completed' : 'status-processing' }} border border-slate-200 rounded px-2 py-1 text-xs" 
                                data-id="{{ $request->id }}" data-field="status" data-original="{{ $request->status }}" onchange="updateStatusStyle(this)">
                                <option value="Đang xử lý" {{ $request->status == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="Hoàn thành" {{ $request->status == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                            </select>
                        </td>
                         <td class="p-4 text-center">
                            <div class="duration-container">
                                <input type="text" class="duration-input" 
                                    data-id="{{ $request->id }}" data-field="goods_received_date" 
                                    value="{{ isset($request->timeline->goods_received_date) ? date('d/m/Y', strtotime($request->timeline->goods_received_date)) : '' }}"
                                    placeholder="1 tuần, 3th...">
                                <div class="date-picker-wrapper">
                                    <svg class="date-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002-2z" /></svg>
                                    <input type="date" class="date-hidden-input" 
                                        value="{{ $request->timeline->goods_received_date ?? '' }}">
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="editable" data-id="{{ $request->id }}" data-field="delivery_note" placeholder="...">{{ $request->delivery_note }}</div>
                        </td>
                        <td class="p-4">
                            <div class="editable" data-id="{{ $request->id }}" data-field="reason" placeholder="...">{{ $request->reason }}</div>
                        </td>
                        <td class="p-4">
                            @php
                                $deptNote = $request->notes->first();
                            @endphp
                            <div class="text-slate-500 italic">
                                @if($deptNote)
                                    <span title="{{ $deptNote->content }} - {{ $deptNote->created_at->format('d/m/Y H:i') }}">
                                        {{ \Illuminate\Support\Str::limit($deptNote->content, 50) }}
                                    </span>
                                @else
                                    {{ $request->department_note ?: '...' }}
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="empty-row">
                        <td colspan="16" class="p-12 text-center text-slate-400 italic bg-white">Chưa có yêu cầu nào được tạo.</td>
                    </tr>
                    @endforelse
                    
                    <tr id="no-results-row" style="display: none;">
                        <td colspan="16" class="p-12 text-center text-slate-400 italic bg-white">
                            <div class="flex flex-col items-center">
                                Không có dữ liệu phù hợp với bộ lọc hiện tại.
                            </div>
                        </td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const tableBody = document.getElementById('pr-table-body');

            // Cập nhật tiến độ dòng NEW khi có thay đổi
            const newRow = document.getElementById('new-pr-row');
            if (newRow) {
                newRow.querySelectorAll('input, select').forEach(input => {
                    input.addEventListener('change', () => refreshProgress(newRow));
                });
            }

            async function saveNewPR() {
                const deptName = document.getElementById('new_department_name').value;
                const toSqlDate = (val) => {
                    if (!val) return null;
                    if (/^\d{2}\/\d{2}\/\d{4}$/.test(val)) {
                        const [d, m, y] = val.split('/');
                        return `${y}-${m}-${d}`;
                    }
                    if (/^\d{4}-\d{2}-\d{2}$/.test(val)) return val;
                    return val;
                };

                const data = {
                    content: document.getElementById('new_content').value,
                    department_id: deptName,
                    status: document.getElementById('new_status').value,
                    pr_received_date: toSqlDate(document.getElementById('new_pr_received_date').value),
                    pr_approved_date: toSqlDate(document.getElementById('new_pr_approved_date').value),
                    quotation_date: toSqlDate(document.getElementById('new_quotation_date').value),
                    po_created_date: toSqlDate(document.getElementById('new_po_created_date').value),
                    po_approved_date: toSqlDate(document.getElementById('new_po_approved_date').value),
                    contract_signed_date: toSqlDate(document.getElementById('new_contract_signed_date').value),
                    goods_received_date: toSqlDate(document.getElementById('new_goods_received_date').value),
                    delivery_note: document.getElementById('new_delivery_note').value,
                    reason: '',
                    department_note: '',
                };

                if (!data.content.trim()) return;

                try {
                    const response = await fetch("{{ route('admin.tracking.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });
                    
                    if (response.ok) {
                        const json = await response.json();
                        addTableRow(json.data);
                        resetNewRow();
                        refreshProgress(document.getElementById('new-pr-row'));
                    } else {
                        const err = await response.json();
                        alert('Lỗi: ' + (err.message || 'Không thể lưu'));
                    }
                } catch (error) {
                    alert('Lỗi khi thêm mới: ' + error.message);
                }
            }
            window.saveNewPR = saveNewPR;

            function resetNewRow() {
                document.getElementById('new_content').value = '';
                document.getElementById('new_department_name').value = '';
                document.getElementById('new_delivery_note').value = '';
                document.querySelectorAll('.bg-blue-50\\/50 input[type="date"]').forEach(input => input.value = '');
            }

            function addTableRow(pr) {
                const emptyRow = document.getElementById('empty-row');
                if (emptyRow) emptyRow.remove();

                const tr = document.createElement('tr');
                tr.className = 'hover:bg-green-50/50 transition-colors animate-in fade-in slide-in-from-top-4 duration-500';
                tr.dataset.prId = pr.id;
                
                const t = pr.timeline || {};
                
                tr.innerHTML = `
                    <td class="p-4 text-center sticky-col-0">
                        <span class="row-editing-indicator">
                            <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </span>
                    </td>
                    <td class="p-4 text-slate-500 font-medium text-center sticky-col-1">
                        <span class="row-stt-text"></span>
                    </td>
                    <td class="p-4 font-semibold text-slate-700 sticky-col-2">${pr.department ? pr.department.name : 'N/A'}</td>
                    <td class="p-4 sticky-col-3 content-wrap">
                        <div class="editable" data-id="${pr.id}" data-field="content">${pr.content}</div>
                    </td>
                    <td class="p-4 text-center sticky-col-4">
                        <input type="date" class="editable-date" data-id="${pr.id}" data-field="pr_received_date" value="${t.pr_received_date || ''}">
                    </td>
                    <td class="p-4 text-center sticky-col-5">
                        <input type="date" class="editable-date" data-id="${pr.id}" data-field="pr_approved_date" value="${t.pr_approved_date || ''}">
                    </td>
                    <td class="p-4 text-center">
                        <input type="date" class="editable-date" data-id="${pr.id}" data-field="quotation_date" value="${t.quotation_date || ''}">
                    </td>
                    <td class="p-4 text-center">
                        <input type="date" class="editable-date" data-id="${pr.id}" data-field="po_created_date" value="${t.po_created_date || ''}">
                    </td>
                    <td class="p-4 text-center">
                        <input type="date" class="editable-date" data-id="${pr.id}" data-field="po_approved_date" value="${t.po_approved_date || ''}">
                    </td>
                    <td class="p-4 text-center">
                        <input type="date" class="editable-date" data-id="${pr.id}" data-field="contract_signed_date" value="${t.contract_signed_date || ''}">
                    </td>
                    <td class="p-4 text-center progress-cell">
                         <div class="flex flex-col items-start space-y-2 min-w-[120px]">
                            <div class="progress-bar-container">
                                <div class="percent-bar h-full transition-all duration-500" style="width: ${pr.progress_info ? pr.progress_info.percent : 0}%"></div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-bold percentage-text">${pr.progress_info ? pr.progress_info.percent : 0}%</span>
                                <span class="status-pill label-text">${pr.progress_info ? pr.progress_info.label : 'Chờ xử lý'}</span>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-center">
                        <select class="editable-select status-select ${pr.status === 'Hoàn thành' ? 'status-completed' : 'status-processing'} border border-slate-200 rounded px-2 py-1 text-xs" 
                            data-id="${pr.id}" data-field="status" data-original="${pr.status}" onchange="updateStatusStyle(this)">
                            <option value="Đang xử lý" ${pr.status === 'Đang xử lý' ? 'selected' : ''}>Đang xử lý</option>
                            <option value="Hoàn thành" ${pr.status === 'Hoàn thành' ? 'selected' : ''}>Hoàn thành</option>
                        </select>
                    </td>
                    <td class="p-4 text-center">
                        <div class="duration-container">
                            <input type="text" class="duration-input" 
                                data-id="${pr.id}" data-field="goods_received_date" 
                                value="${t.goods_received_date ? formatDateDisplay(t.goods_received_date) : ''}"
                                placeholder="1 tuần, 3th...">
                            <div class="date-picker-wrapper">
                                <svg class="date-icon w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002-2z" /></svg>
                                <input type="date" class="date-hidden-input" 
                                    value="${t.goods_received_date || ''}"
                                    onchange="const txt = this.closest('.duration-container').querySelector('.duration-input'); txt.value = formatDateDisplay(this.value); txt.dispatchEvent(new Event('change'))">
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <div class="editable" data-id="${pr.id}" data-field="delivery_note" placeholder="...">${pr.delivery_note || '...'}</div>
                    </td>
                    <td class="p-4">
                        <div class="editable" data-id="${pr.id}" data-field="reason" placeholder="...">${pr.reason || '...'}</div>
                    </td>
                    <td class="p-4">
                        <div class="text-slate-500 italic">${pr.department_note || '...'}</div>
                    </td>
                `;
                
                tableBody.prepend(tr);
                bindRowEvents(tr);
                refreshProgress(tr); // Force final progress sync
                setTimeout(filterTable, 100); // Đảm bảo dòng mới tuân thủ bộ lọc
            }

            function filterTable() {
                const statusFilter = document.getElementById('filter_status').value;
                const monthFilter = document.getElementById('filter_month').value;
                const yearFilter = document.getElementById('filter_year').value;
                const rows = tableBody.querySelectorAll('tr:not(.bg-blue-50\\/50):not(#no-results-row):not(#empty-row)');
                const noResultsRow = document.getElementById('no-results-row');

                let visibleCount = 0;
                rows.forEach(row => {
                    let showStatus = true;
                    let showDate = true;

                    // Lọc trạng thái
                    const statusSelect = row.querySelector('.status-select');
                    if (statusFilter !== 'all' && statusSelect && statusSelect.value !== statusFilter) {
                        showStatus = false;
                    }

                    // Lọc tháng/năm
                    const dateInput = row.querySelector('[data-field="pr_received_date"]');
                    if (dateInput && dateInput.value) {
                        const [y, m, d] = dateInput.value.split('-');
                        
                        if (monthFilter !== 'all' && m !== monthFilter) showDate = false;
                        if (yearFilter !== 'all' && y !== yearFilter) showDate = false;
                    } else {
                        if (monthFilter !== 'all' || yearFilter !== 'all') showDate = false;
                    }

                    if (showStatus && showDate) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Hiển thị/ẩn thông báo không có kết quả
                if (noResultsRow) {
                    noResultsRow.style.display = visibleCount === 0 ? 'table-row' : 'none';
                }

                // Cập nhật STT sau khi lọc
                updateSTT();
            }
            window.filterTable = filterTable;

            function updateSTT() {
                const rows = Array.from(tableBody.querySelectorAll('tr:not(.bg-blue-50\\/50):not(#no-results-row):not(#empty-row)'))
                    .filter(row => row.style.display !== 'none');
                
                let maxSTT = rows.length;
                rows.forEach(row => {
                    const cell = row.querySelector('.row-stt-text');
                    if (cell) {
                        cell.innerText = maxSTT--;
                    }
                });
            }
            window.updateSTT = updateSTT;

            function clearFilters() {
                document.getElementById('filter_month').value = 'all';
                document.getElementById('filter_year').value = 'all';
                document.getElementById('filter_status').value = 'all';
                filterTable();
            }
            window.clearFilters = clearFilters;

            function exportExcel() {
                const month = document.getElementById('filter_month').value;
                const year = document.getElementById('filter_year').value;
                const status = document.getElementById('filter_status').value;
                
                const url = `{{ route('admin.tracking.export') }}?month=${month}&year=${year}&status=${status}`;
                window.location.href = url;
            }
            window.exportExcel = exportExcel;

            document.getElementById('filter_status').onchange = filterTable;
            document.getElementById('filter_month').onchange = filterTable;
            document.getElementById('filter_year').onchange = filterTable;
            
            // Chạy lọc lần đầu để áp dụng Năm hiện tại
            filterTable();

            // Prevent duplicate listeners
            if (!window.trackingListenersAttached) {
                window.trackingListenersAttached = true;

                // 1. Double Click to Select Row
                document.addEventListener('dblclick', function(e) {
                    const tr = e.target.closest('#pr-table-body tr');
                    if (!tr) return;

                    const prevSelected = document.querySelector('.row-selected');
                    if (prevSelected && prevSelected !== tr) {
                        prevSelected.classList.remove('row-selected');
                    }

                    tr.classList.toggle('row-selected');
                    
                    if (tr.classList.contains('row-selected')) {
                        if (document.activeElement && ['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
                            document.activeElement.blur();
                        }
                        window.getSelection()?.removeAllRanges();
                    }
                });

                // 2. Single Click to Deselect (if clicking another row/input)
                document.addEventListener('click', function(e) {
                    const selectedRow = document.querySelector('.row-selected');
                    if (!selectedRow) return;

                    // If clicking inside the selected row itself, keep selection (unless editing input, which is handled elsewhere)
                    // But if user clicks specifically to edit (input/editable), might want to clear.
                    // For now, simple logic: if click is outside selected row, clear it.
                    if (!selectedRow.contains(e.target)) {
                        selectedRow.classList.remove('row-selected');
                    } 
                    // Also clear on interactive elements even inside row if single click usually implies edit start?
                    // But requirement says "choose another row". So outside check is primary.
                    // Let's also check if we are activating an edit on ANY row (input or editable)
                     if (e.target.tagName === 'INPUT' || e.target.closest('.editable')) {
                        selectedRow.classList.remove('row-selected');
                    }
                }, true); // Use capture phase to ensure we catch it early

                // 2b. Keyboard handling for deletion

                // 2. Keyboard handling for deletion
                window.addEventListener('keydown', function(e) {
                    // Ignore held-down keys to prevent valid/cancel double-fire loops
                    if (e.repeat) return;

                    if (e.key === 'Delete' || e.key === 'Backspace') {
                        const selectedRow = document.querySelector('.row-selected');
                        if (!selectedRow) return;

                        if (['INPUT', 'SELECT', 'TEXTAREA'].includes(document.activeElement.tagName) || 
                            document.activeElement.isContentEditable) {
                            return;
                        }

                        const prId = parseInt(selectedRow.dataset.prId);
                        const deptName = selectedRow.querySelector('.sticky-col-2').innerText;
                        
                        showConfirmModal(
                            `Bạn có chắc chắn muốn xóa PR này của <span class="font-bold text-red-500">${deptName}</span> không?`,
                            () => deletePR(prId, selectedRow),
                            () => selectedRow.classList.remove('row-selected')
                        );
                    }
                });
            }

            async function deletePR(id, rowElement) {
                try {
                    const response = await fetch(`/admin/tracking/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    });
                    
                    if (response.ok) {
                        rowElement.style.transition = 'all 0.4s ease';
                        rowElement.style.opacity = '0';
                        rowElement.style.transform = 'translateX(20px)';
                        setTimeout(() => {
                            rowElement.remove();
                            updateSTT();
                        }, 400);
                    } else {
                        const err = await response.json();
                        showAlert('Không thể xóa: ' + (err.message || 'Lỗi không xác định'));
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                    showAlert('Lỗi kết nối máy chủ.');
                }
            }

           function bindRowEvents(container) {

    // Helper to trigger change
    const triggerChange = (element) => {
        const event = new Event('change', { bubbles: true });
        element.dispatchEvent(event);
    };

    // (Old row selection logic removed, handled by global delegation above)

    // Editable text
    container.querySelectorAll('.editable').forEach(el => {
        el.addEventListener('click', function () {
            handleEdit(this);
        });
    });

    // All interactive items in the row
    container.querySelectorAll('.editable-date, .editable-select, .duration-input, .date-hidden-input').forEach(el => {
        
        // 1. Calendar selection (the hidden date input)
        if (el.classList.contains('date-hidden-input')) {
            el.addEventListener('change', function() {
                const txt = this.closest('.duration-container').querySelector('.duration-input');
                if (txt && this.value) {
                    txt.value = formatDateDisplay(this.value);
                    triggerChange(txt);
                }
            });
        }

        // 2. Main change listener for data saving
        if (!el.classList.contains('date-hidden-input')) {
            el.addEventListener('change', function() {
                const id = this.dataset.id;
                const field = this.dataset.field;
                let rawValue = this.value;

                if (field === 'status') {
                    updateStatusStyle(this);
                    setTimeout(filterTable, 100);
                }

                let valueToSave = rawValue;
                if (this.classList.contains('duration-input')) {
                    valueToSave = toSqlDate(rawValue);
                    if (valueToSave && !/^\d{4}-\d{2}-\d{2}$/.test(valueToSave)) return;
                } else if (this.classList.contains('editable-date')) {
                    if (valueToSave && !/^\d{4}-\d{2}-\d{2}$/.test(valueToSave)) return;
                }

                if (id && field) saveData(id, field, valueToSave || null);
                refreshProgress(this.closest('tr'));
            });
        }

        // 3. Duration/Manual Date parsing on blur
        if (el.classList.contains('duration-input')) {
            el.addEventListener('blur', function() {
                const tr = this.closest('tr');
                const startInput = tr.querySelector('[data-field="contract_signed_date"]') || tr.querySelector('#new_contract_signed_date');
                const startDate = startInput ? startInput.value : null;

                if (!this.value) {
                     // Clear hidden date if text is cleared
                     const hidden = this.closest('.duration-container').querySelector('.date-hidden-input');
                     if (hidden) hidden.value = '';
                     return;
                }

                // A. Parse manual date entry (e.g., 30/1/2026)
                const dateMatch = this.value.match(/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{2,4})$/);
                if (dateMatch) {
                    const d = dateMatch[1].padStart(2, '0');
                    const m = dateMatch[2].padStart(2, '0');
                    let y = dateMatch[3];
                    if (y.length === 2) y = '20' + y;
                    this.value = `${d}/${m}/${y}`;
                    
                    // Sync back to hidden input for consistency
                    const hidden = this.closest('.duration-container').querySelector('.date-hidden-input');
                    if (hidden) hidden.value = `${y}-${m}-${d}`;
                    
                    triggerChange(this);
                    return;
                }

                // B. Duration calculation (e.g., 1 week)
                const calculated = parseDuration(this.value, startDate);
                if (calculated) {
                    this.value = formatDateDisplay(calculated);
                    const hidden = this.closest('.duration-container').querySelector('.date-hidden-input');
                    if (hidden) hidden.value = calculated;
                    triggerChange(this);
                } else {
                    // Not a period and not a manual date
                    if (!startDate && /^\d+\s*\w+$/.test(this.value)) {
                        alert('Hệ thống cần ngày "Kí HĐ" để tính toán thời gian. Vui lòng chọn ngày từ lịch hoặc nhập định dạng dd/mm/yyyy.');
                        this.value = '';
                    }
                }
            });

            el.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') this.blur();
            });
        }

        // indicator logic...
        el.addEventListener('focus', function() {
            this.closest('tr').classList.add('active-editing');
        });
        el.addEventListener('blur', function() {
            setTimeout(() => {
                const activeEl = document.activeElement;
                if (!activeEl || activeEl.closest('tr') !== this.closest('tr')) {
                    this.closest('tr').classList.remove('active-editing');
                }
            }, 100);
        });
    });
}


            function updateStatusStyle(el) {
                const originalStatus = el.dataset.original;
                if (originalStatus === 'Hoàn thành' && el.value === 'Đang xử lý') {
                    alert('Hệ thống không cho phép chuyển ngược từ "Hoàn thành" về "Đang xử lý".');
                    el.value = 'Hoàn thành'; // Trả về giá trị cũ
                    return;
                }

                if (el.value === 'Hoàn thành') {
                    el.classList.remove('status-processing');
                    el.classList.add('status-completed');
                    el.dataset.original = 'Hoàn thành'; // Cập nhật mốc khi đã thành Hoàn thành
                } else {
                    el.classList.remove('status-completed');
                    el.classList.add('status-processing');
                }
            }
            window.updateStatusStyle = updateStatusStyle;

            function refreshProgress(tr) {
                if (!tr) return;

                const statusSelect = tr.querySelector('.status-select') || tr.querySelector('#new_status');
                const isHoanThanh = statusSelect && statusSelect.value === 'Hoàn thành';
                
                // Get value of all potential date fields
                const val = (field) => {
                    let el = tr.querySelector(`[data-field="${field}"]`);
                    if (!el) el = tr.querySelector(`#new_${field}`); // Hỗ trợ lấy dữ liệu từ dòng NEW
                    return el && el.value && el.value.trim() !== '' ? el.value : null;
                };

                const dates = {
                    pr_received: val('pr_received_date'),
                    pr_approved: val('pr_approved_date'),
                    quotation: val('quotation_date'),
                    po_created: val('po_created_date'),
                    po_approved: val('po_approved_date'),
                    contract: val('contract_signed_date'),
                    goods: val('goods_received_date')
                };

                const isContract = !!dates.contract;
                const totalSteps = isContract ? 7 : 6;
                
                let completed = 0;
                Object.values(dates).forEach(v => { if(v) completed++; });
                
                let percent = Math.round((completed / totalSteps) * 100);
                if (isHoanThanh) percent = 100;
                if (percent > 100) percent = 100;

                // Determine Label
                let label = 'Đang xử lý';
                if (percent === 0) label = 'Chờ xử lý';
                else if (isHoanThanh || percent === 100) label = 'Hoàn thành';
                else {
                    if (completed === 1) label = 'Đã nhận PR';
                    else if (completed === 2) label = 'Đang chờ báo giá';
                    else if (completed === 3) label = isContract ? 'Đang xử lý – chờ PO' : 'Đang làm PO';
                    else if (completed === 4) label = 'Đang ở bước PO';
                    else if (completed === 5) label = 'Đã duyệt PO';
                    else if (isContract && completed === 6) label = 'Đã ký HĐ';
                }

                const bar = tr.querySelector('.percent-bar');
                const text = tr.querySelector('.percentage-text');
                const labelEl = tr.querySelector('.label-text');

                if (bar && text) {
                    bar.style.width = percent + '%';
                    text.innerText = percent + '%';
                    if (labelEl) labelEl.innerText = label;
                }
            }

            window.toSqlDate = function(val) {
                if (!val) return null;
                val = val.trim();
                const dmyMatch = val.match(/^(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})$/);
                if (dmyMatch) {
                    return `${dmyMatch[3]}-${dmyMatch[2].padStart(2, '0')}-${dmyMatch[1].padStart(2, '0')}`;
                }
                if (/^\d{4}-\d{2}-\d{2}$/.test(val)) return val;
                return val;
            };

            window.formatDateDisplay = function(dateStr) {
                if (!dateStr || !dateStr.includes('-')) return dateStr;
                const parts = dateStr.split('-');
                if (parts.length !== 3) return dateStr;
                return `${parts[2].padStart(2, '0')}/${parts[1].padStart(2, '0')}/${parts[0]}`;
            };

            function parseDuration(input, startDate) {
                if (!startDate) return null;
                const start = new Date(startDate);
                if (isNaN(start.getTime())) return null;

                const regex = /^(\d+)\s*(n|ngày|t|tuần|th|tháng|m)$/i;
                const match = input.trim().toLowerCase().match(regex);
                if (!match) return null;

                const val = parseInt(match[1]);
                const unit = match[2];

                const result = new Date(start);
                if (unit.startsWith('n')) {
                    result.setDate(result.getDate() + val);
                } else if (unit.startsWith('t') && unit !== 'th') {
                    result.setDate(result.getDate() + val * 7);
                } else if (unit === 'm' || unit.startsWith('th')) {
                    result.setMonth(result.getMonth() + val);
                }
                
                const y = result.getFullYear();
                const m = String(result.getMonth() + 1).padStart(2, '0');
                const d = String(result.getDate()).padStart(2, '0');
                return `${y}-${m}-${d}`;
            }

            function handleEdit(el) {
                if (el.querySelector('input')) return;

                const originalText = el.innerText;
                const field = el.dataset.field;
                const id = el.dataset.id;
                
                const input = document.createElement('input');
                input.type = 'text';
                input.value = originalText === '...' ? '' : originalText;
                input.className = 'editing p-1 w-full rounded';
                
                el.innerHTML = '';
                el.appendChild(input);
                input.focus();
                el.closest('tr').classList.add('active-editing');
                
                input.onblur = function() {
                    el.closest('tr').classList.remove('active-editing');
                    const newText = this.value;
                    el.innerText = newText || '...';
                    if (newText !== originalText) {
                        saveData(id, field, newText);
                    }
                };

                input.onkeydown = function(e) {
                    if (e.key === 'Enter') this.blur();
                };
            }

            async function saveData(id, field, value) {
                try {
                    const response = await fetch(`/admin/tracking/${id}/update`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ field, value })
                    });
                    
                    if (!response.ok) {
                        const errorData = await response.json().catch(() => ({}));
                        throw new Error(errorData.message || 'Cập nhật thất bại');
                    }
                } catch (error) {
                    console.error('Update error:', error);
                    alert('Lỗi: ' + error.message);
                }
            }

            // Custom Modal Functions
            function getModalHtml(title, message, isConfirm = false) {
                return `
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full ${isConfirm ? 'bg-red-100' : 'bg-blue-100'} mb-4">
                            ${isConfirm 
                                ? '<svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>'
                                : '<svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
                            }
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">${title}</h3>
                        <p class="text-sm text-slate-500 mb-6">${message}</p>
                        <div class="flex justify-center space-x-3">
                            ${isConfirm 
                                ? `<button id="modal-cancel" style="color: #334155 !important;" class="px-4 py-2 bg-white text-slate-700 font-semibold rounded-lg border border-slate-300 hover:bg-slate-50 transition-colors focus:outline-none">Hủy bỏ</button>
                                   <button id="modal-confirm" style="background-color: #dc2626 !important; color: #ffffff !important;" class="px-4 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition-colors shadow-lg shadow-red-200 focus:outline-none">Xác nhận xóa</button>`
                                : `<button id="modal-ok" style="background-color: #2563eb !important; color: #ffffff !important;" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition-colors shadow-lg shadow-blue-200 focus:outline-none">Đóng</button>`
                            }
                        </div>
                    </div>
                `;
            }

            window.showAlert = function(message) {
                const backdrop = document.getElementById('custom-modal-backdrop');
                const content = document.getElementById('custom-modal-content');
                if (!backdrop || !content) return alert(message);

                content.innerHTML = getModalHtml('Thông báo', message, false);
                backdrop.classList.add('open');

                const btnOk = content.querySelector('#modal-ok');
                btnOk.onclick = () => backdrop.classList.remove('open');
                btnOk.focus();
            };

            window.showConfirmModal = function(message, onConfirm, onCancel) {
                const backdrop = document.getElementById('custom-modal-backdrop');
                const content = document.getElementById('custom-modal-content');
                if (!backdrop || !content) {
                    if (confirm(message.replace(/<[^>]*>?/gm, ''))) return onConfirm();
                    else return onCancel && onCancel();
                }

                content.innerHTML = getModalHtml('Xác nhận hành động', message, true);
                backdrop.classList.add('open');

                const btnConfirm = content.querySelector('#modal-confirm');
                const btnCancel = content.querySelector('#modal-cancel');

                const close = () => {
                    backdrop.classList.remove('open');
                };

                btnConfirm.onclick = () => {
                    close();
                    if (onConfirm) onConfirm();
                };

                btnCancel.onclick = () => {
                    close();
                    if (onCancel) onCancel();
                };

                // Click outside to cancel
                backdrop.onclick = (e) => {
                    if (e.target === backdrop) {
                        close();
                        if (onCancel) onCancel();
                    }
                };

                btnCancel.focus();
            };

            // Override default alert
            window.alert = window.showAlert;

            // Bind events for initial rows
            bindRowEvents(document);
            updateSTT();
        });
    </script>

    <!-- Custom Modal Container -->
    <div id="custom-modal-backdrop" class="custom-modal-backdrop">
        <div id="custom-modal-content" class="custom-modal"></div>
    </div>
@endsection
