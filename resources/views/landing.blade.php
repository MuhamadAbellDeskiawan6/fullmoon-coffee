<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Fullmoon Coffee</title>
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
            <a href="/order" class="bg-white text-[#BDB5A4] px-4 py-2 rounded shadow font-semibold hover:bg-gray-100 transition">Pesan Gratis</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="text-center py-24 bg-gradient-to-b from-[#BDB5A4] to-[#a79c8d] text-white relative overflow-hidden">
        <!-- Decorative moon icons -->
        <svg xmlns="http://www.w3.org/2000/svg" class="absolute top-8 left-8 h-12 w-12 opacity-30 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 0 1 12.21 3a7 7 0 1 0 8.79 9.79z" />
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" class="absolute top-20 right-20 h-20 w-20 opacity-20 animate-bounce" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 0 1 12.21 3a7 7 0 1 0 8.79 9.79z" />
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" class="absolute bottom-10 left-20 h-16 w-16 opacity-25 animate-spin-slow" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 0 1 12.21 3a7 7 0 1 0 8.79 9.79z" />
        </svg>

        <!-- Custom slow spin animation -->
        <style>
            .animate-spin-slow {
                animation: spin 8s linear infinite;
            }

            @keyframes spin {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(360deg);
                }
            }
        </style>

        <div class="max-w-xl mx-auto px-4 relative z-10">
            <h1 class="text-5xl md:text-6xl font-bold mb-4">Nikmati Kopi Gratismu</h1>
            <p class="mb-6 text-lg">Buat story kata-kata tentang bulan dan tag <span class="font-semibold">@fullmoon</span> untuk menikmati kopi spesial kami hari ini.</p>
            <a href="/order" class="inline-flex items-center bg-white text-[#BDB5A4] px-6 py-3 rounded shadow font-semibold hover:bg-gray-100 transition">
                Pesan Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Menu Section -->
    <section class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Menu Kopi Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 justify-center">
            @foreach($menus as $menu)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:scale-105 transform transition w-full max-w-xs mx-auto">
                <img src="{{ asset('storage/'.$menu->foto) }}" alt="{{ $menu->nama }}" class="w-full h-48 object-cover" />
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2">{{ $menu->nama }}</h3>
                    <p class="text-gray-600 text-sm">{{ $menu->deskripsi }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 text-center max-w-2xl">
            <h2 class="text-3xl font-bold mb-6">Tentang Fullmoon</h2>
            <p class="text-gray-700 mb-6">Fullmoon Coffee lahir dari kisah seseorang bernama Purnama, yang memberi inspirasi tentang kehangatan, ketenangan, dan keindahan di balik setiap malam. Kami percaya setiap kopi memiliki cerita, sama seperti setiap bulan yang bersinar di waktunya.</p>
            <div class="flex justify-center space-x-4">
                <a href="https://www.instagram.com/fullmooncoffee.id?igsh=NzhpaTQyZHA5dHp5&utm_source=qr" target="_blank" class="hover:text-[#BDB5A4] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5Zm4.25 3.25a5.25 5.25 0 1 1 0 10.5a5.25 5.25 0 0 1 0-10.5Zm0 1.5a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5Zm4.38-.88a1.13 1.13 0 1 1 0 2.26a1.13 1.13 0 0 1 0-2.26Z" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#BDB5A4] text-white py-8 mt-12">
        <div class="text-center text-sm">&copy; 2025 Fullmoon Coffee | IG: @fullmooncoffe.id</div>
    </footer>
</body>

</html>