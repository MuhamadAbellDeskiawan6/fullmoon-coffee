<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Menu - Fullmoon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F8F8] text-gray-800">
    @include('admin.layouts.navbar')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Kelola Menu Kopi</h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="/admin/menus/add" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow mb-8">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Menu</label>
                <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Harga (Rp)</label>
                <input type="number" name="harga" value="0" min="0" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Foto</label>
                <input type="file" name="foto" accept="image/*" class="w-full border px-3 py-2 rounded">
            </div>
            <button type="submit" class="bg-[#BDB5A4] text-white px-6 py-3 rounded font-semibold hover:bg-[#a79c8d] transition">Tambah Menu</button>
        </form>

        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-[#BDB5A4] text-white">
                    <th class="py-2 px-4 text-left">Nama</th>
                    <th class="py-2 px-4 text-left">Deskripsi</th>
                    <th class="py-2 px-4 text-left">Harga (Rp)</th>
                    <th class="py-2 px-4 text-left">Foto</th>
                    <th class="py-2 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $menu->nama }}</td>
                    <td class="py-2 px-4">{{ $menu->deskripsi }}</td>
                    <td class="py-2 px-4">Rp{{ number_format($menu->harga) }}</td>
                    <td class="py-2 px-4">
                        @if($menu->foto)
                        <img src="{{ asset('storage/'.$menu->foto) }}" alt="{{ $menu->nama }}" class="w-16 h-16 object-cover rounded">
                        @else
                        -
                        @endif
                    </td>

                    <td class="py-2 px-4">
                        <div class="flex space-x-2">
                            <a href="/admin/menus/{{ $menu->id }}/edit" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                            <form action="/admin/menus/{{ $menu->id }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-8">
            <a href="/admin" class="bg-[#BDB5A4] text-white px-4 py-2 rounded">Kembali ke Dashboard</a>
        </div>
    </div>


</body>

</html>