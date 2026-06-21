@extends('layouts.master')
@section('title', 'تفاصيل سجل استفادة')
@section('breadcrumpTitle', 'تفاصيل سجل استفادة')
@section('breadcrump')
    @parent
    <li class="breadcrumb-item">
        <a href="{{ route('admin.support-program-entries.index') }}" class="default-color">سجلات الاستفادة من برامج الدعم</a>
    </li>
    <li class="breadcrumb-item active">تفاصيل سجل استفادة</li>
@endsection

@push('css')
    <style>
        :root {
            --brand: #84BA3F;
            --brand-dark: #6a9a30;
            --teal: #296060;
            --teal-dark: #1e4a4a;
            --text-main: #1a1a2e;
            --text-sub: #4a4a68;
            --text-muted: #9a9ab0;
            --border: #eaeaf0;
            --bg-page: #f5f6fa;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, .06);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, .09);
        }

        .show-wrapper {
            padding: 0.25rem 0 2.5rem;
        }

        /* ══════════════════════════════
        SHOW TOP BAR
        ══════════════════════════════ */
        .show-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border-radius: 12px;
            padding: 1.1rem 1.75rem;
            margin-bottom: 1.75rem;
            box-shadow: var(--shadow-sm);
            border-right: 5px solid var(--brand);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }

        .topbar-icon-wrap {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--brand), var(--brand-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .topbar-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-main);
            margin: 0 0 0.1rem;
            line-height: 1;
        }

        .topbar-subtitle {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin: 0;
        }

        .topbar-actions {
            display: flex;
            gap: 0.6rem;
        }

        .btn-teal {
            background: var(--teal);
            color: #fff !important;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            font-size: 0.83rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none !important;
            transition: background .2s, transform .15s;
        }

        .btn-teal:hover {
            background: var(--teal-dark);
            transform: translateY(-1px);
        }

        .btn-outline-back {
            background: #fff;
            color: var(--text-sub) !important;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            font-size: 0.83rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none !important;
            transition: background .2s, border-color .2s;
        }

        .btn-outline-back:hover {
            background: #f5f6fa;
            border-color: #ccc;
        }

        /* ══════════════════════════════
                           STATS GRID
                        ══════════════════════════════ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.1rem;
            margin-bottom: 1.75rem;
        }

        .scard {
            background: #fff;
            border-radius: 14px;
            padding: 1.4rem 1.5rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 1.1rem;
            border: 1.5px solid transparent;
            transition: transform .2s, box-shadow .2s, border-color .2s;
            position: relative;
            overflow: hidden;
        }

        .scard::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
            border-radius: 0 14px 14px 0;
        }

        .scard:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        /* colors */
        .scard.c-green {
            border-color: #e4f3d0;
        }

        .scard.c-green::before {
            background: var(--brand);
        }

        .scard.c-blue {
            border-color: #d5eef9;
        }

        .scard.c-blue::before {
            background: #3b9fd4;
        }

        .scard.c-orange {
            border-color: #fde9c8;
        }

        .scard.c-orange::before {
            background: #f5a623;
        }

        .scard.c-teal {
            border-color: #cce3e3;
        }

        .scard.c-teal::before {
            background: var(--teal);
        }

        .scard.c-purple {
            border-color: #ead8f7;
        }

        .scard.c-purple::before {
            background: #9b59b6;
        }

        .scard.c-gray {
            border-color: #e2e2ea;
        }

        .scard.c-gray::before {
            background: #6c757d;
        }

        .scard-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .scard.c-green .scard-icon {
            background: #eef7dc;
            color: var(--brand);
        }

        .scard.c-blue .scard-icon {
            background: #e0f1fb;
            color: #3b9fd4;
        }

        .scard.c-orange .scard-icon {
            background: #fef0d8;
            color: #f5a623;
        }

        .scard.c-teal .scard-icon {
            background: #dceee e;
            color: var(--teal);
        }

        .scard.c-purple .scard-icon {
            background: #f0e4fb;
            color: #9b59b6;
        }

        .scard.c-gray .scard-icon {
            background: #ececf1;
            color: #6c757d;
        }

        .scard-body {
            min-width: 0;
            flex: 1;
        }

        .scard-label {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 0.35rem;
        }

        .scard-value {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.25;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .scard-value.big {
            font-size: 1.6rem;
            color: var(--brand);
        }

        /* ══════════════════════════════
                           NOTES CARD
                        ══════════════════════════════ */
        .panel {
            background: #fff;
            border-radius: 14px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            overflow: hidden;
            border: 1.5px solid var(--border);
        }

        .panel-header {
            padding: 0.9rem 1.5rem;
            border-bottom: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.65rem;
            background: #fafbff;
        }

        .panel-header-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            background: #eef7dc;
            color: var(--brand);
            flex-shrink: 0;
        }

        .panel-header-title {
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--text-main);
        }

        .panel-badge {
            margin-right: auto;
            background: var(--brand);
            color: #fff;
            border-radius: 20px;
            padding: 0.15rem 0.75rem;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .panel-body {
            padding: 1.25rem 1.5rem;
        }

        .notes-text {
            font-size: 0.92rem;
            color: var(--text-sub);
            line-height: 1.85;
            padding: 0.9rem 1.1rem;
            background: #f8f9ff;
            border-radius: 8px;
            border-right: 3px solid var(--brand);
        }

        /* ══════════════════════════════
                           ATTACHMENTS
                        ══════════════════════════════ */
        .attachments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(155px, 1fr));
            gap: 1rem;
        }

        .att-card {
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            border: 1.5px solid var(--border);
            transition: box-shadow .2s, border-color .2s, transform .2s;
        }

        .att-card:hover {
            border-color: var(--brand);
            box-shadow: 0 6px 18px rgba(132, 186, 63, .15);
            transform: translateY(-2px);
        }

        .att-img-wrap {
            position: relative;
            overflow: hidden;
            height: 120px;
        }

        .att-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s;
        }

        .att-card:hover .att-img-wrap img {
            transform: scale(1.05);
        }

        .att-overlay {
            position: absolute;
            inset: 0;
            background: rgba(41, 96, 96, .45);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .2s;
        }

        .att-card:hover .att-overlay {
            opacity: 1;
        }

        .att-overlay-icon {
            width: 40px;
            height: 40px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--teal);
            font-size: 1.1rem;
        }

        .att-footer {
            padding: 0.55rem 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: #fafafa;
            border-top: 1.5px solid var(--border);
        }

        .att-name {
            font-size: 0.71rem;
            color: #666;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            flex: 1;
        }

        .att-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
            font-size: 0.72rem;
            font-weight: 700;
            color: #fff !important;
            background: var(--teal);
            border-radius: 5px;
            padding: 0.22rem 0.6rem;
            text-decoration: none !important;
            flex-shrink: 0;
            transition: background .2s;
        }

        .att-btn:hover,
        .att-btn:focus,
        .att-btn:active,
        .att-btn:visited {
            background: var(--teal-dark);
            color: #fff !important;
        }

        .att-btn-download {
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
            font-size: 0.72rem;
            font-weight: 700;
            color: #fff !important;
            background: var(--brand);
            border-radius: 5px;
            padding: 0.22rem 0.6rem;
            text-decoration: none !important;
            flex-shrink: 0;
            transition: background .2s;
        }

        .att-btn-download:hover,
        .att-btn-download:focus,
        .att-btn-download:active,
        .att-btn-download:visited {
            background: var(--brand-dark);
            color: #fff !important;
        }

        /* empty */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #c0c0d0;
        }

        .empty-state i {
            font-size: 3rem;
            display: block;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            font-size: 0.88rem;
            margin: 0;
        }

        /* ══════════════════════════════
                           RESPONSIVE
                        ══════════════════════════════ */
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .show-topbar {
                flex-direction: column;
                gap: 1rem;
            }

            .topbar-actions {
                justify-content: center;
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="show-wrapper">
        {{-- ══ TOP BAR ══ --}}
        <div class="show-topbar">
            <div class="topbar-left">
                <div class="topbar-icon-wrap">
                    <i class="fa fa-file-text"></i>
                </div>
                <div>
                    <p class="topbar-title">سجل استفادة &nbsp;<span style="color:var(--text-muted); font-weight:500;"># {{ $entry->id }}</span></p>
                    <p class="topbar-subtitle">
                        <i class="fa fa-clock-o"></i>
                        أُضيف في {{ optional($entry->created_at)->format('Y-m-d') }}
                    </p>
                </div>
            </div>
            <div class="topbar-actions">
              @can('تعديل سجل استفادة من برنامج الدعم')
                <a href="{{ route('admin.support-program-entries.edit', $entry->id) }}" class="btn-teal">
                    <i class="fa fa-pencil"></i> تعديل
                </a>
              @endcan
                <a href="{{ route('admin.support-program-entries.index') }}" class="btn-outline-back">
                    <i class="fa fa-arrow-right"></i> رجوع
                </a>
            </div>
        </div>

        {{-- ══ STATS ══ --}}
        <div class="stats-grid">
            <div class="scard c-green">
                <div class="scard-icon"><i class="fa fa-bookmark"></i></div>
                <div class="scard-body">
                    <div class="scard-label">برنامج الدعم</div>
                    <div class="scard-value">{{ $entry->program->name ?? '-' }}</div>
                </div>
            </div>
            <div class="scard c-blue">
                <div class="scard-icon"><i class="fa fa-users"></i></div>
                <div class="scard-body">
                    <div class="scard-label">الفئة المستفيدة</div>
                    <div class="scard-value">{{ $entry->category_label }}</div>
                </div>
            </div>
            <div class="scard c-orange">
                <div class="scard-icon"><i class="fa fa-user-circle"></i></div>
                <div class="scard-body">
                    <div class="scard-label">عدد المستفيدين</div>
                    <div class="scard-value big">{{ number_format($entry->beneficiaries_count) }}</div>
                </div>
            </div>
            <div class="scard c-teal">
                <div class="scard-icon"><i class="fa fa-university"></i></div>
                <div class="scard-body">
                    <div class="scard-label">الجهة الممولة</div>
                    <div class="scard-value">{{ $entry->funding_source ?: '-' }}</div>
                </div>
            </div>
            <div class="scard c-purple">
                <div class="scard-icon"><i class="fa fa-calendar"></i></div>
                <div class="scard-body">
                    <div class="scard-label">تاريخ الاستفادة</div>
                    <div class="scard-value">{{ optional($entry->date)->format('Y-m-d') ?: '-' }}</div>
                </div>
            </div>
            <div class="scard c-gray">
                <div class="scard-icon"><i class="fa fa-paperclip"></i></div>
                <div class="scard-body">
                    <div class="scard-label">عدد المرفقات</div>
                    <div class="scard-value big" style="color:#6c757d;">{{ $entry->attachments->count() }}</div>
                </div>
            </div>
        </div>

        {{-- ══ NOTES ══ --}}
        @if ($entry->notes)
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-header-icon"><i class="fa fa-sticky-note"></i></div>
                    <span class="panel-header-title">ملاحظات</span>
                </div>
                <div class="panel-body">
                    <div class="notes-text">{{ $entry->notes }}</div>
                </div>
            </div>
        @endif

        {{-- ══ ATTACHMENTS ══ --}}
        <div class="panel">
            <div class="panel-header">
                <div class="panel-header-icon"><i class="fa fa-paperclip"></i></div>
                <span class="panel-header-title">المرفقات والمستندات</span>
                <span class="panel-badge">{{ $entry->attachments->count() }}</span>
            </div>
            <div class="panel-body">
                @if ($entry->attachments->count())
                    <div class="attachments-grid">
                        @foreach ($entry->attachments as $attachment)
                            <div class="att-card">
                                <a href="{{ $attachment->url }}" target="_blank" class="att-img-wrap d-block">
                                    <img src="{{ $attachment->url }}" alt="{{ $attachment->original_name }}">
                                    <div class="att-overlay">
                                        <div class="att-overlay-icon"><i class="fa fa-eye"></i></div>
                                    </div>
                                </a>
                                <div class="att-footer">
                                    <span class="att-name" title="{{ $attachment->original_name }}">
                                        {{ $attachment->original_name }}
                                    </span>
                                    <div style="display:flex; gap: 0.3rem; flex-shrink:0;">
                                        <a href="{{ $attachment->url }}" target="_blank" class="att-btn" title="عرض">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ $attachment->url }}" download="{{ $attachment->original_name }}" class="att-btn-download" title="تحميل">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fa fa-folder-open-o"></i>
                        <p>لا توجد مرفقات مرتبطة بهذا السجل</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
