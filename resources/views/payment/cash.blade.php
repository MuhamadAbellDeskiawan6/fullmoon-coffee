<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Cash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F8F8] text-gray-800">
    <div class="container mx-auto px-4 py-8">
        @if($order->status === 'diproses')
        <script>
            window.location.href = "{{ route('order.success', ['method' => 'cash', 'id' => $order->id]) }}";
        </script>
        @endif

        <h1 class="text-2xl font-bold mb-6">Pembayaran dengan Cash</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4">Silakan lakukan pembayaran secara tunai di kasir.</p>
            <p class="text-gray-600">Pesanan Anda akan diproses setelah pembayaran selesai.</p>
            
            <div class="mt-4">
                <span class="font-semibold">Atas Nama:</span>
                <span class="text-gray-800 font-mono">{{ $order->nama_pemesan }}</span>
            </div>
            <div class="mt-4">
                <span class="font-semibold">ID Transaksi:</span>
                <span class="text-gray-800 font-mono">{{ $order->id }}</span>
            </div>

            <div class="mt-4">
                <span class="font-semibold">Status saat ini:</span>
                <span class="text-blue-600">{{ ucfirst($order->status) }}</span>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('landing') }}" class="bg-[#BDB5A4] text-white px-4 py-2 rounded">Kembali ke Beranda</a>
        </div>
    </div>
</body>

</html>