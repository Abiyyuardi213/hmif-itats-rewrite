@extends('layouts.admin')

@section('title', 'Edit Halaman Tentang')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-slate-900">Edit Halaman</h1>
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

        <form action="{{ route('admin.about-pages.update', $aboutPage) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left Column: Main Content --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-6">
                        <div class="space-y-1.5">
                            <label class="text-sm font-semibold text-slate-700">Judul Halaman <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" name="title" required value="{{ old('title', $aboutPage->title) }}"
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none"
                                placeholder="Cth: Visi & Misi">
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-semibold text-slate-700">Konten Halaman <span
                                    class="text-rose-500">*</span></label>
                            <input id="x" type="hidden" name="content" required
                                value="{{ old('content', $aboutPage->content) }}">
                            <trix-editor input="x"
                                class="trix-content border-slate-200 rounded-md min-h-[400px] bg-white outline-none"></trix-editor>
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
                                <input type="checkbox" name="is_active" value="1"
                                    {{ $aboutPage->is_active ? 'checked' : '' }}
                                    class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Aktifkan Halaman</p>
                                    <p class="text-xs text-slate-500">Halaman dapat diakses publik.</p>
                                </div>
                            </label>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-semibold text-slate-700">Unique Key (Opsional)</label>
                            <input type="text" name="key" value="{{ old('key', $aboutPage->key) }}"
                                class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all outline-none"
                                placeholder="Cth: visi-misi">
                            <p class="text-[10px] text-slate-400">Gunakan key ini untuk memanggil konten khusus di kode
                                program.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 space-y-4">
                        <h2 class="font-semibold text-slate-900 border-b border-slate-100 pb-2">Media</h2>

                        <div class="space-y-4">
                            <label class="text-xs font-semibold text-slate-700">Gambar Galeri</label>

                            {{-- Existing Images --}}
                            @if ($aboutPage->images->count() > 0)
                                <div class="grid grid-cols-2 gap-2 mb-3">
                                    @foreach ($aboutPage->images as $img)
                                        <div class="relative group rounded-md overflow-hidden border border-slate-200">
                                            <img src="{{ asset('storage/' . $img->image) }}"
                                                class="w-full h-20 object-cover">
                                            <div
                                                class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <label class="cursor-pointer">
                                                    <input type="checkbox" name="delete_images[]"
                                                        value="{{ $img->id }}" class="hidden peer">
                                                    <div
                                                        class="bg-white text-rose-600 px-2 py-1 rounded text-[10px] font-bold peer-checked:bg-rose-600 peer-checked:text-white transition-colors">
                                                        Hapus
                                                    </div>
                                                </label>
                                            </div>
                                            {{-- Visual indicator if checked (requires JS or simplified approach, using simple checkbox below image instead) --}}
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-[10px] text-slate-400 mb-3">*Centang "Hapus" pada gambar yang ingin dihapus,
                                    lalu simpan.</p>
                            @endif

                            {{-- Upload New --}}
                            <div
                                class="border-2 border-dashed border-slate-200 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:bg-slate-50 transition-colors">
                                <input type="file" name="images[]" multiple accept="image/*"
                                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                                <p class="text-[10px] text-slate-400 mt-2">Upload baru (Max. 10MB/file)</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-2.5 bg-slate-900 text-slate-50 rounded-lg text-sm font-bold hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/10 active:scale-95">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
