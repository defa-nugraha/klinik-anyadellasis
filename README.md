# WEBSITE TRACKING PEMBAYARAN TANAH

_Role :_

-   Customer
-   Admin Keuangan
-   Super Admin

_Dashboard Customer_

1. Profil: nama, alamat, no hp, email (username), password
2. Riwayat pembelian: lokasi lahan, nomor lahan, harga lahan
3. Daftar angsuran: ref poin 2 (lokasi lahan, nomor lahan), nominal angsuran, tanggal jatuh tempo, total dp terbayar, total angsuran terbayar, sisa utang x angsuran, foto bukti pembayaran
4. Konfirmasi pembayaran angsuran: ref poin 3 (lokasi lahan, nomor lahan, nominal angsuran), angsuran ke ...., bukti pembayaran

_Dashboard Admin Keuangan_

1. Profil: nama, alamat, no hp, email (username), password
2. CRU Daftar customer: nama, alamat, no.hp, email (username), password
3. CRU Riwayat pembelian customer: ref poin 2 (email, nama, nomor hp), lokasi lahan, nomor lahan, harga lahan
4. CRU Daftar angsuran customer: ref poin 3 (email, nama customer, nomor hp, lokasi lahan, nomor lahan), nominal angsuran, tanggal jatuh tempo, total dp terbayar, total angsuran terbayar, sisa utang x angsuran, foto bukti pembayaran (digunakan utk create dan update pembayaran customer dengan notifikasi email secara otomatis 7 hari sebelum tanggal jatuh tempo dan setelah update pembayaran)
5. Tidak bisa delete data yang sudah diinput

_DASHBOARD SUPERADMIN_

1. CRUD user : menambahkan admin keuangan maupun customer
2. CRUD Properti :

-   Tanah : Kode tanah, Luas tanah, alamat, jenis sertifikat (bisa googling apa aja), dibeli oleh (nama customer), nama marketing (nama marketing)
-   Rumah : Kode rumah, Luas tanah, luas bangunan, alamat, jenis sertifikat (bisa googling apa aja), dibeli oleh (nama customer), nama marketing (nama marketing)

2. Bisa cek seluruh pembayaran customer
3. Bisa filter data by tanggal jatuh tempo, tanggal pembayaran terakhir, nama, dll
4. Bisa CRUD semua data
