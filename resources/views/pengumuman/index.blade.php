@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8 space-y-8 min-h-screen bg-background" x-data="pengumumanApp()">

        {{-- Filter Buttons --}}
        <div class="flex flex-wrap gap-3 justify-center">
            <button @click="filter = 'semua'"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 capitalize"
                :class="filter === 'semua' ? 'bg-primary text-primary-foreground hover:bg-primary/90' :
                    'border border-input bg-background hover:bg-accent hover:text-accent-foreground'">
                Semua
            </button>
            <button @click="filter = 'pengumuman'"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 capitalize"
                :class="filter === 'pengumuman' ? 'bg-primary text-primary-foreground hover:bg-primary/90' :
                    'border border-input bg-background hover:bg-accent hover:text-accent-foreground'">
                Pengumuman
            </button>
            <button @click="filter = 'berita'"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 capitalize"
                :class="filter === 'berita' ? 'bg-primary text-primary-foreground hover:bg-primary/90' :
                    'border border-input bg-background hover:bg-accent hover:text-accent-foreground'">
                Berita
            </button>
        </div>

        {{-- Empty State --}}
        <div x-show="filteredPosts.length === 0" class="text-center py-12" style="display: none;">
            <p class="text-muted-foreground mb-4"
                x-text="filter === 'semua' ? 'Belum ada pengumuman' : 'Belum ada ' + filter"></p>
        </div>

        {{-- Announcements Grid --}}
        <div class="grid gap-6 md:gap-8">


            <template x-for="post in filteredPosts" :key="post.id">
                <a :href="'/pengumuman/' + post.slug">
                    <div
                        class="group relative overflow-hidden rounded-xl border border-border/50 bg-card/80 backdrop-blur-sm hover:bg-card transition-all duration-300 hover:shadow-xl hover:shadow-primary/20 cursor-pointer">
                        <div class="md:flex">
                            {{-- Image Section --}}
                            <div class="md:w-1/3 lg:w-1/4">
                                <div class="relative h-48 md:h-full overflow-hidden">
                                    <img :src="post.image || '/placeholder.svg'" :alt="post.title"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                            </div>

                            {{-- Content Section --}}
                            <div class="md:w-2/3 lg:w-3/4 p-6 md:p-8">
                                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-8">
                                    {{-- Date Box --}}
                                    <div class="flex-shrink-0">
                                        <div class="text-center p-4 bg-muted/50 rounded-lg border border-border/50">
                                            <div class="text-2xl font-bold text-primary" x-text="getDay(post.date)"></div>
                                            <div class="text-sm text-muted-foreground">
                                                <span x-text="getMonth(post.date)"></span> <span
                                                    x-text="getYear(post.date)"></span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Details --}}
                                    <div class="flex-1 space-y-4">
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent"
                                                :class="getCategoryColor(post.category)" x-text="post.category"></span>
                                            <span
                                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent"
                                                :class="getPriorityColor(post.priority)" x-text="post.priority"></span>
                                        </div>

                                        <h3 class="text-xl md:text-2xl font-bold text-foreground group-hover:text-primary transition-colors text-balance"
                                            x-text="post.title"></h3>

                                        <p class="text-muted-foreground leading-relaxed text-pretty" x-text="post.excerpt">
                                        </p>

                                        <div class="flex flex-wrap gap-2">
                                            <template x-for="tag in post.tags">
                                                <span
                                                    class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground border-border">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z" />
                                                        <path d="M7 7h.01" />
                                                    </svg>
                                                    <span x-text="tag"></span>
                                                </span>
                                            </template>
                                        </div>

                                        <div class="flex items-center justify-between pt-4 border-t border-border/50">
                                            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg>
                                                <span x-text="post.author_name"></span>
                                            </div>

                                            <span
                                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-9 px-3 group-hover:bg-primary/10 group-hover:text-primary bg-transparent text-primary">
                                                Baca Selengkapnya
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14" />
                                                    <path d="m12 5 7 7-7 7" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Hover Gradient --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                        </div>
                    </div>
                </a>
            </template>
        </div>
    </div>

    {{-- Script Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function pengumumanApp() {
            return {
                filter: 'semua',
                posts: @json($postsData),

                get filteredPosts() {
                    return this.posts.filter(post => {
                        // Assumption: backend sends already active posts or we check 'is_active'
                        if (post.is_active === false) return false;
                        if (this.filter === 'semua') return true;
                        return post.category === this.filter;
                    });
                },

                getCategoryColor(category) {
                    return category === 'pengumuman' ?
                        'bg-purple-100 text-purple-700 border-purple-200' :
                        'bg-blue-100 text-blue-700 border-blue-200';
                },

                getPriorityColor(priority) {
                    switch (priority) {
                        case 'tinggi':
                            return 'bg-red-100 text-red-700 border-red-200';
                        case 'sedang':
                            return 'bg-yellow-100 text-yellow-700 border-yellow-200';
                        case 'rendah':
                            return 'bg-green-100 text-green-700 border-green-200';
                        default:
                            return 'bg-muted text-muted-foreground';
                    }
                },

                // Date Formatting Utilities
                getDay(dateString) {
                    return new Date(dateString).getDate();
                },
                getMonth(dateString) {
                    return new Date(dateString).toLocaleDateString('id-ID', {
                        month: 'short'
                    });
                },
                getYear(dateString) {
                    return new Date(dateString).getFullYear();
                }
            }
        }
    </script>
@endsection
