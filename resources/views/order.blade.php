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
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-2 text-[#BDB5A4]">Ikutan jadi Tim Tester Rasa Kopi Baru Kami!</h1>
            <p class="text-center mb-8">Dapatkan kopi gratis</p>

            @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6 text-center">{{ session('error') }}</div>
            @endif

            <form action="/order" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama (boleh samaran)</label>
                    <input type="text" name="nama_pemesan" required class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-[#BDB5A4]">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Lokasi (cth: Jakarta Barat, Bandung)</label>
                    <input type="text" name="lokasi" required class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-[#BDB5A4]">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Username Instagram (opsional)</label>
                    <input type="text" name="username_ig" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-[#BDB5A4]">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Nomor WhatsApp (opsional)</label>
                    <input type="text" name="no_whatsapp" class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-[#BDB5A4]">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Pilih Menu Kopi</label>
                    <select name="menu_id" required class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-[#BDB5A4]">
                        @foreach($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="setuju_feedback" required class="mr-2">
                    <label class="text-sm">Saya bersedia kasih feedback jujur setelah nyobain</label>
                </div>
                <button type="submit" class="bg-[#BDB5A4] text-white px-6 py-3 rounded w-full font-semibold hover:bg-[#a79c8d] transition">Kirim Form Tester</button>
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