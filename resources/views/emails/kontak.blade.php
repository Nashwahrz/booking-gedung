<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Kontak</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            padding: 20px;
            color: #333;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .email-header {
            text-align: center;
            margin-bottom: 30px;
            color: #4a90e2;
        }
        .email-content p {
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .email-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2 class="email-header">📬 Pesan dari Form Kontak</h2>
        <div class="email-content">
            <p><strong>Nama:</strong> {{ $data['nama'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Pesan:</strong><br>{{ $data['pesan'] }}</p>
        </div>
        <div class="email-footer">
            Email ini dikirim otomatis dari sistem Booking Gedung.
            Silahkan Balas Pesan Email Di Atas
        </div>
    </div>
</body>
</html>
