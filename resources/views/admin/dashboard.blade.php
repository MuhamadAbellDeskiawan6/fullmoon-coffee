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
                    <th class="py-2 px-4 text-left">Menu</th>
                    <th class="py-2 px-4 text-left">Jumlah</th>
                    <th class="px-4 py-2">Pembayaran</th>
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $order->menu->nama }}</td>
                    <td class="py-2 px-4">{{ $order->jumlah }}</td>
                    <td class="px-4 py-2">{{ ucfirst($order->payment) }}</td>
                    <td class="py-2 px-4">
                        @php
                        $statusColors = [
                        'menunggu' => 'text-yellow-600',
                        'diproses' => 'text-blue-600',
                        'selesai' => 'text-green-600',
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
                                <option value="menunggu" {{ $order->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
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