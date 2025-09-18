<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran QRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Pembayaran via QRIS</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="mb-4">Silakan scan QR Code di bawah ini untuk menyelesaikan pembayaran:</p>

            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/qris.png') }}" alt="QRIS" class="w-64 h-64">
            </div>

            <p class="text-center text-gray-600">Setelah pembayaran berhasil, pesanan Anda akan diproses.</p>
        </div>
    </div>
</body>

</html>