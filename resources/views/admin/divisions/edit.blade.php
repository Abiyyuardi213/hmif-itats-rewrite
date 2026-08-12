@extends('layouts.admin')

@section('title', 'Edit Divisi')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.divisions.index') }}"
                class="text-sm font-bold text-slate-400 hover:text-primary flex items-center gap-2 mb-4 group transition-colors">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Divisi</h1>
            <p class="text-slate-500 mt-1">Perbarui informasi divisi.</p>
        </div>

        <form action="{{ route('admin.divisions.update', $division->id) }}" method="POST"
            class="space-y-6 bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Nama Divisi</label>
                <input type="text" name="name" required
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                    value="{{ old('name', $division->name) }}">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Deskripsi Divisi</label>
                <textarea name="description" rows="3"
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">{{ old('description', $division->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Icon Presets</label>
                    <select name="icon"
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                        <option value="">✨ Otomatis (Default)</option>
                        <option value="fa-users" {{ old('icon', $division->icon) == 'fa-users' ? 'selected' : '' }}>👥 Keorganisasian / BPH</option>
                        <option value="fa-laptop-code" {{ old('icon', $division->icon) == 'fa-laptop-code' ? 'selected' : '' }}>💻 Riset & Teknologi (Litbang)</option>
                        <option value="fa-bullhorn" {{ old('icon', $division->icon) == 'fa-bullhorn' ? 'selected' : '' }}>📢 Media & Informasi</option>
                        <option value="fa-palette" {{ old('icon', $division->icon) == 'fa-palette' ? 'selected' : '' }}>🎨 Desain & Kreatif</option>
                        <option value="fa-coins" {{ old('icon', $division->icon) == 'fa-coins' ? 'selected' : '' }}>💰 Kewirausahaan & Danus</option>
                        <option value="fa-trophy" {{ old('icon', $division->icon) == 'fa-trophy' ? 'selected' : '' }}>🏆 Minat & Bakat</option>
                        <option value="fa-hand-holding-heart" {{ old('icon', $division->icon) == 'fa-hand-holding-heart' ? 'selected' : '' }}>🤝 Pengabdian Masyarakat</option>
                        <option value="fa-layer-group" {{ old('icon', $division->icon) == 'fa-layer-group' ? 'selected' : '' }}>📁 Divisi Umum</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Tema Warna</label>
                    <select name="color"
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                        <option value="">✨ Otomatis (Default)</option>
                        <option value="bg-slate-800 text-white" {{ old('color', $division->color) == 'bg-slate-800 text-white' ? 'selected' : '' }}>⚫ Dark Slate (BPH / Netral)</option>
                        <option value="bg-blue-600 text-white" {{ old('color', $division->color) == 'bg-blue-600 text-white' ? 'selected' : '' }}>🔵 Biru (Teknologi / Utama)</option>
                        <option value="bg-emerald-600 text-white" {{ old('color', $division->color) == 'bg-emerald-600 text-white' ? 'selected' : '' }}>🟢 Hijau (Riset / Inkubasi)</option>
                        <option value="bg-purple-600 text-white" {{ old('color', $division->color) == 'bg-purple-600 text-white' ? 'selected' : '' }}>🟣 Ungu (Kreatif / Media)</option>
                        <option value="bg-amber-600 text-white" {{ old('color', $division->color) == 'bg-amber-600 text-white' ? 'selected' : '' }}>🟡 Kuning (Humas / Publik)</option>
                        <option value="bg-rose-600 text-white" {{ old('color', $division->color) == 'bg-rose-600 text-white' ? 'selected' : '' }}>🔴 Merah (Event / Talenta)</option>
                        <option value="bg-cyan-600 text-white" {{ old('color', $division->color) == 'bg-cyan-600 text-white' ? 'selected' : '' }}>🌐 Cyan (Eksternal)</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Urutan Tampilan</label>
                    <input type="number" name="order" required
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                        value="{{ old('order', $division->order) }}">
                </div>
            </div>

            <button type="submit"
                class="w-full h-12 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-xl shadow-slate-900/20 hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
