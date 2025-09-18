<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Pesan Kopi - Fullmoon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F8F8] text-gray-800">

    <!-- Navbar -->
    <header class="bg-gradient-to-b from-[#BDB5A4] to-[#a79c8d] shadow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="/images/fullmoon.png" class="h-10" alt="Fullmoon Logo" />
                <span class="font-bold text-white text-xl">Fullmoon Coffee</span>
            </div>
            <a href="/" class="bg-white text-[#BDB5A4] px-4 py-2 rounded shadow font-semibold hover:bg-gray-100 transition">Beranda</a>
        </div>
    </header>

    <!-- Form Section -->
    <!-- Form Section -->
    <section class="container mx-auto px-4 py-16">
        <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6">Pesan Kopi</h1>

            <form action="{{ route('order.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block mb-1 font-semibold">Pilih Menu</label>
                    <select name="menu_id" class="w-full border px-3 py-2 rounded">
                        @foreach($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->nama }} - Rp{{ number_format($menu->harga) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Jumlah</label>
                    <input type="number" name="jumlah" value="1" min="1" class="w-full border px-3 py-2 rounded">
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Metode Pembayaran</label>
                    <div class="flex gap-4">
                        <button type="submit" name="payment" value="qris" class="flex-1 bg-green-600 text-white py-2 rounded">QRIS</button>
                        <button type="submit" name="payment" value="cash" class="flex-1 bg-yellow-500 text-white py-2 rounded">Cash</button>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-[#BDB5A4] text-white py-6 mt-12">
        <div class="text-center text-sm">
            &copy; 2025 Fullmoon Coffee | IG: @fullmoon
        </div>
    </footer>

</body>

</html>