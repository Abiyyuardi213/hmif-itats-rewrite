@extends('layouts.admin')

@section('title', 'Tambah Jabatan')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.positions.index') }}"
                class="text-sm font-bold text-slate-400 hover:text-primary flex items-center gap-2 mb-4 group transition-colors">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Tambah Jabatan</h1>
            <p class="text-slate-500 mt-1">Definisikan jabatan baru dalam organisasi.</p>
        </div>

        <form action="{{ route('admin.positions.store') }}" method="POST"
            class="space-y-6 bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm">
            @csrf

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Nama Jabatan</label>
                <input type="text" name="name" required placeholder="Contoh: Ketua Himpunan, Sekretaris Umum, Anggota"
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                    value="{{ old('name') }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Tipe</label>
                    <select name="type" required
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                        <option value="inti" {{ old('type') == 'inti' ? 'selected' : '' }}>Pengurus Inti</option>
                        <option value="divisi" {{ old('type') == 'divisi' ? 'selected' : '' }}>Divisi</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Urutan Tampilan</label>
                    <input type="number" name="order" required
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                        value="{{ old('order', 0) }}">
                </div>
            </div>

            <button type="submit"
                class="w-full h-12 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-xl shadow-slate-900/20 hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
                Simpan Jabatan
            </button>
        </form>
    </div>
@endsection
