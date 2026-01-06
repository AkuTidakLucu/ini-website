# SCRIPT FINAL: Background Putih Bersih, Header/Footer Navy, Tombol Cyan

$layoutFiles = @(
    "app/Views/layout/app.php",
    "app/Views/member/layout/app.php",
    "app/Views/premium/layout/app.php"
)

# Definisi Palet Modern
$navy       = "#0F172A" # Untuk Header, Footer, Sidebar
$cyan       = "#06B6D4" # Untuk Tombol Utama & Aksen
$white      = "#FFFFFF" # Untuk Background Halaman
$textDark   = "#1E293B" # Untuk Teks utama agar tajam

foreach ($file in $layoutFiles) {
    if (Test-Path $file) {
        # Gunakan backup jika ada, jika tidak gunakan file asli
        $content = if (Test-Path "$file.backup") { Get-Content "$file.backup" -Raw } else { Get-Content $file -Raw }

        # 1. Pastikan Background Body kembali ke Putih
        $content = $content -replace 'background-color:\s*#[0-9A-Fa-f]{3,6}', "background-color: $white"
        $content = $content -replace 'bg-\[#[0-9A-Fa-f]{6}\]', "bg-white"

        # 2. Ubah Header & Footer menjadi Navy
        # Mencari tag yang mengandung kata 'header', 'navbar', atau 'footer'
        $content = $content -replace '(?i)(<nav[^>]*style="[^"]*)background-color:\s*#[0-9A-Fa-f]{3,6}', "`$1background-color: $navy"
        $content = $content -replace '(?i)(<footer[^>]*style="[^"]*)background-color:\s*#[0-9A-Fa-f]{3,6}', "`$1background-color: $navy"

        # 3. Ubah Tombol-tombol (Kuning/Hijau lama) menjadi Cyan
        $content = $content -replace '#FBC02D|#FFD700|#D4AF37|#0A5C36', $cyan

        # 4. Pastikan Teks di Background Putih menjadi Gelap (Navy)
        $content = $content -replace 'color:\s*#ffffff|color:\s*#FFFFFF', "color: $textDark"

        # 5. Khusus teks di dalam Navy (Header/Footer) harus tetap Putih
        # Kita tambahkan inline style manual untuk memastikan
        $content = $content -replace '(?i)(<nav[^>]*>)', "`$1<style>.navbar a, .navbar i { color: #ffffff !important; }</style>"
        $content = $content -replace '(?i)(<footer[^>]*>)', "`$1<style>footer p, footer a, footer i { color: #ffffff !important; }</style>"

        $content | Set-Content $file -NoNewline
        Write-Host "Update Selesai: $file sekarang memiliki background putih dan elemen Navy/Cyan." -ForegroundColor Green
    }
}
