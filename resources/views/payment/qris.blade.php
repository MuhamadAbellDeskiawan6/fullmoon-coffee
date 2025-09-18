<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran QRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F8F8] text-gray-800">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Pembayaran via QRIS</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4 text-center">Silakan scan QR Code di bawah ini untuk menyelesaikan pembayaran:</p>

            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/qris.png') }}" alt="QRIS" class="max-w-[200px] h-auto rounded-xl">
            </div>

            <p class="text-center text-gray-600 mb-4">Setelah pembayaran berhasil, klik tombol selesai dibawah</p>

            <div class="text-center mb-4">
                <span class="font-semibold">Atas Nama:</span>
                <span class="text-gray-800 font-mono">{{ $order->nama_pemesan }}</span>
            </div>
            
            <div class="text-center mb-4">
                <span class="font-semibold">ID Transaksi:</span>
                <span class="text-gray-800 font-mono">{{ $order->id }}</span>
            </div>

            <form action="{{ route('payment.qris.done', ['id' => $order->id]) }}" method="POST" class="text-center">
                @csrf
                <button type="submit" class="bg-[#BDB5A4] text-white px-6 py-3 rounded font-semibold hover:bg-gray-700 transition">
                    Selesai Bayar
                </button>
            </form>

        </div>
    </div>
</body>

</html>