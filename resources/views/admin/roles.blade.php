@extends('layouts.admin')

@section('title', 'Manajemen Role')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Manajemen Role</h1>
                <p class="text-slate-500 mt-1">Kelola hak akses pengguna dalam sistem.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Role Saat Ini</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($users as $user)
                            <tr class="bg-white hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-900">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-600">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $badgeColor = match ($user->role) {
                                            'super_admin' => 'bg-red-100 text-red-700 border-red-200',
                                            'admin' => 'bg-blue-100 text-blue-700 border-blue-200',
                                            'ketua_hima' => 'bg-purple-100 text-purple-700 border-purple-200',
                                            'sekretaris' => 'bg-pink-100 text-pink-700 border-pink-200',
                                            'bendahara' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            default => 'bg-slate-100 text-slate-700 border-slate-200',
                                        };
                                        $roleLabel = ucwords(str_replace('_', ' ', $user->role));
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $badgeColor }}">
                                        {{ $roleLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ url('/admin/role/' . $user->id) }}" method="POST"
                                        class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="role"
                                            class="bg-slate-50 border border-slate-300 text-slate-900 text-xs rounded-lg focus:ring-primary focus:border-primary block p-2">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User
                                            </option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="super_admin"
                                                {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                            <option value="ketua_hima" {{ $user->role == 'ketua_hima' ? 'selected' : '' }}>
                                                Ketua Hima</option>
                                            <option value="sekretaris" {{ $user->role == 'sekretaris' ? 'selected' : '' }}>
                                                Sekretaris</option>
                                            <option value="bendahara" {{ $user->role == 'bendahara' ? 'selected' : '' }}>
                                                Bendahara</option>
                                        </select>
                                        <button type="submit"
                                            class="text-white bg-slate-900 hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-xs px-3 py-2 transition-colors">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
