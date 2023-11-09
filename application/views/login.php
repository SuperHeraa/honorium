<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Honorium | LOGIN</title>
	<link rel="shortcut icon" href="<?= base_url('assets/') ?>images/logos/favicon.ico" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/styles.min.css" />
	<style>
		body {
			background-color: black !important;
		}
	</style>
</head>

<body>
	<!--  Body Wrapper -->
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
		<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
			<div class="d-flex align-items-center justify-content-center w-100">
				<div class="row justify-content-center w-100">
					<div class="col-md-6 col-lg-4 col-xxl-4">
						<div class="card mb-0">
							<div class="card-body">
								<a href="<?= base_url('welcome') ?>" class="text-nowrap logo-img text-center d-block py-3 w-100">
									<img src="<?= base_url('assets/') ?>images/logos/honorium-logo.png" width="180" alt="">
								</a>
								<form action="<?= base_url('welcome') ?>" method="POST">
									<?= $this->session->flashdata('message') ?>
									<div class="mb-3">
										<label for="exampleInputEmail1" class="form-label">Username</label>
										<input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" value="<?= isset($_COOKIE['userId']) ? $_COOKIE['userId'] : '' ?>">
										<?= form_error('username', '<div class="text-small text-danger">', '</div>') ?>
									</div>
									<div class="mb-4">
										<label for="exampleInputPassword1" class="form-label">Password</label>
										<input type="password" name="password" class="form-control pw" id="exampleInputPassword1" placeholder="Password" value="<?= isset($_COOKIE['userPass']) ? $_COOKIE['userPass'] : '' ?>">
										<?= form_error('password', '<div class="text-small text-danger">', '</div>') ?>
									</div>
									<div class="form-check form-switch mb-3">
										<input class="form-check-input border-dark swpass" type="checkbox">
										<label class="form-check-label" for="flexSwitchCheckChecked">Lihat Password</label>
									</div>
									<div class="form-check mb-3">
										<input class="form-check-input primary" name="remember_me" type="checkbox" <?= isset($_COOKIE['userId']) ? 'checked' : '' ?>>
										<label class="form-check-label text-dark" for="flexCheckChecked">
											Ingat Saya
										</label>
									</div>
									<button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">LOGIN</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url('assets/') ?>libs/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url('assets/') ?>libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		$(document).ready(function(e) {

			$(".swpass").click(function() {
				if ($(this).is(':checked')) {
					$(".pw").attr('type', 'text');
				} else {
					$(".pw").attr('type', 'password');
				}
			})

		});
	</script>
</body>

</html>