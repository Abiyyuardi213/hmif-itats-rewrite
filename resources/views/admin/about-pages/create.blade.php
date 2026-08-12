@extends('layouts.admin')

@section('title', 'Buat Halaman Tentang')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-slate-900">Buat Halaman</h1>
            <a href="{{ route('admin.about-pages.index') }}" class="text-sm text-slate-500 hover:text-slate-900">
                &larr; Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-rose-50 border border-rose-200">
                <div class="flex items-center gap-2 text-rose-700 font-bold mb-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Terdapat kesalahan pada input:</span>
                </div>
                <ul class="list-disc list-inside text-sm text-rose-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.about-pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left Column: Main Content --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="text-sm font-semibold text-slate-700">Judul Halaman <span
                                        class="text-rose-500">*</span></label>
                                <input type="text" name="title" required
                                    class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none"
                                    placeholder="Cth: Visi & Misi Kabinet REBOOT">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-sm font-semibold text-slate-700">Sub-judul / Badge (Opsional)</label>
                                <input type="text" name="subtitle"
                                    class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none"
                                    placeholder="Cth: HMIF 2024/2025" value="{{ old('subtitle') }}">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700">Konten Halaman <span
                                    class="text-rose-500">*</span></label>

                            {{-- Petunjuk Penomoran Misi --}}
                            <div class="p-3.5 bg-blue-50/80 border border-blue-100 rounded-xl text-xs text-blue-800 space-y-1">
                                <p class="font-bold flex items-center gap-1.5 text-blue-900">
                                    <svg class="w-4 h-4 text-blue-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    💡 Petunjuk Penomoran Misi:
                                </p>
                                <p class="text-blue-700 leading-relaxed">
                                    Gunakan ikon <b>Numbered List (1. 2. 3.)</b> pada toolbar Trix Editor di bawah. Poin Misi akan <b>otomatis bernomor urut (1, 2, 3, dst.)</b> dalam bentuk badge bundar hitam secara langsung pada editor dan halaman publik.
                                </p>
                            </div>

                            <input id="x" type="hidden" name="content" required value="{{ old('content') }}">
                            <trix-editor input="x"
                                class="trix-content border-slate-200 rounded-md min-h-[400px] bg-white outline-none p-4"></trix-editor>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Settings --}}
                <div class="space-y-6">
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-4">
                        <h2 class="font-semibold text-slate-900 border-b border-slate-100 pb-2">Pengaturan</h2>

                        <div class="space-y-3">
                            <label
                                class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50 transition-colors">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Aktifkan Halaman</p>
                                    <p class="text-xs text-slate-500">Halaman dapat diakses publik.</p>
                                </div>
                            </label>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Unique Key (Opsional)</label>
                            <input type="text" name="key"
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none"
                                placeholder="Cth: visi-misi">
                            <p class="text-[10px] text-slate-400">Gunakan key ini untuk memanggil konten khusus di kode
                                program.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-4">
                        <h2 class="font-semibold text-slate-900 border-b border-slate-100 pb-2">Media</h2>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Gambar Galeri (Bisa banyak)</label>
                            <div
                                class="border-2 border-dashed border-slate-200 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:bg-slate-50 transition-colors">
                                <input type="file" name="images[]" multiple accept="image/*"
                                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                                <p class="text-[10px] text-slate-400 mt-2">Max. 10MB per file. Format: JPG, PNG</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-2.5 bg-slate-900 text-slate-50 rounded-lg text-sm font-bold hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/10 active:scale-95">
                            Simpan Halaman
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        trix-editor ol {
            list-style: none !important;
            counter-reset: trix-misi-counter;
            padding: 0 !important;
            margin-top: 0.75rem !important;
            margin-bottom: 0.75rem !important;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        trix-editor ol li {
            counter-increment: trix-misi-counter;
            position: relative;
            padding: 0.75rem 1rem 0.75rem 3.25rem !important;
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.75rem !important;
            list-style: none !important;
            font-size: 0.9rem;
            line-height: 1.5;
            color: #334155;
        }
        trix-editor ol li::before {
            content: counter(trix-misi-counter);
            position: absolute;
            left: 0.75rem;
            top: 0.75rem;
            width: 1.6rem;
            height: 1.6rem;
            background-color: #0f172a;
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        trix-editor h3 {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            margin-top: 1.25rem !important;
            margin-bottom: 0.75rem !important;
        }
    </style>
@endsection
