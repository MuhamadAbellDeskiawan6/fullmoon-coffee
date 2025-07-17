<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h1>Pesanan Baru Masuk</h1>
    <p>Nama Pemesan: {{ $order->nama_pemesan }}</p>
    <p>Menu: {{ $order->menu->nama }}</p>
    <p>Username IG: {{ $order->username_ig }}</p>
    <p>Nomor WhatsApp: {{ $order->no_whatsapp }}</p>
    <p>Link Story: {{ $order->link_story }}</p>
</body>

</html>