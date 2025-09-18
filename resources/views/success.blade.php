<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil - Fullmoon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#BDB5A4] text-white flex items-center justify-center min-h-screen">

    <div class="text-center px-4">
        <img src="/images/fullmoon.png" class="w-24 mx-auto mb-6" alt="Fullmoon Logo">
        <h1 class="text-3xl font-bold mb-4">Terima Kasih!</h1>
        <p class="mb-4">
            Pesananmu telah kami terima
        </p>

        @if($method === 'cash')
        <p class="mb-6 font-semibold">Silakan bayar di kasir.</p>
        @elseif($method === 'qris')
        <p class="mb-6 font-semibold">Tampilkan bukti bayar di kasir.</p>
        @endif

        <a href="{{ route('landing') }}" class="bg-white text-[#BDB5A4] px-6 py-3 rounded font-semibold hover:bg-gray-100 transition">
            Kembali ke Beranda
        </a>
    </div>


</body>

</html>