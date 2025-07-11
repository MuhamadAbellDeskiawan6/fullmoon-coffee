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
    <section class="container mx-auto px-4 py-16">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-8 text-[#BDB5A4]">Form Pemesanan Kopi Gratis</h1>

            <div id="errorMessage" class="hidden bg-red-100 text-red-700 p-4 rounded mb-6 text-center"></div>

            <form id="orderForm" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_pemesan" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-[#BDB5A4]" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Menu Kopi</label>
                    <select name="menu" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-[#BDB5A4]" required>
                        <option value="Americano">Americano Ice</option>
                        <option value="GulaAren">Kopi Susu Gula Aren</option>
                        <option value="SpannishLatte">Spannish Latte</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Username Instagram</label>
                    <input type="text" name="username_ig" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-[#BDB5A4]" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Link Story Instagram</label>
                    <input type="url" name="link_story" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-[#BDB5A4]">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Nomor WhatsApp</label>
                    <input type="text" name="no_whatsapp" class="w-full border border-gray-300 px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-[#BDB5A4]" required>
                </div>

                <button type="submit" id="submitBtn" class="bg-[#BDB5A4] text-white px-6 py-3 rounded w-full font-semibold hover:bg-[#a79c8d] transition">Kirim Pesanan</button>
            </form>
        </div>
    </section>

    <!-- Script Submit & Batas Order -->
    <script>
        // Fungsi untuk format tanggal hari ini yyyy-mm-dd
        function todayDate() {
            const today = new Date();
            return today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');
        }

        const orderForm = document.getElementById('orderForm');
        const errorMessage = document.getElementById('errorMessage');
        const submitBtn = document.getElementById('submitBtn');

        // Cek localStorage saat halaman load
        const orderedDate = localStorage.getItem('orderedDate');
        if (orderedDate === todayDate()) {
            // Jika sudah order hari ini
            errorMessage.classList.remove('hidden');
            errorMessage.textContent = 'Maaf, Anda sudah memesan hari ini. Silakan pesan lagi besok.';
            orderForm.style.display = 'none';
        }

        orderForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const nama = document.querySelector('input[name="nama_pemesan"]').value;
            const menu = document.querySelector('select[name="menu"]').value;
            const ig = document.querySelector('input[name="username_ig"]').value;
            const link = document.querySelector('input[name="link_story"]').value;
            const wa = document.querySelector('input[name="no_whatsapp"]').value;

            const adminNumber = "62895402474500"; // GANTI dengan nomor adminmu
            const pesan = `Halo Admin Fullmoon Coffee!\n\nPesanan Baru:\nNama: ${nama}\nMenu: ${menu}\nIG: ${ig}\nWA: ${wa}\nLink Story: ${link}`;
            const url = `https://wa.me/${adminNumber}?text=${encodeURIComponent(pesan)}`;

            // Simpan tanggal hari ini ke localStorage
            localStorage.setItem('orderedDate', todayDate());

            // Buka WhatsApp di tab baru
            window.open(url, '_blank');

            // Redirect ke halaman success di tab sekarang
            window.location.href = '/success';
        });
    </script>

    <!-- Footer -->
    <footer class="bg-[#BDB5A4] text-white py-6 mt-12">
        <div class="text-center text-sm">
            &copy; 2025 Fullmoon Coffee | IG: @fullmoon
        </div>
    </footer>

</body>

</html>