<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>İletişim Formu Mesajı</title>
</head>

<body>
    <h1>İletişim Formu Mesajı</h1>
    <p>
        <strong>Ad Soyad:</strong> {{ $data['name'] }}
    </p>
    <p>
        <strong>E-posta:</strong> {{ $data['email'] }}
    </p>
    <p>
        <strong>Telefon:</strong> {{ $data['phone'] }}
    </p>
    <p>
        <strong>Mesaj:</strong>
        {{ $data['message'] }}
    </p>
</body>

</html>
