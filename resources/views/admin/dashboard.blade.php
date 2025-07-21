<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Fullmoon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F8F8] text-gray-800">
    @include('admin.layouts.navbar')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Dashboard Pesanan</h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-[#BDB5A4] text-white">
                    <th class="py-2 px-4 text-left">Nama</th>
                    <th class="py-2 px-4 text-left">Lokasi</th>
                    <th class="py-2 px-4 text-left">Menu</th>
                    <th class="py-2 px-4 text-left">Username IG</th>
                    <th class="py-2 px-4 text-left">No WA</th>
                    <th class="py-2 px-4 text-left">Kontak</th>
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $order->nama_pemesan }}</td>
                    <td class="py-2 px-4">{{ $order->lokasi }}</td>
                    <td class="py-2 px-4">{{ $order->menu->nama }}</td>
                    <td class="py-2 px-4">{{ $order->username_ig ?? '-' }}</td>
                    <td class="py-2 px-4">{{ $order->no_whatsapp ?? '-' }}</td>
                    <td class="py-2 px-4">
                        @if($order->no_whatsapp)
                        <a href="https://wa.me/{{ $order->no_whatsapp }}?text=Halo%20{{ urlencode($order->nama_pemesan) }},%20terima%20kasih%20sudah%20ikut%20tester%20Fullmoon%20Coffee." target="_blank" class="bg-green-500 text-white px-3 py-1 rounded">Chat WA</a>
                        @else
                        <span class="text-gray-400">Tidak ada WA</span>
                        @endif
                    </td>
                    <td class="py-2 px-4">
                        @php
                        $statusColors = [
                        'pending' => 'text-yellow-600',
                        'approved' => 'text-blue-600',
                        'done' => 'text-green-600',
                        'rejected' => 'text-red-600',
                        ];
                        @endphp
                        <span class="{{ $statusColors[$order->status] ?? 'text-gray-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>

                    <td class="py-2 px-4">
                        <form action="/admin/order/{{ $order->id }}/status" method="POST" class="inline-block">
                            @csrf
                            <select name="status" class="border rounded px-2 py-1">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>

                            <button type="submit" class="ml-2 bg-[#BDB5A4] text-white px-3 py-1 rounded">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        <!-- Pagination links -->
        <div class="mt-6">
            {{ $orders->links('pagination::tailwind') }}
        </div>

        <div class="mt-8">
            <a href="/admin/menus" class="bg-[#BDB5A4] text-white px-4 py-2 rounded">Kelola Menu</a>
        </div>
    </div>

</body>

</html>