<?php
$nama = trim((string) ($_POST['nama'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$pesan = trim((string) ($_POST['pesan'] ?? ''));
$errors = [];
$berhasil = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($nama)) {
        $errors['nama'] = 'Nama wajib diisi.';
    }
    if (empty($email)) {
        $errors['email'] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email belum valid.';
    }
    if (empty($pesan)) {
        $errors['pesan'] = 'Pesan wajib diisi.';
    }

    if (empty($errors)) {
        $dataPesan = [
            'nama' => $nama,
            'email' => $email,
            'pesan' => $pesan,
            'waktu' => date('c'),
        ];
        $lokasiPesan = __DIR__ . '/data/pesan.json';
        $daftarPesan = [];
        if (is_file($lokasiPesan)) {
            $isiLama = file_get_contents($lokasiPesan);
            $daftarPesan = json_decode($isiLama ?: '[]', true) ?: [];
        }
        $daftarPesan[] = $dataPesan;
        if (file_put_contents($lokasiPesan, json_encode($daftarPesan, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX) === false) {
            $errors['umum'] = 'Pesan tidak dapat disimpan. Silakan coba lagi.';
        } else {
            $berhasil = true;
        }
    }
}

$namaAman = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
$emailAman = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$pesanAman = htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8');

$title = 'images/grape.ico';
require __DIR__ . '/includes/header.php';
?>
<section class="page-intro">
  <p class="eyebrow">Mari terhubung</p>
  <h1>Kontak</h1>
  <p>Punya pertanyaan atau ingin berdiskusi tentang proyek? Kirimkan pesan melalui formulir di bawah.</p>
</section>

<?php if ($berhasil): ?>
  <section class="success-card" aria-live="polite">
    <p class="eyebrow">Pesan terkirim</p>
    <h2>Terima kasih, <?= $namaAman ?>!</h2>
    <p>Pesanmu sudah diterima. Saya akan membalas melalui email <strong><?= $emailAman ?></strong>.</p>
    <p class="message-preview"><strong>Isi pesan:</strong> <?= $pesanAman ?></p>
    <a class="text-link" href="index.html">Kembali ke beranda <span aria-hidden="true">→</span></a>
  </section>
<?php else: ?>
  <?php if (isset($errors['umum'])): ?>
    <p class="notice notice-warning"><?= htmlspecialchars($errors['umum'], ENT_QUOTES, 'UTF-8') ?></p>
  <?php endif; ?>
  <form class="contact-form" method="post" action="kontak.php">
    <div class="form-field">
      <label for="nama">Nama</label>
      <input id="nama" name="nama" type="text" value="<?= $namaAman ?>" autocomplete="name" required>
      <?php if (isset($errors['nama'])): ?><small class="field-error"><?= htmlspecialchars($errors['nama'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div>
    <div class="form-field">
      <label for="email">Email</label>
      <input id="email" name="email" type="email" value="<?= $emailAman ?>" autocomplete="email" required>
      <?php if (isset($errors['email'])): ?><small class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div>
    <div class="form-field">
      <label for="pesan">Pesan</label>
      <textarea id="pesan" name="pesan" rows="6" required><?= $pesanAman ?></textarea>
      <?php if (isset($errors['pesan'])): ?><small class="field-error"><?= htmlspecialchars($errors['pesan'], ENT_QUOTES, 'UTF-8') ?></small><?php endif; ?>
    </div>
    <button class="button button-primary" type="submit">Kirim pesan</button>
  </form>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
