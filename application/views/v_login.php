

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="logo text-center"><h1 class="heading">Login Siswa</h1></div>
							<form class="form-auth-small" action="<?=base_url()?>login/cek_login" method="" enctype="multipart/form-data">
								<div class="form-group">
									<label for="signup-email" class="control-label sr-only">Username</label>
									<input type="text" class="form-control" name="username" placeholder="Username" required="true">
								</div>
								<div class="form-group">
									<label for="signup-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="signup-password" name="password" placeholder="Password" required="true">
								</div>
								<?php $gagal = sha1('gagal');
									if ($this->input->get($gagal)==1): ?>
									<span style="color:rgb(255, 0, 41)">Anda Salah Masukan Password / Username</span>
									<?php endif; ?>
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label>
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
								<div class="bottom">
									<span><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Sistem Akademik</h1>
							<p>Kebutuhan Khusus</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
