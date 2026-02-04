@extends('layouts.admin')

@section('title', 'Tulis Artikel Kegiatan')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-slate-900">Tulis Artikel Baru</h1>
            <a href="{{ route('admin.activity-reports.index') }}" class="text-sm text-slate-500 hover:text-slate-900">
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

        <form action="{{ route('admin.activity-reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left Column: Main Content --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-6">
                        <div class="space-y-1.5">
                            <label class="text-sm font-semibold text-slate-700">Judul Artikel <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" name="title" required
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none"
                                placeholder="Judul menarik untuk artikel...">
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-semibold text-slate-700">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" rows="3"
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none placeholder-slate-400"
                                placeholder="Ringkasan singkat artikel yang akan muncul di daftar..."></textarea>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-semibold text-slate-700">Isi Artikel (Cerita Lengkap) <span
                                    class="text-rose-500">*</span></label>
                            <input id="x" type="hidden" name="content" required value="{{ old('content') }}">
                            <trix-editor input="x"
                                class="trix-content border-slate-200 rounded-md min-h-[400px] bg-white outline-none"></trix-editor>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Settings --}}
                <div class="space-y-6">
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-4">
                        <h2 class="font-semibold text-slate-900 border-b border-slate-100 pb-2">Pengaturan Publikasi</h2>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Status</label>
                            <select name="status"
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none bg-white">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Program Kerja Terkait <span
                                    class="text-rose-500">*</span></label>
                            <select name="work_program_id" required
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none bg-white">
                                <option value="">Pilih Program</option>
                                @foreach ($programs as $prog)
                                    <option value="{{ $prog->id }}">{{ $prog->name }}
                                        ({{ $prog->start_date ? \Carbon\Carbon::parse($prog->start_date)->format('d M Y') : 'TBA' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-4">
                        <h2 class="font-semibold text-slate-900 border-b border-slate-100 pb-2">Media</h2>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Gambar Cover</label>
                            <div
                                class="border-2 border-dashed border-slate-200 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:bg-slate-50 transition-colors">
                                <input type="file" name="image" accept="image/*"
                                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                                <p class="text-[10px] text-slate-400 mt-2">Max. 10MB. Format: JPG, PNG</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-2.5 bg-slate-900 text-slate-50 rounded-lg text-sm font-bold hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/10 active:scale-95">
                            Simpan Artikel
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
