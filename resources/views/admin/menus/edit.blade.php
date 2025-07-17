<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Menu - Fullmoon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#F8F8F8] text-gray-800">
    @include('admin.layouts.navbar')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Menu Kopi</h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="/admin/menus/{{ $menu->id }}/update" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Menu</label>
                <input type="text" name="nama" value="{{ $menu->nama }}" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border px-3 py-2 rounded">{{ $menu->deskripsi }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Foto (biarkan kosong jika tidak diubah)</label>
                <input type="file" name="foto" accept="image/*" class="w-full border px-3 py-2 rounded">
                @if($menu->foto)
                <img src="{{ asset('storage/'.$menu->foto) }}" alt="{{ $menu->nama }}" class="w-24 h-24 object-cover mt-2 rounded">
                @endif
            </div>
            <button type="submit" class="bg-[#BDB5A4] text-white px-6 py-3 rounded font-semibold hover:bg-[#a79c8d] transition">Update Menu</button>
        </form>

        <div class="mt-8">
            <a href="/admin/menus" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </div>

</body>

</html>