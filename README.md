# Proyek Akhir Tekweb
Cara download:
- Klik code, download as zip. Extract di suatu tempat nun jauh disana.

Cara njalankan projectnya:
- Install composer, pastikan composer sudah di add ke PATH. Utk cek, ketik `composer --version` di cmd, trs enter. Klo error, brarti blm ada di path. Klo udah keluar sesuatu, brarti sudah terinstall.
- Install php atau pakai phpnya XAMPP. Pathnya biasanya {FOLDER_XAMPP}/php. Pathnya itu bisa ditambah di environment variable PATH.
- Ketik `composer install` di cmd. Nanti dia akan download kebutuhan projectnya. Agak lama soalnya laravel gede.
- Pergi ke folder projectnya
- Untuk njalankan local server, bisa pake `php artisan serve`.

Untuk tambah ke environment variable, bisa search Environment Variable di searchnya Windows. Trs klik edit environment variables. Cari yang variablenya namanya PATH. Tambahkan path yang mau ditambahin disitu. Klo Windows 8 gk ada GUI utk addnya, bisa ke paling pojok stringnya, trs tambah `;` + path yang mau ditambah + `;`. Klik OK trs restart cmdnya.

Soon: .htaccess untuk bisa dijalankan di webserver Apache (XAMPP)