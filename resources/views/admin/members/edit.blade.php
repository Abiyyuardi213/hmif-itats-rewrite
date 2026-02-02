@extends('layouts.admin')

@section('title', 'Edit Anggota Himpunan')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.members.index') }}"
                class="text-sm font-bold text-slate-400 hover:text-primary flex items-center gap-2 mb-4 group transition-colors">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Anggota</h1>
            <p class="text-slate-500 mt-1">Perbarui informasi anggota himpunan.</p>
        </div>

        <form action="{{ route('admin.members.update', $member->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white p-8 rounded-[2rem] border border-slate-200 shadow-sm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" required
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                        value="{{ old('name', $member->name) }}">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">NPM</label>
                    <input type="text" name="npm" placeholder="Contoh: 06.2021.1.074XX"
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                        value="{{ old('npm', $member->npm) }}">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Jabatan</label>
                    <select name="position_id" required
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}"
                                {{ $member->position_id == $position->id ? 'selected' : '' }}>{{ $position->name }}
                                ({{ $position->type }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Divisi (Opsional)</label>
                    <select name="division_id"
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                        <option value="">- Tanpa Divisi -</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ $member->division_id == $division->id ? 'selected' : '' }}>{{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Foto Anggota</label>
                <div class="flex items-center gap-4 mb-2">
                    @if ($member->image)
                        <img src="{{ asset('storage/' . $member->image) }}"
                            class="w-16 h-16 rounded-xl object-cover ring-1 ring-slate-200">
                    @endif
                    <input type="file" name="image"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-900 file:text-white hover:file:bg-slate-800">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Instagram URL</label>
                    <input type="url" name="instagram_url"
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                        value="{{ old('instagram_url', $member->instagram_url) }}">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">LinkedIn URL</label>
                    <input type="url" name="linkedin_url"
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                        value="{{ old('linkedin_url', $member->linkedin_url) }}">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 ml-1">Urutan Tampilan</label>
                <input type="number" name="order" required
                    class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                    value="{{ old('order', $member->order) }}">
            </div>

            <button type="submit"
                class="w-full h-12 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-xl shadow-slate-900/20 hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
