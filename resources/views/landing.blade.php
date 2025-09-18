<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Fullmoon Coffee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

</head>

<body class="bg-[#F8F8F8] text-gray-800">

    <!-- Background Music -->
    <audio id="bg-music" loop>
        <source src="/music/fullmoon.mp3" type="audio/mpeg">
        Browser kamu tidak mendukung audio.
    </audio>

    <!-- Music Player Floating Bottom -->
    <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2 
            bg-white text-[#BDB5A4] shadow-lg rounded-2xl px-4 py-3 
            flex items-center space-x-3 w-[280px] z-50">

        <!-- Play / Pause Button -->
        <button id="toggleMusic" onclick="toggleMusic()"
            class="p-2 rounded-full bg-[#BDB5A4] text-white">
            <svg id="playIcon" xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M5 9v6h4l5 5V4l-5 5H5z" />
            </svg>
            <svg id="pauseIcon" xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 hidden" fill="currentColor" viewBox="0 0 24 24">
                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
            </svg>
        </button>

        <!-- Song Info -->
        <div class="flex-1">
            <p class="text-sm font-semibold">Fullmoon Coffee</p>
            <p class="text-xs text-gray-500">Background Music</p>
        </div>

        <!-- Duration / Progress bar (optional) -->
        <div class="w-16 h-1 bg-gray-200 rounded-full overflow-hidden">
            <div id="musicProgress" class="h-full bg-[#BDB5A4]" style="width: 0%;"></div>
        </div>
    </div>


    <!-- Navbar -->
    <header class="bg-gradient-to-b from-[#BDB5A4] to-[#a79c8d] shadow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="/images/fullmoon.png" class="h-10" alt="Fullmoon Logo" />
                <span class="font-bold text-white text-xl">Fullmoon Coffee</span>
            </div>
            <a href="/order" class="bg-white text-[#BDB5A4] px-4 py-2 rounded shadow font-semibold hover:bg-gray-100 transition">Jadi Tester</a>
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
            <h1 class="text-5xl md:text-6xl font-bold mb-4">Ikutan jadi Tim Tester Kopi Kami!</h1>
            <p class="mb-6 text-lg">Isi form dengan lengkap dan dapatkan kopi gratis untuk 5 orang tercepat setiap harinya!</p>
            <a href="/order" class="inline-flex items-center bg-white text-[#BDB5A4] px-6 py-3 rounded shadow font-semibold hover:bg-gray-100 transition">
                Ikutan Jadi Tester
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L13.586 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>
    <!-- Photobooth Section -->
    <div class="text-center mt-10">
        <h2 id="frameTitle" class="text-3xl font-bold mb-6">Frame Fullmoon</h2>
        <button id="enableCameraBtn" class="bg-[#BDB5A4] text-white px-6 py-3 rounded shadow hover:bg-[#a79c8d] transition">
            Aktifkan Kamera
        </button>
    </div>

    <div id="photobooth" class="hidden">
        <section class="container mx-auto px-4 py-16 text-center">
            <h2 class="text-3xl font-bold mb-6">Frame Fullmoon</h2>

            <!-- Video preview -->
            <div class="relative inline-block w-[270px] h-[480px] md:w-[360px] md:h-[640px] bg-black rounded-lg overflow-hidden">
                <video id="video" autoplay playsinline class="w-full h-full object-cover"></video>
                <img id="captured-photo" class="absolute top-0 left-0 w-full h-full object-cover hidden" alt="Captured Photo">
                <img src="/images/fullmoon-frame.png" class="absolute top-0 left-0 w-full h-full object-cover pointer-events-none" alt="Fullmoon Frame">
            </div>

            <div class="mt-4 flex justify-center space-x-2">
                <button id="captureButton" onclick="takePhoto()" class="bg-[#BDB5A4] text-white px-4 py-2 rounded shadow hover:bg-[#a79c8d] transition">Ambil Foto</button>
                <button id="retakeButton" onclick="retakePhoto()" class="hidden bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Ambil Ulang</button>
                <button id="switchButton" onclick="switchCamera()" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">Ganti Kamera</button>
                <a id="downloadLink" class="hidden bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600 transition" download="fullmoon-story.png">Download Foto</a>
            </div>
        </section>
    </div>

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
    <!-- AI Kopi Chat -->
    <section class="bg-[#F3F3F3] py-12">
        <div class="container mx-auto px-4 text-center max-w-lg">
            <h2 class="text-2xl font-bold mb-4">Tanya AI Kopi</h2>
            <p class="text-sm text-gray-600 mb-6">Tanya rekomendasi kopi sesuai selera kamu!</p>

            <!-- Chat Box -->
            <div id="chatBox" class="bg-white rounded-lg shadow p-4 h-64 overflow-y-auto text-left mb-4">
                <div class="text-gray-500 text-sm">👋 Halo! Mau kopi yang segar, manis, atau strong?</div>
            </div>

            <!-- Input -->
            <div class="flex">
                <input id="userInput" type="text" placeholder="Contoh: Saya mau yang manis..."
                    class="flex-1 border rounded-l-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#BDB5A4]" />
                <button onclick="askCoffeeAI()"
                    class="bg-[#BDB5A4] text-white px-4 rounded-r-lg hover:bg-[#a79c8d] transition">Tanya</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#BDB5A4] text-white py-8 mt-12">
        <div class="text-center text-sm">&copy; 2025 Fullmoon Coffee | IG: @fullmooncoffe.id</div>
    </footer>
    <script>
        const chatBox = document.getElementById('chatBox');
        const userInput = document.getElementById('userInput');

        // Daftar menu kopi sederhana
        const coffeeMenus = [{
                name: "Americano - Es",
                type: ["strong", "pahit", "segar", "dingin"]
            },
            {
                name: "Kopi Susu Gula Aren - Es",
                type: ["manis", "creamy", "favorit", "gula"]
            },
            {
                name: "Spanish Latte - Es",
                type: ["manis", "rich", "lembut", "cream"]
            },
        ];

        // Fungsi AI kopi
        function askCoffeeAI() {
            const question = userInput.value.trim().toLowerCase();
            if (!question) return;

            // Tampilkan pertanyaan user
            addChat("🧑 Kamu", question);

            // Cari jawaban
            let answer = "Hmm, coba jelaskan lebih spesifik. Mau yang segar, manis, atau strong?";
            for (let menu of coffeeMenus) {
                if (menu.type.some(keyword => question.includes(keyword))) {
                    answer = `☕ Rekomendasi untukmu: <b>${menu.name}</b>`;
                    break;
                }
            }

            // Tampilkan jawaban AI
            setTimeout(() => addChat("🤖 AI Kopi", answer), 600);

            userInput.value = "";
        }

        function addChat(sender, message) {
            const div = document.createElement("div");
            div.classList.add("mb-2");
            div.innerHTML = `<span class="font-bold">${sender}:</span> <span class="text-gray-700">${message}</span>`;
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
        }
        const video = document.getElementById('video');
        const capturedPhoto = document.getElementById('captured-photo');
        const downloadLink = document.getElementById('downloadLink');
        const retakeButton = document.getElementById('retakeButton');
        const captureButton = document.getElementById('captureButton');

        let stream = null;
        let currentCamera = "user"; // default depan

        // Fungsi untuk mulai kamera
        function startCamera(facingMode) {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }

            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: facingMode
                    }
                })
                .then(s => {
                    stream = s;
                    video.srcObject = stream;
                    video.classList.remove('hidden');
                    capturedPhoto.classList.add('hidden');
                    downloadLink.classList.add('hidden');
                    retakeButton.classList.add('hidden');
                    captureButton.classList.remove('hidden');
                })
                .catch(err => {
                    console.log("Error accessing camera: ", err);
                    alert("Tidak dapat mengakses kamera. Pastikan izin kamera aktif.");
                });
        }

        function takePhoto() {
            const canvas = document.createElement('canvas');

            // Ambil proporsi video asli untuk mencegah stretch
            const videoAspectRatio = video.videoWidth / video.videoHeight;
            canvas.width = 1080;
            canvas.height = 1920;

            const ctx = canvas.getContext('2d');

            // Hitung posisi agar crop center tanpa stretch
            const desiredAspect = canvas.width / canvas.height;
            let sx, sy, sw, sh;

            if (videoAspectRatio > desiredAspect) {
                // Video lebih lebar
                sh = video.videoHeight;
                sw = sh * desiredAspect;
                sx = (video.videoWidth - sw) / 2;
                sy = 0;
            } else {
                // Video lebih tinggi
                sw = video.videoWidth;
                sh = sw / desiredAspect;
                sx = 0;
                sy = (video.videoHeight - sh) / 2;
            }

            ctx.drawImage(video, sx, sy, sw, sh, 0, 0, canvas.width, canvas.height);

            // Draw frame overlay
            const frame = new Image();
            frame.src = '/images/fullmoon-frame.png';
            frame.onload = () => {
                ctx.drawImage(frame, 0, 0, canvas.width, canvas.height);

                // Show captured photo preview
                const dataURL = canvas.toDataURL('image/png');
                capturedPhoto.src = dataURL;
                capturedPhoto.classList.remove('hidden');
                video.classList.add('hidden');

                // Enable download & retake button
                downloadLink.href = dataURL;
                downloadLink.classList.remove('hidden');
                retakeButton.classList.remove('hidden');
                captureButton.classList.add('hidden');
            };
        }

        function retakePhoto() {
            capturedPhoto.classList.add('hidden');
            video.classList.remove('hidden');
            downloadLink.classList.add('hidden');
            retakeButton.classList.add('hidden');
            captureButton.classList.remove('hidden');
        }

        function switchCamera() {
            currentCamera = (currentCamera === "user") ? "environment" : "user";
            startCamera(currentCamera);
        }
        const enableCameraBtn = document.getElementById('enableCameraBtn');
        const photoboothSection = document.getElementById('photobooth');

        enableCameraBtn.addEventListener('click', () => {
            // Tampilkan photobooth
            photoboothSection.classList.remove('hidden');
            enableCameraBtn.classList.add('hidden');

            // Sembunyikan judul di atas tombol
            document.getElementById('frameTitle').classList.add('hidden');

            // Mulai kamera
            startCamera(currentCamera);
        });
        const music = document.getElementById('bg-music');
        const progress = document.getElementById('musicProgress');

        function toggleMusic() {
            if (music.paused) {
                music.play();
                document.getElementById("playIcon").classList.add("hidden");
                document.getElementById("pauseIcon").classList.remove("hidden");
            } else {
                music.pause();
                document.getElementById("playIcon").classList.remove("hidden");
                document.getElementById("pauseIcon").classList.add("hidden");
            }
        }

        // Update progress bar
        music.ontimeupdate = () => {
            if (music.duration) {
                let percent = (music.currentTime / music.duration) * 100;
                progress.style.width = percent + "%";
            }
        };
    </script>
</body>

</html>