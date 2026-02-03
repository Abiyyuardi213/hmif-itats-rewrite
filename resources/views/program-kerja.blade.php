@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-background" x-data="programKerjaApp()">
        {{-- Header Sticky --}}
        <div class="border-b border-border bg-card/50 backdrop-blur-sm sticky top-0 z-10 transition-all duration-200">
            <div class="max-w-7xl mx-auto px-6 py-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-4xl font-bold text-balance mb-2">Program Kerja</h1>
                        <p class="text-muted-foreground text-lg">Himpunan Mahasiswa Teknik Informatika</p>
                        <p class="text-sm text-muted-foreground mt-1">Periode 2025/2026</p>
                    </div>
                    <div class="text-left md:text-right">
                        <div class="text-sm text-muted-foreground mb-1">Total Program</div>
                        {{-- Assuming $programs is passed from Controller --}}
                        <div class="text-3xl font-bold text-primary" x-text="programs.length">0</div>
                    </div>
                </div>

                {{-- Filter Buttons --}}
                <div class="flex flex-wrap gap-3">
                    <button @click="filterStatus = 'all'"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2"
                        :class="filterStatus === 'all' ? 'bg-primary text-primary-foreground hover:bg-primary/90' :
                            'border border-input bg-background hover:bg-accent hover:text-accent-foreground'">
                        Semua Program
                    </button>

                    {{-- Selesai --}}
                    <button @click="filterStatus = 'selesai'"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2"
                        :class="filterStatus === 'selesai' ? 'bg-primary text-primary-foreground hover:bg-primary/90' :
                            'border border-input bg-background hover:bg-accent hover:text-accent-foreground'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                        Selesai
                    </button>

                    {{-- Sedang Berjalan --}}
                    <button @click="filterStatus = 'berjalan'"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2"
                        :class="filterStatus === 'berjalan' ? 'bg-primary text-primary-foreground hover:bg-primary/90' :
                            'border border-input bg-background hover:bg-accent hover:text-accent-foreground'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polygon points="10 8 16 12 10 16 10 8" />
                        </svg>
                        Sedang Berjalan
                    </button>

                    {{-- Akan Datang --}}
                    <button @click="filterStatus = 'mendatang'"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2"
                        :class="filterStatus === 'mendatang' ? 'bg-primary text-primary-foreground hover:bg-primary/90' :
                            'border border-input bg-background hover:bg-accent hover:text-accent-foreground'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        Akan Datang
                    </button>
                </div>
            </div>
        </div>

        {{-- Timeline Content --}}
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="relative">
                {{-- Timeline Line --}}
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-border timeline-line"></div>

                {{-- Timeline Items --}}
                <div class="space-y-12">
                    <template x-for="program in filteredPrograms" :key="program.id">
                        <div class="relative flex items-start gap-8">
                            {{-- Timeline Dot --}}
                            <div class="relative flex items-center justify-center w-16 h-16 rounded-full shrink-0 glow-effect"
                                :class="getStatusColorClass(program.status)">
                                <template x-if="program.status === 'selesai'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="m9 12 2 2 4-4" />
                                    </svg>
                                </template>
                                <template x-if="program.status === 'berjalan'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polygon points="10 8 16 12 10 16 10 8" />
                                    </svg>
                                </template>
                                <template x-if="program.status === 'mendatang'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                </template>
                            </div>

                            {{-- Content Card --}}
                            <div class="flex-1 p-8 rounded-xl bg-card/80 backdrop-blur-sm border border-border hover:bg-card/90 transition-all duration-300 cursor-pointer shadow-sm"
                                @click="openModal(program)">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-4">
                                            <span
                                                class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold"
                                                :class="getStatusBadgeClass(program.status)"
                                                x-text="getStatusLabel(program.status)"></span>
                                            <span
                                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold text-muted-foreground border-border">
                                                <span x-text="program.department"></span>
                                            </span>
                                        </div>

                                        <h3 class="text-2xl font-bold text-balance mb-3" x-text="program.title"></h3>
                                        <p class="text-muted-foreground text-pretty mb-6 leading-relaxed"
                                            x-text="program.description"></p>

                                        {{-- Progress Bar for Ongoing --}}
                                        <template x-if="program.status === 'berjalan'">
                                            <div class="mb-6">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-sm font-medium">Progress</span>
                                                    <span class="text-sm text-muted-foreground"
                                                        x-text="program.progress + '%'"></span>
                                                </div>
                                                <div class="w-full bg-secondary rounded-full h-2">
                                                    <div class="bg-primary h-2 rounded-full transition-all duration-300"
                                                        :style="'width: ' + program.progress + '%'"></div>
                                                </div>
                                            </div>
                                        </template>

                                        {{-- Details --}}
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                            <div class="flex items-center gap-2 text-muted-foreground">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect width="18" height="18" x="3" y="4" rx="2"
                                                        ry="2" />
                                                    <line x1="16" x2="16" y1="2" y2="6" />
                                                    <line x1="8" x2="8" y1="2" y2="6" />
                                                    <line x1="3" x2="21" y1="10" y2="10" />
                                                </svg>
                                                <span x-text="formatDate(program.startDate)"></span>
                                            </div>
                                            <div class="flex items-center gap-2 text-muted-foreground">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                    <circle cx="9" cy="7" r="4" />
                                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                </svg>
                                                <span x-text="program.participants + ' peserta'"></span>
                                            </div>
                                            <div class="flex items-center gap-2 text-muted-foreground">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <circle cx="12" cy="12" r="6" />
                                                    <circle cx="12" cy="12" r="2" />
                                                </svg>
                                                <span x-text="program.budget"></span>
                                            </div>
                                        </div>

                                        <div class="mt-4 text-sm text-primary/70 hover:text-primary transition-colors">
                                            Klik untuk melihat detail lengkap →
                                        </div>
                                    </div>

                                    {{-- Date Badge --}}
                                    <div class="text-right hidden lg:block">
                                        <div class="bg-secondary/50 rounded-lg p-4 min-w-[140px]">
                                            <div class="flex items-center justify-center gap-2 mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect width="18" height="18" x="3" y="4" rx="2"
                                                        ry="2" />
                                                    <line x1="16" x2="16" y1="2" y2="6" />
                                                    <line x1="8" x2="8" y1="2" y2="6" />
                                                    <line x1="3" x2="21" y1="10" y2="10" />
                                                    <path d="M8 14h.01" />
                                                    <path d="M12 14h.01" />
                                                    <path d="M16 14h.01" />
                                                    <path d="M8 18h.01" />
                                                    <path d="M12 18h.01" />
                                                    <path d="M16 18h.01" />
                                                </svg>
                                                <span
                                                    class="text-xs font-medium text-muted-foreground uppercase tracking-wide">Periode</span>
                                            </div>
                                            <div class="text-sm font-medium" x-text="formatDate(program.startDate)"></div>
                                            <div class="text-xs text-muted-foreground"
                                                x-text="'s/d ' + formatDate(program.endDate)"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Summary Stats --}}
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Selesai -->
                <div class="p-6 rounded-lg bg-card/50 backdrop-blur-sm border border-border">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-lg bg-gradient-to-br from-green-500 to-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-bold" x-text="programs.filter(p => p.status === 'selesai').length">0
                            </div>
                            <div class="text-sm text-muted-foreground">Selesai</div>
                        </div>
                    </div>
                </div>

                <!-- Sedang Berjalan -->
                <div class="p-6 rounded-lg bg-card/50 backdrop-blur-sm border border-border">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-lg bg-gradient-to-br from-orange-500 to-orange-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polygon points="10 8 16 12 10 16 10 8" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-bold" x-text="programs.filter(p => p.status === 'berjalan').length">
                                0
                            </div>
                            <div class="text-sm text-muted-foreground">Sedang Berjalan</div>
                        </div>
                    </div>
                </div>

                <!-- Akan Datang -->
                <div class="p-6 rounded-lg bg-card/50 backdrop-blur-sm border border-border">
                    <div class="flex items-center gap-4">
                        <div class="p-3 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-bold"
                                x-text="programs.filter(p => p.status === 'mendatang').length">
                                0</div>
                            <div class="text-sm text-muted-foreground">Akan Datang</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div x-show="selectedProgram" style="display: none;"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="closeModal()">
            <div class="bg-card rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-lg"
                x-show="selectedProgram" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                <template x-if="selectedProgram">
                    <div class="relative">
                        {{-- Modal Header --}}
                        <div
                            class="sticky top-0 bg-card border-b border-border p-6 flex items-center justify-between z-10">
                            <div>
                                <h2 class="text-2xl font-bold text-balance" x-text="selectedProgram.title"></h2>
                                <p class="text-muted-foreground" x-text="selectedProgram.department"></p>
                            </div>
                            <button @click="closeModal()"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors hover:bg-secondary h-10 w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M18 6 6 18" />
                                    <path d="m6 6 12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="p-6 space-y-8">
                            {{-- Status & Info --}}
                            <div class="flex flex-wrap gap-4">
                                <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold"
                                    :class="getStatusBadgeClass(selectedProgram.status)"
                                    x-text="getStatusLabel(selectedProgram.status)"></span>
                                <div class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                        <line x1="16" x2="16" y1="2" y2="6" />
                                        <line x1="8" x2="8" y1="2" y2="6" />
                                        <line x1="3" x2="21" y1="10" y2="10" />
                                    </svg>
                                    <span
                                        x-text="formatDate(selectedProgram.startDate) + ' - ' + formatDate(selectedProgram.endDate)"></span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span x-text="selectedProgram.location"></span>
                                </div>
                            </div>

                            {{-- Detailed Desc --}}
                            <div>
                                <h3 class="text-lg font-semibold mb-3">Deskripsi Program</h3>
                                <p class="text-muted-foreground leading-relaxed"
                                    x-text="selectedProgram.detailedDescription"></p>
                            </div>

                            {{-- Leader --}}
                            <div>
                                <h3 class="text-lg font-semibold mb-3">Ketua Program</h3>
                                <div class="flex items-center gap-3 p-4 bg-secondary/30 rounded-lg">
                                    <img :src="selectedProgram.leaderAvatar || '/placeholder.svg'"
                                        :alt="selectedProgram.leader" class="w-12 h-12 rounded-full object-cover">
                                    <div>
                                        <div class="font-medium" x-text="selectedProgram.leader"></div>
                                        <div class="text-sm text-muted-foreground">Ketua Program Kerja</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Team --}}
                            <div>
                                <h3 class="text-lg font-semibold mb-3">Tim Pelaksana</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <template x-for="member in selectedProgram.team">
                                        <div class="flex items-center gap-3 p-3 bg-secondary/20 rounded-lg">
                                            <img :src="member.avatar || '/placeholder.svg'" :alt="member.name"
                                                class="w-10 h-10 rounded-full object-cover">
                                            <div>
                                                <div class="font-medium text-sm" x-text="member.name"></div>
                                                <div class="text-xs text-muted-foreground" x-text="member.role"></div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            {{-- Stats --}}
                            <div>
                                <h3 class="text-lg font-semibold mb-3">Informasi Program</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="p-4 bg-secondary/20 rounded-lg text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mb-2 text-primary"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                        <div class="text-2xl font-bold" x-text="selectedProgram.participants"></div>
                                        <div class="text-sm text-muted-foreground">Peserta</div>
                                    </div>
                                    <div class="p-4 bg-secondary/20 rounded-lg text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mb-2 text-primary"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <circle cx="12" cy="12" r="6" />
                                            <circle cx="12" cy="12" r="2" />
                                        </svg>
                                        <div class="text-lg font-bold" x-text="selectedProgram.budget"></div>
                                        <div class="text-sm text-muted-foreground">Anggaran</div>
                                    </div>
                                    <div class="p-4 bg-secondary/20 rounded-lg text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-auto mb-2 text-primary"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                        <div class="text-2xl font-bold" x-text="selectedProgram.team.length + 1"></div>
                                        <div class="text-sm text-muted-foreground">Tim Inti</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Progress --}}
                            <template x-if="selectedProgram.status === 'berjalan'">
                                <div>
                                    <h3 class="text-lg font-semibold mb-3">Progress Program</h3>
                                    <div class="p-4 bg-secondary/20 rounded-lg">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="font-medium">Kemajuan Pelaksanaan</span>
                                            <span class="text-lg font-bold text-primary"
                                                x-text="selectedProgram.progress + '%'"></span>
                                        </div>
                                        <div class="w-full bg-secondary rounded-full h-3">
                                            <div class="bg-primary h-3 rounded-full transition-all duration-300"
                                                :style="'width: ' + selectedProgram.progress + '%'"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            {{-- Photos --}}
                            <template x-if="selectedProgram.photos.length > 0">
                                <div>
                                    <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                            <circle cx="12" cy="13" r="3" />
                                        </svg>
                                        Dokumentasi
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <template x-for="(photo, index) in selectedProgram.photos">
                                            <div class="relative group">
                                                <img :src="photo || '/placeholder.svg'"
                                                    class="w-full h-48 object-cover rounded-lg">
                                                <div
                                                    class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors rounded-lg">
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <template x-if="selectedProgram.photos.length === 0 && selectedProgram.status === 'mendatang'">
                                <div>
                                    <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                            <circle cx="12" cy="13" r="3" />
                                        </svg>
                                        Dokumentasi
                                    </h3>
                                    <div class="p-8 bg-secondary/20 rounded-lg text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-12 h-12 mx-auto mb-3 text-muted-foreground" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                            <circle cx="12" cy="13" r="3" />
                                        </svg>
                                        <p class="text-muted-foreground">Dokumentasi akan tersedia setelah program
                                            dilaksanakan</p>
                                    </div>
                                </div>
                            </template>

                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- Script Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function programKerjaApp() {
            return {
                filterStatus: 'all', // all, selesai, berjalan, mendatang
                selectedProgram: null,
                programs: @json($programs ?? []), // Inject data from Laravel

                get filteredPrograms() {
                    if (this.filterStatus === 'all') {
                        return this.programs;
                    }
                    return this.programs.filter(p => p.status === this.filterStatus);
                },

                openModal(program) {
                    this.selectedProgram = program;
                    document.body.style.overflow = 'hidden'; // Prevent scroll
                },

                closeModal() {
                    this.selectedProgram = null;
                    document.body.style.overflow = ''; // Restore scroll (better than 'auto')
                },

                // Watcher equivalent using Alpine effect if needed, usually x-effect
                // But simple methods are enough here

                formatDate(dateString) {
                    if (!dateString) return '-';
                    const options = {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    };
                    return new Date(dateString).toLocaleDateString('id-ID', options);
                },

                getStatusColorClass(status) {
                    // Corresponds to tailwind classes from React version
                    switch (status) {
                        case 'selesai':
                            return 'bg-gradient-to-br from-green-500 to-green-600';
                        case 'berjalan':
                            return 'bg-gradient-to-br from-orange-500 to-orange-600';
                        case 'mendatang':
                            return 'bg-gradient-to-br from-blue-500 to-blue-600';
                        default:
                            return 'bg-gray-500';
                    }
                },

                getStatusBadgeClass(status) {
                    switch (status) {
                        case 'selesai':
                            return 'bg-green-500/10 text-green-600 border-green-500/20';
                        case 'berjalan':
                            return 'bg-orange-500/10 text-orange-600 border-orange-500/20';
                        case 'mendatang':
                            return 'bg-blue-500/10 text-blue-600 border-blue-500/20';
                        default:
                            return 'bg-gray-100 text-gray-800';
                    }
                },

                getStatusLabel(status) {
                    switch (status) {
                        case 'selesai':
                            return 'Selesai';
                        case 'berjalan':
                            return 'Sedang Berjalan';
                        case 'mendatang':
                            return 'Akan Datang';
                        default:
                            return status;
                    }
                }
            }
        }
    </script>
@endsection
