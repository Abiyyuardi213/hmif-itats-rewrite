@extends('layouts.admin')

@section('title', 'Pesanan Merchandise')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                    <span class="hover:text-slate-600 transition-colors">Admin</span>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-slate-900">Pesanan Merchandise</span>
                </nav>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Pesanan Merchandise</h1>
                <p class="text-sm text-slate-500">Kelola dan pantau pesanan merchandise dari pembeli.</p>
            </div>

            <a href="{{ route('admin.payment-methods.index') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-white rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm">
                <i class="fas fa-wallet mr-2"></i>
                Kelola Metode Pembayaran
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pesanan</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $orders->count() }}</p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pending</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight text-amber-600">
                    {{ $orders->where('status', 'pending')->count() }}
                </p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Diproses</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight text-blue-600">
                    {{ $orders->whereIn('status', ['confirmed', 'processing', 'shipped'])->count() }}
                </p>
            </div>
            <div class="p-4 bg-white border border-slate-200 rounded-lg shadow-sm">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Selesai</p>
                <p class="text-2xl font-bold text-slate-900 tracking-tight text-emerald-600">
                    {{ $orders->where('status', 'completed')->count() }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/30">
                <div class="relative max-w-sm">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i class="fas fa-search text-xs"></i>
                    </span>
                    <input type="text" id="search" onkeyup="filterTable()"
                        placeholder="Cari nama pembeli atau produk..."
                        class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md bg-white text-sm focus:outline-none focus:ring-2 focus:ring-slate-900/5 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto text-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200">
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Pembeli</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Produk</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($orders as $order)
                            <tr class="group hover:bg-slate-50/40 transition-colors order-row">
                                <td class="px-6 py-4 font-mono text-xs text-slate-500">#{{ $order->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-semibold text-slate-900 search-customer">{{ $order->customer_name }}</span>
                                        <span class="text-xs text-slate-500">{{ $order->customer_phone }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-10 h-10 rounded bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0">
                                            @if ($order->merchandise->image)
                                                <img src="{{ asset('storage/' . $order->merchandise->image) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <i class="fas fa-tshirt text-xs"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <span
                                                class="font-medium text-slate-900 search-product">{{ $order->merchandise->name }}</span>
                                            <div class="text-xs text-slate-500">
                                                {{ $order->quantity }}x
                                                @if ($order->size)
                                                    <span
                                                        class="ml-1 px-1.5 py-0.5 bg-slate-100 rounded text-[10px] font-medium">{{ $order->size }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusConfig = [
                                            'pending' => [
                                                'bg' => 'bg-amber-50',
                                                'text' => 'text-amber-700',
                                                'border' => 'border-amber-100',
                                                'label' => 'Pending',
                                            ],
                                            'confirmed' => [
                                                'bg' => 'bg-blue-50',
                                                'text' => 'text-blue-700',
                                                'border' => 'border-blue-100',
                                                'label' => 'Dikonfirmasi',
                                            ],
                                            'processing' => [
                                                'bg' => 'bg-purple-50',
                                                'text' => 'text-purple-700',
                                                'border' => 'border-purple-100',
                                                'label' => 'Diproses',
                                            ],
                                            'shipped' => [
                                                'bg' => 'bg-indigo-50',
                                                'text' => 'text-indigo-700',
                                                'border' => 'border-indigo-100',
                                                'label' => 'Dikirim',
                                            ],
                                            'completed' => [
                                                'bg' => 'bg-emerald-50',
                                                'text' => 'text-emerald-700',
                                                'border' => 'border-emerald-100',
                                                'label' => 'Selesai',
                                            ],
                                            'cancelled' => [
                                                'bg' => 'bg-rose-50',
                                                'text' => 'text-rose-700',
                                                'border' => 'border-rose-100',
                                                'label' => 'Dibatalkan',
                                            ],
                                        ];
                                        $config = $statusConfig[$order->status] ?? $statusConfig['pending'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest border {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }}">
                                        {{ $config['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button onclick='openDetailModal(@json($order->load('merchandise')))'
                                            class="p-1.5 text-slate-400 hover:text-slate-900 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>
                                        <button onclick='openStatusModal({{ $order->id }}, "{{ $order->status }}")'
                                            class="p-1.5 text-slate-400 hover:text-blue-600 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Update Status">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button
                                            onclick="confirmDelete({{ $order->id }}, '{{ $order->customer_name }}')"
                                            class="p-1.5 text-slate-400 hover:text-rose-600 rounded-md hover:bg-slate-100 transition-colors"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-400 italic">Belum ada pesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detail-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div id="detail-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeDetailModal()"></div>
        <div id="detail-content"
            class="relative bg-white w-full max-w-2xl rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Detail Pesanan</h3>
                <button onclick="closeDetailModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <!-- Product Info -->
                <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-lg border border-slate-200">
                    <div class="w-20 h-20 rounded-lg bg-white border border-slate-200 overflow-hidden flex-shrink-0">
                        <img id="d-product-image" src="" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <h4 id="d-product-name" class="font-bold text-slate-900 mb-1"></h4>
                        <div class="flex items-center gap-3 text-sm text-slate-600">
                            <span>Jumlah: <strong id="d-quantity"></strong></span>
                            <span id="d-size-container" class="hidden">Ukuran: <strong id="d-size"></strong></span>
                        </div>
                        <p id="d-total-price" class="text-lg font-bold text-primary mt-2"></p>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Pembeli</p>
                        <p id="d-customer-name" class="font-medium text-slate-900"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</p>
                        <p id="d-customer-email" class="font-medium text-slate-900"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">No. WhatsApp</p>
                        <p id="d-customer-phone" class="font-medium text-slate-900"></p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Pesanan</p>
                        <p id="d-created-at" class="font-medium text-slate-900"></p>
                    </div>
                </div>

                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Alamat Pengiriman</p>
                    <p id="d-customer-address" class="font-medium text-slate-900 leading-relaxed"></p>
                </div>

                <div id="d-notes-container" class="space-y-1 hidden">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Catatan</p>
                    <p id="d-notes" class="font-medium text-slate-600 italic leading-relaxed"></p>
                </div>

                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</p>
                    <div id="d-status-badge"></div>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                <a id="d-whatsapp-link" href="#" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition-colors">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Hubungi via WhatsApp
                </a>
                <button onclick="closeDetailModal()"
                    class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-100 rounded-md transition-colors">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="status-modal-root" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div id="status-overlay" class="fixed inset-0 bg-slate-950/20 opacity-0 transition-opacity duration-200"
            onclick="closeStatusModal()"></div>
        <div id="status-content"
            class="relative bg-white w-full max-w-md rounded-lg shadow-xl translate-y-4 opacity-0 transition-all duration-200 border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-semibold text-slate-900">Update Status Pesanan</h3>
                <button onclick="closeStatusModal()" class="p-1 text-slate-400 hover:text-slate-900 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <form id="status-form" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Status Pesanan</label>
                    <select name="status" id="f-status" required
                        class="w-full px-3 py-2 border border-slate-200 rounded-md text-sm bg-white focus:ring-2 focus:ring-slate-900/5 transition-all">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Dikonfirmasi</option>
                        <option value="processing">Diproses</option>
                        <option value="shipped">Dikirim</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" onclick="closeStatusModal()"
                        class="px-4 py-2 text-slate-600 text-sm font-medium hover:bg-slate-50 rounded-md transition-colors">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-slate-50 rounded-md text-sm font-medium hover:bg-slate-800 transition-colors shadow-sm active:scale-95">Update
                        Status</button>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-form" action="" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function filterTable() {
            const input = document.getElementById("search");
            const filter = input.value.toUpperCase();
            const rows = document.getElementsByClassName("order-row");

            for (let i = 0; i < rows.length; i++) {
                const customer = rows[i].getElementsByClassName("search-customer")[0].innerText.toUpperCase();
                const product = rows[i].getElementsByClassName("search-product")[0].innerText.toUpperCase();
                rows[i].style.display = (customer.includes(filter) || product.includes(filter)) ? "" : "none";
            }
        }

        // Detail Modal
        const detailModalRoot = document.getElementById('detail-modal-root');
        const detailOverlay = document.getElementById('detail-overlay');
        const detailContent = document.getElementById('detail-content');

        function openDetailModal(order) {
            document.getElementById('d-product-name').innerText = order.merchandise.name;
            document.getElementById('d-quantity').innerText = order.quantity;
            document.getElementById('d-total-price').innerText =
                `Rp ${new Intl.NumberFormat('id-ID').format(order.total_price)}`;
            document.getElementById('d-customer-name').innerText = order.customer_name;
            document.getElementById('d-customer-email').innerText = order.customer_email;
            document.getElementById('d-customer-phone').innerText = order.customer_phone;
            document.getElementById('d-customer-address').innerText = order.customer_address;
            document.getElementById('d-created-at').innerText = new Date(order.created_at).toLocaleString('id-ID');

            if (order.merchandise.image) {
                document.getElementById('d-product-image').src = `/storage/${order.merchandise.image}`;
            }

            if (order.size) {
                document.getElementById('d-size').innerText = order.size;
                document.getElementById('d-size-container').classList.remove('hidden');
            } else {
                document.getElementById('d-size-container').classList.add('hidden');
            }

            if (order.notes) {
                document.getElementById('d-notes').innerText = order.notes;
                document.getElementById('d-notes-container').classList.remove('hidden');
            } else {
                document.getElementById('d-notes-container').classList.add('hidden');
            }

            const statusConfig = {
                'pending': {
                    bg: 'bg-amber-50',
                    text: 'text-amber-700',
                    border: 'border-amber-100',
                    label: 'Pending'
                },
                'confirmed': {
                    bg: 'bg-blue-50',
                    text: 'text-blue-700',
                    border: 'border-blue-100',
                    label: 'Dikonfirmasi'
                },
                'processing': {
                    bg: 'bg-purple-50',
                    text: 'text-purple-700',
                    border: 'border-purple-100',
                    label: 'Diproses'
                },
                'shipped': {
                    bg: 'bg-indigo-50',
                    text: 'text-indigo-700',
                    border: 'border-indigo-100',
                    label: 'Dikirim'
                },
                'completed': {
                    bg: 'bg-emerald-50',
                    text: 'text-emerald-700',
                    border: 'border-emerald-100',
                    label: 'Selesai'
                },
                'cancelled': {
                    bg: 'bg-rose-50',
                    text: 'text-rose-700',
                    border: 'border-rose-100',
                    label: 'Dibatalkan'
                }
            };
            const config = statusConfig[order.status] || statusConfig['pending'];
            document.getElementById('d-status-badge').innerHTML =
                `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest border ${config.bg} ${config.text} ${config.border}">${config.label}</span>`;

            const waMessage = encodeURIComponent(
                `Halo ${order.customer_name}, terima kasih telah memesan ${order.merchandise.name} dari HMIF ITATS!`);
            document.getElementById('d-whatsapp-link').href =
                `https://wa.me/${order.customer_phone.replace(/^0/, '62')}?text=${waMessage}`;

            detailModalRoot.classList.remove('hidden');
            detailModalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                detailOverlay.classList.replace('opacity-0', 'opacity-100');
                detailContent.classList.remove('translate-y-4', 'opacity-0');
                detailContent.classList.add('translate-y-0', 'opacity-100');
            }, 10);
        }

        function closeDetailModal() {
            detailOverlay.classList.replace('opacity-100', 'opacity-0');
            detailContent.classList.replace('translate-y-0', 'opacity-100');
            detailContent.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => {
                detailModalRoot.classList.replace('flex', 'hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        // Status Modal
        const statusModalRoot = document.getElementById('status-modal-root');
        const statusOverlay = document.getElementById('status-overlay');
        const statusContent = document.getElementById('status-content');

        function openStatusModal(orderId, currentStatus) {
            const form = document.getElementById('status-form');
            form.action = `/admin/merchandise-orders/${orderId}/status`;
            document.getElementById('f-status').value = currentStatus;

            statusModalRoot.classList.remove('hidden');
            statusModalRoot.classList.add('flex');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                statusOverlay.classList.replace('opacity-0', 'opacity-100');
                statusContent.classList.remove('translate-y-4', 'opacity-0');
                statusContent.classList.add('translate-y-0', 'opacity-100');
            }, 10);
        }

        function closeStatusModal() {
            statusOverlay.classList.replace('opacity-100', 'opacity-0');
            statusContent.classList.replace('translate-y-0', 'opacity-100');
            statusContent.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => {
                statusModalRoot.classList.replace('flex', 'hidden');
                document.body.style.overflow = 'auto';
            }, 200);
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus pesanan?',
                text: `Pesanan dari "${name}" akan dihapus permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0f172a',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-lg border border-slate-200 shadow-xl',
                    confirmButton: 'px-4 py-2 rounded-md font-medium text-sm',
                    cancelButton: 'px-4 py-2 rounded-md font-medium text-sm text-slate-600'
                }
            }).then((r) => {
                if (r.isConfirmed) {
                    const form = document.getElementById('delete-form');
                    form.action = `/admin/merchandise-orders/${id}`;
                    form.submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded-md border border-slate-100 shadow-lg'
                }
            });
        @endif
    </script>
@endsection
