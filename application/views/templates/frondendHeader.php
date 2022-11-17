<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>SIKAPIDOR - SPK Pemilihan Program - <?= $title; ?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url(); ?>assets/frontend/img/favicon.png" rel="icon">
	<link href="<?= base_url(); ?>assets/frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url(); ?>assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/frontend/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/frontend/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/frontend/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/frontend/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/frontend/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/frontend/vendor/aos/aos.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="<?= base_url(); ?>assets/frontend/css/style.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/frontend/css/style2.css" rel="stylesheet">
</head>

<body>

	<!-- ======= Header ======= -->
		<?php if ($title == "Home") : ?>
			<header id="header" class="fixed-top ">
		<?php else : ?>
			<header id="header" class="fixed-top not-scrolled">
		<?php endif; ?>
		<div class="container d-flex align-items-center">

			<h1 class="logo mr-auto"><a href="<?= base_url(); ?>Pelayanan"><b>SIKAPIDOR</b></a></h1>

			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

			<nav class="nav-menu d-lg-block">
				<ul>
					<?php if ($title == "Home") : ?>
						<li class="active"><a href="<?= base_url(); ?>Pelayanan"><b>Beranda</b></a></li>
					<?php else : ?>
						<li><a href="<?= base_url(); ?>Pelayanan">Beranda</a></li>
					<?php endif; ?>

					<?php if ($title == "Pelayanan") : ?>
						<li class="active"><a href="<?= base_url(); ?>Pelayanan/Pelayanan"><b>Pelayanan</b></a></li>
					<?php else : ?>
						<li><a href="<?= base_url(); ?>Pelayanan/Pelayanan">Pelayanan</a></li>
					<?php endif; ?>

					<?php if ($title == "Tentang") : ?>
						<li class="active"><a href="<?= base_url(); ?>Pelayanan/Tentang"><b>Tentang</b></a></li>
					<?php else : ?>
						<li><a href="<?= base_url(); ?>Pelayanan/Tentang">Tentang</a></li>
					<?php endif; ?>
				</ul>
			</nav><!-- .nav-menu -->

			<a class="get-started-btn scrollto font-weight-bold text-white" data-toggle="modal" data-target="#tambahModal" data-id="" onclick=""><i class='bx bx-copy-alt'></i> Mulai</a>

		</div>
	</header><!-- End Header -->
