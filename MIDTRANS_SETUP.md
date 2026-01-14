# Setup Midtrans Payment Gateway

Panduan ini menjelaskan cara mengintegrasikan sistem pembayaran Midtrans ke dalam aplikasi Point of Sale.

## Langkah 1: Mendaftar Akun Midtrans

1. Kunjungi [https://dashboard.midtrans.com/register](https://dashboard.midtrans.com/register)
2. Daftar akun baru atau login jika sudah memiliki akun
3. Verifikasi email dan lengkapi profil merchant

## Langkah 2: Mendapatkan API Keys

1. Login ke [Midtrans Dashboard](https://dashboard.midtrans.com/)
2. Pilih environment **Sandbox** untuk testing
3. Pergi ke **Settings** > **Access Keys**
4. Copy **Server Key** dan **Client Key**

## Langkah 3: Konfigurasi API Keys

1. Buka file `app/Config/Midtrans.php`
2. Ganti placeholder dengan API keys yang sudah didapat:

```php
// Untuk Sandbox/Testing
public $serverKey = 'SB-Mid-server-YOUR_ACTUAL_SERVER_KEY';
public $clientKey = 'SB-Mid-client-YOUR_ACTUAL_CLIENT_KEY';
public $isProduction = false;
```

## Langkah 4: Testing Pembayaran

### Kartu Kredit Testing
- **Visa**: 4811 1111 1111 1114
- **Mastercard**: 5211 1111 1111 1117
- **CVV**: 123
- **Exp Date**: 12/25

### E-Wallet Testing
- **GoPay**: Gunakan nomor HP apapun
- **OVO**: Gunakan nomor HP apapun
- **DANA**: Gunakan nomor HP apapun

### Bank Transfer Testing
- **BCA**: Akan generate nomor VA otomatis
- **BNI**: Akan generate nomor VA otomatis
- **Mandiri**: Akan generate kode bayar otomatis

## Langkah 5: Webhook/Notification Handler

Sistem sudah dilengkapi dengan notification handler di:
- **URL**: `{base_url}/payment/notification`
- **Method**: POST

Pastikan URL ini dapat diakses dari internet untuk menerima notifikasi status pembayaran.

## Langkah 6: Production Setup

Ketika siap untuk production:

1. Ganti ke environment **Production** di Midtrans Dashboard
2. Dapatkan Production API Keys
3. Update konfigurasi di `app/Config/Midtrans.php`:

```php
// Untuk Production
public $serverKey = 'Mid-server-YOUR_PRODUCTION_SERVER_KEY';
public $clientKey = 'Mid-client-YOUR_PRODUCTION_CLIENT_KEY';
public $isProduction = true;
```

## Fitur yang Tersedia

- ✅ Snap Payment (Popup)
- ✅ Multiple Payment Methods (Credit Card, E-Wallet, Bank Transfer)
- ✅ Transaction Status Handling
- ✅ Notification/Webhook Handler
- ✅ 3D Secure untuk Credit Card
- ✅ Automatic Order Saving setelah Payment Success

## Troubleshooting

### Error: "Snap token is not valid"
- Pastikan Server Key sudah benar
- Pastikan environment (sandbox/production) sudah sesuai

### Error: "snap.pay is not a function"
- Pastikan Snap JS sudah ter-load dengan benar
- Periksa Client Key di konfigurasi

### Pembayaran berhasil tapi pesanan tidak tersimpan
- Periksa notification handler di `/payment/notification`
- Pastikan webhook URL dapat diakses dari internet

## Support

Untuk bantuan lebih lanjut:
- [Midtrans Documentation](https://docs.midtrans.com/)
- [Midtrans Support](https://support.midtrans.com/)