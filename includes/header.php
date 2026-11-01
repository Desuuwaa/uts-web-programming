<?php
$judulHalaman = $judulHalaman ?? 'Portofolio Informatika';
$title = $title ?? '../images/grape.ico';
?>

<!DOCTYPE html>
<html lang="id-ID">
  <head>
    <meta charset="UTF-8">
    <meta name="author" content="Dede Suwarman">
    <meta name="keyword" content="HTML, CSS, PHP">
    <meta name="description" content="Tugas UTS Web Programming Semester 3">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="<?= $title ?>">
    <link rel="stylesheet" href="css/style.css">
    
    <title>Dede Suwarman | Web Developer</title>
  </head>

  <body>
    <header class="site-header">
      <?php require __DIR__ . '/nav.php'; ?>
    </header>
    
    <main class="container php-page">