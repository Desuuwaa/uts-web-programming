<?php
/**
 * Daftar artikel dan proyek yang ditampilkan pada halaman PHP.
 *
 * @return array<int, array<string, string>>
 */
function ambilDataPortofolio(): array
{
    return [
        [
            'judul' => 'Perjalanan Belajar Informatika',
            'deskripsi' => 'Catatan tentang membangun fondasi pemrograman, algoritma, dan kebiasaan belajar yang konsisten.',
            'kategori' => 'Catatan',
            'tanggal' => '12 Januari 2026',
        ],
        [
            'judul' => 'Landing Page Kedai Kopi Lokal',
            'deskripsi' => 'Landing page responsif dengan fokus pada hierarki informasi, warna hangat, dan ajakan bertindak.',
            'kategori' => 'Web Development',
            'tanggal' => '28 Januari 2026',
        ],
        [
            'judul' => 'Landing Page Kedai Kopi Lokal',
            'deskripsi' => 'Landing page responsif dengan fokus pada hierarki informasi, warna hangat, dan ajakan bertindak.',
            'kategori' => 'Web Development',
            'tanggal' => '28 Januari 2026',
        ],
        [
            'judul' => 'Landing Page Kedai Kopi Lokal',
            'deskripsi' => 'Landing page responsif dengan fokus pada hierarki informasi, warna hangat, dan ajakan bertindak.',
            'kategori' => 'Web Development',
            'tanggal' => '28 Januari 2026',
        ],
        [
            'judul' => 'Aplikasi Catatan Tugas Kuliah',
            'deskripsi' => 'Konsep aplikasi sederhana untuk mencatat tugas, menentukan prioritas, dan memantau progres mingguan.',
            'kategori' => 'Produk Digital',
            'tanggal' => '10 Februari 2026',
        ],
        [
            'judul' => 'Dasar Pengolahan Data dengan PHP',
            'deskripsi' => 'Latihan membaca array, menyaring data, dan menampilkan informasi secara dinamis menggunakan PHP dasar.',
            'kategori' => 'PHP',
            'tanggal' => '22 Februari 2026',
        ],
        [
            'judul' => 'Eksperimen Desain Antarmuka',
            'deskripsi' => 'Eksplorasi membuat antarmuka yang memiliki kontras baik, ruang yang cukup, dan nyaman digunakan di ponsel.',
            'kategori' => 'UI Design',
            'tanggal' => '5 Maret 2026',
        ],
        [
            'judul' => 'Membuat Website yang Responsif',
            'deskripsi' => 'Pembelajaran flexbox dan media query untuk memastikan tampilan website tetap rapi pada berbagai ukuran layar.',
            'kategori' => 'CSS',
            'tanggal' => '18 Maret 2026',
        ],
    ];
}

/**
 * Mencari artikel berdasarkan judul atau deskripsi secara case-insensitive.
 */
function cariArtikel(array $data, string $kata): array
{
    if ($kata === '') {
        return $data;
    }

    return array_values(array_filter($data, static function (array $item) use ($kata): bool {
        return stripos($item['judul'], $kata) !== false
            || stripos($item['deskripsi'], $kata) !== false
            || stripos($item['kategori'], $kata) !== false;
    }));
}

/**
 * Mengubah satu item data menjadi kartu HTML yang aman ditampilkan.
 */
function tampilkanKartu(array $item): string
{
    $judul = htmlspecialchars($item['judul'], ENT_QUOTES, 'UTF-8');
    $deskripsi = htmlspecialchars($item['deskripsi'], ENT_QUOTES, 'UTF-8');
    $kategori = htmlspecialchars($item['kategori'], ENT_QUOTES, 'UTF-8');
    $tanggal = htmlspecialchars($item['tanggal'], ENT_QUOTES, 'UTF-8');

    return <<<HTML
    <article class="result-card">
      <div class="result-meta"><span>{$kategori}</span><time>{$tanggal}</time></div>
      <h2>{$judul}</h2>
      <p>{$deskripsi}</p>
    </article>
    HTML;
}
