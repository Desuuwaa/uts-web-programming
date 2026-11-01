<?php
require_once __DIR__ . '/data.php';

$kataKunci = trim((string) ($_GET['q'] ?? ''));
$data = ambilDataPortofolio();
$hasilPencarian = cariArtikel($data, $kataKunci);
$jumlahPerHalaman = 3;
$halaman = max(1, (int) ($_GET['page'] ?? 1));
$totalHalaman = max(1, (int) ceil(count($hasilPencarian) / $jumlahPerHalaman));
$halaman = min($halaman, $totalHalaman);
$hasilHalaman = array_slice($hasilPencarian, ($halaman - 1) * $jumlahPerHalaman, $jumlahPerHalaman);
$kataAman = htmlspecialchars($kataKunci, ENT_QUOTES, 'UTF-8');

$title = 'images/grape.ico';
require __DIR__ . '/includes/header.php';
?>


<section class="page-intro">
  <p class="eyebrow">Eksplorasi</p>
  <h1>Cari artikel dan proyek</h1>
  <p>Temukan catatan belajar dan eksperimen berdasarkan kata kunci yang kamu masukkan.</p>
</section>

<form class="search-form search-form-wide" method="get" action="search.php">
  <label for="keyword">Kata kunci</label>
  <div class="search-row">
    <input id="keyword" name="q" type="search" value="<?= $kataAman ?>" placeholder="Contoh: web, data, desain">
    <button class="button button-primary" type="submit">Cari</button>
  </div>
</form>

<?php if ($kataKunci === ''): ?>
  <p class="notice">Masukkan kata kunci atau lihat seluruh daftar portofolio.</p>
<?php elseif (count($hasilPencarian) === 0): ?>
  <p class="notice notice-warning">Tidak ada hasil untuk kata kunci “<?= $kataAman ?>”. Coba gunakan kata kunci lain.</p>
<?php else: ?>
  <div class="results-heading">
    <h2>Hasil untuk “<?= $kataAman ?>”</h2>
    <span><?= count($hasilPencarian) ?> item</span>
  </div>
  <div class="results-grid">
    <?php foreach ($hasilHalaman as $item): ?>
      <?= tampilkanKartu($item) ?>
    <?php endforeach; ?>
  </div>
  <?php if ($totalHalaman > 1): ?>
    <nav class="pagination" aria-label="Pagination hasil pencarian">
      <?php for ($nomor = 1; $nomor <= $totalHalaman; $nomor++): ?>
        <a class="<?= $nomor === $halaman ? 'current' : '' ?>" href="?q=<?= urlencode($kataKunci) ?>&amp;page=<?= $nomor ?>"><?= $nomor ?></a>
      <?php endfor; ?>
    </nav>
  <?php endif; ?>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
